<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminEditInstitutionForm extends FormValidator {

    protected $rules = [
        'name'			=> 'required',
        'description' 	=> 'required',
        'priority'		=> 'required',
        'status'		=> 'sometimes|boolean'
    ];
}


