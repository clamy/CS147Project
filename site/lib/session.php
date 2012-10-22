<?php
// This class contains all the logic for setting and getting user session
// variables.
class Session {
	// The user's token.
	// TODO: implement this.
	private $token;

    // Generates a 60-character hash from a plain password.
	public function get_password_hash($password) {
		$hasher = new PasswordHash(8, FALSE);
		$hash = $hasher->HashPassword($password);
		return $hash;
	}
	
	// Checks a password against a hash.
	public function verify_password($password, $correct_hash) {
		$hasher = new PasswordHash(8, FALSE);
		$check = $hasher->CheckPassword($password, $correct_hash);
		return $check;
	}
	
	public function init_user_session() {
		session_start();
		if (array_key_exists("token", $_SESSION)) {
			$this->token = $_SESSION["token"];
		} else {
			$this->token = false;
		}
	}
	
	public function __construct () {
	}
}