<?php

include __DIR__.'/../_templates/sitewide.php';
include __DIR__.'/../backend/lib/autoload.php';
require_once __DIR__.'/../backend/config.loader.php';
$page['title'] = 'Checkout &sdot; elementary';
$page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
include $template['header'];
include $template['alert'];

require_once __DIR__.'/../backend/cart.php';
require_once __DIR__.'/../backend/shipment.php';
require_once __DIR__.'/../backend/store.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

$error = false;

if (!$error && !isset($_POST['stripe-token'])) {
    $error = new Exception('Missing a stripe token');
}

if (!$error && (
    !isset($_POST['address-name']) ||
    !isset($_POST['address-line1']) ||
    !isset($_POST['address-line2']) ||
    !isset($_POST['address-level2']) ||
    !isset($_POST['address-level1']) ||
    !isset($_POST['address-postal']) ||
    !isset($_POST['email'])
)) {
    $error = new Exception('Missing a shipping data');
}

if (!$error) {
    try {
        $cart = new Cart();

        foreach($_POST as $key => $id) {
            preg_match("/product-([0-9]+)-id/", $key, $matches);

            if ($matches && isset($_POST["product-$matches[1]-quantity"])) {
                $cart->set_set($id, $_POST["product-$matches[1]-quantity"]);
            }
        }
    } catch (Exception $e) {
        $error = new Exception('Unable to grab cart contents');
    }
}

if (!$error) {
    try {
        $shipment = new Shipment(array(
            "name" => $_POST['address-name'],
            "line1" => $_POST['address-line1'],
            "line2" => $_POST['address-line2'],
            "level2" => $_POST['address-level2'],
            "level1" => $_POST['address-level1'],
            "country" => "US",
            "postal" => $_POST['address-postal'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'] || false
        ));
    } catch (Exception $e) {
        $error = new Exception('Unable to grab shipment data');
    }
}

if (!$error) {
    try {
        $shipment->do_validation();
    } catch (Exception $e) {
        $error = new Exception('Unable to verify shipping address');
    }
}

if (!$error) {
    try {
        $shipment->set_weight($cart->get_weights());
    } catch (Exception $e) {
        $error = new Exception('Unable to calculate weights for shopping cart');
    }
}

if (!$error && $cart->get_count() <= 0) {
    $error = new Exception('Trying to order an empty cart');
}

// ffs php and your numbers
if (!$error && abs($shipment->get_weight() - floatval($_POST['cart-weight'])) > 0.001) {
    $error = new Exception('Cart weight is different than given weight');
}

if (!$error &&
    $shipment->get_line1() !== $_POST['address-line1'] &&
    $shipment->get_line2() !== $_POST['address-line2'] &&
    $shipment->get_level2() !== $_POST['address-level2'] &&
    $shipment->get_level1() !== $_POST['address-level1'] &&
    $shipment->get_country() !== "US" &&
    $shipment->get_postal() !== $_POST['postal-code']
) {
    $error = new Exception('Verified address is different than address given');
}

if (!$error) {
    try {
        $rate = $shipment->get_rate();
    } catch (Exception $e) {
        $error = new Exception('Unable to get shipping rate');
    }

    $total = $rate + $cart->get_totals();
    $total_float = intval($total * 100);
}

if (!$error && $rate !== floatval($_POST['cart-shipping'])) {
    $error = new Exception('Shipping rate is different than given rate');
}

if (!$error && $total !== floatval($_POST['cart-total'])) {
    $error = new Exception('Cart total is different than given total');
}

// Check all inventory levels before we commit to anything
if (!$error) {
    foreach ($cart->get_products() as $id => $prod) {
        if ($prod['quantity'] > $prod['inventory']['quantity_available']) {
            $error = new Exception("We don't have enough items on hand");
            return;
        }
    }
}

// Here we start making outside API verification checks
// Here be fun stuff, and money handling. Make or break time
if (!$error) {
    try {
        $charge = \Stripe\Charge::create(array(
            'amount' => $total_float,
            'currency' => 'USD',
            'card' => $_POST["stripe-token"],
            'description' => "elementary store",
            'receipt_email' => $shipment->get_email(),
            'shipping' => array(
                'name' => $shipment->get_name(),
                'address' => array(
                    'line1' => $shipment->get_line1(),
                    'line2' => $shipment->get_line2(),
                    'city' => $shipment->get_level2(),
                    'state' => $shipment->get_level1(),
                    'country' => $shipment->get_country(),
                    'postal_code' => $shipment->get_postal(),
                ),
                'phone' => $shipment->get_phone(),
                'carrier' => 'UPS'
            ),
            'metadata' => array(
                'name' => $shipment->get_name(),
                'email' => $shipment->get_email(),
                'phone' => $shipment->get_phone() || null
            )
        ));
    } catch (\Stripe\Error\Card $e) {
        $error = new Exception('Unable to processing your payment');
    } catch (Exception $e) {
        $error = new Exception('Error while processing your payment');
    }
}

if (!$error) {
    $items = [];

    foreach ($cart->get_products() as $id => $prod) {
        $items[] = array(
            "sku" => $prod['sku'],
            "description" => $prod['description'],
            "quantity" => $prod['quantity']
        );
    }

    $addr = array(
        "name" => $shipment->get_name(),
        "address1" => $shipment->get_line1(),
        "address2" => $shipment->get_line2(),
        "city" => $shipment->get_level2(),
        "state" => $shipment->get_level1(),
        "postal_code" => $shipment->get_postal(),
        "country_code" => $shipment->get_country(),
        "phone" => $shipment->get_phone(),
        "email" => $shipment->get_email()
    );

    $payload = array(
        "order_source_code" => "elementary mvp",
        "order_id" => $charge->id,
        "order_date" => "",
        "billing_info" => $addr,
        "shipping_info" => $addr,
        "shipping_method" => "UPS Ground",
        "line_items" => $items
    );

    // Yes amplifier does not like flat JSON data ¯\_(ツ)_/¯
    $req = json_encode($payload, JSON_PRETTY_PRINT);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api2.amplifier.com/v1/orders");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: '. strlen($req),
        'Authorization: Basic '. base64_encode($config['amplifier_key'])
    ));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

    $res = json_decode(curl_exec($ch));
    curl_close($ch);

    if (!isset($res->id)) {
        $error = new Exception('Unable to complete shipment order');
    } else {
        $amplifier_id = $res->id;
    }
}

// update the stripe charge with order id
if (!$error) {
    try {
        $ch = \Stripe\Charge::retrieve($charge->id);
        $ch->metadata = array(
            'name' => $shipment->get_name(),
            'email' => $shipment->get_email(),
            'phone' => $shipment->get_phone() || null,
            'order' => $amplifier_id
        );
        $ch->save();
    } catch (Exception $e) {
        error_log("An error occured updating stripe order $e");
    }
}

// Issue a refund if we charged the card but an error occured
if ($error && isset($charge)) {
    try {
        $refund = \Stripe\Refund::create(array(
            "charge" => $charge->id
        ));
    } catch (Exception $e) {
        error_log("Encountered an error while trying to issue a refund! $e");
    }
}

if (!$error) {

?>

<div class="row">
    <h3>Order Placed</h3>
    <a href="/store/">Return to store</a>
</div>

<?php } else { ?>

<div class="row">
    <h3><?php echo $error->getMessage(); ?></h3>
    <a href="/store/">Return to store</a>
</div>

<?php
}

include $template['footer'];

?>
