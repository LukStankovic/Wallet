<?php

class Accounts {

	/**
	 * @var array $data All data
	 */
	private $data = [];

	/**
	 * @var array $balance Total balance of the account
	 */
	private $balance = [];

	/**
	 * @var array $latest Latest added record for account
	 */
	private $latest = [];

	/**
	 * @var int $userID ID user
	 */
	private $userID;


	/**
	 * Accounts constructor.
	 */
	public function __construct() {

		if(isset($_SESSION["logged_id"])) {
			$this->userID = $_SESSION["logged_id"];
		} else {
			$this->userID = null;
		}

		if(!is_null($this->userID)) {
			$res = dibi::query(
				"SELECT A.`id`, A.`id_user`, A.`id_currency`, A.`name` AS `account_name`, A.`icon`, A.`desc`, A.`color`,
				C.`code`, C.`name` as `currency_name`, C.`currency_unit`, CONCAT(U.`fname`, ' ', U.`lname`) as `owner`
				FROM `accounts` A 
					JOIN `currencies` C ON A.`id_currency` = C.`id`
					JOIN `users` U ON A.`id_user` = U.`id`
				WHERE A.`id_user` = %i", $this->userID);
			$this->data = $res->fetchAssoc("id");
		} else {
			$this->data = null;
		}

		/**
		 * Sum all money
		 */
		if(!is_null($this->userID)) {
			$this->sumTotalBalances($this->userID);
		}

		/**
		 * Get latest record for accounts
		 */
		if(!is_null($this->userID)) {
			$this->latestAdd($this->userID);
		}
	}

	/**
	 * Get sum of all accounts of logged user
	 *
	 * @param int $userID Logged user ID
	 * @return void
	 */

	public function sumTotalBalances($userID) {
		$res = dibi::query(
			"SELECT A.`id` AS `id_account`, IFNULL(SUM(MR.`amount`), 0) AS `balance`
			FROM `accounts` A
				LEFT JOIN `money_records` MR ON A.`id` = MR.`id_account`
			WHERE A.`id_user` = %i
			GROUP BY A.`id`", $userID
		);
		$this->balance = $res->fetchAssoc("id_account");
		foreach($this->balance as $key => $item) {
			$this->data[$key]["balance"] = $item["balance"];
		}
	}

	/**
	 * Get latest records from accounts for user
	 *
	 * @param $userID
	 * @return void
	 */
	public function latestAdd($userID) {
		$res = dibi::query(
			"SELECT A.`id`, IFNULL(DATE_FORMAT(MR.`added`,'%e. %c. %Y %k:%i'),'-') AS `datetime`,
				IFNULL(MR.`amount`,'-') AS `latest_amount`, MR.`title` as `latest_record_title`
			FROM `money_records` MR
				JOIN `accounts` A ON MR.`id_account` = A.`id`
			WHERE `added` IN (
			    SELECT MAX(`added`)
			    FROM `money_records`
			    GROUP BY `id_account`)
			AND A.`id_user` = %i", $userID
		);
		$this->latest = $res->fetchAssoc("id");
		foreach($this->latest as $key => $item) {
			$this->data[$key]["latest_datetime"] = $item["datetime"];
			$this->data[$key]["latest_amount"] = $item["latest_amount"];
			$this->data[$key]["latest_record_title"] = $item["latest_record_title"];
		}
	}

	public function getLatestRecords($limit = 5) {
		$res = dibi::query(
			"SELECT MR.`id`, MR.`title`, MR.`amount`, DATE_FORMAT(MR.`added`, '%e. %c. %Y %k:%i') AS 'added', 
				MR.`desc`, A.`name`, C.`currency_unit`
			FROM `money_records` MR
				JOIN `accounts` A ON MR.`id_account` = A.`id`
				JOIN `currencies` C ON A.`id_currency` = C.`id`
			ORDER BY MR.`added` DESC
			LIMIT %i", $limit);
		return $res->fetchAssoc("id");
	}

	/**
	 * Get all data
	 *
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Get total balance
	 *
	 * @return array
	 */
	public function getBalance() {
		return $this->balance;
	}
}