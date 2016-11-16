<?php

require_once __DIR__.'/../_backend/preload.php';
require_once __DIR__.'/../_backend/config.loader.php';

$l10n->set_domain('layout');

if ( getenv('PHPENV') !== 'production' ) {
?>
        <div class="row alert warning">
            <div class="column alert">
                <div class="icon">
                    <i class="warning fa fa-warning"></i>
                </div>
                <div class="icon-text">
                    <h3>This is a development site.</h3>
                    <p>You are viewing a development version of our site. Some pages here may not work or act as you expect. If you got here by accident please go to <a href="http://elementary.io">elementary.io</a>, our actual website address.</p>
                </div>
            </div>
        </div>
<?php
}

if (getenv('PHPENV') !== 'production' && (
    !isset($config['printful_key']) ||
    !isset($config['google_map_key']) ||
    $config['printful_key'] === 'printful_key' ||
    $config['google_map_key'] === 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
)) {
?>
        <div class="row alert warning">
            <div class="column alert">
                <div class="icon">
                    <i class="warning fa fa-warning"></i>
                </div>
                <div class="icon-text">
                    <h3>You are missing API keys</h3>
                    <p>You are viewing an incorrectly configured version of our site. This will lead to false positives and incorrect errors with third party services. Please set the configuration keys for an optimal experience.</p>
                </div>
            </div>
        </div>
<?php
}

$l10n->set_domain($page['name']);
