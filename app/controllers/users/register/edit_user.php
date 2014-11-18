<?php

// Controller
class Controller extends AppController {
	protected function init() {

		$user_id = $_GET['user_id'];
		$user_id = htmlentities($user_id);
		$user = new User($user_id);
		$this->view->user = $user;
	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<form class="reptile-form" action="/users/register/process_form">
	<input type="hidden" name="user_id" value="<?php echo $user->user_id ?>">
	<input type="text" name="first_name" title="First Name" value="<?php echo $user->first_name ?>" required>
	<input type="text" name="last_name" title="Last Name" value="<?php echo $user->last_name ?>" required>
	<input type="date" name="date_of_birth" title="Date of Birth" value="<?php echo $user->date_of_birth ?>" required maxlength="100">
	<select name="gender" title="Gender" required>
		<option value="M" <?php if($user->gender == 'M') { echo 'selected'; } ?>>M</option>
		<option value="F" <?php if($user->gender == 'F') { echo 'selected'; } ?>>F</option>
	</select>
	<button type="submit">Submit</button>
</form>
<a href="/users">Back</a>