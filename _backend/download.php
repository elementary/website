<?php

// provides $timecode, $download_link, $download_link_x86, $download_link_arm

date_default_timezone_set('UTC');
$timecode = base64_encode(time());
$download_link = 'https://dl.elementaryos.org/'.$timecode.'/';
$download_link_x86 = $download_link.'x86-64/';
$download_link_arm = $download_link.'arm64/';
