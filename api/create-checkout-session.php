<?php

require_once __DIR__ . '/../_backend/bootstrap.php';
require_once __DIR__ . '/../_backend/preload.php';

$stripe = new \Stripe\StripeClient([
    "api_key" => $config['stripe_sk'],
    "stripe_version" => "2024-04-10"
]);

if (isset($_POST['amount'])) {
    $amount = intval($_POST['amount']);
    $description = $_POST['description'];

    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }

    $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $description,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]
        ],

        'mode' => 'payment',
        'success_url' => "$protocol$_SERVER[HTTP_HOST]$sitewide[root]?checkout_session_id={CHECKOUT_SESSION_ID}",
        'cancel_url' => "$protocol$_SERVER[HTTP_HOST]$sitewide[root]?checkout_session_id={CHECKOUT_SESSION_ID}",
    ]);

    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} else {
    echo $config['stripe_pk'];
}
