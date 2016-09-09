<?php

/**
 * api/config.php
 * Shows sitewide configuration for use in client side javascript
 */

require_once __DIR__.'/../backend/here-miss.php';

$output = array(
    'trackme' => $trackme
);

echo json_encode($output, JSON_PRETTY_PRINT);
