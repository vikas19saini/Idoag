<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class StudentRegisterForm extends FormValidator {

	protected $rules = [
		'g-recaptcha-response'  => 'required',
	];
}


