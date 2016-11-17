<?php

namespace Store\Product;

const STORE_FILE = __DIR__.'/../../data/store.json';

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
 * Returns a list of products
 * TODO: We should cache this to memory
 *
 * @throws Exception when unable to open store file, or a decoding error
 *
 * @return Array a list of products
 */
function get_products () {
    $products = do_open();

    if ($products == null) {
        throw new \Exception("Unable to get list of products");
    }

    return $products;
}

/**
 * get_product
 * Returns a single product by way of ID
 *
 * @param Integer $i ID of product to return
 *
 * @return Array a single product
 * @throws Exception when product does not exist
 */
function get_product ($i) {
    $products = get_products();

    $key = array_search($i, array_column(get_products(), 'id'));
    if ($key === false || $key === null) {
        throw new \Exception("Product does not exist");
    }

    return $products[$key];
}

/**
 * get_groups
 * Returns a list of groups
 *
 * @return Array a list of groups
 */
function get_groups () {
    $output = array();

    foreach (array_unique(array_column(get_products(), 'group')) as $id) {
        $output[] = get_group($id);
    }

    return $output;
}

/**
 * get_group
 * Returns a list of products all in a similar group
 *
 * [{
 *   'group': 1,
 *   'name': "Men's Cotton T-Shirt",
 *   'description': '..,',
 *   'type': 'Apparel',
 *   'image': 'images/store/apparel...',
 *   'max_price': 26,
 *   'min_price': 25,
 *   'sizes': ['S', 'M', ...],
 *   'colors': ['Teal'],
 *   'products': [{
 *     // Normal product object
 *   }]
 * }]
 *
 * @param Integer $i Group ID of products to return
 *
 * @return Array a list of products belonging to the group
 */
function get_group ($i) {
    $output = array(
        'group' => null,
        'name' => null,
        'description' => null,
        'type' => null,
        'image' => null,
        'max_price' => 0,
        'min_price' => 0,
        'sizes' => array(),
        'colors' => array(),
        'products' => array()
    );

    // Step 1: Collect all the products
    foreach (get_products() as $index => $product) {
        if ($product['group'] === $i) {
            $output['products'][] = $product;
        }
    }

    // Step 2: Calculate the group values like min and max price
    foreach ($output['products'] as $product) {
        if ($output['name'] == null) $output['name'] = $product['long_name'];
        if ($output['description'] == null) $output['description'] = $product['description'];
        if ($output['type'] == null) $output['type'] = $product['type'];
        if ($output['image'] == null) $output['image'] = $product['image'];
        if ($output['max_price'] === 0) $output['max_price'] = $product['price'];
        if ($output['min_price'] === 0) $output['min_price'] = $product['price'];

        if ($product['price'] > $output['max_price']) $output['max_price'] = $product['price'];
        if ($product['price'] < $output['min_price']) $output['min_price'] = $product['price'];

        if (!in_array($product['size'], $output['sizes'])) $output['sizes'][] = $product['size'];
        if (!in_array($product['color'], $output['colors'])) $output['colors'][] = $product['color'];
    }

    return $output;
}

/**
 * get_types
 * Returns an array with type as key of all groups
 *
 *  {
 *   'Apparel': [{
 *     // Normal group object
 *   }]
 * }
 *
 * @return Array a list of groups with the the type as key
 */
function get_types () {
    $groups = get_groups();
    $output = array();

    foreach ($groups as $group) {
        if (!isset($output[$group['type']])) {
            $output[$group['type']] = array();
        }

        $output[$group['type']][] = $group;
    }

    return $output;
}
