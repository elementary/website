<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__ . '/../backend/store/cart.php';
    require_once __DIR__ . '/../backend/store/address.php';

    $cart = \Store\Cart\get_cart();

    if (count($cart) > 0) {
?>

<script>
    jQl.loadjQdep('scripts/store/cart.js')
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
                $id = explode('-', $index)
        ?>

            <div class="list__item" id="product-<?php echo $index ?>">
                <img src="<?php echo $product['image'] ?>"/>
                <div class="list__info">
                    <b><?php echo $variant['name'] ?></b>
                    <span><a href="/store/inventory?math=set&quantity=0&id=<?php echo $id[0] ?>&variant=<?php echo $id[1] ?>">Remove</a></span>
                </div>
                <div class="list__detail">
                    <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $index ?>">
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
            <h4>Sub-Total: $<?php echo \Store\Cart\get_subtotal() ?></h4>
        </div>
    </div>

    <div class="whole">
        <h2>Shipping Information</h2>
    </div>

    <div class="whole grid grid--address">
        <div>
            <input type="text" name="name" placeholder="Name" autocomplete="name" required>
        </div>
        <div>
            <input type="text" name="address1" placeholder="Street Address, P.O. Box, Company Name" autocomplete="shipping address-line1" required>
        </div>
        <div>
            <input type="text" name="address2" placeholder="Apartment, Suite, Unit, Building, Floor" autocomplete="shipping address-line2">
        </div>
        <div>
            <input type="text" name="city" placeholder="City" autocomplete="address-level2" required>
            <select name="state" autocomplete="address-level1" required>
                <?php foreach (\Store\Address\get_states('US') as $code => $item) { ?>
                    <option value="<?php echo $code ?>"><?php echo $item ?></option>
                <?php } ?>
            </select>
            <select name="country" autocomplete="country" required>
                <?php
                    foreach (\Store\Address\get_countries() as $code => $item) {
                        $d = ($code === 'US') ? 'selected' : '';
                ?>
                    <option value="<?php echo $code ?>" <?php echo $d ?>><?php echo $item ?></option>
                <?php } ?>
            </select>
            <input type="number" name="postal" placeholder="Postal Code" autocomplete="postal-code">
        </div>
        <div>
            <input type="email" name="email" placeholder="Email" autocomplete="email" required>
            <input type="tel" name="phone" placeholder="Phone" autocomplete="tel">
        </div>

        <?php if (isset($_GET['error'])) { ?>
        <span class="alert--error"><?php echo urldecode($_GET['error']) ?></span>
        <?php } else { ?>
        <span class="alert--error"></span>
        <?php } ?>

        <div>
            <input type="submit" value="Check Out" class="button suggested-action">
        </div>
    </div>
</form>

<script>var country = <?php echo json_encode(\Store\Address\do_open()) ?></script>

<?php } else { ?>

<div class="grid">
    <h3>You have no items in your cart</h3>
    <a href="/store/">Pick up some swag</a>
</div>

<?php
    }

    include $template['footer'];
?>
