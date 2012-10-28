<?php
// database_settings.php
// ---------------------
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

$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147merouchi', 'fahveipo');
mysql_select_db('c_cs147_merouchi');
