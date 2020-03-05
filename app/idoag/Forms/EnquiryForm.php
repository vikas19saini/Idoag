<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class EnquiryForm extends FormValidator {

    protected $rules = [
        'firstname'			=> 'required',
        'lastname'       	=> 'required',
        'email' 	        => 'required',
        'message'	    	=> 'required',
    ];
}


