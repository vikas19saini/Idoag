<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminBrandUserRegistrationForm extends FormValidator {

	protected $rules = [
		'email' 		=> 'required|email|unique:users',
		'first_name'	=> 'required',
		'last_name' 	=> 'required',
		'mobile' 		=> 'required',
		'brand'			=> 'required'
	];
}


