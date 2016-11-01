<?php

if ( is_readable(__DIR__.'/config.php') ) {
    // for configured local
    require_once __DIR__.'/config.php';
} else if ( is_readable(__DIR__.'/../../master/_backend/config.php') ) {
    // for configured hosted
    require_once __DIR__.'/../../master/_backend/config.php';
} else {
    // for un-configured local
    require_once __DIR__.'/config.example.php';
}
