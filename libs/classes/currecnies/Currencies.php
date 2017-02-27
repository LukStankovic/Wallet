<?php

class Currencies {

	private $data = array();

	public function __construct() {
		$res = dibi::query(
			"SELECT `id`, `name` FROM `currencies`");
		foreach ($res->fetchAll() as $key => $row) {
			$this->data[$key]["id"] = $row["id"];
			$this->data[$key]["name"] = $row["name"];
		}
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

}