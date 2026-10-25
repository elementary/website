<?php

/**
 * _backend/Console/Translation.php
 * Command line operations for translation files
 */

namespace App\Console;

use \App\Lib\L10n;
use \League\CLImate\CLImate;

require_once __DIR__ . '/../bootstrap.php';

$cli = new CLImate();
$root = realpath(__DIR__ . '/../..');

$cli->arguments->add([
    'language' => [
        'prefix'      => 'l',
        'longPrefix'  => 'language',
        'description' => 'Language to extract',
    ],
    'page' => [
        'prefix'      => 'p',
        'longPrefix'  => 'page',
        'description' => 'Page to extract written like docs/getting-started',
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
    ],
]);

$cli->arguments->parse();

if ($cli->arguments->defined('help')) {
    $cli->usage();
    die();
}

$isVerbose = $cli->arguments->defined('verbose');

$languages = L10n::languageFolders();

if ($cli->arguments->defined('language') !== false) {
    $cliLanguage = $cli->arguments->get('language');

    if (in_array($cliLanguage, $languages, true) === false) {
        throw new \Exception("Language '$cliLanguage' is not part of the website");
    }

    $languages = [$cliLanguage];
}

if ($isVerbose) {
    $count = count($languages);
    $cli->whisper("Running for $count languages");
}

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

$pages = array_values(array_unique($pages));

if ($cli->arguments->defined('page') !== false) {
    $cliPage = $cli->arguments->get('page');
    $cliPage = preg_replace('/\.(php|md)$/', '', $cliPage);

    if (strpos($cliPage, '_templates/') === 0) {
        $cliPage = 'layout';
    }

    if (in_array($cliPage, $pages, true) === false) {
        throw new \Exception("Page '$cliPage' is not part of the website");
    }

    $pages = [$cliPage];
}

if ($isVerbose) {
    $count = count($pages);
    $cli->whisper("Running for $count pages");
}

$progress = $cli->progress(count($languages) * count($pages));

$extractScript = __DIR__ . '/Extract.php';
$phpBinary = PHP_BINARY ?: 'php';

foreach ($pages as $page) {
    if ($isVerbose) {
        $cli->whisper("Extracting text for '$page'");
    }

    try {
        $translations = `"$phpBinary" "$extractScript" --page "$page"`;
        $strings = json_decode($translations);
    } catch (\Exception $e) {
        $cli->error("Unable to extract text for '$page'");
        continue;
    }

    if (is_object($strings) === false) {
        $cli->error("Unable to decode extracted translations for '$page'");
        continue;
    }

    foreach ($languages as $language) {
        $languagePath = L10n::languageDirectory($language) . '/' . $page . '.json';

        if (file_exists($languagePath)) {
            $currentData = file_get_contents($languagePath);
            $currentTranslations = json_decode($currentData, true);

            if (is_array($currentTranslations) === false) {
                $cli->error("Unable to decode existing translations in '$languagePath'");
                $progress->advance();
                continue;
            }
        } else {
            $currentTranslations = [];
        }

        $normalizedCurrentTranslations = [];
        foreach ($currentTranslations as $key => $value) {
            $normKey = preg_replace('/\s+/', ' ', str_replace(["\r\n", "\n"], ' ', $key));
            $normalizedCurrentTranslations[$normKey] = $value;
        }

        $newTranslations = [];

        foreach ($strings as $sourceKey => $originalValue) {
            if (isset($normalizedCurrentTranslations[$sourceKey])) {
                // Preserve existing translations.
                $newTranslations[$sourceKey] = $normalizedCurrentTranslations[$sourceKey];
            } elseif ($language === 'en') {
                // English uses the original source text.
                $newTranslations[$sourceKey] = $originalValue;
            } else {
                // New translations start empty.
                $newTranslations[$sourceKey] = '';
            }
        }

        $directory = dirname($languagePath);

        if (is_dir($directory) === false) {
            mkdir($directory, 0766, true);
        }

        if (count($newTranslations) > 0) {
            $newData = json_encode(
                $newTranslations,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );

            if ($newData === false) {
                $cli->error("Unable to encode translations for '$languagePath'");
                $progress->advance();
                continue;
            }

            file_put_contents($languagePath, $newData . "\n");
        } elseif (file_exists($languagePath)) {
            unlink($languagePath);
        }

        $progress->advance();
    }
}
