<?php

/**
 * /hook/stripe/charge_succeeded.php
 * Sends an email when a successful stripe payment is taken
 */

require_once __DIR__.'/index.php';

require_once __DIR__.'/../../_backend/email/os-payment.php';

$charge = $res['data']['object'];

try {
    $charge = \Stripe\Charge::retrieve($charge['id']);
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to find charge';
    die();
}

try {
    email_os_payment($charge);
} catch (Exception $e) {
    header('HTTP/1.0 500 Bad Request');
    echo 'Unable to send email';
    die();
}

header('HTTP/1.1 200 OK');
echo 'Email sent';

die();
