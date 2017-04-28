<?php

if ( is_readable(__DIR__.'/config.php') ) {
    // for configured local
    require __DIR__.'/config.php';
} else if ( is_readable(__DIR__.'/../../master/_backend/config.php') ) {
    // for configured hosted
    require __DIR__.'/../../master/_backend/config.php';
} else {
    // for un-configured local
    require __DIR__.'/config.example.php';
}
