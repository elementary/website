<?php

require_once __DIR__ . '/lib/autoload.php';
require_once __DIR__ . '/config.loader.php';
require_once __DIR__ . '/log-echo.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

/**
 * release_payment_encode
 * Encodes text to be used in cookie storage
 *
 * @param {String} $text - String to encode for use in cookie
 *
 * @return {String} - Text to use in cookie
 */
function release_payment_encode (string $text) {
    return urlencode(str_replace([' ', '.'], '_', $text));
}

/**
 * release_payment_setcookie
 * Sets the payment cookie for a given release version
 *
 * @param {String} $version - Version of release to set cookie for
 * @param {Number} $amount - Amount paid for release
 *
 * @return {Boolean} - True if cookie was set
 */
function release_payment_setcookie (string $version, int $amount) {
    $string = release_payment_encode('release_payment_' . $version);
    $expires = time() + 60 * 60 * 24 * 365; // One year in the future

    return setcookie($string, $amount, $expires, '/', '', false, true);
}

/**
 * release_payment_getcookie
 * Returns the amount paid for a release version
 *
 * @param {String} $version - Version of release to get cookie for
 *
 * @return {Number} - Amount paid for release, 0 for not paid
 */
function release_payment_getcookie (string $version) {
    // DEPRECATED: this is the old version of cookie naming
    if (!isset($version) || $version === '') {
        $string = release_payment_encode('has_paid_' . $config['release_title'] . '_' . $config['release_version']);

        if (isset($_COOKIE[$string])) {
            return intval($_COOKIE[$string]);
        }
    }

    // DEPRECATED: all deprecated variables can be removed next version release
    $string = release_payment_encode('release_payment_' . $version);
    $deprecated_string = release_payment_encode('has_paid_Loki_' . $version);

    if (isset($_COOKIE[$string])) {
        return intval($_COOKIE[$string]);
    }

    if (isset($_COOKIE[$deprecated_string])) {
        return intval($_COOKIE[$deprecated_string]);
    }

    return 0;
}
