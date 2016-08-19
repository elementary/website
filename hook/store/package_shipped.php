<?php
/**
 * /hook/store/package_shipped.php
 * Sends an email when a package is shipped
 */

require_once __DIR__ . '/index.php';

require_once __DIR__ . '/../../backend/config.loader.php';
require_once __DIR__ . '/../../backend/lib/autoload.php';
require_once __DIR__ . '/../../backend/store/address.php';
require_once __DIR__ . '/../../backend/store/product.php';

$mandrill = new Mandrill($config['mandrill_key']);

$recipient = $res['data']['order']['recipient'];
$address = new \Store\Address\Address();

try {
    if (isset($recipient['name']) && $recipient['name'] !== '') $address->set_name($recipient['name']);
    if (isset($recipient['email']) && $recipient['email'] !== '') $address->set_email($recipient['email']);
    if (isset($recipient['phone']) && $recipient['phone'] !== '') $address->set_phone($recipient['phone']);

    if (isset($recipient['country_code']) && $recipient['country_code'] !== '') $address->set_country($recipient['country_code']);
    if (isset($recipient['zip']) && $recipient['zip'] !== '') $address->set_postal($recipient['zip']);
    if (isset($recipient['state_code']) && $recipient['state_code'] !== '') $address->set_state($recipient['state_code']);
    if (isset($recipient['city']) && $recipient['city'] !== '') $address->set_city($recipient['city']);
    if (isset($recipient['address2']) && $recipient['address2'] !== '') $address->set_line2($recipient['address2']);
    if (isset($recipient['address1']) && $recipient['address1'] !== '') $address->set_line1($recipient['address1']);
} catch (Exception $e) {
    error_log('Tryed sending email to invalid address');
    error_log($e->getMessage());

    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to validate address';

    die();
}

try {
    $products = \Store\Product\do_open();

    $cart = [];
    foreach ($res['data']['order']['items'] as $item) {
        $key = array_search($item['id'], array_column($products, 'id'));
        if ($key === null) continue;
        $product = $products[$key];

        $key = array_search($item['variant_id'], array_column($product['variants'], 'id'));
        if ($key === null) continue;
        $variant = $product['variants'][$key];

        // add full url to any absolute image paths
        if (isset($product['image']) && $product['image'][0] === '/') {
            $product['image'] = 'https://elementary.io' . $product['image'];
        }

        if (isset($variant['image']) && $variant['image'][0] === '/') {
            $variant['image'] = 'https://elementary.io' . $variant['image'];
        }

        $cart[] = array(
            'product' => $product,
            'variant' => $variant,
            'quantity' => intval($item['quantity'])
        );
    }
} catch (Exception $e) {
    error_log('Error trying to parse cart information');
    error_log($e->getMessage());

    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to parse cart';

    die();
}

$req = array(
    array(
        'name' => 'shipment',
        'content' => $res['data']['shipment']
    ),
    array(
        'name' => 'order',
        'content' => $res['data']['order']
    ),
    array(
        'name' => 'address',
        'content' => $address->get_formatted()
    ),
    array(
        'name' => 'items',
        'content' => $cart
    )
);

$message = array(
    'subject' => 'Package Shipped',
    'from_email' => 'payment@elementary.io',
    'from_name' => 'elementary',
    'to' => array(
        array(
            'email' => $address->get_email(),
            'name' => $address->get_name(),
            'type' => 'to'
        )
    ),
    'headers' => array(
        'Reply-To' => 'payment@elementary.io'
    ),
    'important' => false,
    'tags' => array(
        'store',
        'package'
    )
);

var_dump($req);

try {
    $res = $mandrill->messages->sendTemplate('package_shipped', $req, $message);

    foreach ($res as $mail) {
        if (isset($mail['reject_reason']) && $mail['reject_reason'] !== '') {
            throw new Exception($mail['reject_reason']);
        }
    }
} catch (Mandrill_Error $e) {
    error_log('Mandrill error trying to send hook/store/package_shipped email');
    error_log(get_class($e) . ' - ' . $e->getMessage());

    header('HTTP/1.1 500 Internal Server Error');
    echo 'Unable to send email';

    die();
} catch (Exception $e) {
    error_log('Failed to send hook/store/package_shipped email');
    error_log($e->getMessage());

    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error while sending email';

    die();
}
