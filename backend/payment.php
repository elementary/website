<?php
require_once __DIR__.'/lib/autoload.php';
require_once __DIR__.'/config.loader.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

if (isset($_POST['token'])) {
    $token       = $_POST['token'];
    $amount      = $_POST['amount'];
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
        ));
        // Set an secure, HTTP only cookie for 10 years in the future.
        $encoded = urlencode(str_replace(' ', '_', 'has_paid_'.$description));
        setcookie($encoded, $amount, time() + 315360000, '/', '', true, true);
        require_once __DIR__.'/average-payments.php';
        echo 'OK';
    } catch(\Stripe\Error\Card $e) {
        echo 'error';
    }
} else {
    echo $config['stripe_pk'];
}
