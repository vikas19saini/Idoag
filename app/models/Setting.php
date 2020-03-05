<?php

class Setting extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';
	
	protected $fillable = ['title', 'logo','twitter','facebook','linkedin','gplus','dashboard_popup'];

}