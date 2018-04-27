<?php

use Shoprunback\RestClient;
use Shoprunback\Elements\Account;
use Shoprunback\Elements\Company;

class AdminShoprunbackController extends ModuleAdminController
{
    const SUCCESS_CONFIG = 'success.config';
    const ERROR_NO_TOKEN = 'error.no_token';
    const ITEMS_BY_PAGE = 10;

    public $token;
    private $actionResult;

    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
        $this->token = isset($_GET['token']) ? $_GET['token'] : '';
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/srbGlobal.css');
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin/header.css');
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin/override.css');
        $this->addCSS('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        $this->actionResult = false;
        $this->tabUrl = Context::getContext()->link->getAdminLink('AdminShoprunback');

        if ($_GET && isset($_GET['action'])) {
            $function = $_GET['action'];
            $this->actionResult = $this->{$function}();
        }
    }

    private function handleConfig()
    {
        $srbtoken = Tools::getValue('srbtoken');

        if ($srbtoken == '') {
            return false;
        }

        $oldSrbToken = RestClient::getClient()->getToken();

        RestClient::getClient()->setToken($srbtoken);
        $user = Account::getOwn();
        if (!$user) {
            SRBLogger::addLog('Invalid API token: ' . $srbtoken, SRBLogger::WARNING, 'configuration');
            RestClient::getClient()->setToken($oldSrbToken);
            return self::ERROR_NO_TOKEN;
        }

        // If the user switches from a valid token to another valid token, the mapping table must be reset
        if ($oldSrbToken != '' && $oldSrbToken != RestClient::getClient()->getToken()) {
            ElementMapper::truncateTable();
            SRBShipback::truncateTable();
        }

        Configuration::updateValue('srbtoken', $srbtoken);
        SRBLogger::addLog('API token saved: ' . substr($srbtoken, 0, 3) . '...' . substr($srbtoken, -3), SRBLogger::INFO, 'configuration');

        $company = Company::getOwn();
        $company->webhook_url = $this->module->webhookUrl;
        $company->save();

        // If the user switches from production to sandbox mode (or the opposite), the mapping table must be reset
        $currentProductionMode = Configuration::get('production');
        if ($currentProductionMode != Tools::getValue('production')) {
            ElementMapper::truncateTable();
            SRBShipback::truncateTable();
        }

        // If the application goes to production mode, the PS returns' system must be turned off
        Configuration::updateValue('production', Tools::getValue('production'));
        if (Configuration::get('production') == 1) {
            Configuration::updateValue('PS_ORDER_RETURN', false);
        }

        SRBLogger::addLog('Sandbox mode: ' . Tools::getValue('production'), SRBLogger::INFO, 'configuration');

        return self::SUCCESS_CONFIG;
    }

    public function initContent()
    {
        $link = Context::getContext()->link;
        parent::initContent();

        $itemType = (isset($_GET['itemType'])) ? $_GET['itemType'] : '';
        $items = [];
        $template = 'srbManager';
        $message = '';
        $this->context->smarty->assign('itemType', $itemType);

        if ($itemType == 'config') {
            if (Tools::getValue('srbtoken')) {
                $message = $this->handleConfig();

                if ($message == self::ERROR_NO_TOKEN) {
                    $this->context->smarty->assign('messageType', 'danger');
                }
                if ($message == self::SUCCESS_CONFIG) {
                    $this->context->smarty->assign('messageType', 'success');
                }
            }

            $template = 'config';

            $this->getConfigFormValues();

            $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin/config.css');
        } else {
            $this->getItems($itemType);
        }

        $this->context->smarty->assign('srbtoken', RestClient::getClient()->getToken());
        $this->context->smarty->assign('shoprunbackURL', $this->module->url);
        $this->context->smarty->assign('shoprunbackURLProd', $this->module->urlProd);
        $this->context->smarty->assign('srbManager', $this->tabUrl);
        $this->context->smarty->assign('asyncCall', $this->tabUrl . '&action=asyncCall');
        $this->context->smarty->assign('link', $link);
        $this->context->smarty->assign('template', $template);
        $this->context->smarty->assign('message', $message);
        $this->setTemplate('../../../../modules/' . $this->module->name . '/views/templates/admin/layout.tpl');
    }

    private function getItems($itemType = 'return')
    {
        $externalLink = $this->module->url;
        $countItems = 0;
        $searchCondition = false;

        $currentPage = (isset($_GET['currentPage'])) ? $_GET['currentPage'] : 1;
        $class = 'SRBShipback';
        $function = 'getAllByCreateDate';

        switch ($itemType) {
            case 'return':
                $externalLink .= '/shipbacks/';
                $actionUrl = Context::getContext()->link->getAdminLink('AdminShoprunback') . '&itemType=return';
                $this->context->smarty->assign('actionUrl', $actionUrl);
                $this->context->smarty->assign('searchOrderReference', Tools::getValue('orderReference'));
                $this->context->smarty->assign('searchCustomer', Tools::getValue('customer'));

                if (Tools::getValue('orderReference') !== false) {
                    $searchCondition = 'orderReference';
                    $function = 'getLikeOrderReferenceByCreateDate';
                    $countItems = SRBShipback::getCountLikeOrderReferenceByCreateDate(Tools::getValue('orderReference'));
                } elseif (Tools::getValue('customer') !== false) {
                    $searchCondition = 'customer';
                    $function = 'getLikeCustomerByCreateDate';
                    $countItems = SRBShipback::getCountLikeCustomerByCreateDate(Tools::getValue('customer'));
                } else {
                    $countItems = SRBShipback::getCountAll();
                }
                break;
            case 'brand':
                $externalLink .= '/brands/';
                $countItems = SRBBrand::getCountAll();
                $class = 'SRBBrand';
                $function = 'getAllWithMapping';
                break;
            case 'product':
                $externalLink .= '/products/';
                $countItems = SRBProduct::getCountAll();
                $class = 'SRBProduct';
                $function = 'getAllWithMapping';
                break;
            case 'order':
                $externalLink .= '/orders/';
                $countItems = SRBOrder::getCountAll();
                $class = 'SRBOrder';
                $function = 'getAllWithMapping';
                break;
            default:
                Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminShoprunback') . '&itemType=return');
                break;
        }

        $pages = ceil($countItems / self::ITEMS_BY_PAGE);
        $currentPage = ($currentPage <= $pages) ? $currentPage : 1;
        $itemMin = ($currentPage - 1) * self::ITEMS_BY_PAGE;

        $items = $searchCondition ?
            $class::$function(Tools::getValue($searchCondition), false, self::ITEMS_BY_PAGE, $itemMin) :
            $class::$function(false, self::ITEMS_BY_PAGE, $itemMin);

        if ($itemType == 'product') {
            $noBrand = [];
            foreach ($items as $product) {
                if (is_null($product->brand)) {
                    $noBrand[] = $product->getDBId();
                }
            }

            $this->context->smarty->assign('noBrand', $noBrand);
        }

        $this->context->smarty->assign('pages', $pages);
        $this->context->smarty->assign('currentPage', $currentPage);
        $this->context->smarty->assign('items', $items);
        $this->context->smarty->assign('externalLink', $externalLink);
        $this->context->smarty->assign('searchCondition', $searchCondition);
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/admin/srbManager.js');
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin/srbManager.css');
    }

    private function getConfigFormValues()
    {
        $this->context->smarty->assign('PSOrderReturn', Configuration::get('PS_ORDER_RETURN'));
        $this->context->smarty->assign('formActionUrl', $this->tabUrl . '&itemType=config');
        $this->context->smarty->assign('production', Configuration::get('production'));
    }

    public function asyncCall()
    {
        require_once($this->module->SRBModulePath . '/asyncCall.php');
    }
}
