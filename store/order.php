<?php
require_once __DIR__ . '/../_backend/preload.php';
require_once __DIR__ . '/../_backend/store/api.php';
require_once __DIR__ . '/../_backend/store/cart.php';
require_once __DIR__ . '/../_backend/store/validation.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

/**
 * res
 * A simple response class for easier handling of errors
 *
 * @param String $m a message to show on cart
 * @param String $a the button link location
 * @param String $b the button text
 */
function res($m = 'Error while checking out', $a = 'store/', $b = 'Return to store')
{
    global $template;
    global $sitewide;

    $page['title'] = 'Checkout &sdot; elementary';

    $page['styles'] = array(
        'styles/store.css'
    );

    include $template['header'];
    include $template['alert'];

    echo "
            <div class=\"row\">
                <h3>" . $m . "</h3>
                <a href=\"" . $page['lang-root'] . $a . "\">" . $b . "</a>
            </div>
        ";

    include $template['footer'];
    return;
}

/**
 * Start checking all incoming variables
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . $sitewide['root'] . "store/");
    return;
}

try {
    $cart = \Store\Cart\do_parse($_POST);

    $subtotal = \Store\Cart\get_subtotal();
} catch (Exception $e) {
    return res('Unable to retrieve cart');
}

if (count($cart) < 1) {
    return res('Trying to order an empty cart');
}

try {
    $address = new \Store\Address\Address();

    $address->setName($_POST['address-name']);
    $address->setLine1($_POST['address-line1']);
    $address->setCity($_POST['address-city']);
    $address->setCountry($_POST['address-country']);
    $address->setEmail($_POST['email']);

    if (isset($_POST['address-line2']) && $_POST['address-line2'] !== '') {
        $address->setLine2($_POST['address-line2']);
    }
    if (isset($_POST['address-state']) && $_POST['address-state'] !== '') {
        $address->setState($_POST['address-state']);
    }
    if (isset($_POST['address-postal']) && $_POST['address-postal'] !== '') {
        $address->setPostal($_POST['address-postal']);
    }
    if (isset($_POST['phone']) && $_POST['phone'] !== '') {
        $address->setPhone($_POST['phone']);
    }
} catch (ValidationException $e) {
    return res($e->getMessage());
} catch (Exception $e) {
    error_log($e);
    return res('Unable to validate shipping information');
}

try {
    $shipping_res = \Store\Api\get_shipping($address, \Store\Cart\get_shipping());

    $shipping = null;
    foreach ($shipping_res as $shipment) {
        if ($shipment['id'] === $_POST['shipping']) {
            $shipping = $shipment;
        }
    }

    if ($shipping === null) {
        throw new Exception('Invalid shipping ID');
    }
} catch (Exception $e) {
    error_log($e);
    return res('Unable to get shipping rate');
}

try {
    $tax = \Store\Api\get_tax($address, $subtotal + $shipping['cost']);
} catch (Exception $e) {
    return err('Unable to get tax rates');
}

$total = number_format($subtotal + $tax + $shipping['cost'], 2);

try {
    if ((floatval($subtotal) !== floatval($_POST['cart-subtotal'])) ||
        (floatval($tax) !== floatval($_POST['cart-tax'])) ||
        (floatval($shipping['cost']) !== floatval($_POST['cart-shipping'])) ||
        (floatval($total) !== floatval($_POST['cart-total']))
    ) {
        throw new Exception();
    }
} catch (Exception $e) {
    return res('Discrepancy in cart prices');
}

try {
    validate_string($_POST['stripe-token']);
} catch (Exception $e) {
    return res('Unable to get payment token');
}

/**
 * Here is the start of payment. Be very careful you don't start drainging
 * bank accounts!
 */
try {
    $charge = \Stripe\Charge::create(array(
        'amount' => intval($total * 100),
        'currency' => 'USD',
        'card' => $_POST['stripe-token'],
        'description' => 'elementary store',
        'receipt_email' => $address->getEmail(),
        'shipping' => array(
            'name' => $address->getName(),
            'address' => array(
                'line1' => $address->getLine1(),
                'line2' => $address->getLine2(),
                'city' => $address->getCity(),
                'state' => $address->getState(),
                'country' => $address->getCountry(),
                'postal_code' => $address->getPostal(),
            ),
            'phone' => $address->getPhone(),
            'carrier' => $shipping['name']
        ),
        'metadata' => array(
            'name' => $address->getName(),
            'email' => $address->getEmail(),
            'phone' => $address->getPhone()
        )
    ));
} catch (\Stripe\Error\Card $e) {
    return res('Unable to processing your payment');
} catch (Exception $e) {
    error_log("Encountered an error while trying to create charge $e");
    return res('Error while processing your payment');
}

try {
    $req = array(
        'external_id' => $charge->id,
        'shipping' => $shipping['id'],
        'recipient' => array(
            'name' => $address->getName(),
            'address1' => $address->getLine1(),
            'address2' => $address->getLine2(),
            'city' => $address->getCity(),
            'state_code' => $address->getState(),
            'country_code' => $address->getCountry(),
            'zip' => $address->getPostal(),
            'phone' => $address->getPhone(),
            'email' => $address->getEmail()
        ),
        'items' => array(),
        'retail_costs' => array(
            'shipping' => $shipping['cost'],
            'tax' => $tax
        )
    );

    foreach ($cart as $index => $item) {
        $req['items'][] = array(
            'external_id' => $item['product']['id'] . '-' . $item['variant']['id'],
            'variant_id' => $item['variant']['printful_id'],
            'quantity' => $item['quantity'],
            'name' => $item['variant']['name'],
            'files' => $item['product']['files'],
            'retail_price' => $item['variant']['price']
        );
    }

    $order = \Store\Api\do_request('POST', 'orders', $req, array(
        'confirm' => true
    ));
} catch (Exception $e) {
    try {
        \Stripe\Refund::create(array(
            "charge" => $charge->id
        ));
    } catch (Exception $e) {
        error_log("Encountered an error while trying to issue a refund! $e");
        return res('Please contact elementary support');
    }

    error_log("Encountered an error while making an order $e");
    return res('Error while creating order');
}

try {
    $ch = \Stripe\Charge::retrieve($charge->id);
    $ch->metadata = array(
        'name' => $address->getName(),
        'email' => $address->getEmail(),
        'phone' => $address->getPhone(),
        'order' => $order['id']
    );
    $ch->save();
} catch (Exception $e) {
    error_log("An error occured updating stripe order $e");
}

//// Show a successful order page
$page['title'] = 'Order Complete &sdot; elementary';

$page['styles'] = array(
    'styles/store.css'
);

include $template['header'];
include $template['alert'];

?>

    <script src="scripts/store/order.js" async></script>

    <div class="grid text-center">
        <h3>It's on its way!</h3>
        <p class="half">Your order is being fulfilled. We emailed you a payment receipt and will send an email once it's
            been shipped. If you have any issues with your order, please email <a href="mailto:payment@elementary.io">payment@elementary.io</a>.
            Thanks!</p>
        <a class="whole" href="<?php echo $page['lang-root']; ?>store">Back to store</a>
    </div>

<?php

include $template['footer'];
