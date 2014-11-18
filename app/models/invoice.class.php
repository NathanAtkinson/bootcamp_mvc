<?php

class Invoice extends Model {

	protected function insert($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you
		$validatorFactory = new ValidatorFactory();

		$user_id = $input['user_id'];
		$user_id = htmlentities($user_id);

		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($user_id);
			$sql_values['user_id'] .= $user_id;
		} catch (ValidationException $e) {
			$sql_values['user_id'] = 'invalid user id';
		}

		$sale_date = date("y.m.d");
		// Prepare SQL Values
		$sql_values = [
			'user_id' => $user_id,
			'sale_date' => $sale_date
		];

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values, ['datetime_added']);

		// Insert
		$results = db::insert('invoice', $sql_values);
		
		// Return the Insert ID
		return $results->insert_id;
	}

	public function update($input) {

		$validatorFactory = new ValidatorFactory();

		$user_id = $input['user_id'];
		$user_id = htmlentities($user_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($user_id);
			$sql_values['user_id'] .= $user_id;
		} catch (ValidationException $e) {
			$sql_values['user_id'] = 'invalid user id';
		}

		$invoice_id = $input['invoice_id'];
		$invoice_id = htmlentities($invoice_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($invoice_id);
			$sql_values['invoice_id'] .= $invoice_id;
		} catch (ValidationException $e) {
			$sql_values['invoice_id'] = 'invalid invoice id';
		}


		// Prepare SQL Values
		$sql_values = [
			'user_id' => $user_id,
			'invoice_id' => $invoice_id,			
		];

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

		// Update
		db::update('invoice', $sql_values, "WHERE user_id = {$this->user_id} AND invoice_id = {$this->invoice_id}");
		
		// Return a new instance of this user as an object
		return new User($this->user_id);
	}

	public function invoiceList() {

		$sql = "SELECT 
					first_name,
					last_name,
					invoice.invoice_id,
					sale_date,
					SUM(product.price * line_item.quantity) AS total
				FROM 
					invoice, user, product, line_item
				WHERE
					user.user_id = invoice.user_id
					AND invoice.invoice_id = line_item.invoice_id
					AND product.product_id = line_item.product_id
				GROUP by
					invoice.invoice_id;
				";
		return db::execute($sql);
	}

	public function invoiceDetail($invoice_id) {

		$validatorFactory = new ValidatorFactory();

		$invoice_id = $invoice_id;
		$invoice_id = htmlentities($invoice_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($invoice_id);
		} catch (ValidationException $e) {
			$sql_values['invoice_id'] = 'invalid invoice id';
		}

		$sql = "SELECT
					*
				FROM
					invoice, line_item, product
				WHERE
					invoice.invoice_id = line_item.invoice_id
					AND line_item.product_id = product.product_id
					AND invoice.invoice_id = $invoice_id
				";

		return db::execute($sql);
	}

// -------------------------------------------

	function removeLineItem($invoice_id, $product_id) {

		$validatorFactory = new ValidatorFactory();

		$product_id = $product_id;
		$product_id = htmlentities($product_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($product_id);
		} catch (ValidationException $e) {
			$sql_values['product_id'] = 'invalid user id';
		}

		$invoice_id = $invoice_id;
		$invoice_id = htmlentities($invoice_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($invoice_id);
		} catch (ValidationException $e) {
			$sql_values['invoice_id'] = 'invalid invoice id';
		}

		$removequery = "DELETE FROM line_item
						WHERE line_item.invoice_id = '{$invoice_id}'
						AND line_item.product_id = '{$product_id}'
						";

		db::execute($removequery);
	}

	function addLineItem($invoice_id, $product_id, $quantity) {

		$validatorFactory = new ValidatorFactory();

		$product_id = $product_id;
		$product_id = htmlentities($product_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($product_id);
		} catch (ValidationException $e) {
			$sql_values['product_id'] = 'invalid user id';
		}

		$invoice_id = $invoice_id;
		$invoice_id = htmlentities($invoice_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($invoice_id);
		} catch (ValidationException $e) {
			$sql_values['invoice_id'] = 'invalid invoice id';
		}		

		$quantity = $quantity;
		$quantity = htmlentities($quantity);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($quantity);
		} catch (ValidationException $e) {
			$sql_values['quantity'] = 'invalid invoice id';
		}	

		$sql = 'INSERT INTO line_item (invoice_id, product_id, quantity) 
						VALUES ("' . $invoice_id .'", "' . $product_id . '", "' . $quantity . '") 
						ON DUPLICATE KEY UPDATE quantity=VALUES(quantity)
						';

			db::execute($sql);
	}

	function getLineItems($invoice_id) {

		$validatorFactory = new ValidatorFactory();

		$invoice_id = $invoice_id;
		$invoice_id = htmlentities($invoice_id);
		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($invoice_id);
		} catch (ValidationException $e) {
			$sql_values['invoice_id'] = 'invalid invoice id';
		}	

		$sql = "SELECT quantity, product.name, price, product.product_id
						FROM invoice, line_item, product 
						WHERE line_item.invoice_id = '{$invoice_id}' 
						AND invoice.invoice_id = '{$invoice_id}' 
						AND product.product_id = line_item.product_id
						";
		
		$results = db::execute($sql);
		$line_items = [];
		while($row = $results->fetch_assoc()) {
			$line_items[] = $row; 
		}
		return $line_items;
	}

	function getProducts($mysqli) {
		$productsql = "SELECT * FROM product;";
		return db::execute($productsql);
	}
}