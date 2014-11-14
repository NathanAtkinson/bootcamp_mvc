<?php

// Controller
class Controller extends AppController {
	protected function init() {

		
		/*$model = new User(999);
		$results = $model->getUsers();*/
		$sql = "
				SELECT *
				FROM user
				";

		$results = db::execute($sql);

		$this->view->output = "<table><tr><td>Name</td><td>Date of Birth</td></tr>";
		
		// Loop Rows
		while ($row = $results->fetch_assoc()) {
			$user_view_fragment = new UserViewFragment;
			$user_view_fragment->user_name = $row ['first_name'] . ' ' . $row['last_name'];
			$user_view_fragment->user_id = $row['user_id'];
			$user_view_fragment->date_of_birth = $row['date_of_birth'];
			$this->view->output .= $user_view_fragment->render();

		}

		$this->view->output .= "</table>";
	}

}
$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>

<div class="users">
	<?php echo $output; ?>
</div>

<a href="/users/register">Add Customer</a><br>
<a href="/">Back</a>
