<?php
// register_lib.php
// ================
// This file contains functions that validate a proposed username and password,
// and save a new username and password into the database.


function ValidateUsername($username) {
    return preg_match('/^\w{3,20}$/', $username);
}

function ValidatePassword($password) {
    return strlen($password) > 6;
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
        $STH->bindParam(':username', $username);
        $STH->bindParam(':password', $password);
        $STH->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }

}
