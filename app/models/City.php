<?php

class City extends \Eloquent {
	
	protected $table = 'cities';
	
	protected $fillable = ['state_id', 'name', 'slug', 'status'];
	
}