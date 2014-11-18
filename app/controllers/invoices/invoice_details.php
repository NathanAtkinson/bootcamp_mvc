<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		$invoice_id = $_GET['invoice_id'];
		$model = new Invoice($invoice_id);
		$results = $model->invoiceDetail($invoice_id);
		
		$this->view->welcome = 'Invoice Details: ' . $invoice_id;

		
		$this->view->output = "<table border=\"1\"><tr><td>Product</td><td>Price</td><td>Quantity</td><td>Line Total</td></tr>";

		while($line_info = $results->fetch_assoc()){
			$subtotal = $line_info['price'] * $line_info['quantity'];
			$total += $subtotal;
			$invoice_details = new InvoiceDetailsViewFragment;
			$invoice_details->name = $line_info['name'];
			$invoice_details->price = $line_info['price'];
			$invoice_details->quantity = $line_info['quantity'];
			$invoice_details->subtotal = $subtotal;
			$this->view->output .= $invoice_details->render();
		}
		$this->view->output .= "<tr><td></td><td></td><td>Total: </td><td>" . $total . "</td></table>";
	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);
?>

<h3><?php echo $welcome; ?></h3>
<?php echo $output ?>
<a href="/invoices">Back</a>