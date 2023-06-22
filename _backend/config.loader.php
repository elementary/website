<?php

// Defaults from repository, contains actual non-secure values only.
$defaultConfig = (require __DIR__.'/config.example.php');

$secretConfig = array();

// Secure config set through ansible
if (is_readable(__DIR__.'/config.php')) {
    $secretConfig = (require __DIR__.'/config.php');

// Fallback to master if on testing branch
} elseif (is_readable(__DIR__.'/../../master/_backend/config.php')) {
    $secretConfig = (require __DIR__.'/../../master/_backend/config.php');
}

// Merge configuration
$config = array_merge($defaultConfig, $secretConfig);
