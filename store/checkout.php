<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Checkout &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    include __DIR__.'/../backend/lib/UPS.php';

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

    echo $response;
?>


<?php
    include $template['footer'];
?>
