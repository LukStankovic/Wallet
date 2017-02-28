<?php

class Accounts {

	/**
	 * @var array $data All nav items
	 */
	private $data = [];

	/**
	 * Accounts constructor.
	 */
	public function __construct() {
		if(isset($_SESSION["logged_id"])) {
			$res = dibi::query("
			SELECT A.`id`, A.`id_user`, A.`id_currency`, A.`name` AS `account_name`, A.`icon`, A.`desc`, C.`code`, C.`name` as `currency_name`,
				C.`currency_unit`
			FROM `accounts` A JOIN `currencies` C ON A.`id_currency` = C.`id`
			WHERE A.`id_user` = %i", $_SESSION["logged_id"]);
			$this->data = $res->fetchAssoc("id");
		} else {
			$this->data = null;
		}
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
}