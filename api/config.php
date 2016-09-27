<?php

/**
 * api/config.php
 * Shows sitewide configuration for use in client side javascript
 */

require_once __DIR__.'/../backend/classify.current.php';
require_once __DIR__.'/../backend/config.loader.php';
require_once __DIR__.'/../backend/here-miss.php';

$output = array(
    'release' => array(
        'title' => $config['release_title'],
        'version' => $config['release_version']
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

echo json_encode($output, JSON_PRETTY_PRINT);
