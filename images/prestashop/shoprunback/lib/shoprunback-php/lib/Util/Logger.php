<?php

namespace Shoprunback\Util;

define('LOG_PATH', dirname(dirname(dirname(__FILE__))) . '/logs/');

class Logger
{
    const FILENAME_DATE_FORMAT = 'Y-m-d';
    const LINE_PREFIX_DATE_FORMAT = '[Y-m-d H:i:s]: ';
    const FILE_EXTENSION = '.txt';

    const INFO = 0;
    const ERROR = 1;

    static public function getFullPathToFile($dateToFormat = '', $logType = self::INFO)
    {
        $date = $dateToFormat ? date(self::FILENAME_DATE_FORMAT, $dateToFormat) : date(self::FILENAME_DATE_FORMAT);
        return LOG_PATH . $date . self::FILE_EXTENSION;
    }

    static private function createFile()
    {
        if (!file_exists(self::getFullPathToFile())) {
            fopen(self::getFullPathToFile(), 'w');
            chmod(self::getFullPathToFile(), 0777);
        }
    }

    static private function log($message = '', $logType = self::INFO)
    {
        self::createFile();
        error_log(date(self::LINE_PREFIX_DATE_FORMAT) . $message . "\n", 3, self::getFullPathToFile('', $logType));
    }

    static public function info($message = '')
    {
        self::log($message, self::INFO);
    }

    static public function error($message = '')
    {
        self::log($message, self::ERROR);
    }

    static public function getLogsForDate($dateToFormat = '')
    {
        return file_get_contents(self::getFullPathToFile($dateToFormat));
    }

    static public function getLastMessageOfDate($dateToFormat = '')
    {
        $allLines = explode("\n", self::getLogsForDate($dateToFormat));
        return $allLines[count($allLines) - 2];
    }
}