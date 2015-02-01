<?php

/* router.php
 *
 * Use `php -S localhost:8000 router.php` to include simple URL rewriting for
 * your local PHP development server. NOT intended for production whatsoever.
 */

// Allow query parameters to be appended to the request
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($requestUri == '/') {
    return false; // Serve the homepage as-is
} elseif (preg_match('/\./', $requestUri)) { // has period in filename
    $target = '.'.$requestUri;
    if (!file_exists($target)) {
        include '404.php';
    } else {
        return false; // Serve the requested resource as-is
    }
} else {
    $target = '.'.$requestUri.'.php'; // Rewrite extension-less files as php files
    if (file_exists($target)) {
        include $target;
    } else {
        include '404.php';
    }
}
