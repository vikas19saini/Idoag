<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Coupon extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
	     use SoftDeletingTrait;
		 
		 protected $dates = ['deleted_at'];

    protected $table = 'coupons';

    protected $fillable = ['post_id' ,'code' , 'limit', 'status'];


}