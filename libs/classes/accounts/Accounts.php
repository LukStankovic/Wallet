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
	 * @var int $userId user
	 */
	private $userId;

	private $shared;

	/**
	 * Accounts constructor.
	 */
	public function __construct() {

		if(isset($_SESSION["logged_id"])) {
			$this->userId = $_SESSION["logged_id"];
		} else {
			$this->userId = null;
		}

		$this->sharedAccounts();
		if(!is_null($this->userId)) {
			$res = dibi::query(
				"SELECT A.`id`, A.`id_user`, A.`id_currency`, A.`name` AS `account_name`, A.`icon`, A.`desc`, A.`color`,
					C.`code`, C.`name` as `currency_name`, C.`currency_unit`, CONCAT(U.`fname`, ' ', U.`lname`) as `owner`,
					`share`
				FROM `accounts` A 
					JOIN `currencies` C ON A.`id_currency` = C.`id`
					JOIN `users` U ON A.`id_user` = U.`id`
				WHERE A.`id_user` = %i
				" . ($this->shared === null ? "" : "OR A.`id` IN %l") , $this->userId, ($this->shared === null ? "" : $this->shared));
			$this->data = $res->fetchAssoc("id");
		} else {
			$this->data = null;
		}

		/**
		 * Sum all money
		 */
		if(!is_null($this->userId)) {
			$this->sumTotalBalances($this->userId);
		}

		/**
		 * Get latest record for accounts
		 */
		if(!is_null($this->userId)) {
			$this->latestAdd($this->userId);
		}
	}

	/**
	 * Get sum of all accounts of logged user
	 *
	 * @param int $userId Logged user ID
	 * @return void
	 */

	public function sumTotalBalances($userId) {
		$res = dibi::query(
			"SELECT A.`id` AS `id_account`, IFNULL(SUM(MR.`amount`), 0) AS `balance`
			FROM `accounts` A
				LEFT JOIN `money_records` MR ON A.`id` = MR.`id_account`
			WHERE A.`id_user` = %i
				" . ($this->shared === null ? "" : "OR A.`id` IN %l") . "
			GROUP BY A.`id`", $userId, ($this->shared === null ? "" : $this->shared)
		);
		$this->balance = $res->fetchAssoc("id_account");
		foreach($this->balance as $key => $item) {
			$this->data[$key]["balance"] = $item["balance"];
		}
	}

	private function getAllShared() {
		$res = dibi::query(
			"SELECT `id` AS `id_account`, `share`
			FROM `accounts`
			WHERE `share` IS NOT NULL
				AND `id_user` != %i", $this->userId
		);
		return $res->fetchAssoc("id_account");
	}

	private function sharedAccounts() {
		$allShared = $this->getAllShared();
		foreach ($allShared as $key => $shared) {

			if(!is_array(unserialize($shared["share"]))) {
				$allShared[$key] = array(unserialize($shared["share"]));
			} else {
				$allShared[$key] = unserialize($shared["share"]);
			}
		}

		foreach ($allShared as $key => $account) {
			foreach ($account as $sharedUsers) {
				if($sharedUsers == $this->userId) {
					$this->shared[] = $key;
				}
			}
		}

	}

	/**
	 * Get latest records from accounts for user
	 *
	 * @param $userId
	 * @return void
	 */
	public function latestAdd($userId) {
		$res = dibi::query(
			"SELECT A.`id`, IFNULL(DATE_FORMAT(MR.`added`,'%e. %c. %Y %k:%i'),'-') AS `datetime`,
				IFNULL(MR.`amount`,'-') AS `latest_amount`, MR.`title` as `latest_record_title`
			FROM `money_records` MR
				LEFT JOIN `accounts` A ON MR.`id_account` = A.`id`
			WHERE MR.`added` IN (
					SELECT MAX(`added`)
					FROM `money_records`
					GROUP BY `id_account`)
				AND A.`id_user` = %i", $userId
		);
		$this->latest = $res->fetchAssoc("id");
		foreach ($this->latest as $key => $item) {
			$this->data[$key]["latest_datetime"] = $item["datetime"];
			$this->data[$key]["latest_amount"] = $item["latest_amount"];
			$this->data[$key]["latest_record_title"] = $item["latest_record_title"];
		}

	}

	public function getLatestRecords($userId, $limit = 5) {
		$res = dibi::query(
			"SELECT IFNULL(MR.`id`,'-') AS `id`, IFNULL(MR.`title`,'-') AS `title`, IFNULL(MR.`amount`,'-') as `amount`,
				IFNULL(DATE_FORMAT(MR.`added`, '%e. %c. %Y %k:%i'),'-') AS 'added', IFNULL(MR.`desc`,'-') AS `desc`,
				A.`name`, C.`currency_unit`
			FROM `money_records` MR
				JOIN `accounts` A ON MR.`id_account` = A.`id`
				JOIN `currencies` C ON A.`id_currency` = C.`id`
			WHERE MR.`id_user` = %i
			ORDER BY MR.`added` DESC
			LIMIT %i", $userId, $limit);
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