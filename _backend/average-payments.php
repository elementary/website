<?php

////    Settings
$database       = __DIR__.'/../_data/average_payments.db';
require_once __DIR__.'/log-echo.php';

if ( empty($amount) ) {
    exit;
}

////    Error Handling
function LastError($db) {
    global $sentry;
    $Error = 'Error Code "'.$db->lastErrorCode().'" : '.$db->lastErrorCode();
    if (getenv('PHPENV') !== 'production') {
        echo $Error;
    } else {
        error_log($Error);
        $sentry->captureMessage($msg);
    }
    exit;
}

////    Open database
if ( !is_writable(dirname($database)) ) {
    log_echo('ERROR: database is not writable.');
    exit(1);
}
try {
    $db = new SQLite3($database, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
} catch (Exception $e) {
    log_echo('ERROR: unable to create database');
    exit(2);
}

if ( $db->lastErrorCode() ) LastError($db);
$db->busyTimeout(300);
if ( $db->lastErrorCode() ) LastError($db);

////    Initialize database
$query = 'CREATE TABLE IF NOT EXISTS `AveragePayments` (`OS` TEXT PRIMARY KEY, `Total` INTEGER, `Count` INTEGER, `Average` INTEGER);';
$db->exec($query); // Result-less

if ( $db->lastErrorCode() ) LastError($db);

$Systems = array('total', 'android', 'ios', 'windows', 'macos', 'linux', 'other');
$query = 'DELETE FROM `AveragePayments` WHERE `OS` NOT IN (\''.implode('\', \'', $Systems).'\')';
$db->exec($query); // Result-less

foreach ( $Systems as $System ) {
    $query = 'INSERT OR IGNORE INTO `AveragePayments` VALUES (\''.$System.'\', 0, 0, 0);';
    $db->exec($query); // Result-less
}

////    Update
$amount = intval(htmlentities($amount, ENT_QUOTES));
$os = strtolower(htmlentities($os, ENT_QUOTES));
$query  = 'UPDATE `AveragePayments` SET `Total` = `Total` + \''.$amount.'\', `Count` = `Count` + 1, `Average` = ((`Total` + \''.$amount.'\') / (`Count` + 1)) WHERE `OS`=\''.$os.'\' OR `OS`=\'total\';';
$result = $db->exec($query); // Result-less

if ( $db->lastErrorCode() ) LastError($db);
echo 'OK'.PHP_EOL;
