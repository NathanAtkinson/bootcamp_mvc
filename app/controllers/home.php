<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>

<!-- Notice this welcome variable was created above and passed into the view -->
<h3><?php echo $welcome; ?></h3>
<a href="/users">Users</a><br>
<a href="/invoices">Invoice List</a><br>
<a href="/inventory">Product List</a><br>
