<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DuplicateStudentData extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'duplicate_studentdata';

    protected $fillable = ['card_number', 'rollno','status','rol_no', 'contact_number', 'first_name', 'last_name', 'dob', 'college_id', 'streamorcourse', 'validity_for_how_many_years', 'cluborgrouporsociety', 'residentordayscholar', 'date_of_issue', 'expiry_date', 'section', 'father_name', 'batch_year', 'program_duration', 'email_id', 'gender'];

}   