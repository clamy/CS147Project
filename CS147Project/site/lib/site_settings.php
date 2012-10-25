<?php
// slte_settings.php
// -----------------
// This file contains the global settings for the website. It should be silent.
// Author: Yacine Merouchi (merouchi@stanford.edu)

// Maintenance mode. This deactivates all pages.
define("SITE_MAINTENANCE", 0);
if (SITE_MAINTENANCE) {
	die("The website is in maintenance. Please try again later.");
}

// Activate or deactivate debug mode. The PHP code should only display error
// or debug messages if this option is enabled.
define("SITE_DEBUG", "0");