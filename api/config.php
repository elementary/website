<?php

/**
 * api/config.json.php
 * Live-generated JSON configuration for use in client side javascript
 */

require_once __DIR__.'/../_backend/classify.current.php';
require_once __DIR__.'/../_backend/config.loader.php';
require_once __DIR__.'/../_backend/here-miss.php';

$output = array(
    'release' => array(
        'title' => $config['release_title'],
        'version' => $config['release_version'],
        'filename' => $config['release_filename'],
        'magnet' => $config['release_magnet'],
        'cdn' => $config['release_cdn']
    ),

    'keys' => array(
        'sentry' => $config['sentry_pub'],
        'stripe' => $config['stripe_pk']
    ),

    'user' => array(
        'region' => $region,
        'trackme' => $trackme
    )
);

header('Content-type:application/json;charset=utf-8');
echo json_encode($output, JSON_PRETTY_PRINT);
