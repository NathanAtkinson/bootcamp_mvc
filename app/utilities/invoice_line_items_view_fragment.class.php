<?php 


class InvoiceLineItemsViewFragment extends ViewFragment {

	private $template = '<tr> <td>{{name}}</td><td>{{price}}</td><td>{{quantity}}</td><td>{{subtotal}}</td> </tr>';

	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	public function render() {
		return parent::fill($this->values, $this->template);
	}
}

?>


