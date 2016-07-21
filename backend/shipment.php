<?php

require_once __DIR__.'/lib/autoload.php';
require_once __DIR__.'/config.loader.php';

////    Shipment: A general class for all your amplifier shipping needs
// TODO: add support for the other, non US, countries
class Shipment {
    private $name;
    private $line1;
    private $line2;
    private $level2;
    private $level1;
    private $country;
    private $postal;
    private $weight;

    // Setter functions
    public function set_name ($in) {
        $this->name = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_line1 ($in) {
        $this->line1 = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_line2 ($in) {
        $this->line2 = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_level2 ($in) {
        $this->level2 = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_level1 ($in) {
        $this->level1 = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_country ($in) {
        $this->country = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    public function set_postal ($in) {
        $this->postal = htmlspecialchars($in, ENT_XML1, 'UTF-8');
    }

    // Getter functions
    public function get_name () {
        return $this->name;
    }

    public function get_line1 () {
        return $this->line1;
    }

    public function get_line2 () {
        return $this->line2;
    }

    public function get_level2 () {
        return $this->level2;
    }

    public function get_level1 () {
        return $this->level1;
    }

    public function get_country () {
        return $this->country;
    }

    public function get_postal () {
        return $this->postal;
    }

    // THIS NEEDS TO BE IN KGS!!!
    public function set_weight ($in) {
        try {
            $this->weight = floatval($in);
        } catch (Exception $e) {
            throw new Exception('Shipping weight needs to be a float value');
        }
    }

    public function do_validation () {
        global $config;

        if ($this->country !== 'US') {
            throw new Exception('Unable to verify addresses outside of the US');
        }

        $ups_address = new \Ups\Entity\Address();
        $ups_address->setAttentionName($this->name);
        $ups_address->setAddressLine1($this->line1);
        $ups_address->setAddressLine2($this->line2);
        $ups_address->setCity($this->level2);
        $ups_address->setStateProvinceCode($this->level1);
        $ups_address->setCountryCode($this->country);
        $ups_address->setPostalCode($this->postal);

        // TODO: this only works for the US. We will want to do something for other countries
        // and will need to abstract this a bit higher so it's not UPS specific
        $xav = new \Ups\AddressValidation($config['ups_access'], $config['ups_user'], $config['ups_password']);
        $xav->activateReturnObjectOnValidate();
        $response = $xav->validate($ups_address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 1);

        if ($response->isValid()) {
            $valid = $response->getValidatedAddress();
            $this->set_line1($valid->getAddressLine(1));
            $this->set_line2($valid->getAddressLine(2));
            $this->set_level2($valid->getCity());
            $this->set_level1($valid->getStateProvince());
            $this->set_postal($valid->getPostalCode());
        } else if ($response->isAmbiguous()) {
            // TODO: Is this what we want? Just use the first canidate?
            $possibles = $response->getCandidateAddressList();
            $valid = $possibles[0];
            $this->set_line1($valid->getAddressLine(1));
            $this->set_line2($valid->getAddressLine(2));
            $this->set_level2($valid->getCity());
            $this->set_level1($valid->getStateProvince());
            $this->set_postal($valid->getPostalCode());
        } else {
            throw new Exception('Not a valid address');
        }
    }

    public function get_rate () {
        global $config;

        if (!isset($this->weight) || $this->weight <= 0) {
            throw new Exception('Shipment requires a valid weight for getting rate');
        }

        $address_to = new \Ups\Entity\Address();
        $address_to->setAttentionName($this->name);
        $address_to->setAddressLine1($this->line1);
        $address_to->setAddressLine2($this->line2);
        $address_to->setCity($this->level2);
        $address_to->setStateProvinceCode($this->level1);
        $address_to->setCountryCode($this->country);
        $address_to->setPostalCode($this->postal);

        $address_from = new \Ups\Entity\Address();
        $address_from->setPostalCode('78721'); // ZIP code of amplifier warehouse

        $ship_to = new \Ups\Entity\ShipTo();
        $ship_to->setAddress($address_to);

        $ship_from = new \Ups\Entity\ShipFrom();
        $ship_from->setAddress($address_from);

        $package = new \Ups\Entity\Package();
        $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_UNKNOWN);

        // FFS "This measurement system is not valid for the selected country"
        if ($this->country === 'US') {
            $weight_UOM = new \Ups\Entity\UnitOfMeasurement;
            $weight_UOM->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS); // The inferior UOM

            $package->getPackageWeight()->setUnitOfMeasurement($weight_UOM);
            $package->getPackageWeight()->setWeight($this->weight * 2.2046);
        } else {
            $weight_UOM = new \Ups\Entity\UnitOfMeasurement;
            $weight_UOM->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS); // The Queen's UOM

            $package->getPackageWeight()->setUnitOfMeasurement($weight_UOM);
            $package->getPackageWeight()->setWeight($this->weight);
        }

        $shipment = new \Ups\Entity\Shipment();
        $shipment->setShipFrom($ship_from);
        $shipment->setShipTo($ship_to);
        $shipment->addPackage($package);

        $rate = new \Ups\Rate($config['ups_access'], $config['ups_user'], $config['ups_password']);
        return $rate->getRate($shipment);
    }
}
