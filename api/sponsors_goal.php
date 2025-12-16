<?php

require_once __DIR__ . '/../_backend/bootstrap.php';

// POST to the GitHub GraphQL API to get the sponsorship goal
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.github.com/graphql",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: bearer $config[gh_sponsors_token]",
        "Content-Type: application/json",
        "User-Agent: elementary Website"
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "query" => "query { organization(login: \"elementary\") { sponsorsListing { activeGoal { percentComplete, targetValue } } } }"
    ])
]);

if (!$response = curl_exec($curl)) {
    // Return error code if the request fails
    http_response_code(500);
    curl_close($curl);
    die();
}

curl_close($curl);

$response = json_decode($response, true);

// Check the response has the data we asked for
if (!isset($response['data']['organization']['sponsorsListing']['activeGoal'])) {
    // Return error code if the response is invalid
    http_response_code(500);
    die();
}

$goal = $response['data']['organization']['sponsorsListing']['activeGoal'];
$percent = $goal['percentComplete'];
$target = $goal['targetValue'];

// Return the goal as a JSON object
header('Content-Type: application/json');
echo json_encode([
    "percent" => $percent,
    "target" => $target
]);
