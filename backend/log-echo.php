<?php

// Log an error and also echo it.
function log_echo($msg) {
	error_log($msg);
	echo $msg."\n";
}
