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
    $address->setCountryCode($_POST['country']);
    $address->setPostalCode($_POST['postal-code']);

    $xav = new \Ups\AddressValidation($config['ups_access'], $config['ups_user'], $config['ups_password']);

    try {
        $response = $xav->validate($address);
    } catch (Exception $e) {
        var_dump($e);
    }

    print_r($response);
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

    // TODO: what are polybags under for UPS API?

    $package = new \Ups\Entity\Package();
    $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_UNKNOWN);
    $package->getPackageWeight()->setWeight(10);
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
