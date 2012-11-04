<?php
// login_lib.php
// =============
// Contains the methods that check a user's credentials.


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
    if (empty($actual)) {
        return FALSE;
    }
    return strcmp($submitted, $actual) == 0;
}
