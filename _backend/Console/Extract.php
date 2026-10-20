<?php

/**
 * _backend/Console/Extract.php
 * Extracts the translatable text from a page
 */

namespace App\Console;

require_once __DIR__ . '/../bootstrap.php';

use \App\Lib\L10n;
use \League\CLImate\CLImate;
use \Parsedown;
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
$isLayout = false;
if ($cli->arguments->defined('page') !== false) {
    $cliPage = $cli->arguments->get('page');
    $cliPage = preg_replace('/\.(php|md)$/', '', $cliPage);

    if ($cliPage === 'layout' || strpos($cliPage, '_templates/') === 0) {
        $isLayout = true;
        $page = 'layout';
    } else {
        $pages = array_map(function ($path) use ($root) {
            $rootPath = str_replace(
                '\\',
                '/',
                substr(realpath($path), strlen($root) + 1)
            );

            if (strpos($rootPath, '_templates/') === 0) {
                return 'layout';
            }

            $isMarkdown = substr($path, -3) === '.md';
            $url = substr($rootPath, 0, -3);

            if ($isMarkdown === false) {
                $url = substr($url, 0, -1);
            }

            return $url;
        }, L10n::pages());

        if (in_array($cliPage, $pages, true) === false) {
            throw new \Exception("Page '$cliPage' is not part of the website");
        }

        if (is_file($root . '/' . $cliPage . '.php')) {
            $page = $cliPage . '.php';
        } elseif (is_file($root . '/' . $cliPage . '.md')) {
            $page = $cliPage . '.md';
        } else {
            throw new \Exception("Page '$cliPage' is not part of the website");
        }
    }
}

if ($isVerbose) {
    $cli->whisper("Extracting text from '$page'");
}

if ($isLayout) {
    $path = null;
    $isMarkdown = false;
    $currentUrl = 'layout';
} else {
    $path = $root . '/' . $page;
    $isMarkdown = (substr($path, -3) === '.md');

    $currentUrl = substr($page, 0, -3);
    if ($isMarkdown === false) {
        $currentUrl = substr($currentUrl, 0, -1);
    }
}

$domain = $currentUrl;
if ($cli->arguments->defined('domain') !== false) {
    $domain = $cli->arguments->get('domain');
}

$currentTranslations = $l10n->loadTranslations($domain);
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

    $l10n->setDomain($domain);
    $l10n->translateHtml($html, '\App\Console\captureTranslations');
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
    $_SERVER['DOCUMENT_ROOT'] = $root;
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['HTTP_HOST'] = 'localhost';
    $_GET['page'] = $domain;
    $page['name'] = $domain;

    require_once $root . '/_backend/preload.php';

    // Do not start output buffering twice
    if (defined('HTML_I18N') === false) {
        define('HTML_I18N', 1);
    } elseif (HTML_I18N === 1) {
        return;
    }

    $l10n->setDomain($domain);

    ob_start(function ($input) use ($l10n) {
        $l10n->translateHtml($input, '\App\Console\captureTranslations');
        return '';
    });

    include $path;

    if (ob_get_level()) {
        ob_end_flush();
    }

    // Add page title to translations
    if (isset($page['title'])) {
        captureTranslations($page['title'], $domain, $page['title']);
    }
}
/**
 * translateLayout
 * Extracts translations from shared templates in their expected context.
 *
 * @return void
 */
function translateLayout()
{
    global $root, $l10n, $page, $template, $sitewide;

    chdir($root);

    $_SERVER['DOCUMENT_ROOT'] = $root;
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['HTTP_HOST'] = 'localhost';
    $_SERVER['HTTP_USER_AGENT'] = 'MSIE 10.0';

    $_GET['page'] = 'layout';

    require_once $root . '/_backend/preload.php';

    $page = array(
        'name' => 'layout',
        'path' => '/',
        'styles' => array(),
        'scripts' => array(),
        'script-plugins' => array(),
    );

    // Avoid requiring JavaScript manifest entries during extraction.
    $scriptless = true;

    $l10n->setDomain('layout');

    if (defined('HTML_I18N') === false) {
        define('HTML_I18N', 1);
    }

    $initialBufferLevel = ob_get_level();

    ob_start(function ($input) use ($l10n) {
        $l10n->translateHtml($input, '\App\Console\captureTranslations');
        return '';
    });

    include $template['header'];
    include $template['alert'];
    include $template['footer'];

    while (ob_get_level() > $initialBufferLevel) {
        ob_end_flush();
    }
}

if ($isLayout) {
    translateLayout();
} elseif ($isMarkdown) {
    translateMarkdown($path, $domain);
} else {
    translatePHP($path, $domain);
}

// Preprocess translations to remove newlines in the keys
$processedTranslations = [];
foreach ($currentTranslations as $key => $value) {
    // Remove newlines from the key completely and reduce multiple spaces to a single space
    $processedKey = str_replace(["\r\n", "\n"], ' ', $key);
    $processedKey = preg_replace('/\s+/', ' ', $processedKey);
    $processedTranslations[$processedKey] = $value;
}

echo json_encode(
    $processedTranslations,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
) . "\n";
