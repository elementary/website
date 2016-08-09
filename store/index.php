<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/store/product.php';

    $products = \Store\get_products();

    $categories = [];
    foreach ($products as $product) {
        if (!isset($categories[$product['type']])) {
            $categories[$product['type']] = [$product];
        } else {
            $categories[$product['type']][] = $product;
        }
    }
?>

<script>
    jQl.loadjQdep('scripts/jQuery.leanModal2.js');
</script>

<div class="row">
    <h1>Store</h1>
</div>

    <?php foreach ($categories as $category => $products) { ?>

        <div class="grid grid--product">
            <h2 class="grid__title"><?php echo $category ?></h2>

            <?php foreach ($products as $index => $product) { ?>

                <div class="grid__item" id="product-<?php echo $index ?>">
                    <img src="<?php echo $product['image'] ?>"/>
                    <h2><?php echo $product['name'] ?></h2>
                    <?php if ($product['price_min'] !== $product['price_max']) { ?>
                        <h4>$<?php echo number_format($product['price_min'], 2) ?> - $<?php echo number_format($product['price_max'], 2) ?></h4>
                    <?php } else { ?>
                        <h4>$<?php echo number_format($product['price_min'], 2) ?></h4>
                    <?php } ?>
                    <a style="display:none;" class="open-modal" href="#product-<?php echo $index ?>-overview"></a>
                </div>

            <?php } ?>

        </div>

    <?php } ?>

<?php
    include $template['footer'];
?>
