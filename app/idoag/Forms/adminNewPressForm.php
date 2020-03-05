<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewPressForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
	];
}


