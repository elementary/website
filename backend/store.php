<?php

require_once __DIR__.'/config.loader.php';

////    Store: A general class for store data manipulation
class Store {
    protected $products = [];

    // These are used when creating the products full name (small logotype)
    private $sizes = [
        'S' => 'Small',
        'M' => 'Medium',
        'L' => 'Large',
        'XL' => 'Extra Large',
        'XXL' => 'Extra Extra Large'
    ];

    // Averate weight of category in pounds (pff) (used for shipping calculations)
    private $weights = [
        'Shirt' => 0.3,
        'Decal' => 0.1
    ];

    function __construct () {
        $this->fetch_product();
    }

    // Setter functions

    // Getter functions
    function get_product ($id) {
        $products = $this->get_products();

        if (isset($products[$id])) {
            return $products[$id];
        }

        return false;
    }

    function get_products () {
        return $this->products;
    }

    function get_category ($name) {
        $categories = $this->get_categories();

        if (isset($categories[$name])) {
            return $categories[$name];
        }

        return false;
    }

    function get_categories () {
        $cats = [];

        foreach ($this->get_products() as $id => $product) {
            if (!isset($cats[$product['category']])) {
                $cats[$product['category']] = [];
            }

            $cats[$product['category']][] = $product;
        }

        return $cats;
    }

    // Look at the next function for more information about this
    function get_front ($uid) {
        $fronts = $this->get_fronts();

        if (isset($fronts[$uid])) {
            return $fronts[$uid];
        }

        return false;
    }

    // This is used by the store index. It cleans up multiple products into one,
    // but with multiple colors, sizes, min max price, etc.
    function get_fronts () {
        $fronts = [];

        foreach ($this->get_products() as $id => $product) {
            if (!isset($fronts[$product['uid']])) {
                $fronts[$product['uid']] = $product;
            }

            $front = &$fronts[$product['uid']];

            // Lets make a pretty color array
            if (isset($product['color'])) {
                if (!is_array($front['color'])) {
                    $front['color'] = [$product['color']];
                } else {
                    $front['color'][] = $product['color'];
                }
            }

            // And the same thing with size
            if (isset($product['size'])) {
                if (!is_array($front['size'])) {
                    $front['size'] = [$product['size']];
                } else {
                    $front['size'][] = $product['size'];
                }
            }

            // Let's make sure we have a retail_price_min value
            if (!isset($front['retail_price_min'])) {
                $front['retail_price_min'] = $product['retail_price'];
            } else if ($front['retail_price_min'] > $product['retail_price']) {
                $front['retail_price_min'] = $product['retail_price'];
            }

            // And same thing for retail_price_max value
            if (!isset($front['retail_price_max'])) {
                $front['retail_price_max'] = $product['retail_price'];
            } else if ($front['retail_price_max'] < $product['retail_price']) {
                $front['retail_price_max'] = $product['retail_price'];
            }
        }

        return $fronts;
    }

    // Fetch and format function MASTER OF TIME AND SPACE
    function fetch_product () {
        // TODO: we need to grab this from amplifier itself with API call
        $product = [[
            'id' => 't8w4v5s6-21e5-40f9-a1be-b7z5d2e4q9g6',
            'sku' => 'SKU123',
            'name' => 'Logotype',
            'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
            'category' => 'Shirt',
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
             'sku' => 'SKU123456',
             'name' => 'Logotype',
             'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
             'category' => 'Shirt',
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
             'sku' => 'SKU123789',
             'name' => 'Logotype',
             'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
             'category' => 'Shirt',
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
             'sku' => 'SKU147',
             'name' => 'Logotype',
             'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
             'category' => 'Shirt',
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
             'sku' => 'SKU258',
             'name' => 'Logotype',
             'description' => 'The elementary logotype screen printed on a comfy blue jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
             'category' => 'Shirt',
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
             'sku' => 'SKU147369',
             'name' => 'Terminal',
             'description' => 'The elementary Terminal app logo screen printed on a comfy asphalt jersey cotton tee by American Apparel. Features the elementary "e" logomark on the sleeve and our website in small type on the back.',
             'category' => 'Shirt',
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
            'sku' => 'SKU159',
            'name' => 'Logomark',
            'description' => 'Set of blue 2-inch (5 cm) circle stickers with the elementary "e" logomark in white. Silkscreened on premium vinyl and layered with three coats of 100% UV protection meaning your stickers will stick for several years without fading.',
            'category' => 'Decal',
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

        foreach ($product as $value) {
            $this->products[$value['id']] = $value;
            $product = &$this->products[$value['id']];

            // Add a uid paramiter for easier identifying
            $product['uid'] = urlencode(str_replace(' ', '-', strtolower($value['category'].'-'.$value['name'])));

            // Format all the numbers
            $product['cost'] = floatval($product['cost']);
            $product['retail_price'] = floatval($product['retail_price']);

            if (isset($product['weight'])) {
                $product['weight'] = floatval($product['weight']);
            }

            // If the weight is not set, add the average category weight from $weights
            if (!isset($product['weight']) && isset($this->weights[$product['category']])) {
                $product['weight'] = $this->weights[$product['category']];
            } else {
                error_log($product['uid'].' has no weight. This can lead to CATASTROPHICALLY bad things');
                $product['weight'] = 1; // This is a hail mary pass
            }

            // Array of words that will make up the full product name (small blue logotype)
            $name_array = [];

            // If we have a size, add it to the name
            if (isset($product['size'])) {
                if (isset($this->sizes[$product['size']])) {
                    array_push($name_array, $this->sizes[$product['size']]);
                } else {
                    array_push($name_array, $product['size']);
                }
            }

            // Add color to the name
            if (isset($product['color'])) {
                array_push($name_array, $product['color']);
            }

            // Add the actual product name to the full name
            array_push($name_array, $product['name']);

            // And we explode the array for a nice descriptive name like "Large Blue Logomark"
            $product['full_name'] = implode(' ', $name_array);
        }
    }
}
