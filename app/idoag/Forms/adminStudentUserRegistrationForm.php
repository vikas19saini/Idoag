<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminStudentUserRegistrationForm extends FormValidator {

	protected $rules = [
		'email' 		=> 'required|email|unique:users',
		'first_name'	=> 'required',
		'last_name' 	=> 'required',
		'mobile' 		=> 'required',
		'card_number'   => 'required',
		'expiry_date'   => 'required',
		'institution_id'	=> 'required'
	];
}


