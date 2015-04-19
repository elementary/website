<?php
/**
 * @see https://help.launchpad.net/API/Hacking
 * @see https://launchpad.net/+apidoc/beta.html#team-getMembersByStatus
 */

// CONFIG STARTS HERE

// Launchpad API URL
$apiBaseUrl = 'https://api.launchpad.net/beta';

// Launchpad team name => website team name
$teams = array('elementary-os' => 'desktop');
$statuses = array('Administrator', 'Approved');

$defaultLogo = 'https://launchpad.net/@@/person-logo';

// CONFIG ENDS HERE

header('Content-Type: text/plain');

function log_info($msg) { // Basic logger
    echo $msg."\n";
}

$outputDir = __DIR__.'/contributors';
if (!is_dir($outputDir)) {
    mkdir($outputDir);
}

foreach ($teams as $launchpadTeam => $websiteTeam) {
    $apiParams = 'ws.op=getMembersByStatus';
    $apiEndpoint = $apiBaseUrl.'/~'.$launchpadTeam.'?'.$apiParams;
    $outputFile = $outputDir.'/'.$websiteTeam.'.json';

    $list = array();
    foreach ($statuses as $status) {
        $apiStatusEndpoint = $apiEndpoint.'&status='.$status;
        log_info('Requesting '.$status.' members of '.$websiteTeam.' team from '.$apiStatusEndpoint);
        $json = file_get_contents($apiStatusEndpoint);
        if ($json === false) {
            throw new Exception('Could not get data from '.$apiStatusEndpoint);
        }
        $data = json_decode($json, true);
        if ($data === null) {
            throw new Exception('Could not parse JSON from '.$apiStatusEndpoint);
        }

        $list = array_merge($list, $data['entries']);
    }

    $members = array();
    foreach ($list as $member) {
        if ($member['resource_type_link'] != $apiBaseUrl.'/#person') {
            log_info('Skipped entity: '.$member['name'].' (type: '.$member['resource_type_link'].').');
            continue;
        }
        if ($member['name'] == 'rabbitbot-a') {
            continue;
        }

        // Cannot make HEAD requests (got: HTTP/1.1 405 Method Not Allowed)
        $logoHeaders = get_headers($member['logo_link'], true);
        if (strpos($logoHeaders[0], ' 404 ') !== false) {
            $member['logo_link'] = 'https://launchpad.net/@@/person-logo';
        }

        $members[] = array(
            'login' => $member['name'],
            'display_name' => $member['display_name'],
            'avatar_url' => $member['logo_link'],
            'html_url' => $member['web_link'],
            'contributions' => $member['karma']
        );
    }

    usort($members, function ($a, $b) {
        return $b['contributions'] - $a['contributions'];
    });

    log_info('Writing team to '.$outputFile);
    file_put_contents($outputFile, json_encode($members, JSON_PRETTY_PRINT));
}

log_info('Done.');