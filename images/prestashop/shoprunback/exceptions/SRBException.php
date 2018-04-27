<?php

include_once _PS_MODULE_DIR_ . 'shoprunback/classes/SRBLogger.php';

class SRBException extends Exception
{
    public $message;
    public $errorCode;
    public $previous;
    public $prefix;

    public function __construct($message, $errorCode = 0, Exception $previous = null)
    {
        parent::__construct($message, $errorCode, $previous);

        $this->message = $message;
        $this->errorCode = $errorCode;
        $this->previous = $previous;

        $this->prefix = '[ShopRunBack]';

        SRBLogger::addLog($this->message, SRBLogger::FATAL);
    }

    public function __toString()
    {
        return $this->prefix . ' ' . __CLASS__ . ': [' . $this->errorCode . ']: ' . $this->message . '\n';
    }
}
