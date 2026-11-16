<?php

// provides $timecode, $download_link

date_default_timezone_set('UTC');
$timecode = base64_encode(time());
$download_link = 'https://dl.elementaryos.org/'.$timecode.'/';
