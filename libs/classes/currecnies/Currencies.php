<?php

class Currencies {

	/**
	 * @var array $data All nav items
	 */
	private $data = [];

	/**
	 * Currencies constructor.
	 */
	public function __construct() {
		$res = dibi::query("SELECT `id`, `name` FROM `currencies`");
		$this->data = $res->fetchAssoc("id");
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

}