<?php
if (php_sapi_name() !== 'cli') {
	die('This script must be run from command line.');
}

function log_info($msg) { // Basic logger
    echo $msg . PHP_EOL;
}

$input = array();
$output = null;
for ($i = 1; $i < count($argv); $i++) {
	$word = $argv[$i];
	if ($word == '-o') {
		$i++;
		$output = $argv[$i];
	} else {
		$input[] = $word;
	}
}

if (count($input) == 0 or empty($output)) {
	die('Usage: '.$argv[0].' -o output_resource [input_resources ...]');
}

$input[] = $output;

$langRootDir = __DIR__.'/../lang';

$source = array();
foreach ($input as $resource) {
	$langInput = $langRootDir.'/en/'.$resource.'.json';
	if (is_file($langInput)) {
		$json = file_get_contents($langInput);
		if ($json !== false) {
			$source[$resource] = json_decode($json, true);
		}
	} else {
		log_info('No file found for resource '.$resource.' in source language en');
	}
}

$langDirHandle = opendir($langRootDir);
while (($lang = readdir($langDirHandle)) !== false) {
	if ($lang == '.' or $lang == '..') {
		continue;
	}
	if ($lang == 'en') {
		continue; // Ignore source lang
	}
	log_info('Processing language: '.$lang);

	$langDir = $langRootDir.'/'.$lang;
	$langOutput = $langDir.'/'.$output.'.json';

	$translations = array();
	foreach ($input as $resource) {
		$langInput = $langDir.'/'.$resource.'.json';
		if (is_file($langInput)) {
			$json = file_get_contents($langInput);
			if ($json !== false) {
				// Remove untranslated items
				$resourceTranslations = json_decode($json, true);
				foreach ($resourceTranslations as $string => $translated) {
					if (!empty($source[$resource][$string]) && $translated == $source[$resource][$string]) {
						unset($resourceTranslations[$string]);
					}
					if (empty($translated)) {
						unset($resourceTranslations[$string]);
					}
					if (html_entity_decode($string) == $translated) {
						unset($resourceTranslations[$string]);
					}
				}
				$translations = array_merge($translations, $resourceTranslations);
			}
		} else {
			log_info('No file found for resource '.$resource.' in language '.$lang);
		}
	}

	if (count($translations) == 0) {
		if (is_file($langOutput)) {
			unlink($langOutput);
		}
	} else {
		$json = json_encode($translations, JSON_PRETTY_PRINT);
		file_put_contents($langOutput, $json);
	}
}
closedir($langDirHandle);