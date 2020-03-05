<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = ['user_id','brand_id','institution_id','type','size', 'name','featured','slug','description', 'short_description','skills','category','image', 'web_only','state','city','offer_type','for_user_type', 'offer_value','panindia','available_stores','voucher_type','status','start_date','end_date','visits','question1','question2','question3','question4','question5','positions','stipend','amount','time_from','time_to', 'isfree','registration_url','contact_details','panindia_inst_id','resume_preference','application_date'];

    public function coupons()
    {
        return $this->hasMany('Coupons','post_id');
    }
    public function ICategories()
    {
        return $this->hasMany('InternshipCategory');
    }
    public function likes()
    {
        return $this->hasMany('PostsLikes');
    }
    public function visits()
    {
        return $this->hasMany('PostsVisits');
    }
    public function internships(){
        return $this->hasMany('Internship','post_id');
    } 
}   