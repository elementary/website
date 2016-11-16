<?php
    require_once __DIR__.'/../_backend/preload.php';
    require_once __DIR__.'/../_backend/config.loader.php';
    require_once __DIR__.'/../_backend/store/product.php';

    $page['title'] = 'Store &sdot; elementary';

    $page['styles'] = array(
        'styles/store.css'
    );

    $page['script-plugins'] = array(
        'https://cdn.jsdelivr.net/g/jquery.leanmodal2@2.5'
    );

    $page['scripts'] = array(
        'scripts/store/index.js' => array(
            'async' => false
        ),
    );

    include $template['header'];
    include $template['alert'];

    $products = \Store\Product\get_products();

    $categories = [];
    foreach ($products as $product) {
        if (!isset($categories[$product['type']])) {
            $categories[$product['type']] = [$product];
        } else {
            $categories[$product['type']][] = $product;
        }
    }

    foreach ($categories as $category => $products) { ?>

    <div class="grid grid--product">
        <h2 class="grid__title"><?php echo $category ?></h2>

        <?php foreach ($products as $product) { ?>

            <div class="grid__item" id="product-<?php echo $product['id'] ?>" data-product-name="<?php echo $product['name']; ?>">
                <img src="<?php echo $product['image'] ?>"/>
                <h4><?php echo $product['name'] ?></h4>
                <?php if ($product['price_min'] !== $product['price_max']) { ?>
                    <p data-l10n-off="1" class="text-center">$<?php echo number_format($product['price_min'], 2) ?> - $<?php echo number_format($product['price_max'], 2) ?></p>
                <?php } else { ?>
                    <p data-l10n-off="1" class="text-center">$<?php echo number_format($product['price_min'], 2) ?></p>
                <?php } ?>
                <a style="display:none;" class="open-modal" href="#product-<?php echo $product['id'] ?>-overview"></a>
            </div>

        <?php } ?>

    </div>

<?php } ?>

<?php foreach (\Store\Product\get_products() as $product) { ?>

    <div id="product-<?php echo $product['id'] ?>-overview" class="modal modal--product"  data-product-name="<?php echo $product['name']; ?>">
        <i class="fa fa-close close-modal"></i>
        <div class="grid">
            <div class="half">
                <img src="<?php echo $product['image'] ?>"/>
            </div>
            <form action="<?php echo $sitewide['root'] ?>store/inventory" class="half">
                <h2><?php echo $product['name'] ?></h2>
                <h4 class="modal__price" data-l10n-off="1">$<?php echo number_format($product['price_min'], 2) ?></h4>
                <p><?php echo $product['description'] ?></p>

                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                <input type="hidden" name="variant" value="<?php echo $product['variants'][0]['id'] ?>">
                <input type="hidden" name="math" value="add">

                <div>
                    <?php if (count($product['color']) > 1) { ?>
                        <h4 class="label">Color</h4>
                        <select name="color">
                            <?php foreach ($product['color'] as $value) { ?>
                                <option value="<?php echo $value ?>"><?php echo $value ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                    <?php if (count($product['size']) > 1) { ?>
                        <h4 class="label">Size</h4>
                        <div class="size-select">
                            <input type="hidden" name="size" value="<?php echo $product['size'][0] ?>">
                            <?php
                                foreach ($product['size'] as $i => $value) {
                                    $o = ($i === 0) ? 'checked' : '';
                            ?>
                                <button type="button" value="<?php echo $value ?>"  class="small-button target-amount <?php echo $o ?>"><?php echo $value ?></button>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <h4 class="label">Quantity</h4>
                    <input type="number" step="1" min="1" value="1" name="quantity">
                </div>

                <span class="alert--error"></span>

                <input type="submit" class="button small-button suggested-action" value="Add to Cart">
            </form>
        </div>
    </div>

<?php } ?>

<script>window.products = <?php echo json_encode(\Store\Product\get_products()) ?></script>

<?php
    include $template['footer'];
?>
