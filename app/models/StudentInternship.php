<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class StudentInternship extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $table = 'student_internship_details';

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id',  'course', 'cover_letter', 'why_selected', 'edu_degree_type', 'edu_college', 'edu_course', 'edu_year', 'exp_title', 'exp_info', 'exp_duration', 'exp_year','city','state','phone','email'];

}

