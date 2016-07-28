<?php

require_once __DIR__.'/../backend/store.php';

if (!isset($store)) {
    $store = new Store();
}

////    Cart: A general class for cart variable management
class Cart {
    private $items = [];

    function __construct ($data = array()) {
        foreach ($data as $id => $quantity) {
            $this->set_set($id, $quantity);
        }
    }

    // Setter functions
    public function set_set ($id, $quantity) {
        global $store;

        $product = $store->get_product($id);

        if (!$product) {
            return 'Unknown product';
        }

        if ($product['inventory']['quantity_available'] < $quantity) {
            return 'Insufficent amount of product';
        }

        if ($quantity <= 0) {
            unset($this->items[$id]);
        } else {
            $this->items[$id] = $quantity;
        }

        return false;
    }

    public function set_add ($id, $quantity) {
        if (isset($this->items[$id])) {
            $current = $this->items[$id];
        } else {
            $current = 0;
        }

        return $this->set_set($id, $current + $quantity);
    }

    public function set_remove ($id, $quantity) {
        if (isset($this->items[$id])) {
            $current = $this->items[$id];
        } else {
            $current = 0;
        }

        $set_quantity = $current - $quantity;

        if ($set_quantity <= 0) {
            unset($this->items[$id]);
        } else {
            $this->items[$id] = $set_quantity;
        }

        return false;
    }

    public function set_cookie () {
        if (count($this->items) > 0) {
            $products = json_encode($this->items);
            setcookie('cart', json_encode($this->items), time() + 604800, '/', '', 0, 1);
        } else {
            setcookie('cart', '', time() - 1, '/', '', 0, 1);
        }
    }

    // Getter functions
    public function get_quantity () {
        return $this->items;
    }

    public function get_count () {
        return count($this->items);
    }

    public function get_weights() {
        global $store;

        $weight = 0;

        foreach ($this->items as $id => $quantity) {
            $product = $store->get_product($id);

            if (!$product) {
                unset($this->items[$id]);
                continue;
            }

            $weight += $product['weight'] * $quantity;
        }

        return floatval($weight);
    }

    public function get_totals() {
        global $store;

        $total = 0;

        foreach ($this->items as $id => $quantity) {
            $product = $store->get_product($id);

            if (!$product) {
                unset($this->items[$id]);
                continue;
            }

            $total += $product['retail_price'] * $quantity;
        }

        return floatval($total);
    }

    public function get_products() {
        global $store;

        $products = [];

        foreach ($this->items as $id => $quantity) {
            $product = $store->get_product($id);

            // Error correction (should never actually happen)
            if (!$product || $quantity <= 0) {
                unset($this->items[$id]);
                continue;
            }

            $products[$id] = $product;
            $products[$id]['quantity'] = $quantity;
        }

        return $products;
    }
}
