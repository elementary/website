<?php

/**
 * api/event.php
 * Gets and sets event values by way of API endpoint
 */

require_once __DIR__.'/../_backend/event.php';

function send_response(int $status, $body) {
    if ($status === 200) {
        header('HTTP/1.0 200 OK');
    } else if ($status === 400) {
        header('HTTP/1.0 400 Bad Request');
    } else if ($status = 404) {
        header('HTTP/1.0 404 Not Found');
    }

    if (isset($body) && is_array($body)) {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($body, JSON_PRETTY_PRINT);
    }

    die();
}

/**
 * POST /api/event.php
 * Sets event cookie based on input
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $req = json_decode(file_get_contents('php://input'), TRUE);
    } catch (Exception $e) {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data'),
            'title' => 'Invalid request',
            'detail' => 'Unable to decode JSON POST data'
        )]);

        send_response(400, $res);
    }

    if (!isset($req['data']) || $req['data'] === '') {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data'),
            'title' => 'Invalid data object',
            'detail' => 'You need to specify a valid data object'
        )]);

        send_response(400, $res);
    }

    if (!isset($req['data']['type']) || $req['data']['type'] !== 'event') {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data/type'),
            'title' => 'Invalid type value',
            'detail' => 'This endpoint only accepts event types'
        )]);

        send_response(400, $res);
    }

    if (!isset($req['data']['attributes'])) {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data/attributes'),
            'title' => 'Invalid attributes',
            'detail' => 'You must specify attributes'
        )]);

        send_response(400, $res);
    }

    if (!isset($req['data']['attributes']['event'])) {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data/attributes/event'),
            'title' => 'Invalid event name',
            'detail' => 'You must specify an event name'
        )]);

        send_response(400, $res);
    }

    $event_name = $req['data']['attributes']['event'];

    if (!isset($event_expires[$event_name])) {
        $res = array('errors' => [array(
            'status' => 404,
            'source' => array('pointer' => '/data/attributes/event'),
            'title' => 'Unknown event name',
            'detail' => 'We do not have record of the request event'
        )]);

        send_response(404, $res);
    }

    if (!isset($req['data']['attributes']['value'])) {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('pointer' => '/data/attributes/value'),
            'title' => 'Invalid event value',
            'detail' => 'You must specify a value to set'
        )]);

        send_response(400, $res);
    }

    $event_value = $req['data']['attributes']['value'];

    try {
        event_cookie_set($event_name, $event_value);
    } catch (Exception $e) {
        $res = array('errors' => [array(
            'status' => 500,
            'title' => 'Server error',
            'detail' => 'An error occured while trying to set event value'
        )]);

        send_response(500, $res);
    }

    send_response(200, null);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['event']) || $_GET['event'] === '') {
        $res = array('errors' => [array(
            'status' => 400,
            'source' => array('parameter' => 'event'),
            'title' => 'Invalid event name',
            'detail' => 'You need to specify an event name'
        )]);

        send_response(400, $res);
    }

    $event_name = $_GET['event'];

    if (!isset($event_expires[$event_name])) {
        $res = array('errors' => [array(
            'status' => 404,
            'source' => array('parameter' => 'event'),
            'title' => 'Unknown event name',
            'detail' => 'We do not have record of the request event'
        )]);

        send_response(404, $res);
    }

    $event = $event_expires[$event_name];

    $res = array('data' => array(
        'event' => $event_name,
        'active' => event_active($event_name),
        'starts' => $event[0],
        'ends' => $event[1],
        'value' => event_cookie_get($event_name)
    ));

    send_response(200, $res);
}

/**
 * ANY /api/event.php
 * We don't know what the user wants, so we just error out
 */
$res = array('errors' => [array(
    'status' => 400,
    'title' => 'Unknown action',
    'detail' => 'This endpoint only accepts GET and POST requests'
)]);

send_response(400, $res);
