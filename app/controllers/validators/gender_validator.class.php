<?php 


	class GenderValidator extends Validator {
		protected function validateParam($value) {
			if(preg_match('/m|f|M|F/',$value) == 0) {
				throw new ValidationException('Invalid indicator for gender: ');
			} else {
				return $value;
			}
		}
	}