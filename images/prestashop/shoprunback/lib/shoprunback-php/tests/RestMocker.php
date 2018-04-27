<?php

namespace Tests;

use Shoprunback\Error\Error;
use Shoprunback\Error\UnknownApiToken;
use Shoprunback\Util\Logger;
use Shoprunback\RestClient;
use Shoprunback\RestResponse;
use Shoprunback\Util\Inflector;

class RestMocker
{
    public static function request($endpoint, $method = RestClient::GET, $body = [])
    {
        RestClient::verifyMethod($method);

        $explodedEndpoint = explode('?', $endpoint);
        if (count($explodedEndpoint) > 1) {
            $endpoint = $explodedEndpoint[0];
        }

        $action = strtolower($method);
        return self::$action($endpoint, $body);
    }

    private static function get($endpoint, $body)
    {
        $responseBody = self::getBody($endpoint, RestClient::GET);

        $response = new RestResponse();
        $response->setCode(200);
        $response->setBody($responseBody);

        return $response;
    }

    private static function put($endpoint, $body)
    {
        $responseBody = self::getBody($endpoint, RestClient::PUT);

        foreach ($body as $key => $value) {
            if (property_exists($responseBody, $key)) {
                $responseBody->$key = $value;
            }
        }

        $response = new RestResponse();
        $response->setCode(200);
        $response->setBody($responseBody);

        return $response;
    }

    private static function post($endpoint, $body)
    {
        $responseBody = self::getBody($endpoint, RestClient::POST);

        foreach ($body as $key => $value) {
            if (property_exists($responseBody, $key)) {
                $responseBody->$key = $value;
            }
        }

        $responseBody->id = rand();

        $response = new RestResponse();
        $response->setCode(200);
        $response->setBody($responseBody);

        return $response;
    }

    private static function delete($endpoint, $body)
    {
        $response = new RestResponse();
        $response->setCode(200);
        $response->setBody('');

        return $response;
    }

    private static function filePath($endpoint, $method)
    {
        if ($method == RestClient::POST) {
            $filename = Inflector::classify($endpoint);
        } else {
            $pathParts = explode('/', $endpoint);

            if (count($pathParts) % 2 == 0) {
                $filename = Inflector::classify($pathParts[count($pathParts) - 2]);
            } else {
                $filename = $pathParts[count($pathParts) - 1];
            }
        }

        return dirname(__FILE__) . '/data/' . strtolower($filename) . '.json';
    }

    private static function getBody($endpoint, $method, $body = [])
    {
        $filePath = self::filePath($endpoint, $method);

        return json_decode(file_get_contents($filePath,  FILE_USE_INCLUDE_PATH));
    }
}
