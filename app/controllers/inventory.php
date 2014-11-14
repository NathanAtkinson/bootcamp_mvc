<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		// Send a variable to the main view
		$this->view->welcome = 'Inventory List';
		// Send a variable to a sub view
		// $this->view->primary_header->welcome = 'Welcome Student!';

		$sql = "
			SELECT *
			FROM product
			";

		// Execute
		$results = db::execute($sql);
		
		$this->view->products = "<table><tr><td>Item Number</td><td>Name</td><td>Description</td><td>Price</td></tr>";
		
		// Loop Rows
		while ($row = $results->fetch_assoc()) {
			$this->view->products .= '<tr><td>' . $row['product_id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['description'] . '</td><td>' . $row['price'] .'</td></tr>';
			// $this->view->products .= '<td><a href="/products/register">Update User</a></td>';
			// $this->view->products .= '<td><a href="/newinvoice">New Invoice</a></td></tr>';
		}

		$this->view->products .= "</table>";

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>

<!-- Notice this welcome variable was created above and passed into the view -->
<h3><?php echo $welcome; ?></h3>
<?php echo $products; ?>
<a href="/">Back</a>