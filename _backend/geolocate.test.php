<?php

require_once __DIR__.'/geolocate.functions.php'; // provides getCurrentLocation()
require_once __DIR__.'/geolocate.guess_ip.php'; // provides $ip

$currentLocation = getCurrentLocation($ip);

var_dump($ip, $currentLocation);
