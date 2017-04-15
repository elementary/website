<?php

/**
 * api/download.php
 * Sets payment cookie from stripe charge
 */

require_once __DIR__ . '/../_backend/bootstrap.php';

require_once __DIR__.'/../_backend/preload.php';
require_once __DIR__.'/../_backend/os-payment.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

/**
 * go_home
 * Sets header to redirect home
 *
 * @return {Void}
 */
function go_home() {
    global $sitewide;

    header("Location: " . $sitewide['root']);
    return;
}

// everything else falls into a great pyrimid of php ifs
$charge_id = $_GET['charge'];

if (substr($charge_id, 0, 3) !== 'ch_') {
    go_home();
}

try {
    $charge = \Stripe\Charge::retrieve($charge_id);
} catch (Exception $e) {
    go_home();
}

$products = array();
if (isset($charge['metadata']['products'])) {
    try {
        $products = json_decode($charge['metadata']['products']);
    } catch (Exception $e) {
        go_home();
    }
}

$iso_version = false;
foreach ($products as $product) {
    if (substr($product, 0, 3) === 'ISO') {
        $iso_version = substr($product, 4);
    }
}

if ($iso_version !== false) {
    os_payment_setcookie($iso_version, $charge['amount']);
}

go_home();
