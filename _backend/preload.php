<?php

require __DIR__ . '/bootstrap.php';
require_once __DIR__.'/log-echo.php';

date_default_timezone_set('UTC');

$sitewide['title'] = 'elementary';
$sitewide['author'] = 'elementary, Inc.';
$sitewide['description'] = 'The thoughtful, capable, and ethical replacement for Windows and macOS';
$sitewide['image'] = 'https://elementary.io/images/preview.png';
$sitewide['theme-color'] = '#3689e6';

// Autodetect website root path
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$websiteRoot = dirname(__DIR__);
if (!empty($_SERVER['REQUEST_URI'])) {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
} else {
    $requestUri = '';
}
$sitewide['root'] = '';
$sitewide['path'] = $requestUri;
if ($serverRoot == $websiteRoot) {
    $sitewide['root'] = '/';
} elseif (strpos($websiteRoot, $serverRoot) === 0) {
    $sitewide['root'] = substr($websiteRoot, strlen($serverRoot)).'/';
} else {
    $websiteArray = explode('/', $websiteRoot);
    $reqArray = array_filter(explode('/', $requestUri));
    foreach ($websiteArray as $websiteOffset => $websiteDir) {
        foreach ($reqArray as $reqOffset => $reqDir) {
            if ($websiteDir != $reqDir) {
                continue;
            }

            $max = min(count($websiteArray) - $websiteOffset, count($reqArray) - $reqOffset);
            for ($i = 0; $i < $max; $i++) {
                if ($websiteArray[$websiteOffset + $i] != $reqArray[$reqOffset + $i]) {
                    break 2; // Doesn't match
                }
            }

          // Matches
            $rootArray = array_slice($reqArray, 0, $reqOffset - $max + 1);
            $sitewide['root'] = '/'.implode('/', $rootArray).'/';
            break 2;
        }
    }
}

$template['header'] = __DIR__.'/../_templates/header.php';
$template['alert']  = __DIR__.'/../_templates/alert.php';
$template['legacy'] = __DIR__.'/../_templates/legacy.php';
$template['footer'] = __DIR__.'/../_templates/footer.php';
