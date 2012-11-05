<?php
// login_lib.php
// =============
// Contains the methods that check a user's credentials.

require("external/PasswordHash.php");

// Fetch the user's password hash.
function GetStoredHash($username, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT password FROM users WHERE username=:username");
        $STH->bindParam(':username', strtolower($username));
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

function CheckPassword($username, $submitted_password, $DBH) {
    // First we fetch the stored hash for this username. If the username does
    // not exist, the stored hash will be NULL and we can return False.
    $stored_hash = GetStoredHash($username, $DBH);
    if (empty($stored_hash)) {
        return False;
    }
    // Now we compare the stored hash to the submitted password.
    // Base-2 logarithm of the iteration count used for password stretching
    $hash_cost_log2 = 8;
    // Do we require the hashes to be portable to older systems (less secure)?
    $hash_portable = FALSE;
    $password_hash = new PasswordHash($hash_cost_log2, $hash_portable);
    return $password_hash->CheckPassword($submitted_password, $stored_hash);
}
