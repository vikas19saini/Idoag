<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewEventsForm extends FormValidator {

	protected $rules = [
		'size'			=> 'required',
		'name'       	=> 'required',
		'description' 	=> 'required',
        'state'         => 'required',
        'start_date'    => 'required',
        'end_date'   => 'required'
	];
}


