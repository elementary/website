<?php

/**
 * _templates/legacy.php
 * Holds all legacy browser messages warnings
 */

$l10n->set_domain('layout');

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

$is_HTTP = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off');
$is_old_IE = preg_match('/MSIE [2-10]/i', $user_agent);

if (getenv('PHPENV') === 'production' && $is_HTTP) {
?>

    <div id="legacy-warning">
        <h1>The elementary OS website is not using secure connections to your browser.</h1>
        <p>Your browser is not taking advantage of HTTPS connections. Some parts of this site will not work properly. Please <a href="http://browsehappy.com/">upgrade</a> to an alternative web browser.</p>
        <div id="legacy-warning-buttons">
            <a href="#" onClick="document.getElementById('legacy-warning').style.display = 'none';">Dismiss</a>
            <a href="https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">Load HTTPS</a>
            <a class="suggested-action" href="http://browsehappy.com/" target="_blank">Upgrade</a>
        </div>
    </div>

<?php } else if ($is_old_IE) { ?>

    <div id="legacy-warning">
        <h1>The elementary OS website is built on modern web technologies your browser doesn&rsquo;t support.</h1>
        <p>This version of Internet Explorer is out of date and may contain bugs or security vulnerabilities. Please <a href="http://browsehappy.com/">upgrade</a> to edge or an alternative web browser.</p>
        <div id="legacy-warning-buttons">
            <a href="#" onClick="document.getElementById('legacy-warning').style.display = 'none';">Dismiss</a>
            <a class="suggested-action" href="http://browsehappy.com/" target="_blank">Learn More</a>
        </div>
    </div>

<?php
}
