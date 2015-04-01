<?php

require_once('./lib/Stripe.php');
require_once('./config.php');
//require_once('../../../backend/config.php');

Stripe::setApiKey($config['stripe_sk']);

if (isset($_POST['token'])) {
    $token  = $_POST['token'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];
    $options = array(
        'amount' => $amount,
        'currency' => 'usd',
        'card' => $token,
        'description' => 'elementary OS download',
        'receipt_email' => $email,
    );

    // Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = Stripe_Charge::create($options);
        // Set an insecure, HTTP only cookie for 10 years in the future.
        setcookie('has_paid_freya', $amount, time() + 315360000, '/', '', 0, 1);
        setcookie('has_paid_freya', $amount, time() + 315360000, '/', '.elementaryos.org', 0, 1);
        echo 'OK';
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo $config['stripe_pk'];
}
