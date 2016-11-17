<?php

/**
 * _backend/store/cart.php
 * Handles backend manipulation of cart cookie
 *
 * Items stored in cart cookie are in the JSON string form of:
 * { <id>: <quantity> }
 *
 * All internal PHP handling is in the form of:
 * { <id> => {
 *     quantity: <quantity>
 *     product: <product object>
 * }}
 */

namespace Store\Cart;

require_once __DIR__.'/product.php';

/**
 * get_cart
 * Returns current parsed cart cookie
 *
 * @return Array list of products
 */
function get_cart () {
    $products = \Store\Product\get_products();

    if (!isset($_COOKIE['cart'])) {
        $cart = array();
    } else {
        $cart = json_decode($_COOKIE['cart'], true);
    }

    $f = [];
    foreach ($cart as $id => $quantity) {
        try {
            $product = \Store\Product\get_product($id);
        } catch (\Exception $e) {
            continue;
        }

        $f[$id] = array(
            'quantity' => intval($quantity),
            'product' => $product
        );
    }

    return $f;
}

/**
 * get_subtotal
 * Returns the current price of the cart without shipping or extras
 *
 * @return Float price of cart
 */
function get_subtotal () {
    $cart = get_cart();
    $price = 0;

    foreach ($cart as $item) {
        $price = $price + ($item['quantity'] * $item['product']['price']);
    }

    return number_format((float) $price, 2);
}

/**
 * get_shipping
 * Returns a list of cart items ready to be used in Printful api
 *
 * @return Array list of cart products
 */
function get_shipping () {
    $cart = get_cart();
    $items = [];

    foreach ($cart as $pro) {
        $items[] = array(
            'quantity' => $pro['quantity'],
            'variant_id' => $pro['product']['printful_variant_id']
        );
    }

    return $items;
}

/**
 * set_cart
 * Sets the cart cookie
 *
 * @param Array $c list of cart items
 *
 * @return Boolean true if cookie was set
 */
function set_cart (array $c) {
    $f = [];
    foreach ($c as $item) {
        if (!isset($item['product']) || !isset($item['product']['id'])) continue;
        if (!isset($item['quantity']) || (int) $item['quantity'] < 1) continue;

        $f[$item['product']['id']] = $item['quantity'];
    }

    if (count($f) > 0) {
        return setcookie('cart', json_encode($f), time() + 315360000, '/', '', 0, 1);
    } else {
        return setcookie('cart', false, 1, '/', '', 0, 1);
    }
}

/**
 * do_parse
 * Parses (usually a POST) array of data for cart information
 * Used instead of cookies to avoid weird missmatches during checkout process
 *
 * @param Array $c list of inputs to parse
 *
 * @return Array list of cart items
 */
function do_parse (array $c) {
    $products = \Store\Product\get_products();
    $f = [];

    foreach ($c as $name => $value) {
        preg_match('/product-([0-9]+)-id/', $name, $matches);

        if ($matches && isset($c["product-$matches[1]-quantity"])) {
            $id = intval($matches[1]);
            $quantity = intval($c["product-$id-quantity"]);

            try {
                $product = \Store\Product\get_product($id);
            } catch (\Exception $e) {
                continue;
            }

            $f[$id] = array(
                'product' => $product,
                'quantity' => $quantity
            );
        }
    }

    set_cart($f);
    return get_cart();
}

/**
 * set_quantity
 * sets the quantity on product in cart
 *
 * @param Int $i product id
 * @param Int $q quantity of product to set
 *
 * @return Boolean true if cookie was set
 *
 * @throws Exception on bad product param given
 */
function set_quantity (int $i, int $q = 1) {
    $cart = get_cart();

    $product = \Store\Product\get_product($i);

    $cart[$product['id']] = array(
        'product' => $product,
        'quantity' => $q
    );

    return set_cart($cart);
}

/**
 * set_add
 * adds to quantity in cart
 *
 * @param Int $i product id
 * @param Int $q quantity of product to add
 *
 * @return Boolean true if cookie was set
 *
 * @throws Exception on bad product param given
 */
function set_add (int $i, int $q = 1) {
    $cart = get_cart();

    if (isset($cart[$i])) {
        $q += $cart[$i]['quantity'];
    }

    return set_quantity($i, $q);
}
