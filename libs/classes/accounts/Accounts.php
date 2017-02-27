<?php

/**
 * Created by PhpStorm.
 * User: lukstankovic
 * Date: 27.02.17
 * Time: 21:08
 */
class Accounts {
	private $data = array();

	public function __construct() {
		$res = dibi::query(
			"SELECT A.`id`, A.`id_currency`, A.`name` AS `account_name`, A.`icon`, A.`desc`, C.`code`, C.`name` as `currency_name`,
				C.`currency_unit`
			FROM `accounts` A JOIN `currencies` C ON A.`id_currency` = C.`id`"
		);
		$this->data = $res->fetchAssoc("id");
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
}