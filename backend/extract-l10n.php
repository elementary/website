<?php
require_once __DIR__.'/../_templates/l10n.php';
require_once __DIR__.'/../docs/_mdr/Parsedown.php';
require_once __DIR__.'/../docs/_mdr/ParsedownExtra.php';

$isCli = (php_sapi_name() == 'cli');
if ($isCli && !empty($argv[1])) {
	$_GET['page'] = $argv[1];
}

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

// If page name has a "/docs" prefix, it's a markdown file
$isMarkdown = (strpos($captureDomain, 'docs/') === 0);

// WARNING: keep a strict page name regex, otherwise everyone could be able to read
// sensitive data from server (e.g. Stripe API keys)
if (!preg_match('#^(docs/[a-z0-9-\./]+|[a-z0-9-\.]+)$#', $page['name'])) {
	header('HTTP/1.0 400 Bad Request');
	exit('Bad page name.');
}

$target = __DIR__.'/../'.$page['name'];
if ($isMarkdown) {
	$target .= '.md';
} else {
	$target .= '.php';
}

if (!file_exists($target)) {
	header('HTTP/1.0 404 Not Found');
	exit('Page not found.');
}

// Extracted translations
$newTranslations = array();
$currentTranslations = load_translations($captureDomain, 'en');
if ($currentTranslations === false) {
	$currentTranslations = array();
}

function capture_translation($id, $domain, $string) {
	global $captureDomain, $newTranslations, $currentTranslations;

	if ($domain != $captureDomain) {
		return;
	}
	if (empty($id)) {
		return;
	}
	if (is_numeric($id) || ctype_punct($id)) {
		return; // Not supposed to be a translatable string
	}
	if (isset($currentTranslations[$id]) && $currentTranslations[$id] === false) {
		if (isset($_GET['include_disabled'])) {
			$newTranslations[$id] = false;
		}
		return; // Disabled translation
	}

	$newTranslations[$id] = html_entity_decode($string);
}

if ($isMarkdown) {
	// Read markdown file
	$markdown = file_get_contents($target);

	// Render markdown as html
	$parsedown = new ParsedownExtra();
	$html = $parsedown->text($markdown);
	$html = str_replace('⌘', '&#8984;', $html);

	// Process html
	set_l10n_domain($captureDomain);
	translate_html($html, 'capture_translation');
} else {
	chdir('..');

	define('HTML_I18N', 1); // Do not start output buffering twice
	ob_start(function ($input) {
	    translate_html($input, 'capture_translation');
	    return '';
	});

	// Include target file
	include $target;

	ob_end_flush();

	// Add page title to translations
	if (!empty($page['title'])) {
		capture_translation($page['title'], $captureDomain, $page['title']);
	}
}

// Output json translation file
$json = json_encode($newTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

header('Content-Type: application/json; charset=utf-8');
exit($json);