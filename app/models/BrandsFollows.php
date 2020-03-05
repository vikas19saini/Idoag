<?php

class BrandsFollows extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */


    protected $table = 'brands_follows';
	
	protected $fillable = ['brand','brand_id', 'user_id'];

	public function brand_follow(){

		return $this->belongsToMany('User');
	}
	
}