<?php

class PostsLikes extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts_likes';
	
	protected $fillable = ['post_id', 'user_id'];
	
}