<?php

namespace Store;

require_once __DIR__.'/config.loader.php';

/**
 * StoreException
 * A simple exception for use in the store
 */
class StoreException extends Exception {}

/**
 * do_request
 * Helper function for making requests to online store
 *
 * @param String  $r RESTful method to use (GET POST etc)
 * @param String  $u url to make the request to
 * @param Array   $a the request data
 * @param Array   $p parameters to send on request
 *
 * @return Array parsed request data
 */
function do_request ($r, $u, array $a = array(), array $p = array()) {
    if (!isset($f)) $f = false;

    if (!function_exists('json_decode') || !function_exists('json_encode')) {
        throw new StoreException('PHP JSON extension required for the store');
    }

    if (!function_exists('curl_init')) {
        throw new StoreException('PHP CURL extension required for the store');
    }

    if ($config['printful_key'] === 'aaaaaaaa-bbbb-cccc:dddd-eeeeeeeeeeee') {
        throw new StoreException('Unconfigured store printful_key');
    }

    $url = 'https://api.theprintful.com/' . $u;
    if (!empty($p)) {
        $url .= '?' . http_build_query($p);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERPWD, $config['printful_key']);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $r);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);

    if (!empty($a)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a));
    }

    $res = curl_exec($ch);
    $errno = curl_errno($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($errno) {
        throw new StoreException('do_request: ' . $error, $errno);
    }

    $res = json_decode($res, true);
    if (!isset($res['code']) || !isset($res['result'])) {
        throw new StoreException('do_request: Invalid API response');
    }

    $status = (int) $res['code'];

    if ($status < 200 || $status >= 300) {
        throw new StoreException($res['result'], $status);
    }

    return $res['result'];
}

/**
 * get_items
 * Returns product list from store
 *
 * @return Array list of product
 */
function get_products () {
    return do_request('GET', 'products');
}

/**
 * get_varients
 * Returns list of varients for the product
 *
 * @param String $i id of product
 *
 * @return Array list of variends
 */
function get_varients ($i) {
    if (!isset($i)) {
        throw new StoreException('get_varients: Missing required product id');
    }

    return do_request('GET', "products/$i");
}
