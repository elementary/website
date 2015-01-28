<?php
/**
 * @see https://help.launchpad.net/API/Hacking
 * @see https://launchpad.net/+apidoc/beta.html#milestone-searchTasks
 */

// CONFIG STARTS HERE

// Launchpad API URL
$apiBaseUrl = 'https://api.launchpad.net/beta/';

// Project name
$targetName = 'elementary';
// Milestone name
$milestoneName = 'freya-beta2';

// Interval for each bar in chart
$timeInterval = 7 * 24 * 60 * 60; // 1 week
// Build a chart from a date
// Set to null to get data for the whole milestone
$timeFrom = time() - 12 * 30 * 24 * 60 * 60; // 1 year
// Build a chart to a date
$timeTo = time(); // Now

// CONFIG ENDS HERE

date_default_timezone_set('UTC');

header('Content-Type: text/plain');

function log_info($msg) { // Basic logger
	echo $msg."\n";
}

$apiParams = 'ws.op=searchTasks';
$apiEndpoint = $apiBaseUrl.'/'.$targetName.'/+milestone/'.$milestoneName.'?'.$apiParams;

$autoDetectTimeFrom = ($timeFrom === null);
$tasks = array();

// Make HTTP requests
$nextCollectionPoint = $apiEndpoint;
while (!empty($nextCollectionPoint)) {
	log_info('Requesting tasks from '.$nextCollectionPoint);
	$json = file_get_contents($nextCollectionPoint);
	$data = json_decode($json, true);

	foreach ($data['entries'] as $task) {
		$dateCreated = strtotime($task['date_created']);

		if ($autoDetectTimeFrom && ($timeFrom === null || $dateCreated < $timeFrom)) {
			$timeFrom = $dateCreated;
		}

		$tasks[] = array(
			'status' => $task['status'],
			'date_created' => $dateCreated,
			'date_in_progress' => strtotime($task['date_in_progress']),
			'date_fix_committed' => strtotime($task['date_fix_committed'])
		);
	}

	$nextCollectionPoint = null;
	if (isset($data['next_collection_link'])) {
		$nextCollectionPoint = $data['next_collection_link'];
	}
}

log_info('Got all tasks.');
log_info('Time span: '.date(DATE_RFC2822, $timeFrom).' -- '.date(DATE_RFC2822, $timeTo));

$dateStatuses = array('fix_committed', 'in_progress', 'created');

$chart = array();
foreach ($tasks as $task) {
	for ($time = $timeTo; $time > $timeFrom; $time -= $timeInterval) {
		foreach ($dateStatuses as $status) {
			$statusDate = $task['date_'.$status];
			if ($statusDate === -1 || $statusDate === false) {
				continue;
			}
			if ($statusDate <= $time) {
				$chart[$time][$status]++;
				break; // Count each task only once
			}
		}
	}
}

ksort($chart);

file_put_contents('./chart.json', json_encode($chart, JSON_PRETTY_PRINT));

log_info('Done.');