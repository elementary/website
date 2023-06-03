<?php

require_once 'classify.functions.php';
require_once 'classify.get_ip.php';

$region = getDownloadRegion($ip);
if (is_array($region)) {
    $hash = getIPHash($ip);
    $region = $region[$hash];
}

date_default_timezone_set('UTC');
$timecode = base64_encode(time());
$download_link = '//'.$region.'.dl.elementary.io/download/'.$timecode.'/';
