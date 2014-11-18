<?php

class Controller extends AppController {
	protected function init() {
		

		$validatorFactory = new ValidatorFactory();

		$validator = $validatorFactory->createValidator('name');
			try {
				$user_name = $_GET['user_name'];
				$user_name = htmlentities($user_name);
				$validator->validate($user_name);
				$this->view->user_name = $user_name;
			} catch (ValidationException $e) {
				//TODO
			}

		
		$validator = $validatorFactory->createValidator('number');
			try {
				$invoice_id = $_GET['invoice'];
				$invoice_id = htmlentities($invoice);
				$validator->validate($invoice);
				$this->view->invoice_id = $model->invoice_id;
			} catch (ValidationException $e) {
				//TODO
			}

		if(isset($_GET['invoice_id']) == 0) {
			$user_id['user_id'] = $_GET['user_id'];
			// have to pass in an array to Invoice so it will create a new invoice
			$user_id['user_id'] = htmlentities($user_id['user_id']);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($user_id['user_id']);
				$model = new Invoice($user_id);
				$this->view->invoice_id = $model->invoice_id;
			} catch (ValidationException $e) {
				//TODO
			}
			
			$this->view->inv = $model;
			$this->view->invoice_id = $model->invoice_id;
			$this->view->output = "<table border=\"1\"><thead><tr><td>Product</td><td>Price</td><td>Quantity</td><td colspan=\"2\">Line Total</td></tr></thead><tbody>";
			$this->view->output .= "</tbody></table>";
		} 
		$productsql = "SELECT * FROM product;";
		$this->view->product_list = DB::execute($productsql);
	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<h3>Invoice ID: <?php echo $invoice_id ?></h3>
<p><?php echo $user_name ?></p>
	<?php echo $output ?>

<form class="reptile-form" action="/invoices/process_invoice" method="POST" >
	<input type="hidden" name="invoice_id" title="Invoice Number" value="<?= $inv->invoice_id ?>">
	<input type="hidden" name="user_id" value	="<?= $inv->user_id ?>">
	<select id="product_id" name="product_id" title="Product: ">
		<?php while($product = $product_list->fetch_assoc()){ ?>
			<option value="<?php echo $product['product_id'] ?>" data-price="<?php echo $product['price'] ?>"><?php echo $product['name'] ?></option>
		<?php } ?>
	</select>
	<input type="number" name="quantity" min=0 title="Quantity: ">
	<button type="submit" id="add-item">Add Item</button>
</form>

<a href="/users">Back</a>