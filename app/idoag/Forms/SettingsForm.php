<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class SettingsForm extends FormValidator {

	protected $rules = [
		
		'logo' => 'mimes:jpeg,jpg,png|image|size:5120'
	];
}


