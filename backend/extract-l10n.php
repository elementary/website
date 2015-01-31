<?php
require_once '../_templates/l10n.php';

if (!isset($_GET['page'])) {
	header('HTTP/1.0 404 Not Found');
	exit('No page specified.');
}

$captureDomain = $_GET['page'];
if ($captureDomain == 'layout') {
	$page['name'] = 'index';
} else {
	$page['name'] = $captureDomain;
}

if (!preg_match('#^[a-z0-9-\.]+$#', $page['name'])) {
	header('HTTP/1.0 400 Bad Request');
	exit('Bad page name.');
}

$target = '../'.$page['name'].'.php';

if (!file_exists($target)) {
	header('HTTP/1.0 404 Not Found');
	exit('Page not found.');
}

$newTranslations = array();
$currentTranslations = load_translations($captureDomain, 'en');
if ($currentTranslations === false) {
	$currentTranslations = array();
}

function capture_translation ($string, $domain) {
	global $captureDomain, $newTranslations, $currentTranslations;

	if ($domain != $captureDomain) {
		return;
	}
	if (is_numeric($string) || ctype_punct($string)) {
		return; // Not supposed to be a translatable string
	}
	if (isset($currentTranslations[$string]) && $currentTranslations[$string] === false) {
		if (isset($_GET['include_disabled'])) {
			$newTranslations[$string] = false;
		}
		return; // Disabled translation
	}

	$newTranslations[$string] = html_entity_decode($string);
}

chdir('..');

define('HTML_I18N', 1);
ob_start(function ($input) {
    translate_html($input, 'capture_translation');
    return '';
});

include './backend/'.$target;

ob_end_flush();

if (!empty($page['title'])) {
	capture_translation($page['title'], $captureDomain);
}

// Output empty translation file
$json = json_encode($newTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

header('Content-Type: application/json; charset=utf-8');
exit($json);