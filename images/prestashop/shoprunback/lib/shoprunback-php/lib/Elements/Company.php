<?php

namespace Shoprunback\Elements;

use Shoprunback\RestClient;

class Company extends Element
{
    use Retrieve;
    use Update;

    public function __toString()
    {
        return $this->display($this->name);
    }

    public static function getBelongsTo()
    {
        return ['account'];
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'name',
            'slug',
            'address1',
            'address2',
            'zipcode',
            'state',
            'country_code',
            'contact_email',
            'website_url',
            'phone_number',
            'logo_url',
            'reasons'
        ];
    }

    public static function getBaseEndpoint()
    {
        return 'company';
    }

    public static function ownEndpoint()
    {
        return 'company';
    }

    public static function updateEndpoint($id)
    {
        return 'company';
    }

    public static function showEndpoint($id)
    {
        return 'companies/' . $id;
    }

    public static function getReferenceAttribute()
    {
        return 'id';
    }

    public static function getOwn()
    {
        $restClient = RestClient::getClient();

        try {
            $response = $restClient->request(self::ownEndpoint(), \Shoprunback\RestClient::GET);
        } catch(RestClientError $e) {
            self::logCurrentClass(json_encode($e));
            if ($e->response->getCode() == 404) {
                throw new NotFoundError('Not found');
            } else {
                throw $e;
            }
        }

        $company = new self();
        $company->copyValues($company->newFromMixed($response->getBody()));
        return $company;
    }
}