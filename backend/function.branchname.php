<?php

function branch_root() {
    $Request_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $Request_URI = explode('/', $Request_URI);
    var_dump($Request_URI);
    if ( $Request_URI[1] == 'branch' ) {
        $Branch = Request_URI[3];
    } else {
        $Branch = false;
    }
    return '//'.filter_input(INPUT_SERVER, 'HTTP_HOST').'/'.$Branch;
}

echo branch_root();
