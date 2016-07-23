<?php

require_once __DIR__.'/../_templates/sitewide.php';
require_once __DIR__.'/../backend/cart.php';

if (!isset($cart)) {
    $cart = new Cart('cookie');
}

$id = $_GET['id'] ?? $_POST['id'] ?? false;
$math = $_GET['math'] ?? $_POST['math'] ?? show;
$quantity = $_GET['quantity'] ?? $_POST['quantity'] ?? 1;
$simple = $_GET['simple'] ?? $_POST['simple'] ?? false;

if (!$id) {
    echo 'Missing id';
    return;
}

if ($math !== 'add' && $math !== 'remove' && $math !== 'set') {
    echo 'Missing add or remove math';
    return;
}

if ($math === 'add') {
    if ($cart->set_add($id, $quantity)) {
        echo 'Failed to add item';
        return;
    }
}

if ($math === 'remove') {
    if ($cart->set_remove($id, $quantity)) {
        echo 'Failed to remove item';
        return;
    }
}

if ($math === 'set') {
    if ($cart->set_set($id, $quantity)) {
        echo 'Failed to set item';
        return;
    }
}

$cart->set_cookie();

if ($simple) {
    echo 'OK';
    return;
}

header("Location: https://$_SERVER[HTTP_HOST]/store/");
