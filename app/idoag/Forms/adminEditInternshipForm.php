<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminEditInternshipForm extends FormValidator {

	protected $rules = [
		'name' => 'required',
		'description' 	=> 'required',
	];
}


