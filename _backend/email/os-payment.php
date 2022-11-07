<?php

/**
 * _backend/email/os-payment.php
 * PHP function for sending out OS receipt emails
 */

require_once __DIR__ . '/../../_backend/preload.php';
require_once __DIR__ . '/../../_backend/config.loader.php';

$mandrill = new Mandrill($config['mandrill_key']);

/**
 * email_os_payment
 * Emails an OS receipt from given stripe payment intent
 *
 * @param {\Stripe\PaymentIntent} $intent - Stripe intent used for payment
 * @return {Array} - Mandrill response
 */
function email_os_payment (\Stripe\PaymentIntent $intent) {
    global $mandrill;

    if (!isset($intent) || !isset($intent['metadata'])) {
        throw new Exception('Unable to read intent metadata');
    }

    if (isset($intent['metadata']['receipt']) && $intent['metadata']['receipt'] === 'true') {
        throw new Exception('Receipt alraedy sent');
    }

    $products = array();
    if (isset($intent['metadata']['products'])) {
        try {
            $products = json_decode($intent['metadata']['products']);
        } catch (Exception $e) {
            throw new Exception('Unable to read intent product list');
        }
    }

    $iso_version = false;
    foreach ($products as $product) {
        if (substr($product, 0, 3) === 'ISO') {
            $iso_version = substr($product, 4);
        }
    }

    if ($iso_version === false) {
        throw new Exception('Unable to read OS release version');
    }

    $req = array(
        array(
            'name' => 'amount',
            'content' => '$' . number_format(floatval($intent['amount'] / 100), 2, '.', ',')
        ),
        array(
            'name' => 'link',
            'content' => 'https://elementary.io/api/download?intent=' . urlencode($intent['id'])
        )
    );

    $message = array(
        'subject' => 'elementary Purchase (Charge ' . $intent['id'] . ')',
        'from_email' => 'payment@elementary.io',
        'from_name' => 'elementary',
        'to' => array(
            array(
                'email' => $intent['charges']['data'][0]['billing_details']['email'],
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

    $res = $mandrill->messages->sendTemplate('os-purchase', $req, $message);

    foreach ($res as $mail) {
        if (isset($mail['reject_reason']) && $mail['reject_reason'] !== '') {
            throw new Exception($mail['reject_reason']);
        }
    }

    try {
        $intent['metadata']['receipt'] = 'true';
        $intent->save();
    } catch (Exception $e) {
        throw new Exception('Unable to save receipt state to Stripe');
    }

    return $res;
}
