<?php
// Debug options.
if(SITE_DEBUG) {
	// DEBUG MODE ACTIVATED, ERROR MESSAGES WILL BE DISPLAYED.
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
} else {
	error_reporting(0);
	ini_set("display_errors", 0);
}

