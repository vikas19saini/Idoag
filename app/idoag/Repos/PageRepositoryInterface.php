<?php namespace idoag\Repos;

interface PageRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}