<?php

namespace Store\Api;

require_once __DIR__ . '/../config.loader.php';
require_once __DIR__ . '/address.php';

/**
 * do_request
 * Helper function for making requests to online store
 *
 * @global Array $config site wide configuration
 *
 * @param String $r      RESTful method to use (GET POST etc)
 * @param String $u      url to make the request to
 * @param Array  $a      the request data
 * @param Array  $p      parameters to send on request
 *
 * @return Array parsed request data
 *
 * @throws Exception on missing extension or request returning an error
 */
function do_request ($r, $u, array $a = array(), array $p = array()) {
    global $config;

    if (!isset($f)) $f = false;

    if (!function_exists('json_decode') || !function_exists('json_encode')) {
        throw new \Exception('PHP JSON extension required for the store');
    }

    if (!function_exists('curl_init')) {
        throw new \Exception('PHP CURL extension required for the store');
    }

    if ($config['printful_key'] === 'aaaaaaaa-bbbb-cccc:dddd-eeeeeeeeeeee') {
        throw new \Exception('Unconfigured store printful_key');
    }

    $url = 'https://api.theprintful.com/' . $u;
    if (!empty($p)) {
        $url .= '?' . http_build_query($p);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, $config['printful_key']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $r);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    if (!empty($a)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($a));
    }

    $res = curl_exec($ch);
    $errno = curl_errno($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($errno) {
        throw new \Exception('do_request: ' . $error, $errno);
    }

    $res = json_decode($res, true);
    if (!isset($res['code']) || !isset($res['result'])) {
        throw new \Exception('do_request: Invalid API response');
    }

    $status = (int) $res['code'];

    if ($status < 200 || $status >= 300) {
        throw new \Exception($res['result'], $status);
    }

    return $res['result'];
}

/**
 * get_varients
 * Returns list of varients for the product
 *
 * @param String $i id of product
 *
 * @return Array list of variends
 */
function get_varients (string $i) {
    return do_request('GET', "products/variant/$i");
}

/**
 * get_shipping
 * Returns a list of shipping rates from Printful api
 *
 * @param \Store\Address\Address $s shipping address
 * @param Arrray                 $i list of items to buy
 *
 * @return Array list of shipping rates
 */
function get_shipping (\Store\Address\Address $s, array $i) {
    $res = do_request('POST', 'shipping/rates', array(
        'recipient' => $s->get_shipping(),
        'items' => $i
    ));

    $choices = [];
    foreach ($res as $option) {
        preg_match('#\(.*?\)#', $option['name'], $matches);
        $name = trim(str_replace($matches[0], '', $option['name']));
        $expected = trim($matches[0], '\)\(');

        $choices[] = array(
            'id' => $option['id'],
            'name' => $name,
            'expected' => $expected,
            'cost' => number_format((float) $option['rate'], 2)
        );
    }

    return $choices;
}

/**
 * get_tax_rate
 * Returns the tax rate for a given address
 *
 * @param \Store\Address\Address $s shipping address
 *
 * @return Number the tax rate
 */
function get_tax_rate (\Store\Address\Address $s) {
    $res = do_request('POST', 'tax/rates', array(
        'recipient' => $s->get_shipping()
    ));

    return (float) $res['rate'];
}

/**
 * get_tax
 * Returns the tax price for a given address and subtotal
 *
 * @param |Store\Address\Address $s shipping address
 * @param Number                 $t the cart sub total and shipping
 *
 * @return Number the amount of tax
 */
function get_tax (\Store\Address\Address $s, float $i) {
    $rate = get_tax_rate($s);

    return number_format($rate * $i, 2);
}
