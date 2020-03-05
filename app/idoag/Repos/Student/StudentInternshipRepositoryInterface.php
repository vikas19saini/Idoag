<?php namespace idoag\Repos\Student;

interface StudentInternshipRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);
	
}