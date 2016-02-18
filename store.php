<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];
?>

<?php
require_once __DIR__.'/backend/store.php';
$product = storeItems();
$cart = storeCart();
?>

            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/store.js');
            </script>

            <div class="row">
                <h1>Store</h1>
            </div>

            <?php

                $categories = [];

                foreach ($product as $key => $value) {
                    if (!isset($categories[$value['category']])) {
                        $categories[$value['category']] = [];
                    }
                    array_push($categories[$value['category']], $value);
                };

                foreach ($categories as $category => $items) {
            ?>

            <div class="row category" id="<?=$category?>">
                <h2><?=$category?></h2>
                <div>

                <?php
                    foreach ($items as $key => $item) {
                ?>

                    <div class="product" id="<?=$item['name']?>">
                        <img src="images/store/<?=urlencode(strtolower($category))?>/<?=urlencode(strtolower($item['name']))?>-small.png"/>
                        <h2><?=$item['name']?></h2>
                        <h3>$<?=$item['retail_price']?></h3>
                        <p><?=$item['description']?></p>
                        <a style="display:none;" class="open-modal" href="#<?=$item['uid']?>"></a>
                    </div>

                <?php
                    }
                ?>

                </div>
            </div>

            <?php
                }
            ?>

            <div class="row">
                <h4>All apparel is in US sizes. Tees run a bit snug; for sizing details, see American Apparel&rsquo;s <a href="http://www.americanapparel.net/sizing/default.asp?chart=mu.shirts" target="_blank">sizing chart</a>.</h4>
            </div>

            <?php
                foreach ($product as $key => $item) {
            ?>

            <div id="<?=$item['uid']?>" class="modal">
                <i class="fa fa-close close-modal"></i>
                <h1><?=$item['name']?></h1>
                <div class="row">
                    <div class="column half">
                        <img src="images/store/<?=urlencode(strtolower($item['category']))?>/<?=urlencode(strtolower($item['name']))?>-large.png"/>
                    </div>
                    <div class="column half">
                        <h2>$<?=$item['retail_price']?></h2>
                        <p><?=$item['description']?></p>
                        <div>
                            <label for="quantity">Qty:</label>
                            <?php if (isset($cart[$item['uid']])) { ?>
                            <input type="number" step="1" min="0" name="quantity" placeholder="1" value="<?=$cart[$item['uid']]?>">
                            <?php } else { ?>
                            <input type="number" step="1" min="0" name="quantity" placeholder="1" value="1">
                            <?php } ?>
                            <button type="submit" class="suggested-action add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                }
            ?>

            <!-- TODO: minimize what is sent to client -->
            <script>var store = <?=json_encode(storeItems())?>;</script>

<?php
    include $template['footer'];
?>
