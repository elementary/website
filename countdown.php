<?php


require_once __DIR__.'/_backend/preload.php';
setcookie('countdown_video', false, 1, '/', '', 0, 1);
header("Location: " . $sitewide['root']);
