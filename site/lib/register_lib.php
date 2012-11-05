<?php
// register_lib.php
// ================
// This file contains functions that validate a proposed username and password,
// and save a new username and password into the database.
require("external/PasswordHash.php");

function ValidateUsername($username) {
    return preg_match('/^\w{3,20}$/', $username);
}

function ValidatePassword($password) {
    return strlen($password) >= 6;
}

// Returns True if the submitted username is available to be registered.
function CheckAvailableUsername($username, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT username FROM users WHERE username=:username LIMIT 1");
        $STH->bindParam(':username', strtolower($username));
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        if ($row = $STH->fetch()) {
            return False;
        } else {
            return True;
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }

}

function RegisterUser($username, $password, $DBH) {
    try {
        $STH = $DBH->prepare("INSERT INTO users (username, password) VALUE (:username, :password)");
        $STH->bindParam(':username', strtolower($username));
        // Base-2 logarithm of the iteration count used for password stretching
        $hash_cost_log2 = 8;
        // Do we require the hashes to be portable to older systems (less secure)?
        $hash_portable = FALSE;
        $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
        $hashed_password = $hasher->HashPassword($password);
        $STH->bindParam(':password', $hashed_password);
        $STH->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }

}
