<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store/cart.css">';
    include $template['header'];
    include $template['alert'];
?>

<?php
require_once __DIR__.'/../backend/store.php';
$product = storeItems();
$cart = storeCart();
?>

            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/store/cart.js');
            </script>

            <div class="row">
                <h1>Cart</h1>
            </div>

            <?php
                if ($cart != false) {
                    foreach ($cart as $key => $quantity) {
                        $item = $product[$key];
            ?>

            <div>
                <img src="images/store/<?php echo urlencode(strtolower($item['name'])) ?>-small.png"/>
                <?php if ($quantity > 1) { ?>
                    <h3><?php echo $quantity?>x <?php echo $item['name'] ?></h3>
                <?php } else { ?>
                    <h3><?php echo $item['name'] ?></h3>
                <?php } ?>

            <span>UID: <?=$item?> @ <?=$quantity?></span>

            <?php
                    }
                } else {
            ?>

            <div class="row">
                <h3>You have no items in your cart</h3>
            </div>

            <?php
                }
            ?>

<?php
    include $template['footer'];
?>
