<?php

/**
 * _backend/bootstrap.php
 * Entry file for the whole website. Handles configuration loading.
 */

require_once __DIR__ . '/vendor/autoload.php';

// TODO: why are these not in composer?
require_once __DIR__ . '/../docs/_mdr/Parsedown.php';
require_once __DIR__ . '/../docs/_mdr/ParsedownExtra.php';

// TODO: move this to a static class
require __DIR__ . '/config.loader.php';
