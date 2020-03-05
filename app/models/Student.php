<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Student extends \Eloquent {
 
 /**
  * The database table used by the model.
  *
  * @var string
  */
 use SoftDeletingTrait;
 protected $table = 'student_data';
 protected $dates = ['deleted_at'];
 
 protected $fillable = ['card_number', 'rollno','status','rol_no', 'contact_number', 'first_name', 'last_name', 'dob', 'college_id', 'streamorcourse', 'validity_for_how_many_years', 'cluborgrouporsociety', 'residentordayscholar', 'date_of_issue', 'expiry_date', 'section', 'father_name', 'batch_year', 'program_duration', 'email_id', 'gender','filename', 'uploaddate', 'type'];
 

}

