<?php
if (! defined('_PS_VERSION_')) {
    die('No direct script access');
}

class ShopRunBackWebhookModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        echo $this->executeWebhook();
        exit;
    }

    private function executeWebhook()
    {
        SRBLogger::addLog('WEBHOOK CALLED');

        $webhook = file_get_contents("php://input");
        $webhook = json_decode($webhook);

        $type = isset($webhook->event) ? explode('.', $webhook->event)[0] : '';
        $id = isset($webhook->data->id) ? $webhook->data->id : '';

        if (!$type && !$id) {
            SRBLogger::addLog('WEBHOOK FAILED: NO TYPE AND NO ID! ' . json_encode($webhook), SRBLogger::FATAL);
            return self::returnHeaderHTTP(200);
        }
        if (!$type) {
            SRBLogger::addLog('WEBHOOK FAILED: TYPE IS MISSING! id: ' . $id, SRBLogger::FATAL);
            return self::returnHeaderHTTP(200);
        }
        if (!$id) {
            SRBLogger::addLog('WEBHOOK FAILED: ID IS MISSING! type: ' . $type, SRBLogger::FATAL);
            return self::returnHeaderHTTP(200);
        }

        if ($type == 'shipback') {
            SRBLogger::addLog('WEBHOOK IS SHIPBACK. id: ' . $id, SRBLogger::INFO, $type, $id);
            try {
                $item = SRBShipback::getById($id);
                $state = isset($webhook->data->state) ? $webhook->data->state : '';
                $mode = isset($webhook->data->mode) ? $webhook->data->mode : '';

                if (!$mode && !$state) {
                    SRBLogger::addLog('WEBHOOK SHIPBACK FAILED: NO MODE AND NO STATE!', SRBLogger::FATAL, $type, $id);
                    return self::returnHeaderHTTP(200);
                }
                if (!$mode) {
                    SRBLogger::addLog('WEBHOOK SHIPBACK FAILED: MODE IS MISSING! state: ' . $state, SRBLogger::FATAL, $type, $id);
                    return self::returnHeaderHTTP(200);
                }
                if (!$state) {
                    SRBLogger::addLog('WEBHOOK SHIPBACK FAILED: STATE IS MISSING! mode: ' . $mode, SRBLogger::FATAL, $type, $id);
                    return self::returnHeaderHTTP(200);
                }

                $item->state = $state;
                $item->mode = $mode;
                $item->updateOnPS();
            } catch (ShipbackException $e) {
                SRBLogger::addLog('WEBHOOK SHIPBACK FAILED: ' . $e, SRBLogger::FATAL, $type, $id);
                return self::returnHeaderHTTP(200);
            }
        } else {
            SRBLogger::addLog('WEBHOOK TYPE UNKNOWN: ' . $type, SRBLogger::ERROR, $type, $id);
            return self::returnHeaderHTTP(200);
        }

        SRBLogger::addLog('WEBHOOK WORKED', SRBLogger::INFO, $type, $id);
        return self::returnHeaderHTTP(200);
    }

    static private function returnHeaderHTTP($httpCode)
    {
        switch ($httpCode) {
            case 403:
                return header('HTTP/1.0 403 Forbidden');
                break;
            case 404:
                return header('HTTP/1.0 404 Not Found');
                break;
            case 200:
            default:
                return header('HTTP/1.0 200 OK');
                break;
        }
    }
}
