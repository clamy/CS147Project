<?php
// login_or_register.php
// =====================
// This form handles the login and registration form response.

require_once("../../lib/database_settings.php");

if ($_POST["submit-option"] == "Login") {
    require("../../lib/login.php");
} else if ($_POST["submit-option"] == "Register") {
    require("../../lib/register.php");
} else {
    $response = array("login_error" => "Invalid option");
    echo json_encode($response);
}
