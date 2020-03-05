<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Institution extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	 use SoftDeletingTrait;
	 
	 protected $dates = ['deleted_at'];
	 
	protected $table = 'institutions';

    protected $fillable = ['id','name', 'slug', 'description', 'image', 'public_id', 'colors', 'priority', 'status','coverimage','url','color1','color2','facebook','twitter','city','state', 'type'];


    public function post()
    {
        return $this->hasMany('Post','institution_id');
    }
    public function follows()
    {
        return $this->hasMany('InstitutionsFollows','institution_id');
    }
    public function feedbacks()
    {
        return $this->hasMany('Feedback','institution_id');
    }
    public function getStudentsCount($id)
    {
		$query = DB::select("select card_number from student_data WHERE college_id = '".$id."' AND deleted_at IS NULL");
		return count($query);
	}
    public function getStudentsActiveCount($id)
    {
		$query = DB::select("SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id 
													 WHERE users.card_number != '' AND student_details.institution_id = '".$id."' AND users.activated = 1 AND users.deleted_at IS NULL");
		return count($query);
	}
    public function studentsNotConfirmedCount($id)
    {
		$query = DB::select("SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id 
													 WHERE users.card_number != '' AND student_details.institution_id = '".$id."' AND users.activated = 0 AND users.deleted_at IS NULL");
		return count($query);
    }
    public function getStudentsCountFromData()
    {
        return Student::where('college_id', $this->id)->count();
    }
	
	public function getDeleteStudentCountFromData($id)
    {
        return StudentDetails::join('users', 'users.id', '=', 'student_details.user_id')
							->where('student_details.institution_id', $id)
							->whereNotNull('users.deleted_at')->count();

    }
	
    public function getStudentsNotRegisteredCountFromData($id)
    {
         //return Student::where('college_id', $this->id)->whereNotIn('card_number',$card_numbers)->count();
		 $query = DB::select("select card_number from student_data WHERE deleted_at IS NULL AND college_id = '".$id."' AND card_number IS NOT NULL AND card_number NOT IN (SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id WHERE student_details.institution_id = '".$id."')");
		return count($query);
	} 
    public function getCountByType($type)
    {
        return Post::where('institution_id', $this->id)->where('type', $type)->count();
    }
    public function getCountByTypeAndActiveStatus($type)
    {
           return Post::where('institution_id', $this->id)->where('type', $type)->where('start_date', '>', date('Y-m-d'))->count();
    }
    public function LikesCount()
    {
        return Post::join('posts_likes', 'posts_likes.post_id', '=', 'posts.id')->where('posts.institution_id',$this->id)->count();
    }
    public function FeedbackCount()
    {
        return Feedback::where('institution_id', '=', $this->id)->count();
    }
    public function FollowerCount()
    {
        return InstitutionsFollows::where('institution_id', '=', $this->id)->count();
    }

 }