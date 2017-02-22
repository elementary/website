<?php

/**
 * /hook/stripe/charge_succeeded.php
 * Sends an email when a successful stripe payment is taken
 */

require_once __DIR__.'/index.php';

require_once __DIR__.'/../../_backend/preload.php';
require_once __DIR__.'/../../_backend/config.loader.php';

$mandrill = new Mandrill($config['mandrill_key']);

$charge = $res['data']['object'];

try {
    $charge = \Stripe\Charge::retrieve($charge['id']);
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to find charge';
    die();
}

if (isset($charge['metadata']['receipt']) && $charge['metadata']['receipt'] === true) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Receipt already sent';
    die();
}

$products = array();
if (isset($charge['metadata']['products'])) {
    try {
        $products = json_decode($charge['metadata']['products']);
    } catch (Exception $e) {
        header('HTTP/1.0 400 Bad Request');
        echo 'Unable to parse products';
        die();
    }
}

$iso_version = false;
foreach ($products as $product) {
    if (substr($product, 0, 3) === 'ISO') {
        $iso_version = substr($product, 4);
    }
}

if ($iso_version === false) {
    header('HTTP/1.0 400 Bad Request');
    echo 'No ISO purchase listed';
    die();
}

$req = array(
    array(
        'name' => 'version',
        'content' => $iso_version
    ),
    array(
        'name' => 'charge',
        'content' => $charge['id']
    )
);

$message = array(
    'subject' => 'elementary Purchase',
    'from_email' => 'payment@elementary.io',
    'from_name' => 'elementary',
    'to' => array(
        array(
            'email' => $charge['receipt_email'],
            'type' => 'to'
        )
    ),
    'headers' => array(
        'Reply-To' => 'payment@elementary.io'
    ),
    'important' => false,
    'tags' => array(
        'purchase',
        'release'
    ),
    'global_merge_vars' => $req, // the regular template data is not working
    'merge_language' => 'handlebars'
);

try {
    $res = $mandrill->messages->sendTemplate('iso_purchased', $req, $message);

    foreach ($res as $mail) {
        if (isset($mail['reject_reason']) && $mail['reject_reason'] !== '') {
            throw new Exception($mail['reject_reason']);
        }
    }
} catch (Mandrill_Error $e) {
    error_log('Mandrill error trying to send hook/stripe/charge_succeeded email');
    error_log(get_class($e) . ' - ' . $e->getMessage());

    header('HTTP/1.1 500 Internal Server Error');
    echo 'Unable to send email';

    die();
} catch (Exception $e) {
    error_log('Failed to send hook/stripe/charge_succeeded email');
    error_log($e->getMessage());

    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error while sending email';

    die();
}
