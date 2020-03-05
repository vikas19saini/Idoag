<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminEditOfferForm extends FormValidator {

	protected $rules = [
		'name'			=> 'required',
		'description' 	=> 'required',
	];
}


