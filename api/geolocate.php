<?php

////	API for Geolocationg

// Option 1. Download
// Parameters:
// - download [no value]
// Outputs:
// {
//     "ip": "92.26.51.149",
//     "download": {
//         "region": "ams3",
//         "download_link": "\/\/ams3.dl.elementary.io\/download\/MTUxNjMxNTg4Mg==\/"
//     }
// }

// Option 2. Shipping
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

if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else if (!empty($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
} else {
    $ip = false;
}

// DEVELOPER OVERRIDE
// Override IP here
//$ip = '92.26.51.149';

require_once __DIR__.'/../_backend/classify.functions.php';

if ( isset($_GET['download']) ) {
	$region = getDownloadRegion($ip);
	if ( is_array($region) ) {
	    $hash = getIPHash($ip);
	    $region = $region[$hash];
	}
	date_default_timezone_set('UTC');
	$download_link = '//'.$region.'.dl.elementary.io/download/'.base64_encode(time()).'/';
	$result = array(
	    'ip' => $ip,
	    'download' => array(
	        'region' => $region,
	        'download_link' => $download_link,
	    ),
	);
	echo json_encode($result);
} else if ( isset($_GET['shipping']) ) {
	$estimatedAddress = getCurrentLocation($ip);

	$result = array(
	    'ip' => $ip,
	    'shipping' => array(
			'address' => $estimatedAddress,
		),
	);

	if ( !empty($_GET['item']) ) {
		require_once __DIR__.'/../_backend/store/address.php';
		require_once __DIR__.'/../_backend/store/api.php';
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
