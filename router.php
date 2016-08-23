<?php

/* router.php
 *
 * Use `php -S localhost:8000 router.php` to include simple URL rewriting for
 * your local PHP development server. NOT intended for production whatsoever.
 */

// Allow query parameters to be appended to the request
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (preg_match('#^/([a-z]{2}(?:_(?:[A-Z]{2}|[A-Z][a-z]+))?)(/.*)?$#', $requestUri, $matches)) {
    $_GET['lang'] = $matches[1];
    $requestUri = (!empty($matches[2])) ? $matches[2] : '/';
}

if ($requestUri == '/') {
    $page['name'] = 'index';
    include 'index.php';
} elseif (preg_match('/\./', $requestUri)) { // Has period in filename
    $target = '.'.$requestUri;
    if (!file_exists($target)) {
        header('HTTP/1.1 404 Not Found');
        include '404.php';
    } else {
        return false;
    }
} elseif (strpos($requestUri, '/docs/') === 0 || $requestUri == '/docs') {
    // For documentation (MDR)
    include __DIR__.'/docs/_mdr/index.php';
} elseif (substr($requestUri, -1) === '/') { // Ends with a slash
    $target = '.'.$requestUri.'index.php';
    if (file_exists($target)) {
        include $target;
    } else {
        header('HTTP/1.1 404 Not Found');
        include '404.php';
    }
} else {
    $target = '.'.$requestUri.'.php'; // Rewrite extension-less files as php files
    if (file_exists($target)) {
        include $target;
    } else {
        header('HTTP/1.1 404 Not Found');
        include '404.php';
    }
}
