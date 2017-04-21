<?php
    require_once __DIR__.'/../_backend/preload.php';

    $page['title'] = 'Cart &sdot; elementary';

    $page['styles'] = array(
        'styles/store.css'
    );

    $page['scripts'] = array(
        'scripts/store/cart.js'
    );

    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../_backend/store/cart.php';
    require_once __DIR__.'/../_backend/store/address.php';
    require_once __DIR__.'/../_backend/classify.current.php';
    $country = getCurrentCountry($ip);
    // Set a deafult country.
    if ( !$country ) $country = 'US';

    $cart = \Store\Cart\get_cart();

    if (count($cart) > 0) {
?>

<form action="<?php echo $page['lang-root'] ?>store/checkout" method="post" class="grid grid--narrow">
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
                    <span><a href="store/inventory?math=set&quantity=0&id=<?php echo $id[0] ?>&variant=<?php echo $id[1] ?>">Remove</a></span>
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
        <label>Name</label>
        <input type="text" name="name" placeholder="Ellie Mendez" autocomplete="name" required>
        <label>Address</label>
        <input type="text" name="address1" placeholder="Street Address, P.O. Box, Company Name" autocomplete="shipping address-line1" required>
        <label>Address 2</label>
        <input type="text" name="address2" placeholder="Apartment, Suite, Unit, Building, Floor" autocomplete="shipping address-line2">
        <label>City</label>
        <input type="text" name="city" placeholder="Anytown" autocomplete="address-level2" required>
        <label>Country</label>
        <select name="country" autocomplete="country" required>
            <?php
                foreach (\Store\Address\get_countries() as $code => $item) {
                    $d = ($code === $country) ? 'selected' : '';
            ?>
                <option value="<?php echo $code ?>" <?php echo $d ?>><?php echo $item ?></option>
            <?php } ?>
        </select>
        <label for="state">State</label>
        <select name="state" autocomplete="address-level1" required>
            <?php foreach (\Store\Address\get_states('US') as $code => $item) { ?>
                <option value="<?php echo $code ?>"><?php echo $item ?></option>
            <?php } ?>
        </select>
        <label>Postal Code</label>
        <input type="text" name="postal" placeholder="12345" autocomplete="postal-code">
        <label>Email</label>
        <input type="email" name="email" placeholder="elliemendez@example.com" autocomplete="email" required>
        <label>Phone</label>
        <input type="tel" name="phone" placeholder="1 867 5309" autocomplete="tel">
    </div>

    <div class="whole">
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

<script>window.country = <?php echo json_encode(\Store\Address\do_open()) ?></script>

<?php } else { ?>

<div class="grid">
    <div class="two-thirds">
        <i class="fa fa-128 fa-shopping-cart"></i>
        <h2>Your Cart Is Empty</h2>
        <p>Go get yourself something nice!</p>
        <a href="store/" class="button suggested-action">Pick Up Some Swag</a>
    </div>
</div>

<?php
    }

    include $template['footer'];
?>
