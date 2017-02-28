<?php

class Login {

	/**
	 * @var string $email User`s e-mail
	 */
	private $email;

	/**
	 * @var string $password User`s password
	 */
	private $password;

	/**
	 * @var string $salt Salt for password
	 */
	private $salt;

	/**
	 * @var int $status 1 - logged
	 */
	private $status;

	/**
	 * @var int $loggedID User`s ID
	 */
	private $loggedID;

	/**
	 * Login constructor.
	 *
	 * @param $email
	 * @param $pass
	 */
	public function __construct($email, $pass) {
		$this->email = $email;
		$this->password = $pass;
		$this->auth();
	}

	/**
	 * Authentication for login
	 *
	 * @return bool
	 */
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

	/**
	 * Get salt for login from DB
	 *
	 * @return bool|mixed|string
	 */
	private function getSalt() {
		$res = dibi::query("SELECT `salt`
			FROM `users` 
			WHERE `email` = %s", $this->email);
		$this->salt = $res->fetchSingle();
		return $this->salt;
	}

	/**
	 * Redirect to dashboard
	 *
	 * @return void
	 */
	public function redirect() {
		if ($this->auth()) {
			header("Location: dashboard.php");
		}
	}

	/**
	 * Get user`s status
	 *
	 * @return int
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Get ID of logged user
	 *
	 * @return int
	 */
	public function getLoggedID() {
		return $this->loggedID;
	}
}