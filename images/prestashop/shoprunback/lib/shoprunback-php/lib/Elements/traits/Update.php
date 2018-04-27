<?php

namespace Shoprunback\Elements;

use Shoprunback\RestClient;

trait Update
{
    public static function update($element)
    {
        $element->put();
        return $element;
    }

    public function put()
    {
        $restClient = RestClient::getClient();
        $data = $this->getElementBody();
        $identifier = (isset($this->id) && $this->id != '') ? $this->id : $this->getReference();
        $response = $restClient->request(self::updateEndpoint($identifier), RestClient::PUT, $data);
        $this->copyValues($this->newFromMixed($response->getBody()));
    }
}
