<?php

/**
 * _backend/Console/Translation.php
 * Command line operations for translation files
 */

namespace App\Console;

require_once __DIR__ . '/../bootstrap.php';

use \App\Lib\L10n;
use \League\CLImate\CLImate;

$cli = new CLImate();
$l10n = new L10n('en');

$root = realpath(__DIR__ . '/../..');

$cli->arguments->add([
    'language' => [
        'prefix'       => 'l',
        'longPrefix'   => 'language',
        'description'  => 'Language to extract',
    ],
    'page' => [
        'prefix'      => 'p',
        'longPrefix'  => 'page',
        'description' => 'Page to extract',
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

$languages = L10n::languages();
if ($cli->arguments->defined('language') !== false) {
    $cliLanguage = $cli->arguments->get('language');

    if (in_array($cliLanguage, $languages) === false) {
        throw new \Exception("Language '$cliLanguage' is not part of the website");
    }

    $languages = array($cliLanguage);
}

if ($isVerbose) {
    $count = count($languages);
    $cli->whisper("Running for $count languages");
}

$pages = array_map(function ($path) use ($root) {
    $rootPath = substr(realpath($path), strlen(realpath($root)) + 1);

    $isMarkdown = (substr($path, -3) === '.md');
    $url = substr($rootPath, 0, -3);
    if ($isMarkdown === false) {
        $url = substr($url, 0, -1);
    }

    return $url;
}, L10n::pages());
if ($cli->arguments->defined('page') !== false) {
    $cliPage = $cli->arguments->get('page');

    if (in_array($cliPage, $pages) === false) {
        throw new \Exception("Page '$cliPage' is not part of the website");
    }

    $pages = array($cliPage);
}

if ($isVerbose) {
    $count = count($pages);
    $cli->whisper("Running for $count pages");
}

$progress = $cli->progress(count($languages) * count($pages));
foreach ($pages as $page) {
    $path = $root . '/' . $page;

    if ($isVerbose) {
        $cli->whisper("Extacting text for '$page'");
    }

    try {
        $extractScript = __DIR__ . '/Extract.php';
        $translations = `php $extractScript --page $page`;
        $strings = json_decode($translations);
    } catch (\Expcetion $e) {
        $cli->error("Unable to extract text for '$page'");
        continue;
    }

    foreach ($languages as $language) {
        $languagePath = L10n::languageDirectory($language) . '/' . $page . '.json';

        $newTranslations = array();

        if (file_exists($languagePath)) {
            $currentData = file_get_contents($languagePath);
            $currentTranslations = json_decode($currentData, true);
        } else {
            $currentTranslations = array();
        }

        foreach ($strings as $string) {
            $newTranslations[$string] = "";

            if (isset($currentTranslations[$string]) !== false) {
                $newTranslations[$string] = $currentTranslations[$string];
            }

            // DEPRECATED: checks if the translation source exists without being
            // encoded correctly. If you are reading this, it can be removed.
            $unencodedSourceString = html_entity_decode($string);
            if (isset($currentTranslations[$unencodedSourceString])) {
                $newTranslations[$string] = $currentTranslations[$unencodedSourceString];
                continue;
            }
        }

        if (count($newTranslations) > 0) {
            $newData = json_encode($newTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($languagePath, $newData . PHP_EOL);
        } elseif (file_exists($languagePath)) {
            unlink($languagePath);
        }

        $progress->advance();
    }
}
