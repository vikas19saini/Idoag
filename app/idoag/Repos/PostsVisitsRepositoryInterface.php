<?php namespace idoag\Repos;

interface PostsVisitsRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}