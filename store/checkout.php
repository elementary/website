<?php
    include __DIR__.'/../_templates/sitewide.php';

    require_once __DIR__ . '/../backend/store/api.php';
    require_once __DIR__ . '/../backend/store/cart.php';
    require_once __DIR__ . '/../backend/validation.php';

    /**
     * err
     * A small little redirection helper for error checking
     *
     * @param String $m a message to show on cart
     */
    function err ($m = 'Error while checking out') {
        header("Location: /store/cart?error=" . urlencode($m));
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') err();

    try {
        $cart = \Store\Cart\do_parse($_POST);

        $subtotal = \Store\Cart\get_subtotal();
    } catch (Exception $e) {
        return err('Unable to retrieve cart');
    }

    if (count($cart) < 1) {
        return err('Cannot checkout with an empty cart');
    }

    try {
        $address = new \Store\Address\Address();

        $address->set_name($_POST['name']);
        $address->set_line1($_POST['address1']);
        $address->set_city($_POST['city']);
        $address->set_country($_POST['country']);
        $address->set_email($_POST['email']);

        if (isset($_POST['address2']) && $_POST['address2'] !== '') $address->set_line2($_POST['address2']);
        if (isset($_POST['state']) && $_POST['state'] !== '') $address->set_state($_POST['state']);
        if (isset($_POST['postal']) && $_POST['postal'] !== '') $address->set_postal($_POST['postal']);
        if (isset($_POST['phone']) && $_POST['phone'] !== '') $address->set_phone($_POST['phone']);
    } catch (ValidationException $e) {
        return err($e->getMessage());
    } catch (Exception $e) {
        error_log($e);
        return err('Unable to validate shipping information');
    }

    try {
        $tax = \Store\Api\get_tax($address, $subtotal);
    } catch (Exception $e) {
        return err('Unable to get tax rates');
    }

    try {
        $shipping = \Store\Api\get_shipping($address, \Store\Cart\get_shipping());
        $shipping_default = $shipping[0];
    } catch (Exception $e) {
        error_log($e);
        return err('Unable to get shipping rates');
    }

    $total = number_format($subtotal + $tax + $shipping_default['cost'], 2);

    $page['title'] = 'Checkout &sdot; elementary';
    $page['scripts'] = '<script src="https://checkout.stripe.com/checkout.js" data-alipay="auto" data-locale="auto"></script>';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];
?>

<script>
    var stripeKey = '<?php include __DIR__.'/../backend/payment.php'; ?>'
    jQl.loadjQdep('scripts/store/checkout.js')
</script>

<form action="/store/order" method="post" class="grid grid--narrow">
    <div class="whole">
        <h1>Checkout</h1>
    </div>

    <div class="whole">
        <div class="list list--product">

            <?php
                foreach ($cart as $index => $item) {
                    $product = $item['product'];
                    $variant = $item['variant'];
            ?>

                <div class="list__item" id="product-<?php echo $index ?>">
                    <img src="<?php echo $product['image'] ?>"/>
                    <div class="list__info">
                        <b><?php echo $variant['name'] ?></b>
                    </div>
                    <div class="list__detail">
                        <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $variant['price'] ?>">

                        <span class="alert--error"></span>

                        <div class="subtotal">
                            <span>$<?php echo number_format($variant['price'], 2) ?></span>
                            <span>×</span>
                            <span><?php echo $item['quantity'] ?></span>
                            <span>=</span>
                            <b>$<?php echo number_format($variant['price'] * $item['quantity'], 2) ?></b>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <div class="list__footer">
                <input type="hidden" name="cart-subtotal" value="<?php echo $subtotal ?>">
                <input type="hidden" name="cart-tax" value="<?php echo $tax ?>">
                <input type="hidden" name="cart-shipping" value="<?php echo $shipping_default['cost'] ?>">
                <input type="hidden" name="cart-total" value="<?php echo $total ?>">

                <h4 id='cart-subtotal'>Sub-Total: $<?php echo $subtotal ?></h4>
                <?php if ($tax !== 0) { ?>
                <h4>Tax: $<?php echo $tax ?></h4>
                <?php } ?>
                <h4 id='cart-shipping'>Shipping: $<?php echo $shipping_default['cost'] ?></h4>
                <hr>
                <h4 id='cart-total'>Total: $<?php echo $total ?></h4>
            </div>
        </div>
    </div>

    <div class="whole">
        <h2>Shipping Information</h2>
    </div>

    <div class="whole">
        <?php
            $a = $address->get_string();

            $q = [];
            $q['key'] = $config['google_map_key'];
            $q['center'] = $a;
            $q['markers'] = $a;
            $q['size'] = '640x320';
            $q['scale'] = 2;
            $q['zoom'] = 17;
            $q = http_build_query($q);

            $url = "https://maps.googleapis.com/maps/api/staticmap?$q";

            $headers = @get_headers($url);
            if ($headers[0] === 'HTTP/1.0 200 OK') {
        ?>
        <img id="shipping-photo" src="<?php echo $url ?>" alt="shipping address">
        <?php } ?>
    </div>

    <div class="half list--address">
        <input type="hidden" name="address-name" value="<?php echo $address->get_name() ?>">
        <input type="hidden" name="address-line1" value="<?php echo $address->get_line1() ?>">
        <input type="hidden" name="address-line2" value="<?php echo $address->get_line2() ?>">
        <input type="hidden" name="address-city" value="<?php echo $address->get_city() ?>">
        <input type="hidden" name="address-state" value="<?php echo $address->get_state() ?>">
        <input type="hidden" name="address-country" value="<?php echo $address->get_country() ?>">
        <input type="hidden" name="address-postal" value="<?php echo $address->get_postal() ?>">

        <input type="hidden" name="email" value="<?php echo $address->get_email() ?>">
        <input type="hidden" name="phone" value="<?php echo $address->get_phone() ?>">

        <h5>Ship to:</h5>
        <?php foreach ($address->get_formatted() as $line) { ?>
        <span><?php echo $line ?></span>
        <?php } ?>
    </div>

    <div class="half">
        <h5>Estimated delivery:</h5>
        <span class="text--success shipping-expected"><?php echo $shipping_default['expected'] ?></span>
        <span>Items will be shipped by <span class="shipping-name"><?php echo $shipping_default['name'] ?></span></span>
    </div>

    <div class="whole">
        <table class="list--shipping">
            <?php
                foreach ($shipping as $index => $option) {
                    $sel = ($index === 0) ? 'checked' : '';
            ?>
                <tr class="list__item">
                    <input type='hidden' name='shipping-<?php echo $option['id'] ?>-name' value='<?php echo $option['name'] ?>'>
                    <input type='hidden' name='shipping-<?php echo $option['id'] ?>-expected' value='<?php echo $option['expected'] ?>'>
                    <input type='hidden' name='shipping-<?php echo $option['id'] ?>-cost' value='<?php echo $option['cost'] ?>'>

                    <td class="list__row"><input type='radio' name='shipping' value='<?php echo $option['id'] ?>' <?php echo $sel ?>></td>
                    <td class="list__row"><?php echo $option['name'] ?></td>
                    <td class="list__row"><?php echo $option['expected'] ?></td>
                    <td class="list__row">$<?php echo $option['cost'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="whole">
        <span class="alert--error"></span>
    </div>

    <div class="whole">
        <input type="hidden" name="stripe-token">
        <button type="submit" id="order" class="suggested-action">Place order</button>
    </div>
</form>

<?php
    include $template['footer'];
?>
