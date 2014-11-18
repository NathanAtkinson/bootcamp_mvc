<?php 



	class ValidatorFactory {

		public function createValidator($type) {
			if ($type == 'email') {
				return new EmailValidator();
			} elseif ($type == 'number') {
				return new NumberValidator();
			} elseif ($type == 'phone') {
				return new PhoneNumberValidator();
			} elseif ($type == 'username') {
				return new UserNameValidator();
			} elseif ($type == 'password') {
				return new PasswordValidator();
			} elseif ($type == 'name') {
				return new NameValidator();
			} elseif ($type == 'dateofbirth') {
				return new DateOfBirthValidator();
			} elseif ($type == 'gender') {
				return new GenderValidator();
			} else {
				throw new Exception('Unknown Validator type: '. $type);
			}
		}
	}