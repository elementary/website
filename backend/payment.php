<?php
require_once __DIR__.'/lib/Stripe.php';
require_once __DIR__.'/config.loader.php';
require_once __DIR__.'/secure.functions.php';

Stripe::setApiKey($config['stripe_sk']);

if (isset($_POST['token'])) {
    $token  = $_POST['token'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];

    // Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = Stripe_Charge::create(array(
            'amount' => $amount,
            'currency' => 'usd',
            'source' => $token,
            // 'card' => $token,
            'description' => 'elementary OS download',
            'receipt_email' => $email,
        ));
        // var_dump($charge['paid']);
        if($charge['paid']==true){
            echo 'PAID';
                // Set an insecure, HTTP only cookie for 10 years in the future.
                setcookie('has_paid_'.$config['os-codename'].'', $amount, time() + 315360000, '/', '.elementary.local', 0, 1);

                //securing email in cookies for privacy protection 
                setcookie('paid_'.$config['os-codename'].'_by',encrypt($email), time() + 315360000, '/', '.elementary.local', 0, 1);
        }else {
            echo 'OK';    
        }
    } catch(Stripe_CardError $e) {
        echo 'error';
    }
} else {
    echo $config['stripe_pk'];
}
