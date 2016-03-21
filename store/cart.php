<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/store.php';
    $cart = store_cart();

    if ($cart) {

?>

<script>
    jQl.loadjQdep('scripts/store/cart.js');
</script>

<form>
    <div class="row">
        <h1>Cart</h1>

        <?php
            $sub_total = 0;
            $index = 0;
            foreach ($cart as $id => $product) {
                $sub_total += ($product['quantity'] * $product['retail_price']);
                $index++;
        ?>

        <div class="row product">
            <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
            <div class="information">
                <h3><?php echo $product['full_name'] ?></h3>
                <h3>$<?php echo $product['retail_price'] ?></h3>
            </div>
            <div>
                <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $id ?>">
                <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $product['retail_price'] ?>">
                <label for="product-<?php echo $index ?>-quantity">Qty:</label>
                <input type="number" min="0" max="<?php echo $product['inventory']['quantity_available'] ?>" step="1" value="<?php echo $product['quantity'] ?>" name="product-<?php echo $index ?>-quantity">
            </div>
            <a href="/store/inventory?id=<?php echo $product['id'] ?>&math=subtract&quantity=<?php echo $product['quantity'] ?>">remove</a>
        </div>

        <?php
            }
        ?>

        <div class="row">
            <hr>
            <h4 class="totals">Sub-Total: $<?php echo $sub_total ?></h4>
        </div>


    </div>

    <div class="row">
        <h2>Shipping information</h2>
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
