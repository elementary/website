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
 * Emails an OS receipt from given stripe charge
 *
 * @param {\Stripe\Charge} $charge - Stripe charge used for payment
 * @return {Array} - Mandrill response
 */
function email_os_payment (\Stripe\Charge $charge) {
    global $mandrill;

    if (!isset($charge) || !isset($charge['metadata'])) {
        throw new Exception('Unable to read charge metadata');
    }

    if (isset($charge['metadata']['receipt']) && $charge['metadata']['receipt'] === 'true') {
        throw new Exception('Receipt alraedy sent');
    }

    $products = array();
    if (isset($charge['metadata']['products'])) {
        try {
            $products = json_decode($charge['metadata']['products']);
        } catch (Exception $e) {
            throw new Exception('Unable to read charge product list');
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
            'content' => '$' . number_format(floatval($charge['amount'] / 100), 2, '.', ',')
        ),
        array(
            'name' => 'link',
            'content' => 'https://elementary.io/api/download?charge=' . urlencode($charge['id'])
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

    $res = $mandrill->messages->sendTemplate('os-purchase', $req, $message);

    foreach ($res as $mail) {
        if (isset($mail['reject_reason']) && $mail['reject_reason'] !== '') {
            throw new Exception($mail['reject_reason']);
        }
    }

    try {
        $charge['metadata']['receipt'] = 'true';
        $charge->save();
    } catch (Exception $e) {
        throw new Exception('Unable to save receipt state to Stripe');
    }

    return $res;
}
