<?php

/**
 * api/cart.php
 * Allows javascript manipulation of the cart cookie
 * NOTE: partially implements [JSON api spec](http://jsonapi.org/)
 *
 * Currently impliments:
 *   GET to show cart data and sadly manipulate cart data
 *   POST to manipulate cart data
 */

namespace Store\Cart;

require_once __DIR__.'/../_backend/preload.php';
require_once __DIR__.'/../_backend/store/cart.php';

$cart = get_cart();

$req = $_SERVER['REQUEST_METHOD'];

/**
 * res_error
 * Echos a JSON API error
 *
 * @param Number status http error code
 * @param String title error message title
 * @param String detail error message details if any
 * @param String input the input that the error occured with
 *
 * @return Void
 */
function res_error ($status, $title, $detail, $input) {
    $error = array(
        "title" => $title
    );

    if (isset($detail)) $error['detail'] = $detail;
    if (isset($input)) $error['source'] = array("pointer" => $input);

    $output = array(
        "errors" => [$error]
    );

    header('Content-type:application/vnd.api+json');
    http_response_code($status);
    echo json_encode($output, JSON_PRETTY_PRINT);
}

/**
 * cart_manipulate
 * helper function for manipulating the cart
 *
 * @param Number $id the product ID to manipulate
 * @param String $math the type of manipulation
 * @param Number $quantity the amount to manipulate by
 *
 * @return Boolean true if successful
 */
function cart_manipulate ($id, $math = 'add', $quantity = 1) {
    if ($math === 'add') {
        try {
            $success = set_add($id, $quantity);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    if ($math === 'set') {
        try {
            $success = set_quantity($id, $quantity);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    return false;
}

/**
 * GET /api/cart
 * Shows the current cart and sadly does manipulation for links
 * TODO: phase out the need for the redirect param
 *
 * @param Number id the product id to manipulate
 * @param String math the manipulation to occur. Currently `add` and `set`
 * @param Number quantity the quantity to use in manipulation
 * @param Boolean redirect true if we should respond with JSON. false to redirect
 */
if ($req === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $math = $_GET['math'] ?? 'add';
        $quantity = $_GET['quantity'] ?? 1;
        $redirect = $_GET['redirect'] ?? false;

        $success = cart_manipulate($id, $math, $quantity);

        if ($success === false) {
            return res_error(500, 'Internal Error', 'Unsuccessful while trying to change cart');
        }

        if ($redirect === false) {
            header("Location: " . $sitewide['root'] . "store/cart");
            return;
        }
    }

    $output = array(
        "data" => $cart
    );

    header('Content-type:application/vnd.api+json');
    echo json_encode($output, JSON_PRETTY_PRINT);
    return;
}

/**
 * POST /api/cart
 * Manipulates the cart
 * TODO: phase out the need for the redirect param
 *
 * @param Number id the product id to manipulate
 * @param String math the manipulation to occur. Currently `add` and `set`
 * @param Number quantity the quantity to use in manipulation
 * @param Boolean redirect true if we should respond with JSON. false to redirect
 */
if ($req === 'POST') {
    if (!isset($_POST['id'])) {
        return res_error(400, 'Invalid Attribute', 'Missing ID POST value');
    }

    $id = $_POST['id'];
    $math = $_POST['math'] ?? 'add';
    $quantity = $_POST['quantity'] ?? 1;
    $redirect = $_POST['redirect'] ?? false;

    $success = cart_manipulate($id, $math, $quantity);

    if ($success === false) {
        return res_error(500, 'Internal Error', 'Unsuccessful while trying to change cart');
    }

    if ($redirect === false) {
        header("Location: " . $sitewide['root'] . "store/cart");
        return;
    }

    $output = array(
        "data" => get_cart()
    );

    header('Content-type:application/vnd.api+json');
    echo json_encode($output, JSON_PRETTY_PRINT);
    return;
}
