<?php

/**
 * api/payment.php
 * Accepts payment for current release
 */

require_once __DIR__ . '/../_backend/config.loader.php';
require_once __DIR__ . '/../_backend/email/os-payment.php';
require_once __DIR__ . '/../_backend/lib/autoload.php';
require_once __DIR__ . '/../_backend/log-echo.php';
require_once __DIR__ . '/../_backend/os-payment.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

if (isset($_POST['token'])) {
    $token       = $_POST['token'];
    $amount      = intval($_POST['amount']);
    $description = $_POST['description'];
    $email       = $_POST['email'];
    $os          = $_POST['os'];

    // Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = \Stripe\Charge::create(array(
            'amount' => $amount,
            'currency' => 'usd',
            'card' => $token,
            'description' => $description,
            'receipt_email' => $email,
            'metadata' => array(
                'receipt' => 'false',
                'products' => json_encode(array('ISO-' . $config['release_version']))
            )
        ));
    } catch(\Stripe\Error\Card $e) {
        // Don't use log_echo because we don't want finance stuff echoing.
        error_log($e);
        $sentry->captureMessage($e);
        echo 'An error occurred.';
        die();
    }

    os_payment_setcookie($config['release_version'], $amount);

    try {
        email_os_payment($charge);
    } catch (Exception $e) {
        error_log($e);
        $sentry->captureMessage($e);
        echo 'Unable to send receipt email';
    }

    require_once __DIR__.'/../_backend/average-payments.php';
} else {
    echo $config['stripe_pk'];
}
