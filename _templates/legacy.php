<?php

/**
 * _templates/legacy.php
 * Holds all legacy browser messages warnings
 */

$l10n->setDomain('layout');

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$is_old_IE = preg_match('/MSIE [2\-10]/i', $user_agent);

if ($is_old_IE) { ?>
    <div id="legacy-warning">
        <h1>The elementary OS website is built on modern web technologies your browser doesn&rsquo;t support.</h1>
        <p>This version of Internet Explorer is out of date and may contain bugs or security vulnerabilities. Please <a href="http://browsehappy.com/">upgrade</a> to edge or an alternative web browser.</p>
        <div id="legacy-warning-buttons">
            <a href="#" onClick="document.getElementById('legacy-warning').style.display = 'none';">Dismiss</a>
            <a class="suggested-action" href="http://browsehappy.com/" target="_blank" rel="noopener">Learn More</a>
        </div>
    </div>

    <?php
}
