<?php

class Navigation {

	private $data = array();

	public function __construct() {
		$res = dibi::query(
				"SELECT `name`, `url`, `translate`, `icon`
				FROM `pages`
				ORDER BY `order`");
		foreach ($res->fetchAll() as $key => $row) {
			$this->data[$key]["name"] = $row["name"];
			$this->data[$key]["url"] = $row["url"];
			$this->data[$key]["translate"] = $row["translate"];
			$this->data[$key]["icon"] = $row["icon"];
		}
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	public function selected() {
		return basename($_SERVER['SCRIPT_NAME']);
	}
}