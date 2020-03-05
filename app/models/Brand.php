<?php

 use Illuminate\Database\Eloquent\SoftDeletingTrait;
 
class Brand extends \Eloquent {
 use SoftDeletingTrait;
 	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'brands';
	
	 protected $dates = ['deleted_at'];
	
	protected $fillable = ['name', 'slug', 'description', 'image', 'public_id', 'category', 'colors', 'priority', 'status','coverimage','url','color1','color2','facebook','twitter','panindia','institution_id','city','state'];
	
	public function categories()
    {
        return $this->belongsToMany('Category');
    }
    public function post()
    {
        return $this->hasMany('Post','brand_id');
    }
	public function follows()
    {
        return $this->hasMany('BrandsFollows','brand_id');
    }
    public function feedbacks()
    {
        return $this->hasMany('Feedback','brand_id');
    }
    public function outlets()
    {
        return $this->hasMany('Outlet','brand_id');
    }
    public function getCountByType($type)
    {
        return Post::where('brand_id', $this->id)->where('type', $type)->count();
    }
    public function getCountByTypeAndActiveStatus($type)
    {
        if($type=='offer')
            return Post::where('brand_id', $this->id)->where('type', $type)->where('end_date', '<', date('Y-m-d'))->count();
        if($type=='internship')
            return Post::where('brand_id', $this->id)->where('type', $type)->where('application_date', '<', date('Y-m-d'))->count();
        if($type=='event')
            return Post::where('brand_id', $this->id)->where('type', $type)->where('start_date', '>', date('Y-m-d'))->count();
    }
    public function LikesCount()
    {
        return Post::join('posts_likes', 'posts_likes.post_id', '=', 'posts.id')->where('posts.brand_id',$this->id)->count();
    }
    public function FeedbackCount()
    {
        return Feedback::where('brand_id', '=', $this->id)->count();
    }
    public function FollowerCount()
    {
        return BrandsFollows::where('brand_id', '=', $this->id)->count();
    }

}