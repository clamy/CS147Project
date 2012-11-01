<?php
require_once("../lib/database_settings.php");

session_start();

function GetUserPassword($username, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT * FROM users WHERE username=:username");
        $STH->bindParam(':username', $username);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        if ($row = $STH->fetch()) {
            return $row["password"];
        } else {
            return NULL;
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function CheckPassword($username, $password, $DBH) {
    $submitted = $password;
    $actual = GetUserPassword($username, $DBH);
    echo "<!--";
    echo $submitted;
    echo "  ";
    echo $actual;
    echo "-->";
    if (empty($actual)) {
        return FALSE;
    }
    return strcmp($submitted, $actual) == 0;
}

if (isset($_POST["logout"])) {
	session_destroy();
	session_start();
} else if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (CheckPassword($_POST["username"], $_POST["password"], $DBH)) {
        $_SESSION["username"] = $_POST["username"];
    }
}

$username = $_SESSION["username"];
