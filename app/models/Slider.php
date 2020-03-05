<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Slider extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	  use SoftDeletingTrait;
	  
	 protected $dates = ['deleted_at'];
	 
	protected $table = 'sliders';
	
	protected $fillable = ['page_name', 'name', 'title', 'image_name','link','priority','target', 'text_color', 'mobile_image'];
	
}