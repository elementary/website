<?php

namespace Store\Address;

require_once __DIR__ . '/../validation.php';

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
    try {
        $res = file_get_contents(COUNTRY_FILE);
    } catch (Exception $e) {
        error_log('Unable to open COUNTRY_FILE');
        return array();
    }

    if ($res === false) {
        error_log('Unable to open COUNTRY_FILE');
        return array();
    }

    return json_decode($res, true);
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

/**
 * Address
 * a class to store address information including email and phone
 */
class Address {
    private $name;
    private $line1;
    private $line2;
    private $city;
    private $state;
    private $country;
    private $postal;

    private $email;
    private $phone;

    function __construct ($data = array()) {
        if (isset($data['name'])) $this->set_name($data['name']);
        if (isset($data['line1'])) $this->set_line1($data['line1']);
        if (isset($data['line2'])) $this->set_line2($data['line2']);
        if (isset($data['city'])) $this->set_city($data['city']);
        if (isset($data['state'])) $this->set_state($data['state']);
        if (isset($data['country'])) $this->set_country($data['country']);
        if (isset($data['postal'])) $this->set_postal($data['postal']);
        if (isset($data['email'])) $this->set_email($data['email']);
        if (isset($data['phone'])) $this->set_phone($data['phone']);
    }
    // Setter functions
    public function set_name (string $in) {
        \validate_string($in);

        if (strlen($in) < 4) {
            throw new \ValidationException('Name needs to be greater than 3 charactors');
        }

        $this->name = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function set_line1 ($in) {
        if (!isset($in)) {
            throw new \ValidationException('Address line 1 is not set');
        }

        $this->line1 = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function set_line2 ($in) {
        if (!isset($in)) {
            throw new \ValidationException('Address line 2 is not set');
        }

        $this->line2 = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function set_city ($in) {
        \validate_string($in);

        if (!preg_match("/^[a-z0-9 ]{3,}$/i", $in)) {
            throw new \ValidationException('City is not valid');
        }

        $this->city = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function set_state ($in) {
        if (!isset($in)) {
            throw new \ValidationException('State code is not set');
        }

        if (!isset($this->country)) {
            throw new \ValidationException('Country code is not yet set');
        }

        $states = get_states($this->country);
        $in = strtoupper($in);

        if (count($states) === 0) return;

        if (!isset($states[$in])) {
            throw new \ValidationException('State code does not exist');
        }

        $this->state = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_country ($in) {
        if (!isset($in) || !is_string($in)) {
            throw new \ValidationException('Country code is not valid');
        }

        $countries = get_countries();
        $in = strtoupper($in);

        if (!isset($countries[$in])) {
            throw new \ValidationException('Country code does not exist');
        }

        $this->country = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_postal ($in) {
        if (!isset($in)) {
            throw new \ValidationException('Postal code is not set');
        }

        if (!is_string($in) && !is_int($in)) {
            throw new \ValidationException($m);
        }

        if (!preg_match("/^[0-9\- ]{4,}$/i", $in)) {
            throw new \ValidationException($m);
        }

        $this->postal = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_email ($in) {
        \validate_string($in);

        if (!filter_var($in, FILTER_VALIDATE_EMAIL)) {
            throw new \ValidationException('Email is not valid');
        }

        $this->email = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_phone ($in) {
        if (!isset($in)) {
            throw new \ValidationException('Phone number is not set');
        }

        if (!is_string($in) || !is_int($in)) {
            throw new \ValidationException('Phone number is not valid');
        }

        if (!preg_match("/^[\+0-9\-\# ]{7,}$/i", $in)) {
            throw new \ValidationException('Phone number is not valid');
        }

        $this->phone = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    // Getter functions
    public function get_name () {
        return $this->name;
    }

    public function get_line1 () {
        return ucwords(strtolower($this->line1));
    }

    public function get_line2 () {
        return ucwords(strtolower($this->line2));
    }

    public function get_city () {
        return ucwords(strtolower($this->city));
    }

    public function get_state () {
        return strtoupper($this->state);
    }

    public function get_country () {
        return strtoupper($this->country);
    }

    public function get_postal () {
        return $this->postal;
    }

    public function get_email () {
        return $this->email;
    }

    public function get_phone () {
        return $this->phone;
    }

    /**
     * get_string
     * Returns a single line formated string of address
     *
     * @return String single line of address
     */
    public function get_string () {
        $a = [];

        if (isset($this->line1)) $a[] = $this->get_line1();
        if (isset($this->line2)) $a[] = $this->get_line2();
        if (isset($this->city)) $a[] = $this->get_city();
        if (isset($this->state)) $a[] = $this->get_state();
        if (isset($this->country)) $a[] = $this->get_country();
        if (isset($this->postal)) $a[] = $this->get_postal();

        return implode(' ', $a);
    }

    /**
     * get_formatted
     * Returns an array of human readable address label
     *
     * @return Array each value as a line in a human readable label
     */
    public function get_formatted () {
        $a = [];

        if (isset($this->name)) $a[] = $this->get_name();

        if (isset($this->line1)) $a[] = $this->get_line1();
        if (isset($this->line2)) $a[] = $this->get_line2();

        $line4 = [];

        if (isset($this->city)) $line4[] = $this->get_city();
        if (isset($this->state)) $line4[] = $this->get_state();
        if (isset($this->country)) $line4[] = $this->get_country();
        if (isset($this->postal)) $line4[] = $this->get_postal();

        $a[] = implode(' ', $line4);

        return $a;
    }

    /**
     * get_shipping
     * Returns an array of shipping informatino to be consumed by Printful api
     *
     * @return Array list of address information
     */
     public function get_shipping () {
         $res = array(
            'address1' => $this->get_line1(),
            'city' => $this->get_city(),
            'country_code' => $this->get_country()
         );

         if (isset($this->state)) $res['state'] = $this->get_state();
         if (isset($this->postal)) $res['zip'] = $this->get_postal();

         return $res;
     }
}
