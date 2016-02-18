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
                    foreach ($cart as $item => $quantity) {
            ?>

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
