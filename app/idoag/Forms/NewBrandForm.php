<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewBrandForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'description' 	=> 'required',
		'category'		=> 'required',
	];
}


