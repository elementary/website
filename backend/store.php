<?php
require_once __DIR__.'/amplifier.php';

function store_cart() {
    $product = amplifier_raw();
    $cart = json_decode($_COOKIE['cart'], true);
    $return = [];

    foreach ($cart as $id => $quantity) {
        if (isset($product[$id])) {
            $return[$id] = $product[$id];
            $return[$id]['quantity'] = $quantity;
        }
    }

    return $return;
}
