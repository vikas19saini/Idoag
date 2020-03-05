<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class NewOffersForm extends FormValidator {

	protected $rules = [
 		'size'			=> 'required',
		'name'       	=> 'required',
		'description' 	=> 'required',
		'web_only'		=> '',
        'offer_type'    => 'required',
        'offer_value'   => 'required',
        'voucher_type'  => 'required',
	];
}	


