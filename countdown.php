<?php


include __DIR__.'/_templates/sitewide.php';
setcookie('countdown_video', false, 1, '/', '', 0, 1);
header("Location: " . $sitewide['root']);
