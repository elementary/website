<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store/index.css">';
    include $template['header'];
    include $template['alert'];
?>

<?php
// TODO: add api grabbing from amplifier

$productRaw = [[
    'aid' => '83ea7daadc1d435ca9aad8a9e42811c5',
    'name' => 'Logotype',
    'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
    'category' => 'apparel',
    'cost' => 22.000000,
    'retail_price' => 40.000000,
    'backorderable' => false,
    'discontinued' => false,
    'inventory' => [
        'quantity_available' => 0,
        'quantity_on_hand' => 0,
        'quantity_committed' => 0,
        'quantity_on_order' => 0
    ]
 ], [
     'aid' => '83ea7daadc1d435ca9aad8a9e42811c5',
     'name' => 'Terminal',
     'description' => 'The elementary Terminal app logo screen printed on a comfy asphalt jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
     'category' => 'apparel',
     'cost' => 22.000000,
     'retail_price' => 40.000000,
     'backorderable' => false,
     'discontinued' => false,
     'inventory' => [
         'quantity_available' => 0,
         'quantity_on_hand' => 0,
         'quantity_committed' => 0,
         'quantity_on_order' => 0
    ]
], [
    'aid' => '83ea7daadc1d435ca9aad8a9e42811c5',
    'name' => 'Logomark',
    'description' => 'Set of blue 2-inch (5 cm) circle stickers with the elementary "e" logomark in white. Silkscreened on premium vinyl and layered with three coats of 100% UV protection meaning your stickers will stick for several years without fading.',
    'category' => 'stickers',
    'cost' => 1.000000,
    'retail_price' => 8.000000,
    'backorderable' => false,
    'discontinued' => false,
    'inventory' => [
        'quantity_available' => 40,
        'quantity_on_hand' => 50,
        'quantity_committed' => 2,
        'quantity_on_order' => 8
    ]
]];

$product = [];

foreach ($productRaw as $key => $value) {
    if (!isset($product[$value['category']])) {
        $product[$value['category']] = [];
    }

    $value['uid'] = urlencode($value['category'].'-'.$value['name']);

    $productKey = array_push($product[$value['category']], $value);
};
?>

            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/store/index.js');
            </script>

            <div class="row">
                <h1>Store</h1>
            </div>

            <?php
                foreach ($product as $category => $items) {
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
                        <h3><?=$item['retail_price']?></h3>
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
                foreach ($product as $category => $items) {
                    foreach($items as $key => $item) {
            ?>

            <div id="<?=$item['uid']?>" class="modal">
                <i class="fa fa-close close-modal"></i>
                <h1><?=$item['name']?></h1>
                <div class="row">
                    <div class="column half">
                        <img src="images/store/<?=urlencode(strtolower($category))?>/<?=urlencode(strtolower($item['name']))?>-large.png"/>
                    </div>
                    <div class="column half">
                        <h2><?=$item['retail_price']?></h2>
                        <p><?=$item['description']?></p>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
            ?>

<?php
    include $template['footer'];
?>
