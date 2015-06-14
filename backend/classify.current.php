<?php

include_once 'classify.functions.php';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	 $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

$region = ipCheck($ip);
if ( is_array($region) ) {
	$hash = ipHash($ip);
	$region = $region[$hash];
}
