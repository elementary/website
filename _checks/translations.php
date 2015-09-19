<?php

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
    // Validate
    if ( isJson($filename) ) {
        $result['valid_files'][] = $shortname;
    } else {
        $result['invalid_files'][] = $shortname;
    }
}

var_dump($result);
// echo json_encode($result);

if ( !empty($result['invalid_files']) ) {
    // That's an error
    exit(1);
}
