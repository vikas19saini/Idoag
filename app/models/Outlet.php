<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Outlet extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	  use SoftDeletingTrait;
	  
	   protected $dates = ['deleted_at'];
	  
	protected $table = 'outlets';
	
	protected $fillable = ['brand_id', 'user_id', 'name', 'address', 'locality', 'state', 'city', 'contact_info'];
	
}