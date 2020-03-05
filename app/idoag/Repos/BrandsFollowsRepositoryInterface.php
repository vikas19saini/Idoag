<?php namespace idoag\Repos;

interface BrandsFollowsRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}