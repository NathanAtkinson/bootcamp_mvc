<?php

class Controller extends AjaxController {
	protected function init() {

		if(isset($_POST['remove']) == 1) {
			$user_id = $_POST['user_id'];
			$user_id = htmlentities($user_id);

			$validatorFactory = new ValidatorFactory();
			$validator = $validatorFactory->createValidator('number');
			
			try {
				$validator->validate($user_id);
			} catch (ValidationException $e) {
				//TODO
			}

			$product_id = $_POST['remove'];
			$product_id = htmlentities($product_id);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($product_id);
			} catch (ValidationException $e) {
				//TODO
			}

			$invoice_id = $_POST['invoice_id'];
			$invoice_id = htmlentities($invoice_id);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($invoice_id);
			} catch (ValidationException $e) {
				//TODO
			}


			$model = new Invoice($invoice_id);
			$model->removeLineItem($invoice_id, $product_id);
			$line_items= $model->getLineItems($invoice_id);
			$this->view['line_items'] = json_encode($line_items);
		} else {
			$user_id = $_POST['user_id'];
			$user_id = htmlentities($user_id);
			$validatorFactory = new ValidatorFactory();
			$validator = $validatorFactory->createValidator('number');
			
			try {
				$validator->validate($user_id);
			} catch (ValidationException $e) {
				//TODO
			}


			$invoice_id = $_POST['invoice_id'];
			$invoice_id = htmlentities($invoice_id);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($invoice_id);
			} catch (ValidationException $e) {
				//TODO
			}

			$product_id = $_POST['product_id'];
			$product_id = htmlentities($product_id);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($product_id);
			} catch (ValidationException $e) {
				//TODO
			}

			$quantity = $_POST['quantity'];
			$quantity = htmlentities($quantity);
			$validator = $validatorFactory->createValidator('number');
			try {
				$validator->validate($quantity);
			} catch (ValidationException $e) {
				//TODO
			}

			$model = new Invoice($invoice_id);
			$model->addLineItem($invoice_id, $product_id, $quantity);
			$line_items = $model->getLineItems($invoice_id);
			$this->view['line_items'] = $line_items;
			
		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
		}
	}
}
$controller = new Controller();