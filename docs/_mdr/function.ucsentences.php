<?php

function ucsentences($String) {

	// Note: That's an emdash, not just a normal one.
	$Sentences = preg_split('/([.?!—:]+)/', $String, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

	$New_String = '';
	foreach ($Sentences as $Key => $Sentence) {
		if ( ( $Key & 1 ) == 0 ) {
			$New_String .= ucfirst(strtolower(trim($Sentence)));
		} else {
			$New_String .= $Sentence.' ';
		}
	}

	return trim($New_String);

}