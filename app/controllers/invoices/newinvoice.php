<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		// Send a variable to the main view
		$this->view->welcome = 'Create a New Invoice';

		// Send a variable to a sub view
		// $this->view->primary_header->welcome = 'Welcome Student!';

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>

<!-- Notice this welcome variable was created above and passed into the view -->
<h3><?php echo $welcome; ?></h3>

<form class="reptile-form" action="invoices/create_invoice">
	<input type="text" name="invoice_number" title="Invoice Number" required>
	<input type="text" name="first_name" title="First Name" required>
	<input type="text" name="last_name" title="Last Name" required>
	<input type="number" name="quantity" title="Quantity" min=0 required maxlength="100">
	<input type="number" name="product_number" min=0 title="Product Number" required>
	<button type="submit">Submit</button>
</form>