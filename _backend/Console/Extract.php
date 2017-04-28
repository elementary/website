<?php

/**
 * _backend/Console/Extract.php
 * Extracts the translatable text from a page
 */

namespace App\Console;

require_once __DIR__ . '/../bootstrap.php';

use \App\Lib\L10n;
use \League\CLImate\CLImate;
use \ParsedownExtra;

$cli = new CLImate();
$l10n = new L10n('en');

$root = realpath(__DIR__ . '/../..');

$cli->arguments->add([
    'page' => [
        'prefix'      => 'p',
        'longPrefix'  => 'page',
        'description' => 'Page to extract',
    ],
    'domain' => [
        'prefix'      => 'd',
        'longPrefix'  => 'domain',
        'description' => 'Domain to extract'
    ],
    'verbose' => [
        'prefix'      => 'v',
        'longPrefix'  => 'verbose',
        'description' => 'Verbose output',
        'noValue'     => true,
    ],
    'help' => [
        'longPrefix'  => 'help',
        'description' => 'Prints a usage statement',
        'noValue'     => true,
    ]
]);
$cli->arguments->parse();

if ($cli->arguments->defined('help')) {
    $cli->usage();
    die();
}

$isVerbose = $cli->arguments->defined('verbose');

$page = 'index.php';
if ($cli->arguments->defined('page') !== false) {
    $cliPage = $cli->arguments->get('page');

    $pages = array_map(function ($path) use ($root) {
        return substr(realpath($path), strlen(realpath($root)) + 1);
    }, L10n::pages());

    if (in_array($cliPage . '.php', $pages)) {
        $page = $cliPage . '.php';
    } elseif (in_array($cliPage . '.md', $pages)) {
        $page = $cliPage . '.md';
    } else {
        throw new \Exception("Page '$cliPage' is not part of the website");
    }
}

if ($isVerbose) {
    $cli->whisper("Extracting text from '$page'");
}

$path = $root . '/' . $page;
$isMarkdown = (substr($path, -3) === '.md');

$currentUrl = substr($page, 0, -3);
if ($isMarkdown === false) {
    $currentUrl = substr($currentUrl, 0, -1);
}

$currentTranslations = $l10n->load_translations($currentUrl);
if ($currentTranslations === false) {
    $currentTranslations = array();
}

/**
 * captureTranslations
 * L10n translation callback
 *
 * @param  string $id     The source string
 * @param  string $domain The translation domain
 * @param  string $string The translation string
 * @return Void
 */
function captureTranslations($id, $domain, $string)
{
    global $currentTranslations, $currentUrl;

    if ($domain !== $currentUrl) {
        return;
    }

    if (empty($id)) {
        return;
    }

    if (is_numeric($id) || ctype_punct($id)) {
        return;
    }

    if (isset($currentTranslations[$id])) {
        return;
    }

    $currentTranslations[$id] = $string;
}

/**
 * translateMarkdown
 * Translates a page of markdown
 *
 * @param  string $path   Path to markdown file
 * @param  string $domain Page URL without extension
 * @return void           All translations kept in $currentTranslations array
 */
function translateMarkdown($path, $domain)
{
    global $l10n;

    $markdown = file_get_contents($path);

    $parsedown = new ParsedownExtra();
    $html = $parsedown->text($markdown);

    $html = str_replace('⌘', '&#8984;', $html);

    $l10n->set_domain($domain);
    $l10n->translate_html($html, '\App\Console\captureTranslations');
}

/**
 * translatePHP
 * Translates a wall of PHP HTML code
 *
 * @param  string $path   Path to PHP file
 * @param  string $domain Page URL without extension
 * @return void           All translations kept in $currentTranslations array
 */
function translatePHP($path, $domain)
{
    global $l10n, $root;

    chdir($root);
    $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
    $_GET['page'] = $domain;
    $page['name'] = $domain;

    // Do not start output buffering twice
    if (defined('HTML_I18N') === false) {
        define('HTML_I18N', 1);
    } elseif (HTML_I18N === 1) {
        return;
    }

    $l10n->set_domain($domain);
    ob_start(function ($input) use ($l10n) {
        $l10n->translate_html($input, '\App\Console\captureTranslations');
        return '';
    });

    include $path;

    if (ob_get_level()) {
        ob_end_flush();
    }

    // Add page title to translations
    if (isset($page['title']) !== false) {
        captureTranslations($page['title'], $domain, $page['title']);
    }
}

$domain = $currentUrl;
if ($cli->arguments->defined('domain') !== false) {
    $domain = $cli->arguments->get('domain');
}

if ($isMarkdown) {
    translateMarkdown($path, $currentUrl);
} else {
    translatePHP($path, $currentUrl);
}

echo json_encode($currentTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
