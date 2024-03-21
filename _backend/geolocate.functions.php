<?php

////    Continents
// NA   North america    Split by locale between NYC3 and SFO1
// SA   South america    Split by IP hash between NYC3 and SFO1
// EU   Europe           Split by locale between AMS3 and FRA1
// AF   Africa           Split by IP hash between AMS3 and FRA1
// AS   Asia             SGP1
// OC   Oceania          SGP1
// AN   Antarctica       SGP1

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__.'/log-echo.php';
use GeoIp2\Database\Reader;

////    getDownloadRegion
// Lookup the IP, and classify it by:
// - Continent
// - Country
// - Timezone
// Returns either a string of the selected region,
// or an array of two regions.
function getDownloadRegion($hostname, $debug = false)
{

    try {
        if (!class_exists('GeoIp2\Database\Reader')) {
            throw new \Exception('Class GeoIp2\Database\Reader not found');
        }
        $reader = new Reader(__DIR__.'/GeoLite2-City.mmdb');
        $record = $reader->city($hostname);

        $continent = $record->continent->code;
        $country   = $record->country->isoCode;
        $longitude = $record->location->longitude;
    } catch (\Exception $e) {
        if ($debug) {
            echo $e->getMessage();
        } else {
            error_log($e->getMessage());
        }

        $continent = false;
        $country   = false;
        $longitude = false;
    }

    if ($debug) {
        echo 'Continent: "'.$continent.'"'."\n";
        echo 'Country: "'  .$country  .'"'."\n";
        echo 'Longitude: "'.$longitude.'"'."\n";
    }

    // North America
    if ($continent == 'NA') {
        // These lists are based on who is on what side of the USA.
        $northEast = array('BZ', 'CR', 'SV', 'GT', 'HN', 'MX', 'NI', 'PA');
        /** @var string $northWest */
        $northWest = array('AG', 'BS', 'BB', 'BM', 'VG', 'KY', 'CU', 'DM', 'DO', 'GL', 'GD', 'GP', 'HT', 'JM', 'MQ', 'MS', 'CW', 'AW', 'SX', 'BQ', 'PR', 'BL', 'KN', 'AI', 'LC', 'MF', 'PM', 'VC', 'TT', 'TC', 'VI');
        if (in_array($country, $northEast) ||
            $longitude < -100
        ) {
            return 'sfo1';
        } elseif (in_array($country, $northWest) ||
            $longitude >= -100
        ) {
            return 'nyc3';
        } else {
            return array('nyc3', 'sfo1');
        }

    // Europe
    } elseif ($continent == 'EU') {
        // These lists are based on who is connected to which international exchange directly.
        // They are by no means exclusive.
        $isles = array('GB', 'IM', 'IE', 'FO', 'IS', 'GG', 'JE', 'GI');
        $vikings = array('NL', 'SX', 'DK', 'NO', 'SE', 'FI', 'SJ');
        // Great Britain
        if (in_array($country, $isles)) {
            return 'ams3';
        // Vikings
        } elseif (in_array($country, $vikings)) {
            return 'ams3';
        // Everywhere else
        } else {
            return array('ams3', 'fra1');
        }

    // South America
    } elseif ($continent == 'SA') {
        return array('nyc3', 'sfo1');

    // Africa
    } elseif ($continent == 'AF') {
        return array('fra1', 'ams3');
    } elseif (
        // Asia
        $continent == 'AS' ||
        // Oceania
        $continent == 'OC' ||
        // Antarctica
        $continent == 'AN'
    ) {
        return 'sgp1';

    // Other
    } else {
        return array('nyc3', 'ams3');
    }
}

////    getIPHash
// Hashes the given IP to return either a 0 or a 1 consistently for the same IP.
// Used when balancing between two regions returned by getDownloadRegion.
function getIPHash($hostname, $debug = false)
{
    $hash = array_sum(str_split($hostname));
    if ($debug) {
        echo 'Hash: "'.$hash.'"'."\n";
    }
    $hash = $hash % 10;
    if ($debug) {
        echo 'Remainder: "'.$hash.'"'."\n";
    }
    if ($hash > 5) {
        return 0;
    } else {
        return 1;
    }
}

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
