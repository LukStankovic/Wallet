<?php

class Navigation {

	/**
	 * @var array $data All nav items
	 */
	private $data = [];

	/**
	 * Navigation constructor.
	 */
	public function __construct() {
		$res = dibi::query(
				"SELECT `id`, `name`, `url`, `translate`, `icon`
				FROM `pages`
				ORDER BY `order`"
		);

		$this->data = $res->fetchAssoc("id");
	}

	/**
	 * Get all nav items
	 *
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Return selected nav item
	 *
	 * @return string
	 */
	public function selected() {
		return basename($_SERVER['SCRIPT_NAME']);
	}
}