<?php

// Honor the IE do-not-track-header,
// even though it's set automatically.
$respectIE = true;
// Set the DNT variables.
include __DIR__.'/../backend/here-miss.php';

$sitewide['title'] = 'elementary';
$sitewide['author'] = 'elementary LLC';
$sitewide['description'] = 'A fast and open replacement for Windows and OS X. Pay what you want or download for free.';
$sitewide['theme-color'] = '#3892E0';

// Autodetect website root path
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
$websiteRoot = dirname(__DIR__);
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$sitewide['root'] = '';
if ($serverRoot == $websiteRoot) {
	$sitewide['root'] = '/';
} elseif (strpos($websiteRoot, $serverRoot) === 0) {
	$sitewide['root'] = substr($websiteRoot, strlen($serverRoot));
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