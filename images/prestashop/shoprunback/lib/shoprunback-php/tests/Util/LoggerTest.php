<?php

namespace Tests\Util;

use \Tests\BaseTest;

use \Shoprunback\RestClient;
use \Shoprunback\Elements\Brand;
use \Shoprunback\Util\Logger;

final class LoggerTest extends BaseTest
{
    public function testCanCreateFile()
    {
        Logger::info('Test');
        $this->assertTrue(file_exists(Logger::getFullPathToFile()));
    }

    public function testCanLogError()
    {
        Logger::error('Error');
        $this->assertTrue(strpos(Logger::getLastMessageOfDate(), 'Error') > 0);
    }

    public function testCanLogElement()
    {
        RestClient::getClient()->enableTesting();
        Brand::delete(1);

        $this->assertTrue(strpos(Logger::getLastMessageOfDate(), date(Logger::LINE_PREFIX_DATE_FORMAT) . 'Brand:') === 0);
    }

    public function testCanGetLineOfPrecedentDates()
    {
        $yesterdayLogfilePath = LOG_PATH . date(Logger::FILENAME_DATE_FORMAT, strtotime('-1 days')) . Logger::FILE_EXTENSION;
        $fileAlreadyExisted = file_exists($yesterdayLogfilePath);

        if (!$fileAlreadyExisted) {
            fopen($yesterdayLogfilePath, 'w');
            chmod($yesterdayLogfilePath, 0777);
        }

        $todayTime = strtotime(date(Logger::FILENAME_DATE_FORMAT, strtotime('-1 days')));
        $line = date(Logger::LINE_PREFIX_DATE_FORMAT) . 'Line1';

        file_put_contents($yesterdayLogfilePath, $line . "\n");

        $lastLine = Logger::getLastMessageOfDate($todayTime);
        $this->assertSame($line, $lastLine);

        if (!$fileAlreadyExisted) {
            unlink($yesterdayLogfilePath);
        } else {
            $fileContent = Logger::getLogsForDate($todayTime);
            str_replace($line, '', $fileContent);

            unlink($yesterdayLogfilePath);
            fopen($yesterdayLogfilePath, 'w');
            chmod($yesterdayLogfilePath, 0777);

            file_put_contents($yesterdayLogfilePath, $fileContent);
        }
    }
}