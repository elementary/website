<?php

require_once __DIR__ . '/bootstrap.php';

require_once __DIR__ . '/log-echo.php';

/**
 * os_payment_encode
 * Encodes text to be used in cookie storage
 *
 * @param {String} $text - String to encode for use in cookie
 *
 * @return {String} - Text to use in cookie
 */
function os_payment_encode(string $text)
{
    return urlencode(str_replace([' ', '.'], '_', $text));
}

/**
 * os_payment_setcookie
 * Sets the payment cookie for a given release version
 *
 * @param {String} $version - Version of release to set cookie for
 * @param {Number} $amount - Amount paid for release
 *
 * @return {Boolean} - True if cookie was set
 */
function os_payment_setcookie(string $version, int $amount)
{
    $string = os_payment_encode('os_payment_' . $version);
    $expires = time() + 60 * 60 * 24 * 365; // One year in the future

    return setcookie($string, $amount, $expires, '/', '', false, true);
}

/**
 * os_payment_getcookie
 * Returns the amount paid for a release version
 *
 * @param {String} $version - Version of release to get cookie for
 *
 * @return {Number} - Amount paid for release, 0 for not paid
 */
function os_payment_getcookie(string $version)
{
    $string = os_payment_encode('os_payment_' . $version);

    if (isset($_COOKIE[$string])) {
        return intval($_COOKIE[$string]);
    }

    return 0;
}
