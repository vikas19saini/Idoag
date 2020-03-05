<?php namespace idoag\Repos\Institution;

interface InstitutionRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}