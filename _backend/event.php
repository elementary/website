<?php

/**
 * _backend/event.php
 * Holds functions for handling time sensitive events
 */

// Here is an array of events, holding an array with start and end dates.
$event_expires = array(
    'indiegogo appcenter 2/17' => [new DateTime('2/8/17'), new DateTime('3/10/17')]
);

/**
 * event_active
 * Checks if an event is past the expiration date
 *
 * @param {String} $event - Name of event to check for
 *
 * @return {Boolean} - True if event is currently active
 */
function event_active (string $event) {
    global $event_expires;

    if (!isset($event_expires[$event])) {
        return false;
    }

    $dates = $event_expires[$event];
    $date = new DateTime("now");

    if ($date > $dates[0] && $date < $dates[1]) {
        return true;
    }

    return false;
}

/**
 * event_cookie_encode
 * Encodes text to be used in cookie storage
 *
 * @param {String} $text - String to encode for use in cookie
 *
 * @return {String} - Text to use in cookie
 */
function event_cookie_encode (string $text) {
    return urlencode(str_replace([' ', '.', '/'], '_', $text));
}

/**
 * event_cookie_set
 * Sets an event cookie to value
 *
 * @param {String} $event - Name of event to set for
 * @param {*} $value - Value of cookie
 *
 * @return {Boolean} - True if cookie was set
 */
function event_cookie_set (string $event, $value) {
    $string = event_cookie_encode('event_' . $event);
    $expires = time() + 60 * 60 * 24 * 365; // One year in the future

    return setcookie($string, $value, $expires, '/', '', false, true);
}

/**
 * event_cookie_get
 * Returns the amount paid for a release version
 *
 * @param {String} $event - Name of event to get cookie for
 *
 * @return {*} - Value of event cookie
 */
function event_cookie_get (string $event) {
    $string = event_cookie_encode('event_' . $event);

    if (isset($_COOKIE[$string])) {
        return $_COOKIE[$string];
    }

    return null;
}
