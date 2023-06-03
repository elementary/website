<?php

/**
 * _tests/translations.php
 * Checks translation files for common HTML problems that would break the site.
 * Can be ran as `php translations.php` for checking all files or
 * ran with `php translations.php ../_lang/en/index.js` for individual files.
 */

echo "#####################################\n";
echo "Starting Translation Checking linting\n";
echo "#####################################\n";

if (!function_exists('json_decode')) {
    throw new Exception('translations-checker needs the JSON PHP extension.');
}

function isJson($filename)
{
    $string = file_get_contents($filename);
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function translationFilename($filename)
{
    $filearr = explode('_lang', $filename);
    end($filearr);
    return current($filearr);
}

function globRecursive($Pattern, $Flags = 0)
{
    // Search in the Current Directory
    $Return = glob($Pattern, $Flags);
    // FOREACHDIRECTORY
    // Search in ALL sub-directories.
    foreach (glob(dirname($Pattern).'/*', GLOB_ONLYDIR | GLOB_NOSORT) as $Directory) {
        // This is a recursive function.
        // Usually, THIS IS VERY BAD.
        // For searching recursively however,
        // it does make some sense.
        if (strpos($Directory, '/_') === false) {
            $Return = array_merge($Return, globRecursive($Directory.'/'.basename($Pattern), $Flags));
        }
    } // FOREACHDIRECTORY
    return $Return;
}

// Assume this script will be ran with php translations.php _lang/en/index.json
if (count($argv) > 1) {
    $translation_files = array();
    $paths = array_slice($argv, 1);

    foreach ($paths as $relPath) {
        $translation_files[] = __DIR__.'/'.$relPath;
    }
} else {
    $translation_files = globRecursive(__DIR__.'/../_lang/*/*.json');
}

$result['invalid_files'] = 0;
$result['valid_files'] = 0;
$result['errors'] = array();

foreach ($translation_files as $filename) {
    $shortname = translationFilename($filename);
    $error = false;

    // Validate JSON
    if (! isJson($filename)) {
        $result['invalid_files']++;
        $result['errors'][] = $shortname." => Invalid JSON";
        continue;
    }

    // Validate all HTML tags have an open tag and close tag in same string
    $values = array_values(json_decode(file_get_contents($filename), true));

    foreach ($values as $i => $value) {
        $line_number = $i + 2; // Line number in the JSON file

        preg_match_all("/\<([a-z0-9]+)\s?[^\<]*?(?<!\/)\s*\>/i", $value, $open_tags);
        preg_match_all("/\<\/([a-z0-9]+)\s?[^\<]*?(?<!\/)\s*\>/i", $value, $close_tags);

        foreach ($open_tags[1] as $oi => $open_tag) {
            foreach ($close_tags[1] as $ci => $close_tag) {
                if (strtolower($open_tag) === strtolower($close_tag)) {
                    unset($close_tags[1][$ci]);
                    unset($open_tags[1][$oi]);
                    break;
                }
            }
        }

        foreach ($open_tags[1] as $open_tag) {
            $error = true;
            $result['errors'][] = $shortname.":$line_number => Unclosed \"".$open_tag."\" tag";
        }
        foreach ($close_tags[1] as $close_tag) {
            $error = true;
            $result['errors'][] = $shortname.":$line_number => Unopened \"".$close_tag."\" tag";
        }

        // Check for an even amount of quotes, but ignore sr language do to weird scheme
        if (substr($shortname, 1, 2) != 'sr' && substr_count($value, '"') % 2 != 0) {
            $error = true;
            $result['errors'][] = $shortname.":$line_number => Uneven amount of \" quotes";
        }
    }

    if ($error) {
        $result['invalid_files']++;
    } else {
        $result['valid_files']++;
    }
}

foreach ($result['errors'] as $error) {
    echo $error."\n";
}

echo "Checked ".count($translation_files)." translation files\n";
echo $result['valid_files']." valid translation files\n";
echo $result['invalid_files']." invalid translation files\n";

echo "##############################\n";
echo "Translation Checking complete!\n";
echo "##############################\n";

if ($result['valid_files'] === count($translation_files)) {
    exit(0);
} else {
    exit(1);
}
