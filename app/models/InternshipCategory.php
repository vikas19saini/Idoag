<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class InternshipCategory extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	  use SoftDeletingTrait;
	  
	   protected $dates = ['deleted_at'];
	  
	protected $table = 'internship_categories';
	
	protected $fillable = ['name', 'description', 'slug', 'status'];
	
	public function brands()
    {
        return $this->belongsToMany('Brand', 'brand_category', 'category_id', 'brand_id');
    }
	
}