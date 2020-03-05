<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Page extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	  use SoftDeletingTrait;
	 
	 protected $dates = ['deleted_at'];
	 
	protected $table = 'pages';
	
	protected $fillable = ['heading', 'description', 'slug', 'pagetitle', 'metadesc', 'metakeywords'];
	
}