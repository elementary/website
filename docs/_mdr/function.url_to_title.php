<?php

function url_to_title($Location, $Capitalize_Override = false) {
	global $MDR, $Settings;

	$Capitalize_Possible = array('Words', 'Sentences', 'First', 'All', 'None');

	// START IF CAPITALIZE OVERRIDE
	if (
		$Capitalize_Override &&
		in_array($Capitalize_Override, $Capitalize_Possible)
	) {
		$Capitalize = $Capitalize_Override;

	} else {
		$Capitalize = $Settings['Capitalize']['Titles'];
	} // END IF CAPITALIZE OVERRIDE

	$Title = strtolower(trim(str_replace(array('/', '_', '-'), array(' ', ' ', ' '), trim($Location, '/'))));

	// START IF CAPITALIZE
	if ( $Capitalize == 'Words' ) {
		$Title = ucwords($Title);

	} else if ( $Capitalize == 'Sentences' ) {
		require_once $MDR['Core'].'/function.ucsentences.php';
		$Title = ucsentences($Title);

	} else if ( $Capitalize == 'First' ) {
		$Title = ucfirst($Title);

	} else if ( $Capitalize == 'All' ) {
		$Title = strtoupper($Title);
	} // END IF CAPITALIZE

	return $Title;

}