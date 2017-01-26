<?php
    require_once __DIR__.'/../_backend/preload.php';
    require_once __DIR__.'/../_backend/config.loader.php';
    require_once __DIR__.'/../_backend/classify.current.php';
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

    if (getenv('PHPENV') !== 'production' && (
        !isset($config['printful_key']) ||
        !isset($config['google_map_key']) ||
        $config['printful_key'] === 'printful_key' ||
        $config['google_map_key'] === 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
    )) {

        $l10n->set_domain('layout');
?>
    <div class="row alert warning">
        <div class="column alert">
            <div class="icon">
                <i class="warning fa fa-warning"></i>
            </div>
            <div class="icon-text">
                <h3>You are missing API keys</h3>
                <p>You are viewing a developmental version of the store without configuring api keys. This will lead to false positives and incorrect errors. Please set your keys to testing configuration.</p>
            </div>
        </div>
    </div>
<?php
        $l10n->set_domain($page['name']);
    }
?>

<section class="grid">
    <div class="two-thirds">
        <h2>Support Development. Get Swag. Win Win.</h2>
        <p>Every purchase goes towards developing elementary OS, its apps, and its services. We're a small <a href="/team">team</a>, mostly volunteer, working constantly to make elementary better. Every little bit of help is one step closer to hiring another full-time developer.</p>
    </div>
</section>

<?php foreach ($categories as $category => $products) { ?>

    <div class="grid grid--product">
        <h3 class="grid__title"><?php echo $category ?></h3>

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

<section class="grid">
    <div class="two-thirds">
        <?php
            $country_code = getCurrentCountry($ip);
            $shipping_text = 'Worldwide Shipping';

            $blacklisted_countries = array('US', 'CU', 'IR', 'KP');
            if ($country_code && !in_array($country_code, $blacklisted_countries)) {
                $country_name = getCurrentCountryName($ip, $page['lang']);

                if ($country_name) {
                    $shipping_text = 'Now shipping to ' . $country_name;
                }
            }
        ?>
        <h2><?php echo $shipping_text ?></h2>
        <p>We now ship all around the world! Place your order and choose from a number of shipping methods to fit your needs. Orders are made on-demand typically within 2–7 days.</p>
        <p><small>Cuba, Iran, and North Korea excluded. Shipping methods, prices, and times vary by country.</small></p>
    </div>
</section>

<script>window.products = <?php echo json_encode(\Store\Product\get_products()) ?></script>

<?php
    include $template['footer'];
?>
