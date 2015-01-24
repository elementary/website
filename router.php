<?php

/* router.php
 *
 * Use `php -S localhost:8000 router.php` to include simple URL rewriting for 
 * your local PHP development server. NOT intended for production whatsoever.
 */

if ($_SERVER["REQUEST_URI"] == '/') {
	return false; // serve the homepage as-is.
} elseif (preg_match('/\./', $_SERVER["REQUEST_URI"])) { // has period in filename
    return false; // serve the requested resource as-is.
} else { 
    include '.'.$_SERVER["REQUEST_URI"].'.php'; // Rewrite extension-less files as php files
}

?>

