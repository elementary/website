<?php

namespace Store;

require_once __DIR__ . '/product.php';

/**
 * get_cart
 * Returns current parsed cart cookie
 *
 * @return Array list of products
 */
function get_cart () {
    if (!isset($_COOKIE['cart'])) {
        return array();
    } else {
        return json_decode($_COOKIE['cart'], true);
    }
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
    if (count($c) > 0) {
        return setcookie('cart', json_encode($c), strtotime('+1 days'));
    } else {
        return setcookie('cart', false, 1);
    }
}

/**
 * set_quantity
 * sets the quantity on product in cart
 *
 * @param Number $i product id
 * @param Number $v product variant id
 * @param Number $q quantity of product to set
 *
 * @return Boolean true if cookie was set
 *
 * @throws Exception on bad product or variant param given
 */
function set_quantity (int $i, int $v, int $q = 1) {
    $cart = get_cart();
    $products = \Store\do_open();

    if (!isset($products[$i])) {
        throw new \Exception('Product id does not exist');
    }

    $key = array_search($v, array_column($products[$i]['variants'], 'id'));

    if ($key === null) {
        throw new \Exception('Variant id does not exist');
    }

    $id = $i . '-' . $v;
    $cart[$id] = $q;

    return set_cart($cart);
}

/**
 * set_add
 * adds to quantity in cart
 *
 * @param Number $i product id
 * @param Number $v product variant id
 * @param Number $q quantity of product to add
 *
 * @return Boolean true if cookie was set
 *
 * @throws Exception on bad product or variant param given
 */
function set_add (int $i, int $v, int $q = 1) {
    $cart = get_cart();
    $id = $i . '-' . $v;

    if (isset($cart[$id])) {
        $q += $cart[$id];
    }

    return set_quantity($i, $v, $q);
}
