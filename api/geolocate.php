<?php

require_once __DIR__.'/../_backend/classify.functions.php';

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

$region = getDownloadRegion($ip);
if ( is_array($region) ) {
    $hash = getIPHash($ip);
    $region = $region[$hash];
}

date_default_timezone_set('UTC');
$download_link = '//'.$region.'.dl.elementary.io/download/'.base64_encode(time()).'/';

$shipping = getCurrentLocation($ip);

$result = array(
    'ip' => $ip,
    'download' => array(
        'region' => $region,
        'download_link' => $download_link,
    ),
    'shipping' => $shipping,
);

echo json_encode($result, JSON_PRETTY_PRINT);
