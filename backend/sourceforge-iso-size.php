<?php
/**
 * Get last ISO size from SourceForge.
 */

require_once __DIR__.'/config.loader.php';

if (php_sapi_name() != 'cli') {
    die('This script can only be run from command line');
}

$downloadUrl = $config['sourceforge_iso_amd64'];
//http://sourceforge.net/projects/elementaryos/files/stable/elementaryos-freya-i386.20150411.iso/download

$regex = '#^http://sourceforge\.net/projects/([a-zA-Z0-9\._-]+)/files/([a-zA-Z0-9/\._-]+)/download$#';
if (!preg_match($regex, $downloadUrl, $matches)) {
	die('Invalid download URL in config');
}

$project = $matches[1];
$filepath = $matches[2];
$sepIndex = strrpos($filepath, '/');
$channel = substr($filepath, 0, $sepIndex);
$filename = substr($filepath, $sepIndex + 1);

$xml = file_get_contents('http://sourceforge.net/projects/'.$project.'/rss?path=/'.$channel);

$doc = new DOMDocument();
$doc->loadXML($xml);

$items = $doc->getElementsByTagName('item');

$isoItem = null;
foreach ($items as $it) {
	$titleNode = $it->getElementsByTagName('title')->item(0);
	if (empty($titleNode)) {
		continue;
	}
	if ($titleNode->nodeValue == '/'.$filepath) {
		$isoItem = $it;
		break;
	}
}
if (empty($isoItem)) {
	die('Cannot find ISO file');
}

$media = $isoItem->getElementsByTagNameNS('http://video.search.yahoo.com/mrss/', 'content')->item(0);
if (empty($media)) {
	die('Cannot find ISO file size');
}
$filesize = (int) $media->getAttribute('filesize');

file_put_contents(__DIR__.'/iso-size.txt', $filesize);