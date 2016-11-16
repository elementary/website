<?php

require_once __DIR__.'/address.php';
require_once __DIR__.'/api.php';
require_once __DIR__.'/product.php';

/**
 * Setup everything with command ling arguments etc
 */
$args = getopt("hv", ["help", "verbose"]);
$args["help"] = (isset($args["h"]) || isset($args["help"]));
$args["verbose"] = (isset($args["v"]) || isset($args["verbose"]));

if ($args["help"]) {
	printf('Usage: php sync.php [options]
  -h --help    Shows this help information
  -v --verbose Shows debug information during sync
');

	exit(0);
}

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

// Keep records of what we already have set
$saved_id = array();
$saved_group = array();
$saved_printful_id = array();
$saved_printful_variant = array();
$saved_price = array();
$saved_error = array();

foreach($products as $index => &$product) {
    if (!isset($product['id'])) {
        $saved_error[] = 'product index #'.$index.' has no product id';
        continue;
    } else if (!in_array($product['id'], $saved_id)) {
        $saved_id[] = $product['id'];
    }

    if (!isset($product['group'])) {
        $saved_error[] = 'product id #'.$product['id'].' has no group id';
        continue;
    } else if (!in_array($product['group'], $saved_group)) {
        $saved_group[] = $product['group'];
    }

    if (!isset($product['printful_id'])) {
        $saved_error[] = 'product id #'.$product['id'].' has no printful id';
        continue;
    } else if (!in_array($product['printful_id'], $saved_printful_id)) {
        $saved_printful_id[] = $product['printful_id'];
    }

    if (!isset($product['printful_variant'])) {
        $saved_error[] = 'product id #'.$product['id'].' has no printful variant';
        continue;
    } else if (!in_array($product['printful_variant'], $saved_printful_variant)) {
        $saved_printful_variant[] = $product['printful_variant'];
    }

    if (!isset($product['files']) || count($product['files']) < 1) {
        $saved_error[] = 'product id #'.$product['id'].' contain no files';
    }

    $res = \Store\Api\get_varients($product['printful_variant']);
    $pro = $res['product'];
    $var = $res['variant'];

    if (!isset($product['long_name'])) $product['long_name'] = $pro['name'];
    if (!isset($product['short_name'])) $product['short_name'] = $pro['name'];

    if (!isset($product['image'])) $product['image'] = $pro['image'];
    if (!isset($product['type'])) $product['type'] = $pro['type'];
    if (!isset($product['size'])) $product['size'] = $var['size'];
    if (!isset($product['color'])) $product['color'] = $var['color'];
    if (!isset($product['price'])) $product['price'] = number_format((float) $var['price'], 2);

    if (!in_array($product['price'], $saved_price)) {
        $saved_price[] = $product['price'];
    }

    if ($product['price'] < $var['price']) {
        $saved_error[] = 'product id #'.$product['id'].' is being sold for less than '.$var['price'].' cost';
    }
}

\Store\Product\do_save($products);

// Print out all off the debug information
printf(Store\Product\STORE_FILE." synced\n");

if ($args["verbose"]) {
    printf(count($saved_id)." products:\n");
    foreach ($saved_id as $id) {
        printf($id.' ');
    }
    printf("\n");

    printf(count($saved_group)." groups:\n");
    foreach ($saved_group as $group) {
        printf($group.' ');
    }
    printf("\n");

    printf(count($saved_printful_id)." printful products:\n");
    foreach ($saved_printful_id as $id) {
        printf($id.' ');
    }
    printf("\n");

    printf(count($saved_printful_variant)." printful variants:\n");
    foreach ($saved_printful_variant as $variant) {
        printf($variant.' ');
    }
    printf("\n\n");

    printf(count($saved_price)." product prices:\n");
    foreach ($saved_price as $price) {
        printf($price.' ');
    }
    printf("\n");
}

if (count($saved_error) > 0) {
    foreach ($saved_error as $err) {
        error_log($err);
    }

    exit(1);
}

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

printf(\Store\Address\COUNTRY_FILE." synced\n");
