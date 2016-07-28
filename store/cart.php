<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/cart.php';

    if (isset($_COOKIE['cart'])) {
        $items = json_decode($_COOKIE["cart"], true);
    }

    if (isset($items) && is_array($items) && count($items) > 0) {
        $cart = new Cart($items);
        $count = $cart->get_count();
    } else {
        $count = 0;
    }

    if ($count > 0) {

?>

<script>
    jQl.loadjQdep('scripts/store/cart.js');
</script>

<form action="/store/checkout" method="post">
    <div class="row">
        <h1>Cart</h1>
    </div>

    <div class="list list--product">
        <?php
            $index = 0;
            foreach ($cart->get_products() as $id => $product) {
                $index++;
        ?>

        <div class="list__item" id="product-<?php echo $index ?>">
            <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
            <div class="list__info">
                <b><?php echo $product['full_name'] ?></b>
            </div>
            <div class="list__detail">
                <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $id ?>">
                <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $product['retail_price'] ?>">

                <span class="alert--error"></span>

                <div class="subtotal">
                    <span>$<?php echo number_format($product['retail_price'], 2) ?></span>
                    <span>×</span>
                    <input type="number" min="0" max="<?php echo $product['inventory']['quantity_available'] ?>" step="1" value="<?php echo $product['quantity'] ?>" name="product-<?php echo $index ?>-quantity">
                    <span>=</span>
                    <b>$<?php echo number_format($product['retail_price'] * $product['quantity'], 2) ?></b>
                </div>
            </div>
        </div>

        <?php
            }
        ?>

        <div class="list__footer">
            <h4>Sub-Total: $<?php echo number_format($cart->get_totals(), 2) ?></h4>
        </div>
    </div>

    <div class="row">
        <h2>Shipping Information</h2>
    </div>

    <div class="grid grid--address">
        <div>
            <input type="text" name="first-name" placeholder="First Name" autocomplete="given-name" required>
            <input type="text" name="last-name" placeholder="Last Name" autocomplete="family-name" required>
        </div>
        <div>
            <input type="text" name="address-line1" placeholder="Street Address, P.O. Box, Company Name" autocomplete="address-line1" required>
        </div>
        <div>
            <input type="text" name="address-line2" placeholder="Apartment, Suite, Unit, Building, Floor" autocomplete="address-line2">
        </div>
        <div>
            <input type="text" name="address-level2" placeholder="City" autocomplete="address-level2" required>
            <input type="text" name="address-level1" placeholder="State" autocomplete="address-level1" maxlength="2" required>
            <input type="number" name="postal-code" placeholder="ZIP" autocomplete="postal-code" required>
        </div>
        <div>
            <input type="email" name="email" placeholder="Email" autocomplete="email" required>
            <input type="tel" name="phone" placeholder="Phone" autocomplete="tel">
        </div>

        <div>
            <input type="submit" value="Check Out" class="button suggested-action">
        </div>
    </div>
</form>

    <?php
        } else {
    ?>

<div class="row">
    <h3>You have no items in your cart</h3>
    <a href="/store/">Pick up some swag</a>
</div>

    <?php
        }
    ?>

<?php
    include $template['footer'];
?>
