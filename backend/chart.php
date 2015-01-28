<?php
/**
 * @see https://help.launchpad.net/API/Hacking
 * @see https://launchpad.net/+apidoc/beta.html#milestone-searchTasks
 */

date_default_timezone_set('UTC');

header('Content-Type: text/plain');

function log_info($msg) {
	echo $msg."\n";
}

$apiBaseUrl = 'https://api.launchpad.net/beta/';

$timeInterval = 30 * 24 * 60; // Interval between time spans in stats
$timeFrom = null; // Set to null to get data for the whole milestone
$timeTo = time();

$targetName = 'elementary';
$milestoneName = 'freya-beta2';

$apiParams = 'ws.op=searchTasks';
if (!empty($timeFrom)) {
	$apiParams .= '&created_since='.date(DATE_ATOM, $timeFrom);
}
$apiEndpoint = $apiBaseUrl.'/'.$targetName.'/+milestone/'.$milestoneName.'?'.$apiParams;

$tasks = array();

// Make HTTP requests
$nextCollectionPoint = $apiEndpoint;
while (!empty($nextCollectionPoint)) {
	log_info('Requesting tasks from '.$nextCollectionPoint);
	$json = file_get_contents($nextCollectionPoint);
	$data = json_decode($json, true);

	foreach ($data['entries'] as $task) {
		$dateCreated = strtotime($task['date_created']);

		if ($timeFrom === null || $dateCreated < $timeFrom) {
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