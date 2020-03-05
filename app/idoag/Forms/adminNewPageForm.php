<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewPageForm extends FormValidator {

	protected $rules = [
		'heading'			=> 'required',
 	];
}


