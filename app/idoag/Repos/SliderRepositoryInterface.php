<?php namespace idoag\Repos;

interface SliderRepositoryInterface {
	
	public function getAll();
	
	public function find($id);
		
	public function create($fields);
	
	public function delete($id);

    public function activate($ids);

    public function deactivate($ids);

    public function trash($ids);

    public function untrash($ids);
	
}