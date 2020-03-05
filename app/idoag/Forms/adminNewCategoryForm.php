<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewCategoryForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'description' 	=> 'required',
		'slug'			=> 'required',
		'status'		=> 'sometimes|boolean'
	];
}


