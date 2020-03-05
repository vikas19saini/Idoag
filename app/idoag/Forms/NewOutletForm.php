<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewOutletForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'address' 		=> 'required',
		'city'			=> 'required',
		'state'			=> 'required',
	];
}


