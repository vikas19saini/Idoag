<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminEditEventForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'description' 	=> 'required',
	];
}


