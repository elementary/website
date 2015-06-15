<?php

include_once 'classify.functions.php';

if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

$region = ipCheck($ip);
if ( is_array($region) ) {
	$hash = ipHash($ip);
	$region = $region[$hash];
}

date_default_timezone_set('UTC');
$download_link = '//'.$region.'.dl.elementary.io/download/'.base64_encode(time()).'/';
