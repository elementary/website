<?php

require_once __DIR__ . '/bootstrap.php';

// Setup sentry error logging
if (
    getenv('PHPENV') == 'production' &&
    isset($config['sentry_key']) &&
    $config['sentry_key'] !== false
) {
    $sentry = new Raven_Client($config['sentry_key']);
    $sentry->install();
}

// Log an error and also echo it.
function log_echo($msg, $echo = false) {
    global $sentry;
    error_log($msg);
    if ( $sentry ) $sentry->captureMessage($msg);
    if ( $echo ) echo $msg.PHP_EOL;
}
