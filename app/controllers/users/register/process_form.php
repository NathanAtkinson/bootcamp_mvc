<?php

class Controller extends AjaxController {
	protected function init() {

		if($_POST['user_id']) {
			$user_id = $_POST['user_id'];
			$user_id = htmlentities($user_id);
			$user = new User($user_id);
			$user->update($_POST);
		} else {
			//Insert new user
			$user_id = $_POST['user_id'];
			$user_id = htmlentities($user_id);
			$user = new User($_POST);
		}

		$this->view['redirect'] = '/users';
	}
}
$controller = new Controller();