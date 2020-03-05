<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Feedback extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    
	use SoftDeletingTrait;
	
	 protected $dates = ['deleted_at'];
	
	protected $table = 'feedbacks';

    protected $fillable = ['brand_id', 'institution_id', 'user_id', 'name','message', 'replymessage', 'replydate', 'status'];

}