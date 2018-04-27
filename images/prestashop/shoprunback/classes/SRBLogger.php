<?php
class SRBLogger
{
    const INFO = 0;
    const WARNING = 1;
    const ERROR = 2;
    const FATAL = 3;
    const UNKNOWN = 4;

    static public function addLog($message, $severity = self::INFO, $objectType = null, $objectId = 0)
    {
        if (substr($message, 0, 13) !== '[ShopRunBack]') {
            $message = '[ShopRunBack] ' . $message;
        }

        Logger::addLog($message, $severity, null, $objectType, $objectId, true, null);
    }
}
