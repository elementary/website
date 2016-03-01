<?php
require_once __DIR__.'/config.loader.php';

// TODO: add api grabbing from amplifier

function storeRaw() {
    return [[
        'id' => 'aserv48des48r6e486a048df04a86sd0',
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
         'id' => 'af4d8s9045xv640cx4f05se4f0s65dff',
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
        'id' => '83ea7daadc1d435ca9aad8a9e42811c5',
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
}

function storeItems() {
    $product = storeRaw();
    $list = [];

    foreach($product as $key => $item) {
        $list[$item['id']] = $item;
    }

    return $list;
}


function storeCart() {
    if (!isset($_COOKIE['cart'])) return false;

    $cart = json_decode($_COOKIE['cart'], true);

    if (count($cart) < 1) return false;

    return $cart;
}
