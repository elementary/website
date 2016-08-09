<?php

namespace Store;

require_once __DIR__ . '/api.php';
require_once __DIR__ . '/product.php';

/**
 * This is a php script to sync the product list in /data with up to date info
 * from Printful
 */
$products = do_open();

if ($products == null) {
    throw new \Exception('Unable to open store data');
}

if (count($products) < 1) {
    throw new \Exception('Product length is less than 1');
}

foreach($products as $index => &$product) {
    if (!isset($product['variants']) || count($product['variants']) < 1) {
        throw new \Exception('Product does not contain any variants');
    }

    if (!isset($product['files']) || count($product['files']) < 1) {
        throw new \Exception('Product does not contain any files');
    }

    foreach($product['variants'] as &$variant) {
        $res = get_varients($variant['id']);
        $pro = $res['product'];
        $var = $res['variant'];

        if (!isset($product['name'])) $product['name'] = $pro['name'];
        if (!isset($product['type'])) $product['type'] = $pro['type'];
        if (!isset($product['image'])) $product['image'] = $pro['image'];

        if (!isset($variant['size'])) $variant['size'] = $var['size'];
        if (!isset($variant['color'])) $variant['color'] = $var['color'];

        $variant['cost'] = (float) $var['price'];
        if (!isset($variant['price'])) $variant['price'] = $variant['cost'];
    }
}

do_save($products);
