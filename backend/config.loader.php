<?php

if ( substr($_SERVER['REQUEST_URI'], 0, 8) == '/branch/' ) {
    // for Branches
    require_once __DIR__.'/../../../backend/config.php';
} else if ( is_readable(__DIR__.'/config.php') ) {
    // for Configured MASTER
    require_once __DIR__.'/config.php';
} else {
    // for un-configured Lobal
    require_once __DIR__.'/config.example.php';
}
