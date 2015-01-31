<?php
include '../_templates/i18n.php';

if (!isset($_GET['page'])) {
	header('HTTP/1.0 404 Not Found');
	exit('No page specified.');
}

$pageName = $_GET['page'];

if (!preg_match('#^[a-z0-9-\.]+$#', $pageName)) {
	header('HTTP/1.0 400 Bad Request');
	exit('Bad page name.');
}

$target = '../'.$pageName.'.php';

if (!file_exists($target)) {
	header('HTTP/1.0 404 Not Found');
	exit('Page not found.');
}

$translations = array();

function capture_translation ($string) {
	global $translations;

	if (is_numeric($string) || ctype_punct($string)) {
		return;
	}

	$translations[$string] = $string;
}

ob_start(function ($input) {
    translate_html($input, 'capture_translation');
    return '';
});

include $target;

ob_end_flush();

// Output empty translation file
$json = json_encode($translations, JSON_PRETTY_PRINT);

header('Content-Type: application/json');
exit($json);