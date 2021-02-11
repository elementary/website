<?php
    require_once __DIR__.'/../_backend/preload.php';
    require_once __DIR__.'/../_backend/config.loader.php';
    require_once __DIR__.'/../_backend/store/product.php';

    $page['title'] = 'Store &sdot; elementary';

    $page['styles'] = array(
        'styles/store.css'
    );

    $page['script-plugins'] = array(
        'https://cdn.jsdelivr.net/gh/eustasy/jquery.leanmodal2@2.5/jQuery.leanModal2.min.js'
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
                <i class="warning fas fa-4x fa-exclamation-triangle"></i>
            </div>
            <div class="icon-text">
                <h3>You are missing API keys</h3>
                <p>You are viewing a development version of the store without configuring API keys. This will lead to false positives and incorrect errors. Please set your keys to testing configuration.</p>
            </div>
        </div>
    </div>
<?php
        $l10n->set_domain($page['name']);
    }
?>

<section class="grid">
    <div class="two-thirds">
        <h1>
            Support Development.<br />
            Get Gear. Win/Win.
        </h1>
        <p>Every purchase goes towards developing elementary OS, its apps, and its services. We're a small <a href="/team">team</a>, mostly volunteer, working constantly to make elementary better—your support helps make elementary OS more sustainable.</p>
    </div>
</section>

<section class="grid" id="devices">
    <div class="two-thirds">
        <h2>Devices</h2>
        <p>Hardware devices with elementary OS can be purchased from the following retailers. Purchasing from these companies helps support elementary OS.</p>
    </div>

    <div class="grid">
        <div class="third">
            <h4><a class="read-more" href="https://laptopwithlinux.com/?ref=36&utm_source=referral&utm_medium=elementary&utm_campaign=elementary" target="_blank" title="Visit Laptop With Linux">Laptop With Linux</a></h4>
            <ul>
                <li>Laptops, mini desktops</li>
                <li>Based in the Netherlands</li>
                <li>Free shipping within EU</li>
            </ul>
        </div>
        <div class="third">
            <h4><a class="read-more" href="https://slimbook.es?utm_source=referral&utm_medium=elementary&utm_campaign=elementary" target="_blank" title="Visit Slimbook">Slimbook</a></h4>
            <ul>
                <li>Laptops, desktops, mini desktops, all-in-ones</li>
                <li>Based in Spain</li>
                <li>International shipping</li>
            </ul>
        </div>
        <div class="third">
            <h4><a class="read-more" href="https://starlabs.systems/?rfsn=4227837.e8f025" target="_blank" title="Visit Star Labs">Star Labs</a></h4>
            <ul>
                <li>Laptops</li>
                <li>Based in the United Kingdom</li>
                <li>International shipping</li>
            </ul>
        </div>
    </div>

    <div class="two-thirds">
        <p><small>Hardware and software support for these devices are provided by the retailer.</small></p>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>More Coming Soon…</h2>
        <p>New tees, mugs, and more will be launching with our new store soon. Keep an eye on <a href="https://blog.elementary.io" target="_self">our blog</a> for the latest updates and announcements.</p>
    </div>
</section>

<script>window.products = <?php echo json_encode(\Store\Product\get_products()) ?></script>

<?php
    include $template['footer'];
?>
