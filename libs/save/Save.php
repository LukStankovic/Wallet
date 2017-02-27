<?php

class Save {

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

	public function saveAccount($required = null) {
		if ($this->checkRequired($required)) {
			$arr = [
				'id' => '',
				'id_user' => $_SESSION["logged_id"],
				'id_currency' => $_POST["currency"],
				'name' => $_POST["name"],
				'icon' => $_POST["icon"],
				'desc' => $_POST["desc"],
			];
			dibi::query('INSERT INTO [accounts]', $arr);
			header("Location: accounts.php#view");
		} else {
			return 0;
		}
	}
}