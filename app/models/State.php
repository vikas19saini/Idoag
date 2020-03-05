<?php

class State extends \Eloquent {
	
	protected $table 	= 'states';
	
	protected $fillable = ['name', 'slug', 'status'];

    public function cities()
    {
        return $this->hasMany('City','state_id');
    }
}