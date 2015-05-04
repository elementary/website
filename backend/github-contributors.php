<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, 'https://api.github.com/repos/elementary/mvp/contributors');
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($connection, CURLOPT_VERBOSE, 1);
curl_setopt($connection, CURLOPT_HEADER, 1);
curl_setopt($connection, CURLOPT_USERAGENT, 'This request was from elementary.io to cache our contributors. Contact github.com/lewisgoddard or tweet @goddardlewis');
$data = curl_exec($connection);
$header_size = curl_getinfo($connection, CURLINFO_HEADER_SIZE);
curl_close($connection);

$header_array = array();
$header_data = substr($data, 0, strpos($data, "\r\n\r\n"));
foreach(explode("\r\n", $header_data) as $i => $line) {
    if($i===0) $header_array['HTTP-Code'] = $line;
    else {
        list ($key, $value) = explode(': ', $line);
        $header_array[$key] = $value;
    }
}

if ( $header_array['HTTP-Code'] == 'HTTP/1.1 202 Accepted' ) {
    // Wait a minute.
    header($_SERVER['SERVER_PROTOCOL'].' 202 Accepted', true);

} else if ( $header_array['X-RateLimit-Remaining'] > 0 ) {
    $data = substr($data, $header_size);
    $data = json_decode($data, true);
    foreach ( $data as $Key => $Value ) {
        unset(
            $data[$Key]['id'],
            $data[$Key]['gravatar_id'],
            $data[$Key]['url'],
            $data[$Key]['followers_url'],
            $data[$Key]['gists_url'],
            $data[$Key]['starred_url'],
            $data[$Key]['subscriptions_url'],
            $data[$Key]['organizations_url'],
            $data[$Key]['following_url'],
            $data[$Key]['repos_url'],
            $data[$Key]['events_url'],
            $data[$Key]['received_events_url'],
            $data[$Key]['type'],
            $data[$Key]['site_admin']
        );
    }
    $put = file_put_contents(__DIR__.'/contributors/web.json', json_encode($data));
    if ( $put ) {
        // All done.
        header($_SERVER['SERVER_PROTOCOL'].' 201 Created', true);
    } else {
        // Not allowed to write.
        header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden', true);
    }

} else {
    // Wait an hour.
    header($_SERVER['SERVER_PROTOCOL'].' 429 Too Many Requests', true);
}