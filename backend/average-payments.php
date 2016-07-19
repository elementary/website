<?php

////    Settings
$database       = __DIR__.'/../data/_average_payments.db';

////    Parse Variables
$processing = false;
if ( !empty($amount) ) {
    $processing = true;
}
if ( $processing ) {
    $OS = strtolower(htmlentities($_POST['os'], ENT_QUOTES, 'UTF-8'));
}

////    TEMP
if ( !empty($_GET['amount']) ) {
    $amount = $_GET['amount'];
    $OS = 'linux';
    $processing = true;
}

////    Error Handling
function LastError($db) {
    $Error = 'Error Code "'.$db->lastErrorCode().'" : '.$db->lastErrorCode();
    var_dump($Error);
}

////    Open database
if ( $processing ) {
    if ( !is_writable(dirname($database)) ) {
        echo 'ERROR: database is not writable.';
        exit;
    }
    $db = new SQLite3($database, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
} else {
    $db = new SQLite3($database, SQLITE3_OPEN_READONLY);
}
if ( $db->lastErrorCode() ) LastError($db);
$db->busyTimeout(300);
if ( $db->lastErrorCode() ) LastError($db);

if ( $processing ) {
    ////    Initialize database
    $query = 'CREATE TABLE IF NOT EXISTS `AveragePayments` (`OS` TEXT PRIMARY KEY, `Total` INTEGER, `Count` INTEGER, `Average` INTEGER);';
    $db->exec($query); // Result-less
    if ( $db->lastErrorCode() ) LastError($db);
    $Systems = array('total', 'android', 'ios', 'windows', 'os x', 'linux', 'other');
    $query = 'DELETE FROM `AveragePayments` WHERE `OS` NOT IN (\''.implode('\', \'', $Systems).'\')';
    $db->exec($query); // Result-less
    foreach ( $Systems as $System ) {
        $query = 'INSERT OR IGNORE INTO `AveragePayments` VALUES (\''.$System.'\', 0, 0, 0);';
        $db->exec($query); // Result-less
    }
    ////    Update
    $query  = 'UPDATE `AveragePayments` SET `Total` = `Total` + \''.$amount.'\', `Count` = `Count` + 1, `Average` = ((`Total` + \''.$amount.'\') / (`Count` + 1)) WHERE `OS`=\''.$OS.'\' OR `OS`=\'total\';';
    $result = $db->exec($query); // Result-less
    if ( $db->lastErrorCode() ) LastError($db);
} else {
    $query = 'SELECT `Average`, `OS` FROM `AveragePayments`;';
    $results = $db->query($query);
    if ( $db->lastErrorCode() ) LastError($db);
    $toJSON = array();
    while ($row = $results->fetchArray()) {
        $toJSON[$row['OS']] = $row;
    }
    $db->close();
    if ( $db->lastErrorCode() ) LastError($db);
    echo json_encode($toJSON, JSON_PRETTY_PRINT);
}
