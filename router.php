<?php

/* router.php
 *
 * Use `php -S localhost:8000 router.php` to include simple URL rewriting for
 * your local PHP development server. NOT intended for production whatsoever.
 */

$target = null;

if ($_SERVER["REQUEST_URI"] == '/') {
    return false; // Serve the homepage as-is
} elseif (preg_match('/\./', $_SERVER["REQUEST_URI"])) { // has period in filename
    $target = '.'.$_SERVER["REQUEST_URI"];
    if (!file_exists($target)) {
        include '404.php';
    } else {
        return false; // Serve the requested resource as-is
    }
} else {
    $target = '.'.$_SERVER["REQUEST_URI"].'.php'; // Rewrite extension-less files as php files
    if (file_exists($target)) {
        include $target;
    } else {
        include '404.php';
    }
}
