<?php

namespace Shoprunback\Elements;

use Shoprunback\RestClient;

class Account extends Element
{
    use Retrieve;
    use Update;

    private $company;

    public function __toString()
    {
        return $this->display($this->first_name . ' ' . $this->last_name);
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'company_id',
            'created_at',
            'owner',
            'pending',
            'manager',
            'auth_token'
        ];
    }

    public static function getBaseEndpoint()
    {
        return 'me';
    }

    public static function ownEndpoint()
    {
        return 'me';
    }

    public static function updateEndpoint($id)
    {
        return 'me';
    }

    public static function showEndpoint($id)
    {
        return 'users/' . $id;
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

        $user = new self();
        $user->copyValues($user->newFromMixed($response->getBody()));
        return $user;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getCompany()
    {
        return $this->company;
    }
}