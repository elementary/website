<?php

require_once __DIR__.'/../_backend/geolocate.functions.php'; // provides getCurrentLocation()
require_once __DIR__.'/../_backend/geolocate.guess_ip.php'; // provides $ip
require_once __DIR__.'/../_backend/store/address.php';
require_once __DIR__.'/../_backend/store/api.php';

////    API for Geolocating Shipping
// Parameters:
// - shipping [no value]
// - item (printful variant id of 1 product)
// Outputs:
// {
//     "ip": "92.26.51.149",
//     "shipping": {
//         "address": ...,
//         "estimates": ...
//     }
// }

if (isset($_GET['shipping']) && !empty($_GET['item'])) {
    $estimatedAddress = getCurrentLocation($ip);

    $result = array(
        'ip' => $ip,
        'shipping' => array(
            'address' => $estimatedAddress,
        ),
    );

    if (!empty($estimatedAddress['countryCode']) &&
        !empty($estimatedAddress['stateCode']) &&
        !empty($estimatedAddress['city']) &&
        !empty($estimatedAddress['postcode'])
    ) {
        $address = new \Store\Address\Address();
        $address->set_line1('');
        $address->set_country($estimatedAddress['countryCode']);
        $address->set_state($estimatedAddress['stateCode']);
        $address->set_city($estimatedAddress['city']);
        $address->set_postal($estimatedAddress['postcode']);
        $items = array(
            array (
                'quantity' => 1,
                 'variant_id' => $_GET['item'],
            ),
        );
        $result['shipping']['estimates'] = Store\Api\get_shipping($address, $items);
    }

    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    $result = array ('error' => 'No parameters were supplied, but some were expected.');
    echo json_encode($result, JSON_PRETTY_PRINT);
}
