<?php

namespace Shoprunback\Elements;

use Shoprunback\RestClient;

trait Delete
{
    public static function delete($id)
    {
        $instance = new static($id);
        return $instance->remove();
    }

    public function remove()
    {
        $restClient = RestClient::getClient();
        $this->refresh();
        self::logCurrentClass('Log of the object before its removal: ' . json_encode($this->_origValues));
        $response = $restClient->request(self::deleteEndpoint($this->id), \Shoprunback\RestClient::DELETE);
    }
}
