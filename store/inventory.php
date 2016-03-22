<?php
require_once __DIR__.'/../backend/store.php';
require_once __DIR__.'/../backend/amplifier.php';

$products = amplifier_product();

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
} else {
    $cart = [];
}

$uid = $_GET['uid'] ?? $_POST['uid'] ?? false;
$size = $_GET['size'] ?? $_POST['size'] ?? false;
$color = $_GET['color'] ?? $_POST['color'] ?? false;

$id = $_GET['id'] ?? $_POST['id'] ?? false;
$math = $_GET['math'] ?? $_POST['math'] ?? show;
$quantity = $_GET['quantity'] ?? $_POST['quantity'] ?? 1;

if ($uid) {
    foreach($products as $id => $product) {
        $p_color = $product['color'] ?? false;
        $p_size = $product['size'] ?? false;

        if ($product['uid'] === $uid && $p_color === $color && $p_size === $size) {
            $id = $product['id'];
            break;
        }
    }
}

if (!$id) {
    echo 'Missing id or uid';
    return;
}

if ($math === 'show') {
    echo json_encode($_COOKIE['cart']);
    return;
}

$cart[$id] = $cart[$id] ?? 0;

if ($math === 'add') {
    $cart[$id] = intVal($cart[$id]) + intVal($quantity);
}

if ($math === 'subtract') {
    $cart[$id] = intVal($cart[$id]) - intVal($quantity);
}

if ($math === 'set') {
    $cart[$id] = intVal($quantity);
}

if ($cart[$id] <= 0) {
    unset($cart[$id]);
}

if (count($cart) > 0) {
    setcookie('cart', json_encode($cart), time() + 604800, '/', '', 0, 1);
} else {
    $math = 'clear';
}

if ($math === 'clear') {
    setcookie('cart', '', time() - 1, '/', '', 0, 1);
}

echo 'OK';
