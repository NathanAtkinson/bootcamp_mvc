<?php

/**
 * User
 */
class User extends Model {

	/**
	 * Insert User
	 */
	protected function insert($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		$validatorFactory = new ValidatorFactory();

		$first_name = $input['first_name'];
		$validator = $validatorFactory->createValidator('name');
		try {
			$validator->validate($first_name);
			$sql_values['first_name'] .= $first_name;

		} catch (ValidationException $e) {
			$sql_values['first_name'] = 'invalid first name';
		}

		$last_name = $input['last_name'];
		$validator = $validatorFactory->createValidator('name');
		try {
			$validator->validate($last_name);
			$sql_values['last_name'] .= $last_name;

		} catch (ValidationException $e) {
			$sql_values['last_name'] = 'invalid last name';
		}


		$date_of_birth = $input['date_of_birth'];
		$validator = $validatorFactory->createValidator('dateofbirth');
		try {
			$validator->validate($date_of_birth);
			$sql_values['date_of_birth'] .= $date_of_birth;

		} catch (ValidationException $e) {
			$sql_values['date_of_birth'] = 'invalid date of birth';
		}


		$gender = $input['gender'];
		$validator = $validatorFactory->createValidator('gender');
		try {
			$validator->validate($gender);
			$sql_values['gender'] .= $gender;

		} catch (ValidationException $e) {
			$sql_values['gender'] = 'invalid gender';
		}



	

		// Ensure values are encompassed with quote marks
		//TODO remove datetime added?  It's optional
		$sql_values = db::auto_quote($sql_values, ['datetime_added']);

		// Insert
		$results = db::insert('user', $sql_values);
		
		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update User
	 */
	public function update($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		$validatorFactory = new ValidatorFactory();

		$first_name = $input['first_name'];
		$validator = $validatorFactory->createValidator('name');
		try {
			$validator->validate($first_name);
			$sql_values['first_name'] .= $first_name;

		} catch (ValidationException $e) {
			$sql_values['first_name'] = 'invalid first name';
		}

		$last_name = $input['last_name'];
		$validator = $validatorFactory->createValidator('name');
		try {
			$validator->validate($last_name);
			$sql_values['last_name'] .= $last_name;

		} catch (ValidationException $e) {
			$sql_values['last_name'] = 'invalid last name';
		}

		$date_of_birth = $input['date_of_birth'];
		$validator = $validatorFactory->createValidator('dateofbirth');
		try {
			$validator->validate($date_of_birth);
			$sql_values['date_of_birth'] .= $date_of_birth;

		} catch (ValidationException $e) {
			$sql_values['date_of_birth'] = 'invalid date of birth';
		}


		$gender = $input['gender'];
		$validator = $validatorFactory->createValidator('gender');
		try {
			$validator->validate($gender);
			$sql_values['gender'] .= $gender;

		} catch (ValidationException $e) {
			$sql_values['gender'] = 'invalid gender';
		}


		// Prepare SQL Values
		/*$sql_values = [
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'date_of_birth' => $input['date_of_birth'],
			'gender' => $input['gender']
		];*/

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

		// Update
		db::update('user', $sql_values, "WHERE user_id = {$this->user_id}");
		
		// Return a new instance of this user as an object
		// return new User($this->user_id);

	}

	//created so I could get list of users
	public function getUsers() {

		$sql = "
			SELECT *
			FROM user
			";


		return db::execute($sql);

	}

	public function userInfo($user_id) {
		
		$validatorFactory = new ValidatorFactory();

		$user_id = $input['user_id'];
		$user_id = htmlentities($user_id);

		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($user_id);
			$user_id  = $user_id;

		} catch (ValidationException $e) {
			$sql_values['user_id'] = 'invalid user id';
		}

		$sql = "
			SELECT *
			FROM user
			WHERE user_id = {$user_id}
			";

		return db::execute($sql);
	}

	public function removeUser($user_id) {

		$validatorFactory = new ValidatorFactory();

		// $user_id = $user_id;
		$user_id = htmlentities($user_id);

		$validator = $validatorFactory->createValidator('number');
		try {
			$validator->validate($user_id);
			$user_id = $user_id;
		} catch (ValidationException $e) {
			$sql_values['user_id'] = 'invalid user id';
		}

		$sql = "SELECT invoice.invoice_id
				FROM invoice
				WHERE invoice.user_id = $user_id;";
		$invoicestodelete = db::execute($sql);

		/*had tried to concat queries by including ";" so I could
		do multiple queries with same call to DB*/
		$sql = "DELETE FROM user
				WHERE user.user_id = $user_id
				LIMIT 1;";
		db::execute($sql);

		$sql = "DELETE FROM invoice
				WHERE user_id = $user_id;";
		db::execute($sql);

		while($item = $invoicestodelete->fetch_assoc()) {
			$sql = "DELETE FROM line_item
				WHERE invoice_id = '{$item['invoice_id']}';";
			db::execute($sql);
		}

	}

	
}