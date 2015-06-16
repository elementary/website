<?php

include_once 'classify.functions.php';

if (!empty($_GET['IP'])) {
    $ip = $_GET['IP'];
} else if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
    $ip = $_GET['REMOTE_ADDR'];
}

$region = ipCheck($ip, true);
if ( is_array($region) ) {
    $hash = ipHash($ip, true);
    $region = $region[$hash];
}
echo $region;
