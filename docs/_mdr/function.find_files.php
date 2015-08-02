<?php

function Find_Files($Directory, $Recursive = true, $Recurred = false) {

	global $MDR;

	$Files = array();

	foreach ( glob($Directory.'/*.md') as $File ) {
		if ( strpos($File, '/_') === false ) {
			$File = substr($File, 0, -3);
			if ( $Recurred ) {
				$URL = str_replace($Directory, '', $File);
			} else {
				$URL = str_replace($MDR['Root'], '', $File);
			}
			require_once $MDR['Core'].'/function.url_to_title.php';
			$Files[$URL] = url_to_title(str_replace($Directory, '', $File));
		}
	}

	// FOREACHDIRECTORY
	// Search in ALL sub-directories.
	foreach ( glob($Directory.'/*', GLOB_ONLYDIR) as $Sub ) {
		// This is a recursive function.
		// Usually, THIS IS VERY BAD.
		// For searching recursively however,
		// it does make some sense.
		if (
			substr($Sub, -7) != '/assets' &&
			strpos($Sub, '/_') === false
		) {
			if ( $Recursive ) {
				$Sub_Files = Find_Files($Sub, $Recursive, true);
			} else {
				$Sub_Files = array('__NON_RECURSIVE__' => '&hellip;');
			}
			$Sub = str_replace($MDR['Root'], '', $Sub);
			$Files[$Sub] = $Sub_Files;
		}
	} // FOREACHDIRECTORY

	return $Files;

}