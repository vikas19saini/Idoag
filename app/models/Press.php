<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Press extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	  use SoftDeletingTrait;
	  
	  protected $dates = ['deleted_at'];
	  
	protected $table = 'press';
	
	protected $fillable = ['name', 'slug','link', 'image_logo' ,'image_news', 'description'];
	
}