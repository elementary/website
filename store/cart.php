<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/store/cart.php';

    $cart = \Store\get_cart();

    if (count($cart) > 0) {
?>

<script>
    jQl.loadjQdep('scripts/store/cart.js');
</script>

<form action="/store/checkout" method="post" class="grid grid--narrow">
    <div class="whole">
        <h1>Cart</h1>
    </div>

    <div class="whole list list--product">

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
                        <input type="number" min="0" max="9999" step="1" value="<?php echo $item['quantity'] ?>" name="product-<?php echo $index ?>-quantity">
                        <span>=</span>
                        <b>$<?php echo number_format($variant['price'] * $item['quantity'], 2) ?></b>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="list__footer">
            <h4>Sub-Total: $<?php echo \Store\get_subtotal() ?></h4>
        </div>
    </div>

    <div class="whole">
        <h2>Shipping Information</h2>
    </div>

    <div class="whole grid grid--address">
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

<?php } else { ?>

<div class="grid">
    <h3>You have no items in your cart</h3>
    <a href="/store/">Pick up some swag</a>
</div>

<?php
    }

    include $template['footer'];
?>
