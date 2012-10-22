<?php
// slte_settings.php
// -----------------
// This file contains the global settings for the website. It should be silent.
// Author: Yacine Merouchi (merouchi@stanford.edu)

// Maintenance mode. This deactivates all pages.
define("SERENTRIPITY_MAINTENANCE", 0);
if (SERENTRIPITY_MAINTENANCE) {
	die("We are performing maintenance operations on the server. Please try"
        " again in a little while!");
}

// Activate or deactivate debug mode. The PHP code should only display error
// or debug messages if this option is enabled.
define("SERENTRIPIDITY_DEBUG", "0");