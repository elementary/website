<?php
require_once __DIR__.'/config.loader.php';

// TODO: add api grabbing from amplifier
function amplifier_raw() {
    return [[
        'id' => 't8w4v5s6-21e5-40f9-a1be-b7z5d2e4q9g6',
        'name' => 'Logotype',
        'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
        'category' => 'apparel',
        'cost' => 22.000000,
        'retail_price' => 30.000000,
        'color' => null,
        'size' => 'S',
        'backorderable' => false,
        'discontinued' => false,
        'inventory' => [
            'quantity_available' => 30,
            'quantity_on_hand' => 0,
            'quantity_committed' => 0,
            'quantity_on_order' => 0
        ]
    ], [
         'id' => 'v9s4e2z4-21e5-40f9-a1be-q9g4o5m4v12w',
         'name' => 'Logotype',
         'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
         'category' => 'apparel',
         'cost' => 22.000000,
         'retail_price' => 35.000000,
         'color' => null,
         'size' => 'M',
         'backorderable' => false,
         'discontinued' => false,
         'inventory' => [
             'quantity_available' => 35,
             'quantity_on_hand' => 0,
             'quantity_committed' => 0,
             'quantity_on_order' => 0
         ]
    ], [
         'id' => '8vb4e1s5-21e5-40f9-a1be-385b6xc49erg',
         'name' => 'Logotype',
         'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
         'category' => 'apparel',
         'cost' => 22.000000,
         'retail_price' => 40.000000,
         'color' => null,
         'size' => 'L',
         'backorderable' => false,
         'discontinued' => false,
         'inventory' => [
             'quantity_available' => 40,
             'quantity_on_hand' => 0,
             'quantity_committed' => 0,
             'quantity_on_order' => 0
         ]
    ], [
         'id' => '9q5j4cv8-21e5-40f9-a1be-145y48f634s1',
         'name' => 'Logotype',
         'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
         'category' => 'apparel',
         'cost' => 22.000000,
         'retail_price' => 45.000000,
         'color' => null,
         'size' => 'XL',
         'backorderable' => false,
         'discontinued' => false,
         'inventory' => [
             'quantity_available' => 45,
             'quantity_on_hand' => 0,
             'quantity_committed' => 0,
             'quantity_on_order' => 0
         ]
    ],[
         'id' => 'v8s4e124-21e5-40f9-a1be-8v4as864ae4f',
         'name' => 'Logotype',
         'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
         'category' => 'apparel',
         'cost' => 22.000000,
         'retail_price' => 50.000000,
         'color' => null,
         'size' => 'XXL',
         'backorderable' => false,
         'discontinued' => false,
         'inventory' => [
             'quantity_available' => 50,
             'quantity_on_hand' => 0,
             'quantity_committed' => 0,
             'quantity_on_order' => 0
         ]
    ], [
         'id' => '8c4w1gd4-21e5-40f9-a1be-v48eaq4x645s',
         'name' => 'Terminal',
         'description' => 'The elementary Terminal app logo screen printed on a comfy asphalt jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
         'category' => 'apparel',
         'cost' => 22.000000,
         'retail_price' => 40.000000,
         'backorderable' => false,
         'discontinued' => false,
         'inventory' => [
             'quantity_available' => 40,
             'quantity_on_hand' => 0,
             'quantity_committed' => 0,
             'quantity_on_order' => 0
        ]
    ], [
        'id' => 'e515f421-21e5-40f9-a1be-4dc8c07f061c',
        'name' => 'Logomark',
        'description' => 'Set of blue 2-inch (5 cm) circle stickers with the elementary "e" logomark in white. Silkscreened on premium vinyl and layered with three coats of 100% UV protection meaning your stickers will stick for several years without fading.',
        'category' => 'stickers',
        'cost' => 1.000000,
        'retail_price' => 8.000000,
        'backorderable' => false,
        'discontinued' => false,
        'inventory' => [
            'quantity_available' => 8,
            'quantity_on_hand' => 50,
            'quantity_committed' => 2,
            'quantity_on_order' => 8
        ]
    ]];
}

function amplifier_product() {
    $data = amplifier_raw();
    $sorted = [];

    $sizes = [
        'S' => 'Small',
        'M' => 'Medium',
        'L' => 'Large',
        'XL' => 'Extra Large',
        'XXL' => 'Extra Extra Large'
    ];

    foreach ($data as $key => &$value) {
        $sorted[$value['id']] = $value;

        $product = &$sorted[$value['id']];

        $product['uid'] = urlencode(str_replace(' ', '-', strtolower($value['category'].'-'.$value['name'])));

        $name_array = [];
        if (isset($product['size'])) {
            if (isset($sizes[$product['size']])) {
                array_push($name_array, $sizes[$product['size']]);
            } else {
                array_push($name_array, $product['size']);
            }
        }

        if (isset($product['color'])) {
            array_push($name_array, $product['color']);
        }

        array_push($name_array, $product['name']);
        $product['full_name'] = implode(' ', $name_array);
    }

    return $sorted;
}
