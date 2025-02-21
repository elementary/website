<?php // provides $timecode, $download_link

$timecode = base64_encode(time());
$download_link = 'https://weathered-wildflower-cec3.eustasy.workers.dev/'.$timecode.'/';
