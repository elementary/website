<?php
require_once __DIR__.'/../backend/store.php';

if (isset($_GET['uid']) && isset($_GET['quantity'])) {
    $cart = storeCart();
    if (!$cart) {
        $cart = [];
    }

    if ($_GET['quantity'] > 0) {
        $cart[$_GET['uid']] = intVal($_GET['quantity']);
    } else {
        unset($cart[$_GET['uid']]);
    }

    if (count($cart) > 0) {
        setcookie('cart', json_encode($cart), time() + 604800, '/', '', 0, 1);
    } else {
        setcookie('cart', "", time() - 1, '/', '', 0, 1);
    }
    echo "OK";
} else {
    echo "NO";
}
