<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewSliderForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'title' 		=> 'required',
		'page_name'		=> 'required'
	];
}


