<?php

class Settings {

	/**
	 * @var array $data
	 */
	private $data = [];

	/**
	 * Settings constructor.
	 */
	public function __construct() {
		$result = dibi::query('SELECT * FROM settings');

		foreach ($result->fetchAssoc("name") as $key => $row) {
			$this->data[$key] = $row["value"];
		}
	}

	/**
	 * Get all settings from database
	 *
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
}