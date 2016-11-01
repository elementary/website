<?php

// Settings
$database  = __DIR__.'/../../_data/average_payments.db';
$target    = __DIR__.'/../../data/average-payments.json';

// Writable check
if ( !is_writable($target) ) {
	echo 'ERROR: File `'.$target.'` is not writable.'.PHP_EOL;
	exit(1);
}

// Error Handling
require_once __DIR__.'/../log-echo.php';
function LastError($db) {
    global $sentry;
    $Error = 'Error Code "'.$db->lastErrorCode().'" : '.$db->lastErrorCode();
    if (getenv('PHPENV') !== 'production') {
        echo $Error;
    } else {
        log_echo($Error);
    }
    exit(1);
}

// Open database
try {
    $db = new SQLite3($database, SQLITE3_OPEN_READONLY);
} catch (Exception $e) {
    log_echo('ERROR: unable to open database');
    exit(3);
}

// Wait if necessary
if ( $db->lastErrorCode() ) LastError($db);
$db->busyTimeout(3000);
if ( $db->lastErrorCode() ) LastError($db);

// Select only what is needed.
$query = 'SELECT `Average`, `OS` FROM `AveragePayments`;';
$results = $db->query($query);
if ( $db->lastErrorCode() ) LastError($db);

// Build an array
$toJSON = array();
while ($row = $results->fetchArray()) {
    $toJSON[$row['OS']] = $row['Average'];
}
$db->close();
if ( $db->lastErrorCode() ) LastError($db);

// Sort and write
ksort($toJSON);
file_put_contents($target, json_encode($toJSON, JSON_PRETTY_PRINT));
echo 'Done.'.PHP_EOL;
