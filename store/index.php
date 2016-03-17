<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];
?>

<?php
require_once __DIR__.'/../backend/amplifier.php';
$raw = amplifier_raw();

$categories = [];

foreach ($raw as $item_key => $item_value) {
    // This section can be somewhat confusing so here is a breakdown:
    // 1) see if the category exists, if not create it with the new product
    // 2) make sure there is no other product by the same name, then add to list
    // 3) if another product by same name exists, merge size and color properties
    if (!isset($categories[$item_value['category']])) {
        $categories[$item_value['category']] = [];
        $categories[$item_value['category']][$item_value['name']] = $item_value;
    } else if (!isset($categories[$item_value['category']][$item_value['name']])) {
        $categories[$item_value['category']][$item_value['name']] = $item_value;
    } else {
        $product = &$categories[$item_value['category']][$item_value['name']];
        if (!is_array($product['size']) && isset($item_value['size'])) {
            $product_size = $product['size'];
            $product['size'] = [$product_size, $item_value['size']];
        } else if (isset($item_value['size']) && !in_array($item_value['size'], $product['size'])) {
            array_push($product['size'], $item_value['size']);
        }

        if (!is_array($product['color']) && isset($item_value['color'])) {
            $product_color = $product['color'];
            $product['color'] = [$product_color, $item_value['color']];
        } else if (isset($item_value['color']) && !in_array($item_value['color'], $product['color'])) {
            array_push($product['color'], $item_value['color']);
        }
    }

    // calculate min and max price for each item (size differences can add cost)
    $product = &$categories[$item_value['category']][$item_value['name']];
    if (!isset($product['retail_min'])) {
        $product['retail_min'] = $product['retail_price'];
    } else if ($product['retail_min'] > $item_value['retail_price']) {
        $product['retail_min'] = $item_value['retail_price'];
    }

    if (!isset($product['retail_max'])) {
        $product['retail_max'] = $product['retail_price'];
    } else if ($product['retail_max'] < $item_value['retail_price']) {
        $product['retail_max'] = $item_value['retail_price'];
    }
}
?>

            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/store.js');
            </script>

            <div class="row">
                <h1>Store</h1>
            </div>

            <?php
                foreach ($categories as $category => $items) {
            ?>

            <div class="row category" id="<?php echo $category ?>">
                <h2><?php echo $category ?></h2>
                <div>

                <?php
                    foreach ($items as $key => $item) {
                ?>

                    <div class="product" id="<?php echo $item['name'] ?>">
                        <img src="images/store/<?php echo $item['uid'] ?>-small.png"/>
                        <h2><?php echo $item['name'] ?></h2>
                        <?php if ($item['retail_min'] !== $item['retail_max']) { ?>
                            <h3>$<?php echo $item['retail_min'] ?> - $<?php echo $item['retail_max']?></h3>
                        <?php } else { ?>
                            <h3>$<?php echo $item['retail_price'] ?></h3>
                        <?php } ?>
                        <p><?php echo $item['description'] ?></p>
                        <a style="display:none;" class="open-modal" href="#<?php echo $item['uid'] ?>"></a>
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
                foreach ($categories as $category => $items) {
                    foreach ($items as $key => $item) {
            ?>

            <div id="<?php echo $item['uid'] ?>" class="modal">
                <i class="fa fa-close close-modal"></i>
                <h1><?php echo $item['name'] ?></h1>
                <div class="row">
                    <div class="column half">
                        <img src="images/store/<?php echo $item['uid'] ?>-large.png"/>
                    </div>
                    <div class="column half">
                        <h2 class="price">$<?php echo $item['retail_price'] ?></h2>
                        <p><?php echo $item['description'] ?></p>
                        <form>
                            <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                            <input type="hidden" name="uid" value="<?php echo $item['uid'] ?>">
                            <?php if (is_array($item['color'])) { ?>
                                <label for="color">Color:</label>
                                <select name="color">
                                <?php foreach ($item['color'] as $key => $value) { ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php } ?>
                                </select>
                            <?php } ?>
                            <?php if (is_array($item['size'])) { ?>
                                <label for="size">Size:</label>
                                <select name="size">
                                <?php foreach ($item['size'] as $key => $value) { ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php } ?>
                                </select>
                            <?php } ?>
                            <label for="quantity">Qty:</label>
                            <input type="number" step="1" min="1" max="<?php echo $item['inventory']['quantity_available'] ?>" value="1" name="quantity">
                            <input type="submit" class="button suggested-action" value="Add to Cart">
                        </form>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
            ?>

            <!-- TODO: minimize what is sent to client -->
            <script>var store = <?php echo json_encode($raw) ?>;</script>

<?php
    include $template['footer'];
?>
