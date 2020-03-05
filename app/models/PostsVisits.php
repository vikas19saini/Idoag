<?php

class PostsVisits extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts_visits';
	
	protected $fillable = ['post_id', 'user_id'];
	
}