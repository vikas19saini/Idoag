<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewInternshipsForm extends FormValidator {

	protected $rules = [
		'name'       			=> 'required',
		'description' 			=> 'required',
        'offer_type'    	=> 'required',
	];
}