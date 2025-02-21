<?php // provides getCurrentLocation()

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__.'/log-echo.php';
use GeoIp2\Database\Reader;

function getCurrentLocation($hostname, $debug = false)
{

    try {
        if ($debug) {
            echo $hostname."\n";
        }
        if (!class_exists('GeoIp2\Database\Reader')) {
            throw new \Exception('Class GeoIp2\Database\Reader not found');
        }
        $reader = new Reader(__DIR__.'/GeoLite2-City.mmdb');
        $record = $reader->city($hostname);

        $city        = $record->city->name; // 'Minneapolis'
        $state       = $record->mostSpecificSubdivision->name ; // 'Minnesota'
        $stateCode   = $record->mostSpecificSubdivision->isoCode; // 'MN'
        $country     = $record->country->name; // 'United States'
        $countryCode = $record->country->isoCode; // 'US'
        $postcode    = $record->postal->code; // '55455'
        $continent   = $record->continent->code;
    } catch (\Exception $e) {
        if ($debug) {
            echo $e->getMessage();
        } else {
            error_log($e->getMessage());
        }

        $city        = false;
        $state       = false;
        $stateCode   = false;
        $country     = false;
        $countryCode = false;
        $postcode    = false;
        $continent   = false;
    }

    return array(
        'city' => $city,
        'state' => $state,
        'stateCode' => $stateCode,
        'country' => $country,
        'countryCode' => $countryCode,
        'postcode' => $postcode,
        'continent' => $continent,
    );
}
