<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StudentRegistrations extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'student_registrations';

    protected $fillable = ['college', 'state','city', 'name', 'designation', 'email', 'mobile','stud_name', 'stud_email', 'stud_mobile','comments','status'];

}