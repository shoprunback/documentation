<?php

namespace Shoprunback\Error;

use Exception;
use \Shoprunback\Util\Logger;

class Error extends Exception
{
    public $message;
    public $httpStatus;

    public function __construct($message, $httpStatus = '')
    {
        parent::__construct($message);
        $this->httpStatus = $httpStatus;

        Logger::error('Error ' . $this->httpStatus . ': ' . $this->message);
    }
}