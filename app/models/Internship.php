<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Internship extends \Eloquent {

    use SoftDeletingTrait;
	  
    protected $dates = ['deleted_at'];
	  
    protected $table = 'internships';
	
    protected $fillable = array('post_id', 'user_id', 'name', 'institution', 'course', 'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'answer6', 'resume', 'status', 'video_resume','city','state','phone','email','video_url','brand_id');

    public function post(){
        return $this->belongsTo('Post','post_id');
    }
    
    public function brand(){
        return $this->belongsTo('Brand','brand_id');
    }
}


