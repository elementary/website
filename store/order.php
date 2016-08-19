<?php
    include __DIR__ . '/../backend/lib/autoload.php';

    require_once __DIR__ . '/../backend/config.loader.php';
    require_once __DIR__ . '/../backend/store/api.php';
    require_once __DIR__ . '/../backend/store/cart.php';
    require_once __DIR__ . '/../backend/validation.php';

    \Stripe\Stripe::setApiKey($config['stripe_sk']);

    /**
     * res
     * A simple response class for easier handling of errors
     *
     * @param String $m a message to show on cart
     * @param String $a the button link location
     * @param String $b the button text
     */
    function res ($m = 'Error while checking out', $a = '/store/', $b = 'Return to store') {
        include __DIR__ . '/../_templates/sitewide.php';

        $page['title'] = 'Checkout &sdot; elementary';
        $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';

        include $template['header'];
        include $template['alert'];

        echo "
            <div class=\"row\">
                <h3>" . $m . "</h3>
                <a href=\"" . $a . "\">" . $b . "</a>
            </div>
        ";

        include $template['footer'];
        return;
    }

    /**
     * Start checking all incoming variables
     */
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /store/");
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

        $address->set_name($_POST['address-name']);
        $address->set_line1($_POST['address-line1']);
        $address->set_city($_POST['address-city']);
        $address->set_country($_POST['address-country']);
        $address->set_email($_POST['email']);

        if (isset($_POST['address-line2']) && $_POST['address-line2'] !== '') $address->set_line2($_POST['address-line2']);
        if (isset($_POST['address-state']) && $_POST['address-state'] !== '') $address->set_state($_POST['address-state']);
        if (isset($_POST['address-postal']) && $_POST['address-postal'] !== '') $address->set_postal($_POST['address-postal']);
        if (isset($_POST['phone']) && $_POST['phone'] !== '') $address->set_phone($_POST['phone']);
    } catch (ValidationException $e) {
        return res($e->getMessage());
    } catch (Exception $e) {
        error_log($e);
        return res('Unable to validate shipping information');
    }

    try {
        $shipping_res = \Store\Api\get_shipping($address, \Store\Cart\get_shipping());

        $shipping = null;
        foreach($shipping_res as $shipment) {
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
        if (
            (floatval($subtotal)         !== floatval($_POST['cart-subtotal'])) ||
            (floatval($tax)              !== floatval($_POST['cart-tax'])) ||
            (floatval($shipping['cost']) !== floatval($_POST['cart-shipping'])) ||
            (floatval($total)            !== floatval($_POST['cart-total']))
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
            'receipt_email' => $address->get_email(),
            'shipping' => array(
                'name' => $address->get_name(),
                'address' => array(
                    'line1' => $address->get_line1(),
                    'line2' => $address->get_line2(),
                    'city' => $address->get_city(),
                    'state' => $address->get_state(),
                    'country' => $address->get_country(),
                    'postal_code' => $address->get_postal(),
                ),
                'phone' => $address->get_phone(),
                'carrier' => $shipping['name']
            ),
            'metadata' => array(
                'name' => $address->get_name(),
                'email' => $address->get_email(),
                'phone' => $address->get_phone()
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
                'name' => $address->get_name(),
                'address1' => $address->get_line1(),
                'address2' => $address->get_line2(),
                'city' => $address->get_city(),
                'state_code' => $address->get_state(),
                'country_code' => $address->get_country(),
                'zip' => $address->get_postal(),
                'phone' => $address->get_phone(),
                'email' => $address->get_email()
            ),
            'items' => array(),
            'retail_costs' => array(
                'shipping' => $shipping['cost'],
                'tax' => $tax
            )
        );

        foreach ($cart as $index => $item) {
            $req['items'][] = array(
                'variant_id' => $item['variant']['id'],
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
            'name' => $address->get_name(),
            'email' => $address->get_email(),
            'phone' => $address->get_phone(),
            'order' => $order['id']
        );
        $ch->save();
    } catch (Exception $e) {
        error_log("An error occured updating stripe order $e");
    }

    return res('Order created');
