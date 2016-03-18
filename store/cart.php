<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];
?>

<?php
require_once __DIR__.'/../backend/store.php';
$cart = store_cart();
?>

            <script>
                jQl.loadjQdep('scripts/store.js');
            </script>

            <div class="row">
                <h1>Cart</h1>

                <?php
                    if ($cart) {
                        foreach ($cart as $id => $product) {
                ?>
                    <div class="row product">
                        <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
                        <div class="information">
                            <h3><?php echo $product['name'] ?></h3>
                        </div>
                        <form class="totals">
                            <label for="quantity">Qty:</label>
                            <input type="number" min="0" max="<?php echo $product['inventory']['quantity_available'] ?>" step="1" value="<?php echo $product['quantity'] ?>" name="quantity">
                        </form>
                    </div>

                    <?php
                        }
                    ?>


                <?php
                    } else {
                ?>

                <h3>You have no items in your cart</h3>
                <a href="/store/">Pick up some swag</a>

                <?php
                    }
                ?>
            </div>

<?php
    include $template['footer'];
?>
