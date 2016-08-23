<?php
/**
 * /hook/store/package_shipped.php
 * Sends an email when a package is shipped
 */

require_once __DIR__ . '/index.php';

require_once __DIR__ . '/../../_templates/sitewide.php';

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
        if (isset($product['image']) && strpos($product['image'][0], 'http') === false) {
            $product['image'] = 'https:' . $sitewide['branch_root'] . $product['image'];
        }

        if (isset($variant['image']) && strpos($variant['image'][0], 'http') === false) {
            $variant['image'] = 'https:' . $sitewide['branch_root'] . $variant['image'];
        }

        $cart[] = array(
            'image' => $product['image'],
            'name' => $variant['name'],
            'price' => $variant['price'],
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
        'name' => 'address',
        'content' => $address->get_formatted()
    ),
    array(
        'name' => 'cart',
        'content' => $cart
    ),
    array(
        'name' => 'ship_date',
        'content' => $res['data']['shipment']['ship_date']
    )
);

if (isset($res['data']['shipment']['tracking_number'])) {
    $req[] = array(
        'name' => 'tracking_number',
        'content' => $res['data']['shipment']['tracking_number']
    );
    $req[] = array(
        'name' => 'tracking_url',
        'content' => $res['data']['shipment']['tracking_url']
    );
    $req[] = array(
        'name' => 'carrier',
        'content' => $res['data']['shipment']['carrier']
    );
    $req[] = array(
        'name' => 'service',
        'content' => $res['data']['shipment']['service']
    );
}

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
    ),
    'global_merge_vars' => $req, // the regular template data is not working
    'merge_language' => 'handlebars'
);

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
