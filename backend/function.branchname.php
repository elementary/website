<?php
function branch_root() {
    $Branch = '//'.filter_input(INPUT_SERVER, 'HTTP_HOST').'/';
    $Request_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $Request_URI = explode('/', $Request_URI);
    var_dump($Request_URI);
    if ( $Request_URI[1] == 'branch' ) {
        $Branch .= 'branch/'.$Request_URI[2];
    }
    return $Branch;
}

echo branch_root();
