<?php

////    Here, Miss.
// An DoNotTrack detection script that ignores settings done automatically.
// Copyright Lewis Goddard 2014 - MIT Licensed
//
////    Inputs
//
// $respectIE = bool(false)
// A boolean value on whether to respect later IE versions that turn on DoNotTrack by default.
// Defaults to `false`
//
////    Outputs
//
// $iev = int(11)
// The Internet Explorer version. An integer if Internet Explorer, `false` if not.
//
// $isie = bool(true)
// A boolean value to check if this is Internet Explorer.
//
// $dnt = bool(false)
// A boolean value that states whether the DoNotTrack header was set.
//
// $trackme = bool(true)
// A boolean value that states whether the user allows tracking.

$iev = false;
$isie = false;
$dnt = false;
if ( isset($_SERVER['HTTP_USER_AGENT']) ) {
    $ua = htmlentities($_SERVER['HTTP_USER_AGENT']);
} else {
    $ua = false;
}
if ( !isset($respectIE) ) {
    $respectIE = false;
}

// 5 - 10
$msie = strrpos($ua, 'MSIE ');
if ( $msie !== false ) {
    $iev = intval(substr($ua, ($msie + 5), strrpos($ua, '.', $msie)));

// >= 11 (Majority)
} else if ( strrpos($ua, 'Trident/') !== false ) {
    $rv = strrpos($ua, 'rv:');
    $iev = intval(substr($ua, ($rv + 3), strrpos($ua, '.', $rv)));
}

// No detection of 0 - 4
// Rarely used.

// If is IE, mark it as so.
if ( $iev ) {
    $isie = true;
}

if (
    // If DNT is on
    isset($_SERVER['HTTP_DNT']) &&
    $_SERVER['HTTP_DNT'] &&
    (
        // AND you are not using IE 10 or later
        $iev < 10 ||
        // OR we were asked to respect it
        $respectIE
    )
) {
    $dnt = true;
}

$trackme = !$dnt;