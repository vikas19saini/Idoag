<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class adminNewStudentForm extends FormValidator {

	protected $rules = [
		'first_name'					=> 'required',
		'last_name' 					=> 'required',
		'card_number'					=> 'required|unique:student_data',
		'rol_no'						=> 'required',
		'dob'							=> 'required',
		'college_id' 					=> 'required',
		'streamorcourse'				=> 'required',
		'validity_for_how_many_years'	=> 'required',
		'date_of_issue'					=> 'required',
		'expiry_date'					=> 'required',
		'section' 						=> 'required',
		'father_name'					=> 'required',
		'batch_year'					=> 'required',
		'program_duration' 				=> 'required',
		'email_id'						=> 'required|email|unique:student_data',
		'gender'						=> 'required',
	];

	/**
	* @param int $id
	*/
	public function excludeUserId($id)
	{
		$this->rules['email_id'] = "required|email|unique:student_data,email_id,$id";

		return $this;
	}
}


