<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewPhotosForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'description' 	=> 'required',
		'status'		=> 'sometimes|boolean'
	];
}


