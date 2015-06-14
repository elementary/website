<?php

include_once 'classify.functions.php';

if (!empty($_GET['IP'])) {
	 $_GET['IP'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	 $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_GET['REMOTE_ADDR'];
}

$region = ipCheck($ip, true);
if ( is_array($region) ) {
	$hash = ipHash($ip, true);
	$region = $region[$hash];
}
echo $region;

