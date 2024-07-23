<?php

/**
 * api/download.php
 * Sets payment cookie from stripe charge
 *
 * This code is left in place to honor old re-download links that user's may already have.
 * But new links are no longer generated after Stripe API changes made it difficult to add
 * redownload links to the receipt emails.
 *
 */

require_once __DIR__ . '/../_backend/bootstrap.php';

require_once __DIR__ . '/../_backend/preload.php';
require_once __DIR__ . '/../_backend/os-payment.php';

$stripe = new \Stripe\StripeClient([
    "api_key" => $config['stripe_sk'],
    "stripe_version" => "2024-04-10"
]);

/**
 * go_home
 * Sets header to redirect home
 *
 * @return {Void}
 */
function go_home()
{
    global $sitewide;

    header("Location: " . $sitewide['root']);
    die();
}

// everything else falls into a great pyrimid of php ifs
if (isset($_GET['charge'])) {
    $charge_id = $_GET['charge'];

    if (substr($charge_id, 0, 3) !== 'ch_') {
        return go_home();
    }

    // Try to fetch the charge id under the current Stripe account
    try {
        $charge = $stripe->charges->retrieve($charge_id);
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        $status = $e->getHttpStatus();
        if (isset($status) && $status !== 404) {
            return go_home();
        }
    }

    // Try to fetch the charge id under the _previous_ Stripe account
    // IF the metadata we need isn't set yet
    if (!isset($charge['metadata']['products'])) {
        try {
            $charge = $stripe->charges->retrieve(
                $charge_id,
                [],
                ['api_key' => $config['previous_stripe_sk']]
            );
        } catch (Exception $e) {
            return go_home();
        }
    }
} else {
    $intent_id = $_GET['intent'];

    try {
        $charge = $stripe->paymentIntents->retrieve($intent_id);
    } catch (Exception $e) {
        return go_home();
    }
}

$products = array();
if (isset($charge['metadata']['products'])) {
    try {
        $products = json_decode($charge['metadata']['products']);
    } catch (Exception $e) {
        return go_home();
    }
}

$isoVersion = false;
foreach ($products as $product) {
    if (substr($product, 0, 3) === 'ISO') {
        // Set $isoVersion to the ISO Version number like '0.4.1' from the purchased product string 'ISO_0.4.1'
        $isoVersion = substr($product, 4);
        // Set $isoMajor as the first number from $isoVersion
        list($isoMajor) = explode('.', $isoVersion);
        // If that worked
        if ($isoMajor != null) {
            // Set $currentMajor as the first number from the current release version
            list($currentMajor) = explode('.', $config['release_version']);
            // Set $previousMajor as the first number from the previous release version
            list($previousMajor) = explode('.', $config['previous_version']);

            // If the purchased major matches the current major
            if ($isoMajor == $currentMajor) {
                // Override $isoVersion to match the current release,
                // so long as it's only a minor upgrade.
                $isoVersion = $config['release_version'];
                // $isoVersion is either:
                // 1. an outdated product that was purchased
                // 2. a minor upgrade version to a product that was purchased
                os_payment_setcookie($isoVersion, $charge['amount']);
                go_home();

            // If the purchased major matches the previous major
            } elseif ($isoMajor == $previousMajor) {
                // Override $isoVersion to match the previous release,
                // so long as it's only a minor upgrade.
                $isoVersion = $config['previous_version'];
                // $isoVersion is either:
                // 1. an outdated product that was purchased
                // 2. a minor upgrade version to a product that was purchased
                os_payment_setcookie($isoVersion, $charge['amount']);
                header('Location: ' . $sitewide['root'] . 'previous');
                exit;

            // Was too old or not determinable
            } else {
                go_home();
            }
        }
    }
}
