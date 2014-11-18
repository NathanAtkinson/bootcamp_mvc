<?php 

class Controller extends AjaxController {
	protected function init() {

		$user_id = $_GET['user_id'];
		$user_id = htmlentities($user_id);

		$user = new User($user_id);

		$user->removeUser($user_id);

		header('Location: /users');
		exit();
	}
}
$controller = new Controller();