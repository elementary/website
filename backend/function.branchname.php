<?php
function branch_name() {
    $Branch = '//'.filter_input(INPUT_SERVER, 'HTTP_HOST').'/';
    $Request_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $Request_URI = explode('/', $Request_URI);
    if ( !empty($Request_URI[1]) && $Request_URI[1] == 'branch' ) {
        $Branch .= 'branch/'.$Request_URI[2].'/';
    }
    return $Branch;
}
