<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewTestimonialForm extends FormValidator {

    protected $rules = [
        'company_name'			=> 'required',
        'email'		        	=> 'required',
        'description'			=> 'required',
        'name' 	    	        => 'required'
    ];
}


