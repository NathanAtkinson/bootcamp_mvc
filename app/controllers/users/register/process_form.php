<?php

// Controller
class Controller extends AjaxController {
	protected function init() {

		// Validate First



		if($_POST['user_id']) {
			$user = new User($_POST['user_id']);
			$user->update($_POST);
		} else {
			//Insert new user
			$user = new User($_POST);
		}

		// send message back
		$this->view['redirect'] = '/users';






		// Save User
		/*$user = new User($_POST);

		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
		$this->view['response'] = 'User ' . $user->first_name . ' was successfully created';
*/
	}

}
$controller = new Controller();