<?php

if (
    !empty($_SERVER['REQUEST_URI']) &&
    substr($_SERVER['REQUEST_URI'], 0, 8) == '/branch/'
) {
    // for Branches
    require_once __DIR__.'/../../../backend/config.php';
} else if ( is_readable(__DIR__.'/config.php') ) {
    // for Configured MASTER
    require_once __DIR__.'/config.php';
} else {
    // for un-configured Local
    require_once __DIR__.'/config.example.php';
}

if ( empty($config['release_filename']) ) {
    $config['release_filename'] = 'elementaryos-0.3.2-stable-amd64.20151209.iso';
}
