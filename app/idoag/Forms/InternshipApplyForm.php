<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class InternshipApplyForm extends FormValidator {

    protected $rules = [
        'name'				=> 'required',
        'institution'  			=> 'required',
        'course' 	    		=> 'required',
        'video_resume'          =>'mimes:mp4,wmv | max:20000',
        'resume'                =>'required|max:3000|mimes:doc,docx,pdf',
    ];
}
