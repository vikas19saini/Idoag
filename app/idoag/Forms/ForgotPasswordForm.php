<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class ForgotPasswordForm extends FormValidator {

	protected $rules = [
		'email' => 'required|email',
	];
}


