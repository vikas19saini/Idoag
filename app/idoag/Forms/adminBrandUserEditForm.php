<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminBrandUserEditForm extends FormValidator {

	protected $rules = [
		'email' 		=> 'required|email|unique:users',
		'first_name'	=> 'required',
		'last_name' 	=> 'required',
		'mobile' 		=> 'required',
		'brand_id'			=> 'required',
		'activated' 	=> 'sometimes|boolean'
	];
	
	 public function excludeUserId($id)
	  {
			$this->rules['email'] = "required|email|unique:users,email,$id";
	
			return $this;
	  }
}


