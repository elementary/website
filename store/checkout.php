<?php
    include __DIR__.'/../_templates/sitewide.php';
    include __DIR__.'/../backend/lib/autoload.php';
    require_once __DIR__.'/../backend/config.loader.php';
    $page['title'] = 'Checkout &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    // TODO: check variables for bad eggs

    $address = new \Ups\Entity\Address();
    $address->setAttentionName($_POST['name']);
    $address->setAddressLine1($_POST['address-line1']);
    $address->setAddressLine2($_POST['address-line2']);
    $address->setCity($_POST['address-level2']);
    $address->setStateProvinceCode($_POST['address-level1']);
    $address->setCountryCode($_POST['country']);
    $address->setPostalCode($_POST['postal-code']);

    try {
        $xav = new \Ups\AddressValidation($config['ups_access'], $config['ups_user'], $config['ups_password']);
        $xav->activateReturnObjectOnValidate();
        $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 1);

        if ($response->isValid()) {
            $valid = $response->getValidatedAddress();
            $address->setAddressLine1($valid->getAddressLine(1));
            $address->setAddressLine2($valid->getAddressLine(2));
            $address->setAddressLine3($valid->getAddressLine(3));
            $address->setCity($valid->getCity());
            $address->setStateProvinceCode($valid->getStateProvince());
            $address->setPostalCode($valid->getPostalCode());
        } else if ($response->isAmbiguous()) {
            $possibles = $response->getCandidateAddressList();
            print_r("==== POSS ====");
            print_r($possibles[0]);
            $address = $possibles[0];
        } else if ($response->noCandidates()) {
            // Notify user the address might be wrong
        }
    } catch (Exception $e) {
        // Notify user unable to verify address (similar to above)
    }
?>

<hr>

<?php
    $shipment = new \Ups\Entity\Shipment();

    $fromAddress = new \Ups\Entity\Address();
    $fromAddress->setPostalCode('78721');
    $from = new \Ups\Entity\ShipFrom();
    $from->setAddress($fromAddress);
    $shipment->setShipFrom($from);

    $to = new \Ups\Entity\ShipTo();
    $to->setAddress($address);
    $shipment->setShipTo($to);

    $cart = json_decode($_COOKIE['cart'], true);
    $weight = 0;
    print_r($cart);
    foreach($cart as $id => $product) {
        if (isset($product['weight'])) {
            $weight = bcadd($weight, $product['weight']);
        } else {
            // oh god, an unknown weight. how to rate shipping?
        }
    }

    $kg = new \Ups\Entity\UnitOfMeasurement;
    $kg->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);

    $package = new \Ups\Entity\Package();
    $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_UNKNOWN);
    $package->getPackageWeight()->setUnitOfMeasurement($kg);
    $package->getPackageWeight()->setWeight($weight);
    $shipment->addPackage($package);

    $rate = new \Ups\Rate($config['ups_access'], $config['ups_user'], $config['ups_password']);

    try {
        $response = $rate->getRate($shipment);
    } catch (Exception $e) {
        var_dump($e);
    }

    print_r($response);
?>

<?php
    include $template['footer'];
?>
