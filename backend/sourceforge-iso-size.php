<?php
/**
 * Get last ISO size from SourceForge.
 */

$channel = 'stable';

if (php_sapi_name() != 'cli') {
    die('This script can only be run from command line');
}

$xml = file_get_contents('http://sourceforge.net/projects/elementaryos/rss?path=/'.$channel);

$doc = new DOMDocument();
$doc->loadXML($xml);

$latestItem = $doc->getElementsByTagName('item')[0];
$media = $latestItem->getElementsByTagNameNS('http://video.search.yahoo.com/mrss/', 'content')[0];
$filesize = (int) $media->getAttribute('filesize');

file_put_contents(__DIR__.'/iso-size.txt', $filesize);