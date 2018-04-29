<?php

namespace Store\Address;

require_once __DIR__ . '/validation.php';

const COUNTRY_FILE = __DIR__ . '/../../data/country.json';

/**
 * do_save
 * Grabs all country information from COUNTRY_FILE
 *
 * @param Array $i list of products
 */
function do_save(array $i)
{
    file_put_contents(COUNTRY_FILE, json_encode($i, JSON_PRETTY_PRINT));
}

/**
 * do_open
 * Saves array to COUNTRY_FILE json
 *
 * @return Array list of products
 */
function do_open()
{
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
function get_countries()
{
    $countries = do_open();
    $c = [];

    foreach ($countries as $code => $item) {
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
function get_states($c)
{
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
class Address
{
    private $name;
    private $line1;
    private $line2;
    private $city;
    private $state;
    private $country;
    private $postal;

    private $email;
    private $phone;

    public function __construct($data = array())
    {
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['line1'])) {
            $this->setLine1($data['line1']);
        }
        if (isset($data['line2'])) {
            $this->setLine2($data['line2']);
        }
        if (isset($data['city'])) {
            $this->setCity($data['city']);
        }
        if (isset($data['state'])) {
            $this->setState($data['state']);
        }
        if (isset($data['country'])) {
            $this->setCountry($data['country']);
        }
        if (isset($data['postal'])) {
            $this->setPostal($data['postal']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['phone'])) {
            $this->setPhone($data['phone']);
        }
    }

    // Setter functions
    public function setName(string $in)
    {
        \validate_string($in);

        if (strlen($in) < 4) {
            throw new \ValidationException('Name needs to be greater than 3 charactors');
        }

        $this->name = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function setLine1($in)
    {
        if (!isset($in)) {
            throw new \ValidationException('Address line 1 is not set');
        }

        $this->line1 = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function setLine2($in)
    {
        if (!isset($in)) {
            throw new \ValidationException('Address line 2 is not set');
        }

        $this->line2 = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function setCity($in)
    {
        \validate_string($in);

        if (strlen($in) < 3) {
            throw new \ValidationException('City needs to be greater than 2 charactors');
        }

        $this->city = htmlspecialchars(ucwords($in), ENT_XML1, 'UTF-8');
    }

    public function setState($in)
    {
        if (!isset($in)) {
            throw new \ValidationException('State code is not set');
        }

        if (!isset($this->country)) {
            throw new \ValidationException('Country code is not yet set');
        }

        $states = get_states($this->country);
        $in = strtoupper($in);

        if (count($states) === 0) {
            return;
        }

        if (!isset($states[$in])) {
            throw new \ValidationException('State code does not exist');
        }

        $this->state = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function setCountry($in)
    {
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

    public function setPostal($in)
    {
        if (!isset($in)) {
            throw new \ValidationException('Postal code is not set');
        }

        $this->postal = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function setEmail($in)
    {
        \validate_string($in);

        if (!filter_var($in, FILTER_VALIDATE_EMAIL)) {
            throw new \ValidationException('Email is not valid');
        }

        $this->email = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function setPhone($in)
    {
        if (!isset($in)) {
            throw new \ValidationException('Phone number is not set');
        }

        if (!preg_match("/^[\+0-9\-\#\(\) ]{7,}$/i", $in)) {
            throw new \ValidationException('Phone number is not valid');
        }

        $this->phone = preg_replace('!\D+!', '', $in);
    }

    // Getter functions
    public function getName()
    {
        return $this->name;
    }

    public function getLine1()
    {
        return ucwords(strtolower($this->line1));
    }

    public function getLine2()
    {
        return ucwords(strtolower($this->line2));
    }

    public function getCity()
    {
        return ucwords(strtolower($this->city));
    }

    public function getState()
    {
        return strtoupper($this->state);
    }

    public function getCountry()
    {
        return strtoupper($this->country);
    }

    public function getPostal()
    {
        return $this->postal;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * get_string
     * Returns a single line formated string of address
     *
     * @return String single line of address
     */
    public function getString()
    {
        $a = [];

        if (isset($this->line1)) {
            $a[] = $this->getLine1();
        }
        if (isset($this->line2)) {
            $a[] = $this->getLine2();
        }
        if (isset($this->city)) {
            $a[] = $this->getCity();
        }
        if (isset($this->state)) {
            $a[] = $this->getState();
        }
        if (isset($this->country)) {
            $a[] = $this->getCountry();
        }
        if (isset($this->postal)) {
            $a[] = $this->getPostal();
        }

        return implode(' ', $a);
    }

    /**
     * get_formatted
     * Returns an array of human readable address label
     * TODO: this can be localized
     *
     * @return Array each value as a line in a human readable label
     */
    public function getFormatted()
    {
        $a = [];

        if (isset($this->name)) {
            $a[] = $this->getName();
        }

        if (isset($this->line1)) {
            $a[] = $this->getLine1();
        }
        if (isset($this->line2)) {
            $a[] = $this->getLine2();
        }

        $line4 = [];

        if (isset($this->city)) {
            $line4[] = $this->getCity();
        }
        if (isset($this->state)) {
            $line4[] = $this->getState();
        }
        if (isset($this->country)) {
            $line4[] = $this->getCountry();
        }
        if (isset($this->postal)) {
            $line4[] = $this->getPostal();
        }

        $a[] = implode(' ', $line4);

        return $a;
    }

    /**
     * get_shipping
     * Returns an array of shipping informatino to be consumed by Printful api
     *
     * @return Array list of address information
     */
    public function getShipping()
    {
        $res = array(
            'name' => $this->getName(),
            'address1' => $this->getLine1(),
            'city' => $this->getCity(),
            'country_code' => $this->getCountry(),
            'email' => $this->getEmail()
        );

        if (isset($this->line2)) {
            $res['address2'] = $this->getLine2();
        }
        if (isset($this->state)) {
            $res['state'] = $this->getState();
        }
        if (isset($this->postal)) {
            $res['zip'] = $this->getPostal();
        }
        if (isset($this->phone)) {
            $res['phone'] = $this->getPhone();
        }

        return $res;
    }
}
