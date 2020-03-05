<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StudentDetails extends \Eloquent {
 
 /**
  * The database table used by the model.
  *
  * @var string
  */
   use SoftDeletingTrait;
   
 protected $table = 'student_details';
 
 protected $dates = ['deleted_at'];
 
 protected $fillable = ['user_id','institution_id','aboutme', 'expiry','interests','name','email','institution', 'color','course','card_number','dob','city','state','roll_no','validity_for_how_many_years','cluborgrouporsociety','residentordayscholar','date_of_issue','section','father_name','batch_year','program_duration', 'gender',
     'highschool_year_comp', 'highschool_board', 'highschool_marks', 'highschool_marks_obtain', 'highschool_name', 'sss_comp', 'sss_board', 'sss_marks', 
     'sss_marks_obtain', 'sss_name', 'sss_stream', 'diploma_start', 'diploma_end', 'diploma_marks', 'diploma_marks_obtain', 'diploma_name', 'diploma_stream', 
     'bachelor_start', 'bachelor_end', 'bachelor_marks', 'bachelor_marks_obtain', 'bachelor_college', 'bachelor_degree', 'bachelor_stream', 'master_start', 
     'master_end', 'master_marks', 'master_marks_obtain', 'master_college', 'master_degree', 'master_stream', 'phd_start', 'phd_end', 'phd_marks', 'phd_marks_obtain', 
     'phd_university', 'phd_stream', 'work_samples', 'additional_details', 'project_details', 'phone_no'];
 
    public function getUser()
    {
        return $this->belongsTo('User','user_id');
    }
}

