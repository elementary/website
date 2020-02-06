<?php

// Defaults from repository, contains actual non-secure values only. 
require __DIR__.'/config.example.php';
$defaultConfig = $config;
    
// Secure config set through ansible
if ( is_readable(__DIR__.'/config.php') ) {
    require __DIR__.'/config.php';

// Fallback to master if on testing branch
} else if ( is_readable(__DIR__.'/../../master/_backend/config.php') ) {
    require __DIR__.'/../../master/_backend/config.php';
}

// Merge configuration
$config = array_merge($defaultConfig, $config);
