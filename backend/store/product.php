<?php

namespace Store\Product;

const STORE_FILE = __DIR__ . '/../../data/store.json';

/**
 * do_save
 * Saves array to store list
 *
 * @param Array $i list of products
 */
function do_save (array $i) {
    file_put_contents(STORE_FILE, json_encode($i, JSON_PRETTY_PRINT));
}

/**
 * do_open
 * Returns the saved list of products
 *
 * @return Array list of products
 */
function do_open () {
    return json_decode(file_get_contents(STORE_FILE), true);
}

/**
 * get_products
 * Returns a list of detailed product information includeing price range and color array
 *
 * @return Array list of products
 */
function get_products () {
    $products = do_open();

    foreach ($products as &$product) {
        $product['price_min'] = null;
        $product['price_max'] = null;

        $product['size'] = [];
        $product['color'] = [];

        foreach ($product['variants'] as $variant) {
            if ($product['price_max'] == null || $variant['price'] > $product['price_max']) {
                $product['price_max'] = $variant['price'];
            }

            if ($product['price_min'] == null || $variant['price'] < $product['price_min']) {
                $product['price_min'] = $variant['price'];
            }

            if (!in_array($variant['size'], $product['size'])) $product['size'][] = $variant['size'];
            if (!in_array($variant['color'], $product['color'])) $product['color'][] = $variant['color'];
        }
    }

    return $products;
}
