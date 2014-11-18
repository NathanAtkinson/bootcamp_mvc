<?php 



class NumberValidator extends Validator {

	protected function validateParam($value) {
		if(!is_numeric($value)) {
			throw new ValidationException('Invalid number: ');
		} else {
			return $value;
		}
	}
}
