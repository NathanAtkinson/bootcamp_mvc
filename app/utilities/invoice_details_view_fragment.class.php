<?php 


class InvoiceDetailsViewFragment extends ViewFragment {

	private $template = '<tr><td> {{name}}</td> <td> {{price}}</td><td> {{quantity}}</td> <td> {{subtotal}}</td> <td><a href="newinvoice.php?id={{$custid}}&invnumber={{$invnumber}}&remove={{product_id}}&customername={{$customername}}">Remove</a></td> </tr>';

	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	public function render() {
		return parent::fill($this->values, $this->template);
	}
}

