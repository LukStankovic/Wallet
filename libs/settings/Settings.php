<?php

class Settings {

	/*
	 * @var data
	 */
	public $data = array();

	public function __construct() {
		$result = dibi::query('SELECT * FROM settings');

		foreach ($result->fetchAssoc("name") as $key => $row) {
			$this->data[$key] = $row["value"];
		}
	}
}