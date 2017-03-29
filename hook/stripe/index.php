<?php

/**
 * /hook/stripe/index.php
 * Verifies hook variables and passes data to individual hook files
 */

require_once __DIR__.'/../../_backend/lib/autoload.php';
require_once __DIR__.'/../../_backend/config.loader.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Only POST is supported';
    die();
}

try {
    $res = json_decode(file_get_contents('php://input'), TRUE);

    if ($res == null) throw new Exception('Unable to decode');
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to decode data';
    die();
}

// Check the stripe event ID to ensure it's real
try {
    $evn = \Stripe\Event::retrieve($res['id']);
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Inaccurate data';
    die();
}

// And we finally fire off the hook file we need
if ($res['type'] === 'charge.succeeded') {
    require_once __DIR__.'/charge_succeeded.php';
} else {
    header('HTTP/1.0 415 Unsupported Media Type');
    echo 'Hook type not supported';
    die();
}
