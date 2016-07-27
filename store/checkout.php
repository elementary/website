<?php
    include __DIR__.'/../_templates/sitewide.php';
    include __DIR__.'/../backend/lib/autoload.php';
    require_once __DIR__.'/../backend/config.loader.php';
    $page['title'] = 'Checkout &sdot; elementary';
    $page['scripts'] .= '<script src="https://checkout.stripe.com/checkout.js" data-alipay="auto" data-locale="auto"></script>';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/cart.php';

    $cart = new Cart('post');

    require_once __DIR__.'/../backend/shipment.php';
    $shipment = new Shipment();

    if ($cart->get_count() <= 0) {
        $error = new Exception('Trying to checkout with an empty cart');
    } else {
        $error = false;
    }

    if (!$error) {
        if (!isset($_POST['first-name']) || !isset($_POST['last-name'])) {
            $error = new Exception('Checkout requires a shipment name');
        }

        if (!isset($_POST['address-line1'])) {
            $error = new Exception('Checkout requires a shipment address line');
        }

        if (!isset($_POST['address-level2'])) {
            $error = new Exception('Checkout requires a shipment address city');
        }

        if (!isset($_POST['address-level1'])) {
            $error = new Exception('Checkout requires a shipment address state');
        }

        if (!isset($_POST['postal-code'])) {
            $error = new Exception('Checkout requires a shipment address postal code');
        }

        if (!isset($_POST['email'])) {
            $error = new Exception('Checkout requires an email');
        }
    }

    if (!$error) {
        try {
            $shipment->set_name($_POST['first-name'].' '.$_POST['last-name']);
            $shipment->set_line1($_POST['address-line1']);
            $shipment->set_line2($_POST['address-line2']);
            $shipment->set_level2($_POST['address-level2']);
            $shipment->set_level1($_POST['address-level1']);
            $shipment->set_country('US');
            $shipment->set_postal($_POST['postal-code']);
            $shipment->set_email($_POST['email']);

            if (isset($_POST['phone'])) {
                $shipment->set_phone($_POST['phone']);
            }
        } catch (Exception $e) {
            $error = new Exception('Unable to parse shipment form');
        }
    }

    if (!$error) {
        try {
            $shipment->do_validation();
        } catch (Exception $e) {
            $error = new Exception('Unable to verify shipping address');
        }
    }

    // Time to grab all the weight
    if (!$error) {
        try {
            $shipment->set_weight($cart->get_weights());
        } catch (Exception $e) {
            $error = new Exception('Unable to calculate weights for shopping cart');
        }
    }

    if (!$error) {
        try {
            $rate = $shipment->get_rate();
        } catch (Exception $e) {
            $error = new Exception('Unable to get rates for shipment');
        }
    }

    if (!$error) {
        try {
            $transit = $shipment->get_transit($cart->get_totals());
        } catch (Exception $e) {
            var_dump("<pre>".$e."</pre>");
            $error = new Exception('Unable to get shipping estimate');
        }
    }

    if (!$error) {
?>

<script>
    var stripe_key = '<?php include __DIR__.'/../backend/payment.php'; ?>';
    jQl.loadjQdep('scripts/store/checkout.js');
</script>

<form action="/store/order" method="post" class="grid">
    <h1>Checkout</h1>

    <div class="list list--product">
        <?php
            $index = 0;
            foreach ($cart->get_products() as $id => $product) {
                $index++;
        ?>

        <div class="list__item">
            <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
            <div class="information">
                <h3><?php echo $product['full_name'] ?></h3>
                <h3>$<?php echo $product['retail_price'] ?></h3>
            </div>
            <div>
                <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $id ?>">
                <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $product['retail_price'] ?>">
                <label for="product-<?php echo $index ?>-quantity">Qty:</label>
                <input type="number" min="0" max="<?php echo $product['inventory']['quantity_available'] ?>" step="1" value="<?php echo $product['quantity'] ?>" name="product-<?php echo $index ?>-quantity" disabled>
            </div>
        </div>

        <?php
            }
        ?>

        <div class="list__footer">
            <hr>

            <input type="hidden" name="cart-sub_total" value="<?php echo $cart->get_totals() ?>">
            <input type="hidden" name="cart-total" value="<?php echo $cart->get_totals() + $rate ?>">

            <h4>Sub-Total: $<?php echo $cart->get_totals(); ?></h4>
            <h4>Shipping: $<?php echo $rate; ?></h4>
            <hr>
            <h4>Total: $<?php echo $cart->get_totals() + $rate; ?></h4>
        </div>
    </div>

    <h1>Shipping information</h1>

    <div class="whole text-center">
        <div>Items will be shipped by UPS ground. Estimated to arive on <?php echo $transit["date"] ?>.</div>

        <div>
            <input type="hidden" name="address-name" value="<?php echo $shipment->get_name() ?>">
            <input type="hidden" name="address-line1" value="<?php echo $shipment->get_line1() ?>">
            <input type="hidden" name="address-line2" value="<?php echo $shipment->get_line2() ?>">
            <input type="hidden" name="address-level2" value="<?php echo $shipment->get_level2() ?>">
            <input type="hidden" name="address-level1" value="<?php echo $shipment->get_level1() ?>">
            <input type="hidden" name="address-country" value="<?php echo $shipment->get_country() ?>">
            <input type="hidden" name="address-postal" value="<?php echo $shipment->get_postal() ?>">
            <input type="hidden" name="address-weight" value="<?php echo $shipment->get_weight() ?>">

            <input type="hidden" name="email" value="<?php echo $shipment->get_email() ?>">
            <input type="hidden" name="phone" value="<?php echo $shipment->get_phone() ?>">

            <div><?php echo $shipment->get_name(); ?></div>
            <div><?php echo $shipment->get_line1(); ?></div>
            <div><?php echo $shipment->get_line2(); ?></div>
            <div><?php echo $shipment->get_level2(); ?> <?php echo $shipment->get_level1(); ?> <?php echo $shipment->get_postal(); ?> <?php echo $shipment->get_country(); ?></div>
        </div>

        <input type="hidden" name="stripe-token">
        <button type="submit" id="order" class="suggested-action">Place order</button>
    </div>
</form>

<?php } else { ?>

<div class="row">
    <h3><?php echo $error->getMessage(); ?></h3>
    <a href="/store/">Return to store</a>
</div>

<?php }
    include $template['footer'];
?>
