<?php namespace idoag\Repos\Student;

use \Student;
use \DB; 

class DbStudentRepository implements StudentRepositoryInterface
{

	public function getAll()
	{
		return Student::all();
	}
	
	public function getList()
	{
		return Student::orderBy('name')->lists('name', 'slug');
	}
	
	public function find($id)
	{
		return Student::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {	
    	return Student::create($fields);	
    }

	public function findByName($value)
	{
		return Student::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return Student::where('slug', $value)->first();
	}

	public function findByCardNumber($value)
	{
		return Student::where('card_number', $value)->first();
	}

	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Student::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Student::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return Student::destroy($id);
	}

	public function activate($ids)
	{
	return  Student::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
		return  Student::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{	
	return  Student::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
	
	}
	
	public function untrash($ids)
	{
	 return  Student::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
	}
	
	public function getSlug($slug)
	{
		$slugCount 	= count( Student::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 
		if($slugCount == 1)
		{
			$Student = Student::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->first();
			
			return $slug;
			
		} else {
			
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}
	}
	
	public function findByCategory($slug)
	{
		return Student::where('category', 'LIKE', '%'.$slug.'%')->get();
	}
}