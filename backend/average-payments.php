<?php

////    Settings
$Database = __DIR__.'/../data/average_payments.db';

////    Parse Variables
if ( !empty($_GET['os']) && !empty($_GET['payment']) ) {
    $Processing = true;
} else {
    $Processing = false;
}
if ( $Processing ) {
    $OS = strtolower(htmlentities($_GET['os'], ENT_QUOTES, 'UTF-8'));
    $Payment = intval($_GET['payment']);
}

////    Error Handling
function LastError($db) {
    $Error = 'Error Code "'.$db->lastErrorCode().'" : '.$db->lastErrorCode();
    var_dump($Error);
}

////    Open Database
if ( $Processing ) {
    if ( !is_writable($Database) ) {
        echo 'ERROR: Database is not writable.';
        exit;
    }
    $db = new SQLite3($Database);
} else {
    $db = new SQLite3($Database, SQLITE3_OPEN_READONLY);
}
if ( $db->lastErrorCode() ) LastError($db);
$db->busyTimeout(300);
if ( $db->lastErrorCode() ) LastError($db);

if ( $Processing ) {
    ////    Initialize Database
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
    $query  = 'UPDATE `AveragePayments` SET `Total` = `Total` + \''.$Payment.'\', `Count` = `Count` + 1, `Average` = ((`Total` + \''.$Payment.'\') / (`Count` + 1)) WHERE `OS`=\''.$OS.'\' OR `OS`=\'total\'; ';
    $query .= 'UPDATE `AveragePayments` SET `Total` = `Total` + \''.$Payment.'\', `Count` = `Count` + 1, `Average` = ((`Total` + \''.$Payment.'\') / (`Count` + 1)) WHERE `OS`=\'total\';';
    $result = $db->exec($query); // Result-less
    if ( $db->lastErrorCode() ) LastError($db);
}

$query = 'SELECT * FROM `AveragePayments`;';
$results = $db->query($query);
if ( $db->lastErrorCode() ) LastError($db);
$toJSON = array();
while ($row = $results->fetchArray()) {
    $toJSON[$row['OS']] = $row;
}

$db->close();
if ( $db->lastErrorCode() ) LastError($db);

echo json_encode($toJSON, JSON_PRETTY_PRINT);
