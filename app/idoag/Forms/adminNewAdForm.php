<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewAdForm extends FormValidator {

    protected $rules = [
        'name'			=> 'required',
        'image'		   	=> 'required'
    ];
}