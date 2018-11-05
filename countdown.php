<?php

require_once __DIR__.'/_backend/preload.php';
require_once __DIR__.'/_backend/event.php';

event_cookie_set('juno 5.0 release', 0);

header("Location: " . $sitewide['root']);
