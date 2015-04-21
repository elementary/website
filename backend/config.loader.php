<?php

if ( substr($_SERVER['REQUEST_URI'], 0, 8) == '/branch/' ) {
    // for Branches
    require_once(__DIR__.'/../../../backend/config.php');
} else {
    // for MASTER
    include(__DIR__.'/config.php');
}
