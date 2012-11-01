<?php
// database_settings.php
// ---------------------
// Author: Yacine Merouchi (merouchi@stanford.edu)

// Maintenance mode. This deactivates all pages.
define("SERENTRIPITY_MAINTENANCE", 0);
if (SERENTRIPITY_MAINTENANCE) {
	die("We are performing maintenance operations on the server. Please try again in a little while!");
}

// Activate or deactivate debug mode. The PHP code should only display error
// or debug messages if this option is enabled.
define("SERENTRIPIDITY_DEBUG", "0");

//$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147merouchi', 'fahveipo');
$db_host = "mysql-user-master.stanford.edu";
$db_name = "c_cs147_merouchi";
$db_username = "ccs147merouchi";
$db_password = "fahveipo";
$DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password); 
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// mysql_select_db('c_cs147_merouchi');

// Table users
// userid
// username
// password
// token
