<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		$this->view->welcome = 'Invoice List';

		$inv = new Invoice(82);
		$results = $inv->invoiceList();
		
		$this->view->output = "<table border=\"1\"><tr><td>Invoice #</td><td>Customer</td><td>Sale Date</td><td>Total</td></tr>";
		
		while ($row = $results->fetch_assoc()) {
			$grandtotal += $row['total'];
			$invoice_list = new InvoiceListViewFragment;
			$invoice_list->invoice_id = $row['invoice_id'];
			$invoice_list->first_name = $row['first_name'];
			$invoice_list->last_name = $row['last_name'];
			$invoice_list->sale_date = $row['sale_date'];
			$invoice_list->total = $row['total'];
			$this->view->output .= $invoice_list->render();
		}
		$this->view->output .= '<tr><td></td><td></td><td>' . 'Total: ' . '</td><td>' . $grandtotal .  '</td></tr></table>';
	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<h3><?php echo $welcome; ?></h3>
<h3><?php echo $output; ?></h3>

<a href="/">Back</a>
<a href="/invoice_details"></a>