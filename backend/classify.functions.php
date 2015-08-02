<?php

////    Continents
// NA   North america    Split by locale between NYC3 and SFO1
// SA   South america    Split by IP hash between NYC3 and SFO1
// EU   Europe           Split by locale between AMS3, FRA1, and LON1
// AF   Africa           Split by IP hash between AMS3 and FRA1
// AS   Asia             SGP1
// OC   Oceania          SGP1
// AN   Antarctica       SGP1

include 'geoip2.phar';
use GeoIp2\Database\Reader;

////    ipCheck
// Lookup the IP, and classify it by:
// - Continent
// - Country
// - Timezone
// Returns either a string of the selected region,
// or an array of two regions.
function ipCheck($hostname, $debug = false) {

    try {
        if ( $debug ) {
            echo $hostname."\n";
        }
        if (!class_exists('GeoIp2\Database\Reader')) {
            throw new \Exception('Class GeoIp2\Database\Reader not found');
        }
        $reader = new Reader(__DIR__.'/GeoLite2-City.mmdb');
        $record = $reader->city($hostname);
        if ( $debug > 1 ) {
            var_dump($record);
        }
        $continent = $record->continent->code;
        $country   = $record->country->isoCode;
        $longitude  = $record->location->longitude;

    } catch (\Exception $e) {
        echo '<!-- '.$e->getMessage().' -->'."\n";
        $continent = false;
        $country   = false;
        $longitude  = false;
    }

    if ( $debug ) {
        echo 'Continent: "'.$continent.'"'."\n";
        echo 'Country: "'.$country.'"'."\n";
        echo 'Longitude: "'.$longitude.'"'."\n";
    }

    // North America
    if ( $continent == 'NA' ) {
        // These lists are based on who is on what side of the USA.
        $northEast = array('BZ', 'CR', 'SV', 'GT', 'HN', 'MX', 'NI', 'PA');
        $northWest = array('AG', 'BS', 'BB', 'BM', 'VG', 'KY', 'CU', 'DM', 'DO', 'GL', 'GD', 'GP', 'HT', 'JM', 'MQ', 'MS', 'CW', 'AW', 'SX', 'BQ', 'PR', 'BL', 'KN', 'AI', 'LC', 'MF', 'PM', 'VC', 'TT', 'TC', 'VI');
        if (
            in_array($country, $northEast) ||
            $longitude < -100
        ) {
            return 'sfo1';
        } else if (
            in_array($country, $northWest) ||
            $longitude >= -100
        ) {
            return 'nyc3';
        } else {
            return array('nyc3', 'sfo1');
        }

    // Europe
    } else if ( $continent == 'EU' ) {
        // These lists are based on who is connected to which international exchange directly.
        // They are by no means exclusive.
        $isles = array('GB', 'IM', 'IE', 'FO', 'IS', 'GG', 'JE', 'GI');
        $germanic = array('DE', 'PT', 'ES', 'FR', 'AD', 'BE', 'LU', 'IT', 'AT', 'CZ', 'PL');
        $vikings = array('NL', 'SX', 'DK', 'NO', 'SE', 'FI', 'SJ');
        // Great Britain
        if ( in_array($country, $isles) ) {
            return 'lon1';
        // Germanics
        } else if ( in_array($country, $germanic) ) {
            return 'fra1';
        // Vikings
        } else if ( in_array($country, $vikings) ) {
            return 'ams3';
        // Everywhere else
        } else {
            return array('ams3', 'fra1');
        }

    // South America
    } else if ( $continent == 'SA' ) {
        return array('nyc3', 'sfo1');

    // Africe
    } else if ( $continent == 'AF' ) {
        return array('fra1', 'ams3');

    } else if (
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

////    ipHash
// Hashes the given IP to return either a 0 or a 1 consistently for the same IP.
// Used when balancing between two regions returned by ipCheck.
function ipHash($hostname, $debug = false) {
    $hash = array_sum(str_split($hostname));
    if ( $debug ) {
        echo 'Hash: "'.$hash.'"'."\n";
    }
    $hash = $hash % 10;
    if ( $debug ) {
        echo 'Remainder: "'.$hash.'"'."\n";
    }
    if ( $hash > 5 ) {
        return 0;
    } else {
        return 1;
    }
}

