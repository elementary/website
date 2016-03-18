<?php
require_once __DIR__.'/../backend/store.php';

$current = json_decode($_COOKIE['cart'], true);
$future = $current;

if (isset($_GET['id']) && isset($_GET['math']) && isset($_GET['quantity'])) {
    if ($_GET['math'] === 'add') {
        if (isset($current[$_GET['id']])) {
            $amount = $current[$_GET['id']];
        } else {
            $amount = 0;
        }

        $future[$_GET['id']] = intVal($amount) + intVal($_GET['quantity']);
    } else if ($_GET['math'] === 'subtract') {
        $amount = $cart[$_GET['id']] || 0;

        $future[$_GET['id']] = intVal($amount) - intVal($_GET['quantity']);

        if ($future[$_GET['id']] <= 0) {
            unset($future[$_GET['id']]);
        }
    }

    if (count($future) > 0) {
        setcookie('cart', json_encode($future), time() + 604800, '/', '', 0, 1);
    } else {
        setcookie('cart', '', time() - 1, '/', '', 0, 1);
    }

    echo 'OK';
} else if (isset($_GET['math']) && $_GET['math'] === 'clear') {
    setcookie('cart', '', time() - 1, '/', '', 0, 1);

    echo 'OK';
} else {
    echo json_encode($current);
}
