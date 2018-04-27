<?php
// This file must be called by an AJAX function to be asynchrous
require_once(_PS_MODULE_DIR_ . '../config/config.inc.php');
require_once(_PS_MODULE_DIR_ . '../init.php');

require_once 'shoprunback.php';
include_once 'classes/SRBLogger.php';

$class = $_POST['className'] ? $_POST['className'] : 'ShopRunBack';

$action = $_POST['action'];
$result = '';

if (isset($_POST['params'])) {
    if ($action == 'sync') {
        SRBLogger::addLog('AsyncCall sync ' . $class . ' ' . $_POST['params'], SRBLogger::INFO);
        try {
            $item = $class::getNotSyncById($_POST['params']);
            $result = $item->sync();
        } catch (SRBException $e) {
            SRBLogger::addLog($e, SRBLogger::FATAL, $class);
        }
    } elseif ($action == 'syncAll') {
        SRBLogger::addLog('AsyncCall syncAll ' . $class, SRBLogger::INFO);
        $result = $class::syncAll($_POST['params']);
    } else {
        throw new SRBException('AsyncCall unknown action ' . $action . '. Param: ' . $_POST['params'], 3);
    }
} else {
    SRBLogger::addLog('AsyncCall params is missing. Action: ' . $action . '. Class: ' . $class, SRBLogger::ERROR);
    throw new SRBException('AsyncCall params is missing. Action: ' . $action);
}

if (! is_string($result)) {
    $result = json_encode($result);
}

echo $result;
die;
