<?php

namespace Shoprunback\Error;

class RestClientError extends Error
{
    public function __construct($response)
    {
        $this->response = $response;
        parent::__construct(json_encode($response->getErrors()), $response->getCode());
    }
}