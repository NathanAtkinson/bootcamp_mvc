<?php

class Controller extends AppController {
	protected function init() {

		$sql = "
				SELECT *
				FROM user
				";

		$results = db::execute($sql);

		$this->view->output = "<table border=\"1\"><tr><td>Name</td><td>Date of Birth</td></tr>";
		
		// Loop Rows
		while ($row = $results->fetch_assoc()) {
			$user_view_fragment = new UserViewFragment;
			$user_view_fragment->user_name = htmlentities($row ['first_name']) . ' ' . htmlentities($row['last_name']);
			$user_view_fragment->user_id = htmlentities($row['user_id']);
			$user_view_fragment->date_of_birth = htmlentities($row['date_of_birth']);
			$this->view->output .= $user_view_fragment->render();
		}
		$this->view->output .= "</table>";
	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<div class="users">
	<?php echo $output; ?>
</div>

<a href="/users/register">Add Customer</a><br>
<a href="/">Back</a>
