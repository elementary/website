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
    $put = file_put_contents('./contributors.json', $data);
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