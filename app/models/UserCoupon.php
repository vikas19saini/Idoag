<?php

 use Illuminate\Database\Eloquent\SoftDeletingTrait;
 
 class UserCoupon extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
	 
	 use SoftDeletingTrait;
	 
	 protected $dates = ['deleted_at'];
	  
    protected $table = 'user_coupons';

    protected $fillable = ['user_id','code','post_id', 'coupon_id'];

    public function coupon(){
        return $this->belongsTo('Coupon','coupon_id');
    }

    public function post(){
            return $this->belongsTo('Post','post_id');
        }
}