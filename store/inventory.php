<?php
require_once __DIR__.'/../backend/store.php';
require_once __DIR__.'/../backend/amplifier.php';

if (isset($_COOKIE['cart'])) {
    $current = json_decode($_COOKIE['cart'], true);
} else {
    $current = [];
}

$future = $current;
$products = amplifier_product();

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $color = $_GET['color'];
    $size = $_GET['size'];
} else if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $color = $_POST['color'];
    $size = $_POST['size'];
}

if (isset($uid)) {
    foreach($products as $id => $product) {
        if ($product['uid'] === $uid && $product['color'] == $color && $product['size'] == $size) {
            $id = $product['id'];
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else if (!isset($id)) {
    echo 'Missing id or uid';
    return;
}

if (isset($_GET['math'])) {
    $math = $_GET['math'];
} else if (isset($_POST['math'])) {
    $math = $_POST['math'];
} else {
    echo 'Missing math';
    return;
}

if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
} else if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
} else {
    $quantity = 1;
}

if (!isset($id)) {
    echo $_COOKIE['cart'];
    return;
} else if (!isset($future[$id])) {
    $future[$id] = 0;
}

if ($math === 'add') {
    $future[$id] = intVal($current[$id]) + intVal($quantity);
}

if ($math === 'subtract') {
    $future[$id] = intVal($current[$id]) - intVal($quantity);
}

if ($math === 'set') {
    $future[$id] = intVal($quantity);
}

if ($future[$id] <= 0) {
    unset($future[$id]);
}

if (count($future) > 0) {
    setcookie('cart', json_encode($future), time() + 604800, '/', '', 0, 1);
} else {
    $math = 'clear';
}

if ($math === 'clear') {
    setcookie('cart', '', time() - 1, '/', '', 0, 1);
}

echo 'OK';
