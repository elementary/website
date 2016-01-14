<?php

$Authenticatron = __DIR__.'/authenticatron.php';
$Secret         = __DIR__.'/authenticatron.secret.php';
require_once $Authenticatron;
if ( is_readable($Secret) ) {
    // Load the site-unique secret.
    require_once $Secret;
} else {
    // Use a not-so-secret as a fallback.
    $Secret = 'BULWYTXXPJVHETRD';
}
