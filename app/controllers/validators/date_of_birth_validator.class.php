<?php 



	class DateOfBirthValidator extends Validator {
/*how to validate a birthday month and the days? especially since some months have different
amounts of days.  What about leapyears?*/
		protected function validateParam($value) {
			if(preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})/',$value) == 0) {
				throw new ValidationException('Invalid Date of Birth: ');
			} else {
				return $value;
			}
		}
	}
