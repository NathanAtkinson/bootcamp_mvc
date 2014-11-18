<?php 


class InvoiceListViewFragment extends ViewFragment {

	private $template = '<tr><td>{{invoice_id}}</td><td>{{first_name}} {{last_name}}</td><td>{{sale_date}}</td><td>{{total}}</td><td><a href="invoice_details?invoice_id={{invoice_id}}">Details</a></td></tr>';

	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	public function render() {
		return parent::fill($this->values, $this->template);
	}
}

