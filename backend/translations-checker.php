<?php

if (!function_exists('tidy_parse_string')) {
  throw new Exception('translations-checker needs the tidy PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('translations-checker needs the JSON PHP extension.');
}

function isJson($filename) {
    $string = file_get_contents($filename);
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function translationFilename($filename) {
    $filearr = explode('lang', $filename);
    end($filearr);
    return current($filearr);
}

function globRecursive($Pattern, $Flags = 0) {
    // Search in the Current Directory
    $Return = glob($Pattern, $Flags);
    // FOREACHDIRECTORY
    // Search in ALL sub-directories.
    foreach (glob(dirname($Pattern).'/*', GLOB_ONLYDIR | GLOB_NOSORT) as $Directory) {
        // This is a recursive function.
        // Usually, THIS IS VERY BAD.
        // For searching recursively however,
        // it does make some sense.
        if ( strpos($Directory, '/_') === false ) {
            $Return = array_merge($Return, globRecursive($Directory.'/'.basename($Pattern), $Flags));
        }
    } // FOREACHDIRECTORY
    return $Return;
}

$translation_files = globRecursive(__DIR__.'/../lang/*/*.json');
$result['invalid_files'] = array();
$result['valid_files']   = array();

foreach ( $translation_files as $filename ) {
    $shortname = translationFilename($filename);

    // Validate JSON
    if ( ! isJson($filename) ) {
        $result['invalid_files'][] = $shortname;
        continue;
    }

    // Validate HTML encoding
    $values = array_values(json_decode(file_get_contents($filename), TRUE));
    $error = false;
    foreach ( $values as $value ) {
        $tidy = tidy_parse_string("<body>".$value."</body>");
        $tidy->diagnose();
        $errors = tidy_error_count($tidy);

        if ($errors > 0) {
            echo $tidy->errorBuffer;

            $error = true;
        }
    }

    if ($error) {
        $result['invalid_files'][] = $shortname;
    } else {
        $result['valid_files'][] = $shortname;
    }
}

$invalidCount = count($result['invalid_files']);

echo count($translation_files)." translation files\n";

echo count($result['valid_files'])." valid translation files\n";

if ($invalidCount) {
    var_dump($result['invalid_files']);
}

echo $invalidCount." invalid translation files\n";
