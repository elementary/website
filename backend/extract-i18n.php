<?php
include_once '../_templates/i18n.php';

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
$currentTranslations = load_translations($pageName, 'en');
if ($currentTranslations === false) {
	$currentTranslations = array();
}

function capture_translation ($string) {
	global $translations;
	global $currentTranslations;

	if (is_numeric($string) || ctype_punct($string)) {
		return; // Not supposed to be a translatable string
	}
	if (isset($currentTranslations[$string]) && $currentTranslations[$string] === false) {
		return; // Disabled translation
	}

	$translations[$string] = html_entity_decode($string);
}

chdir('..');

ob_start(function ($input) {
    translate_html($input, 'capture_translation');
    return '';
});

include './backend/'.$target;

ob_end_flush();

// Output empty translation file
$json = json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

header('Content-Type: application/json; charset=utf-8');
exit($json);