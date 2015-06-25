<?php

function isJson($filename) {
    $string = file_get_contents($filename);
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function translationFilename($filename) {
    $filearr = explode('/', $filename);
    end($filearr);
    return prev($filearr).'/'.next($filearr);
}

$translation_files = glob(__DIR__.'/../lang/*/*.json');
$valid_files = array();
$invalid_files = array();

foreach ( $translation_files as $filename ) {
    $shortname = translationFilename($filename);
    // Validate
    if ( isJson($filename) ) {
        $valid_files[] = $shortname;
    } else {
        $invalid_files[] = $shortname;
    }
}

$result = array(
    'invalid_files' => $invalid_files,
    'valid_files'   => $valid_files,
);

var_dump($result);
// echo json_encode($result);
