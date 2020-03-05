<?php

 use Illuminate\Database\Eloquent\SoftDeletingTrait;
 
class Activity extends \Eloquent {
  	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $table = 'brands';

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['brand_id','internship_id', 'user_id', 'inst_id' ,'type', 'offer_name', 'internship_name', 'coupon_code','message','post_id','visit_status'];

}