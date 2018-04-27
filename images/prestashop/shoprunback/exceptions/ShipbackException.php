<?php

include_once 'SRBException.php';

class ShipbackException extends SRBException
{
    public function __construct($message, $errorCode = 0, Exception $previous = null)
    {
        parent::__construct($message, $errorCode, $previous);
        SRBLogger::addLog($this->message, SRBLogger::FATAL, 'shipback');
    }

    public function __toString()
    {
        return $this->prefix . ' ' . __CLASS__ . ': [' . $this->errorCode . ']: ' . $this->message . '\n';
    }
}
