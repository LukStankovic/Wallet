<?php

class Login {

	private $email;

	private $password;

	private $salt;

	private $status;

	private $loggedID;

	public function __construct($email, $pass) {
		$this->email = $email;
		$this->password = $pass;
		$this->auth();
	}

	private function auth() {
		$options = ['cost' => 13, 'salt' => $this->getSalt(),];
		$res = dibi::query("SELECT `id`
					FROM `users`
					WHERE `email` = %s 
					AND `pass` = %s", $this->email, password_hash($this->password, PASSWORD_BCRYPT, $options));

		if ($this->loggedID = $res->fetchSingle()) {
			$this->status = 1;
			return true;
		} else {
			$this->status = 0;
			return false;
		}
	}

	private function getSalt() {
		$res = dibi::query("SELECT `salt`
			FROM `users` 
			WHERE `email` = %s", $this->email);
		$this->salt = $res->fetchSingle();
		return $this->salt;
	}

	public function redirect() {
		if ($this->auth()) {
			header("Location: dashboard.php");
		}
	}

	/**
	 * @return int
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return mixed
	 */
	public function getLoggedID() {
		return $this->loggedID;
	}
}