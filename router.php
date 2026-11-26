<?php

/* router.php
 *
 * Use `php -S localhost:8000 router.php` to include simple URL rewriting for
 * your local PHP development server. NOT intended for production whatsoever.
 */

if (getenv('PHPENV') === 'production') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Script only accessible in development environment.';
    exit;
}

// Allow query parameters to be appended to the request
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Strip every leading language code in one pass, as nginx does. L10n reads
// the language from REQUEST_URI and redirects bad or nested codes.
require_once __DIR__.'/_backend/vendor/autoload.php';
$parsed = \App\Lib\LanguageRoute::parse($requestUri);
if (!empty($parsed['codes'])) {
    $requestUri = $parsed['rest'];
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
