<?php

class Users {

	/**
	 * @var int Id of logged user
	 */
	private $loggedUser;

	public function __construct() {
		$this->setLoggedUser();
	}

	/**
	 * @param int $loggedUser
	 */
	public function setLoggedUser() {
		if(isset($_SESSION["logged_id"])) {
			$this->loggedUser = $_SESSION["logged_id"];
		} else {
			$this->loggedUser = null;
		}
	}
	/**
	 * @return array
	 */
	public function getAllUsers() {
		$res = dibi::query(
			"SELECT `id`, `fname`, `lname`, `email`
			FROM `users`
			WHERE `id` != ?", $this->loggedUser);
		return $res->fetchAssoc("id");
	}

	/**
	 * @return int
	 */
	public function getLoggedUser() {
		return $this->loggedUser;
	}
}