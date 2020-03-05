<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class StudentActivationForm extends FormValidator {

	protected $rules = [
        'card_number' 	=> 'required|Min:16|Max:20',
		'dob' 			=> 'required|date|date_format:d-m-Y',

	];
}


