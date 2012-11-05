<?php
// register.php
// ============
// Handles user registration.

require_once("register_lib.php");

$register_response = array();
if (!ValidateUsername($_POST["username"])) {
    $register_response["register_error"] = "Please type a username between 3 and 20 characters long, using only alphanumeric characters and underscores.";
} else if (!CheckAvailableUsername($_POST["username"], $DBH)) {
    $register_response["register_error"] = "Sorry, that username is already taken.";
} else if (!ValidatePassword($_POST["password"])) {
    $register_response["register_error"] = "Your password should be at least 6 characters long.";
} else {
    RegisterUser($_POST["username"], $_POST["password"], $DBH);
    $register_response["username"] = $_POST["username"];
    $register_response["token"] = $_POST["username"];
}

echo json_encode($register_response);
