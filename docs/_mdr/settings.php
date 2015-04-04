<?php

////    General Settings

// How should MDR capitalize things?
// - 'Words'
// - 'Sentences'
// - 'First'
// - 'All'
// - 'None'
$Settings['Capitalize']['Titles'] = 'Words';
$Settings['Capitalize']['Breadcrumbs'] = 'All';

// Language
// - 'en'
// - 'tech'
$Settings['Language'] = 'tech';

// Show Source
// - true
// - false
$Settings['Show Source'] = true;



////    Automatic and Advanced Settings
// Figure out what file they're after.

$MDR['Core']            = __DIR__;
$MDR['Root']            = str_replace('/docs/_mdr', '', $MDR['Core']);
$MDR['Templates']       = $MDR['Root'].'/_templates/';

$Request['Raw']         = filter_input(INPUT_SERVER, 'REQUEST_URI');
$Request['Exploded']    = explode('?', $Request['Raw'])[0];
$Request['Trimmed']     = trim(rtrim(str_replace('.md', '', $Request['Exploded']), '/'));
// Made dynamic per-branch
// $Request['Directory']   = str_replace('/branch/docs-by-mdr', '', $MDR['Root']).$Request['Trimmed'];
$Request['Directory']   = $MDR['Root'].'/docs/'.explode('/docs/', $Request['Trimmed'])[1];
$Request['Markdown']    = $Request['Directory'].'.md';
$Request['Source']      = false;

$Libraries['Parsedown'] = $MDR['Core'].'/Parsedown.php';
$Libraries['ParsedownExtra'] = $MDR['Core'].'/ParsedownExtra.php';

$Templates['Header']    = $MDR['Templates'].'header.php';
$Templates['Footer']    = $MDR['Templates'].'footer.php';

////    Special
include $MDR['Root'].'/_templates/sitewide.php';



////    Strings and Translations

$Lang['tech']['FILE_NOT_FOUND'] = 'File Not Found.';
$Lang['tech']['NO_FILES_IN_DIRECTORY'] = 'No Files in Directory.';
$Lang['tech']['SOURCE'] = 'Source';

$Lang['en']['FILE_NOT_FOUND'] = 'Sorry, we couldn\'t find that.';
$Lang['en']['NO_FILES_IN_DIRECTORY'] = 'Sorry, we couldn\'t find any files in this folder.';
$Lang['en']['SOURCE'] = 'Source';
