<?php
    include __DIR__.'/../_templates/sitewide.php';
    include __DIR__.'/../backend/lib/autoload.php';
    require_once __DIR__.'/../backend/config.loader.php';
    $page['title'] = 'Checkout &sdot; elementary';
    $page['scripts'] = '<script src="https://checkout.stripe.com/checkout.js" data-alipay="auto" data-locale="auto"></script>';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/shipment.php';
    require_once __DIR__.'/../backend/cart.php';

    $error = false;

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

    if (!$error && $cart->get_count() <= 0) {
        $error = new Exception('Trying to checkout with an empty cart');
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
            $shipment = new Shipment(array(
                "name" => $_POST['first-name'].' '.$_POST['last-name'],
                "line1" => $_POST['address-line1'],
                "line2" => $_POST['address-line2'],
                "level2" => $_POST['address-level2'],
                "level1" => $_POST['address-level1'],
                "country" => "US",
                "postal" => $_POST['postal-code'],
                "email" => $_POST['email'],
                "phone" => $_POST['phone']
            ));
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

        <div class="list__item" id="product-<?php echo $index ?>">
            <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
            <div class="list__info">
                <h3><?php echo $product['full_name'] ?></h3>
            </div>
            <div class="list__detail">
                <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $id ?>">
                <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $product['retail_price'] ?>">
                <input type="hidden" name="product-<?php echo $index ?>-quantity" value="<?php echo $product['quantity'] ?>">

                <div>
                    $
                    <?php echo number_format($product['retail_price'], 2) ?>
                    *
                    <?php echo $product['quantity'] ?>
                    =
                    <h4>$<?php echo number_format($product['retail_price'] * $product['quantity'], 2) ?></h4>
                </div>
            </div>
        </div>

        <?php
            }
        ?>

        <div class="list__footer">
            <hr>

            <input type="hidden" name="cart-weight" value="<?php echo $shipment->get_weight() ?>">
            <input type="hidden" name="cart-sub_total" value="<?php echo $cart->get_totals() ?>">
            <input type="hidden" name="cart-shipping" value="<?php echo $rate ?>">
            <input type="hidden" name="cart-total" value="<?php echo $cart->get_totals() + $rate ?>">

            <h4>Sub-Total: $<?php echo number_format($cart->get_totals(), 2) ?></h4>
            <h4>Shipping: $<?php echo number_format($rate, 2); ?></h4>
            <hr>
            <h4>Total: $<?php echo number_format($cart->get_totals() + $rate, 2) ?></h4>
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
    <a href="/store/cart">Return to cart</a>
</div>

<?php }
    include $template['footer'];
?>
