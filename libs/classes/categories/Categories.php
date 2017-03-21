<?php

class Categories {

	/**
	 * @var $generalCategories array
	 */
	private $generalCategories;

	/**
	 * @var $allCategories array
	 */
	private $allCategories;

	private $userId;

	public function __construct() {
		if(isset($_SESSION["logged_id"])) {
			$this->userId = $_SESSION["logged_id"];
		} else {
			$this->userId = null;
		}

		$this->loadCategories();
	}

	private function loadCategories() {
		$res = dibi::query(
			"SELECT `id`, `name`, `icon`, `type`
			FROM `categories`
			WHERE `id_user` = %i
				OR `id_user` IS NULL
			ORDER BY type DESC", $this->userId);
		$this->allCategories = $res->fetchAll();
	}

	/**
	 * Get all categories
	 *
	 * @return array
	 */
	public function getAllCategories() {
		return $this->allCategories;
	}

	/**
	 * Get general categories
	 *
	 * @return array
	 */
	public function getGeneralCategories() {
		return $this->generalCategories;
	}
}