<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewInstitutionForm extends FormValidator {

	protected $rules = [
		'id' 			=> 'required|integer|unique:institutions',
		'name'			=> 'required',
		'description' 	=> 'required',
		'priority'		=> 'required',
		'status'		=> 'sometimes|boolean'
	];
}


