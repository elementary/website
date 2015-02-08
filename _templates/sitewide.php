<?php

// Honor the IE do-not-track-header,
// even though it's set automatically.
$respectIE = true;
// Set the DNT variables.
include __DIR__.'/../backend/here-miss.php';

date_default_timezone_set('UTC');

$sitewide['title'] = 'elementary';
$sitewide['author'] = 'elementary LLC';
$sitewide['description'] = 'A fast and open replacement for Windows and OS X. Pay what you want or download for free.';
$sitewide['theme-color'] = '#3892E0';

$template['header'] = __DIR__.'/header.php';
$template['footer'] = __DIR__.'/footer.php';