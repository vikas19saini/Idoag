<?php namespace idoag\Repos;

interface CategoryRepositoryInterface {
	
	public function getAll();

	public function getList();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}