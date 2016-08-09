<?php

namespace Store\Address;

const COUNTRY_FILE = __DIR__ . '/../../data/country.json';

/**
 * do_save
 * Saves array to store list
 *
 * @param Array $i list of products
 */
function do_save (array $i) {
    file_put_contents(COUNTRY_FILE, json_encode($i, JSON_PRETTY_PRINT));
}

/**
 * do_open
 * Returns the saved list of products
 *
 * @return Array list of products
 */
function do_open () {
    return json_decode(file_get_contents(COUNTRY_FILE), true);
}

/**
 * get_countries
 * Returns a list of countries sorted in order of name
 *
 * @return Array list of countries
 */
function get_countries() {
    $countries = do_open();
    $c = [];

    foreach($countries as $code => $item) {
        if (is_string($item)) {
            $c[$code] = $item;
        } else {
            $c[$code] = $item['name'];
        }
    }

    asort($c);
    return $c;
}

/**
 * get_states
 * Returns a list of states for a given country in sorted name order
 *
 * @param String $c Country code for list of states
 *
 * @return Array list of states
 *
 * @throws Exception on bad country code given
 */
function get_states($c) {
    $countries = do_open();

    if (!isset($countries[$c])) {
        throw new \Exception('Unknown country code');
    }

    $country = $countries[$c];

    if (is_array($country) && is_array($country['states'])) {
        return $country['states'];
    } else {
        return array();
    }
}
