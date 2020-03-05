<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewFAQForm extends FormValidator {

    protected $rules = [
        'question'			=> 'required',
        'answer' 	    	=> 'required'
    ];
}


