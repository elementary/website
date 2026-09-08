<?php

/**
 * api/config.php
 * Live-generated JSON configuration for use in client side javascript
 */

require_once __DIR__.'/../_backend/config.loader.php';

$output = array(
    'release' => array(
        'title' => $config['release_title'],
        'version' => $config['release_version']
    ),

    'previous' => array(
        'title' => $config['previous_title'],
        'version' => $config['previous_version']
    ),

    'keys' => array(
        'stripe' => $config['stripe_pk']
    )
);

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
echo json_encode($output, JSON_PRETTY_PRINT);
