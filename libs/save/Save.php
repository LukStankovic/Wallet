<?php

class Save {

	/**
	 * Check all given $_POSTS if are sets
	 *
	 * @param null $required
	 * @return bool
	 */
	private function checkRequired($required = null) {
		if($required != null) {
			foreach ($required as $item) {
				if((isset($_POST[$item])) && ($_POST[$item] === "")) {
					return false;
				}
			}
			if(isset($_POST["save"])){
				return true;
			} else {
				return false;
			}
		} else {
			if(isset($_POST["save"])){
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * Save account
	 *
	 * @param null $required
	 * @return int
	 */
	public function account($required = null) {
		if ($this->checkRequired($required)) {

			$arr = [
				'id' => '',
				'id_user' => $_SESSION["logged_id"],
				'id_currency' => $_POST["currency"],
				'name' => $_POST["name"],
				'icon' => $_POST["icon"],
				'desc' => $_POST["desc"],
				'color' => $_POST["color"],
				'share' => (isset($_POST["share"]) ? serialize($_POST["share"]) : "")
			];
			dibi::query('INSERT INTO [accounts]', $arr);
			header("Location: ucty#view");
		} else {
			return 0;
		}
	}

	/**
	 * Save new registred user
	 *
	 * @param $required
	 * @return int
	 */
	public function register($required) {
		if ($this->checkRequired($required)) {
			$options = array(
				'cost' => 13,
				'salt' => uniqid(mt_rand(),true));
			$arr = [
				'id' => '',
				'email' => $_POST["email"],
				'salt' => $options["salt"],
				'pass' => password_hash($_POST["pass"], PASSWORD_BCRYPT, $options),
				'fname' => $_POST["fname"],
				'lname' => $_POST["lname"]
			];
			dibi::query('INSERT INTO [users]', $arr);
			header("Location: login.php?status=1");
		} else {
			return 0;
		}
	}

	/**
	 * Save new money record
	 *
	 * @param $required
	 * @return int
	 */
	public function moneyRecord($required) {
		if ($this->checkRequired($required)) {
			$arr = [
				'id' => '',
				'id_user' => $_SESSION["logged_id"],
				'id_account' => $_POST["account"],
				'title' => $_POST["title"],
				'amount' => $_POST["amount"],
				'added' => $_POST["added"],
				'desc' => $_POST["desc"],
			];
			dibi::query('INSERT INTO [money_records]', $arr);
		} else {
			return 0;
		}
	}
}