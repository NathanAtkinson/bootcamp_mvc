<?php 

	abstract class Validator {
		
		abstract protected function validateParam($param); 

		public function validate($value) {
			return $this->validateParam($value);
		}
	}