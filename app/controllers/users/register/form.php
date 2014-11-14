<?php

// Controller
class Controller extends AppController {
	protected function init() {

		// More code could go here depending on what you want to do with this page
		$user_id = $_GET['user_id'];

		$user = new user($user_id);

		$this->view->user = $user;



	}

}
$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>

<form class="reptile-form" action="/users/register/process_form">
	<input type="hidden" name="user_id" value="<?php echo $user->user_id ?>">
	<input type="text" name="first_name" title="First Name" value="<?php echo $user->first_name ?>" required>
	<input type="text" name="last_name" title="Last Name" value="<?php echo $user->last_name ?>" required>
	<input type="date" name="date_of_birth" title="Date of Birth" value="<?php echo $user->date_of_birth ?>" required maxlength="100">
	<input type="text" name="gender" title="Gender" value="<?php echo $user->gender ?>" required>
	<button type="submit">Submit</button>
</form>
<a href="/users">Back</a>