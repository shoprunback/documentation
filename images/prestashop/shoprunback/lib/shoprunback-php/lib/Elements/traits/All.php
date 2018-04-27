<?php

namespace Shoprunback\Elements;

use Shoprunback\ElementManager;
use Shoprunback\RestClient;
use Shoprunback\Util\Inflector;

trait All
{
    public static function all($page = 1)
    {
        $restClient = RestClient::getClient();
        $response = $restClient->request(self::indexEndpoint($page), \Shoprunback\RestClient::GET);

        return new ElementManager($response->getBody(), get_called_class());
    }
}
