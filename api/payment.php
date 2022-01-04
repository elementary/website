<?php

/**
 * api/payment.php
 * Accepts payment for current release
 */

require_once __DIR__ . '/../_backend/bootstrap.php';

require_once __DIR__ . '/../_backend/email/os-payment.php';
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
        http_response_code(500);
        echo 'An error occurred.';
        die();
        
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        log_echo($e, false);
        http_response_code(500);
        echo 'A "RateLimit" error occurred.';
        die();
        
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        log_echo($e, false);
        http_response_code(500);
        echo 'An "InvalidRequest" error occurred.';
        die();
        
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        log_echo($e, false);
        http_response_code(500);
        echo 'An "Authentication" error occurred.';
        die();
        
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        log_echo($e, false);
        http_response_code(500);
        echo 'An "ApiConnection" error occurred.';
        die();
        
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        log_echo($e, false);
        http_response_code(500);
        echo 'A "Base" error occurred.';
        die();
        
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        log_echo($e, false);
        http_response_code(500);
        echo 'An error occurred.';
        die();
        
    }

    os_payment_setcookie($config['release_version'], $amount);

    try {
        email_os_payment($charge);
    } catch (Exception $e) {
        log_echo($e, false);
        echo 'Unable to send receipt email';
    }

} else {
    echo $config['stripe_pk'];
}
