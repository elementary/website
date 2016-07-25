<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/store.php';

    if (!isset($store)) {
        $store = new Store();
    }

    $fronts = $store->get_fronts();
    $categories = array_keys($store->get_categories());
?>

<script>
    jQl.loadjQdep('scripts/jQuery.leanModal2.js');
    jQl.loadjQdep('scripts/store/index.js');
</script>

<div class="row">
    <h1>Store</h1>
</div>

<?php
    foreach ($categories as $category) {
        $products = array_filter($fronts, function ($front) use ($category) {
            return $front['category'] === $category;
        })
?>

    <div class="grid grid--product">
        <h2 class="grid__title"><?php echo $category ?></h2>

        <?php
            foreach ($products as $key => $product) {
        ?>

            <div class="grid__item" id="<?php echo $product['uid'] ?>">
                <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
                <h2><?php echo $product['name'] ?></h2>
                <?php if ($product['retail_price_min'] !== $product['retail_price_max']) { ?>
                    <h3>$<?php echo $product['retail_price_min'] ?> - $<?php echo $product['retail_price_max']?></h3>
                <?php } else { ?>
                    <h3>$<?php echo $product['retail_price'] ?></h3>
                <?php } ?>
                <p><?php echo $product['description'] ?></p>
                <a style="display:none;" class="open-modal" href="#<?php echo $product['uid'] ?>-overview"></a>
            </div>

        <?php
            }
        ?>

    </div>

<?php
    }
?>

<div class="row">
    <h4>All apparel is in US sizes. Tees run a bit snug; for sizing details, see American Apparel&rsquo;s <a href="http://www.americanapparel.net/sizing/default.asp?chart=mu.shirts" target="_blank">sizing chart</a>.</h4>
</div>

<?php
    foreach ($fronts as $front) {
?>

<div id="<?php echo $front['uid'] ?>-overview" class="modal modal--product">
    <i class="fa fa-close close-modal"></i>
    <div class="grid">
        <div class="half">
            <img src="images/store/<?php echo $front['uid'] ?>-large.png"/>
        </div>
        <form action="/store/inventory" class="half">
            <h2><?php echo $front['name'] ?></h2>
            <h4 class="modal__price">$<?php echo $front['retail_price'] ?></h4>
            <p><?php echo $front['description'] ?></p>

            <input type="hidden" name="id" value="<?php echo $front['id'] ?>">
            <input type="hidden" name="uid" value="<?php echo $front['uid'] ?>">
            <input type="hidden" name="math" value="add">

            <div>
                <?php if (isset($front['color']) && is_array($front['color'])) { ?>
                    <select name="color">
                        <?php foreach ($front['color'] as $value) { ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <?php if (isset($front['size']) && is_array($front['size'])) { ?>
                    <h4 class="label">Size</h4>
                    <select name="size">
                    <?php foreach ($front['size'] as $value) { ?>
                        <option value="<?php echo $value ?>"><?php echo $value ?></option>
                    <?php } ?>
                    </select>
                <?php } ?>

                <h4 class="label">Qty</h4>
                <input type="number" step="1" min="1" max="<?php echo $front['inventory']['quantity_available'] ?>" value="1" name="quantity">
            </div>

            <input type="submit" class="button suggested-action" value="Add to Cart">
        </form>
    </div>
</div>

<?php
    }

    $products = $store->get_products();
    $json = [];

    foreach ($products as $product) {
        $json[] = array(
            "id" => $product['id'],
            "uid" => $product['uid'],
            "color" => $product['color'] ?? null,
            "size" => $product['size'] ?? null,
            "inventory" => $product['inventory']['quantity_available'],
            "price" => $product['retail_price']
        );
    }
?>

<script>var store = <?php echo json_encode($json) ?>;</script>

<?php
    include $template['footer'];
?>
