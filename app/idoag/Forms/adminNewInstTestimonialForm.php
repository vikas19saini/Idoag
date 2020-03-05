<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewInstTestimonialForm extends FormValidator {

    protected $rules = [
        'institute_name'			=> 'required',
        'email'		        	=> 'required',
        'description'			=> 'required',
        'name' 	    	        => 'required'
    ];
}


