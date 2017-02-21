<?php
/**
 * /hook/store/index.php
 * Verifies hook variables and passes data to individual hook files
 */

require_once __DIR__.'/../../_backend/lib/autoload.php';
require_once __DIR__.'/../../_backend/config.loader.php';

\Stripe\Stripe::setApiKey($config['stripe_sk']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Only POST is supported';
    die();
}

try {
    $res = json_decode(file_get_contents('php://input'), TRUE);

    if ($res == null) throw new Exception('Unable to decode');
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Unable to decode data';
    die();
}

if (
    (!isset($res['store']) ||
     !isset($res['type']) ||
     !isset($res['data']['shipment']['service']) ||
     !isset($res['data']['order']['external_id']) ||
     $res['store'] !== 148324)
) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Incomplete data';
    die();
}

// Check the stripe checkout to make sure we have a _real_ call
try {
    $ch = \Stripe\Charge::retrieve($res['data']['order']['external_id']);
} catch (Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Inaccurate data';
    die();
}

// And we finally fire off the hook file we need
if ($res['type'] === 'package_shipped') {
    require_once __DIR__.'/package_shipped.php';
} else {
    header('HTTP/1.0 415 Unsupported Media Type');
    echo 'Hook type not supported';
    die();
}
