<?php
// login.php
// =========
// This script checks a username and password submitted by post, and returns a
// JSON response that gives a token and username, or else an error response.

require("login_lib.php");

$login_info = array();

if (CheckPassword($_POST["username"], $_POST["password"], $DBH)) {
    $login_info["username"] = $_POST["username"];
    $login_info["token"] = $_POST["username"];
} else {
    $login_info["login_error"] = "Wrong username or password.";
}

echo json_encode($login_info);
