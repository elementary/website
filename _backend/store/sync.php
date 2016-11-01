<?php

require_once __DIR__.'/address.php';
require_once __DIR__.'/api.php';
require_once __DIR__.'/product.php';

/**
 * This part of the script is to sync the product list in /data with up to
 * date info from Printful
 */
$products = \Store\Product\do_open();

if ($products == null) {
    throw new \Exception('Unable to open store data');
}

if (count($products) < 1) {
    throw new \Exception('Product length is less than 1');
}

foreach($products as $index => &$product) {
    if (!isset($product['id'])) {
        throw new \Exception('Product does not have an id');
    }

    if (!isset($product['variants']) || count($product['variants']) < 1) {
        throw new \Exception('Product does not contain any variants');
    }

    if (!isset($product['files']) || count($product['files']) < 1) {
        throw new \Exception('Product does not contain any files');
    }

    foreach($product['variants'] as &$variant) {
        $res = \Store\Api\get_varients($variant['id']);
        $pro = $res['product'];
        $var = $res['variant'];

        if (!isset($product['name'])) $product['name'] = $pro['name'];
        if (!isset($product['type'])) $product['type'] = $pro['type'];
        if (!isset($product['image'])) $product['image'] = $pro['image'];

        if (!isset($variant['name'])) $variant['name'] = $product['name'];
        if (!isset($variant['size'])) $variant['size'] = $var['size'];
        if (!isset($variant['color'])) $variant['color'] = $var['color'];

        $variant['cost'] = (float) $var['price'];
        if (!isset($variant['price'])) $variant['price'] = $variant['cost'];
    }
}

\Store\Product\do_save($products);

/**
 * And this part grabs all the country information from Printful and puts it
 * in the country list
 */
$countries = \Store\Api\do_request('GET', 'countries');
$list = \Store\Address\do_open();

foreach($countries as $country) {
    if (!isset($list[$country['code']])) {
        $list[$country['code']] = $country['name'];
    }

    if ($country['states'] !== null) {
        $states = [];
        foreach($country['states'] as $state) {
            $states[$state['code']] = $state['name'];
        }

        $list[$country['code']] = array(
            'name' => $country['name'],
            'states' => $states
        );
    }
}

\Store\Address\do_save($list);
