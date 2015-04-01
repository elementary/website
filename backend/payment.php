<?php
require_once('./lib/Stripe.php');
require_once('./config.php');

Stripe::setApiKey($config['stripe_sk']);


if (isset($_POST['token'])) {
    $token  = $_POST['token'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];

    // I would add some validation here just to be on the safe side - 
    // You rarely want to pass $_POST data straight into something without 
    // being fairly certain of what it is.

    // Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = Stripe_Charge::create(array(
            'amount' => $amount,
            'currency' => 'usd',
            'card' => $token,
            'description' => 'elementary OS download',
            'receipt_email' => $email,
        ));
        // Set an insecure, HTTP only cookie for 10 years in the future.
        setcookie('has_paid_freya', $amount, time()+315360000, '/', '.elementary.io', 0, 1);
        echo 'OK';
    } catch(Stripe_CardError $e) {
        echo 'error';
    }
} else { 
    echo $config['stripe_pk'];
}
