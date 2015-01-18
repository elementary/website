<?php
require_once('./lib/Stripe.php');
require_once('./config.php');

Stripe::setApiKey($config['stripe_sk']);

$token  = $_POST['token'];
$amount = $_POST['amount'];

// Create the charge on Stripe's servers - this will charge the user's card
try {
    $charge = Stripe_Charge::create(array(
        "amount" => $amount,
        "currency" => "usd",
        "card" => $token,
        "description" => "elementary OS download")
    );
    echo "OK";
} catch(Stripe_CardError $e) {
    echo "error";
}

?>
