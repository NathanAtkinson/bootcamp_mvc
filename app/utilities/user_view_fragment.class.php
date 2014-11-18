<?php 


class UserViewFragment extends ViewFragment {

	private $template = '<tr><td>{{user_name}}</td><td>{{date_of_birth}} </td><td><a href="/new_invoice/?user_id={{user_id}}&user_name={{user_name}}">New Invoice </a></td><td><a href="/users/edit_user/?user_id={{user_id}}">Edit </a></td><td> <a href="/users/remove_user/?user_id={{user_id}}">Remove</a></td></tr>';
	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	public function render() {
		return parent::fill($this->values, $this->template);
	}
}




?>



















