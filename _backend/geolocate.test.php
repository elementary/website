<?php

require_once __DIR__.'/geolocate.functions.php';
require_once __DIR__.'/geolocate.guess_ip.php';

$region = getDownloadRegion($ip);
$hash = getIPHash($ip);
if (is_array($region)) {
    $region = $region[$hash];
}
$currentLocation = getCurrentLocation($ip);

var_dump($ip, $region, $hash, $currentLocation);
