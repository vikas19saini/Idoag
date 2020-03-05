<?php namespace idoag\Repos\Student;

use \StudentDetails;
use \DB;


class DbStudentDetailsRepository implements StudentDetailsRepositoryInterface
{

	public function getAll()
	{
		return StudentDetails::all();
	}
	
	public function getList()
	{
		return StudentDetails::orderBy('name')->lists('name', 'slug');
	}
	
	public function find($id)
	{
		return StudentDetails::withTrashed()->findOrFail($id);
	}

	public function findbyUserId($id)
	{
		return StudentDetails::where('user_id',$id)->first();
	}

	public function findByEmail($email)
	{
		return StudentDetails::where('email',$email)->first();
	}
    
    public function create($fields)
    {
    	return StudentDetails::create($fields);
    }

	public function delete($id)
	{
		return StudentDetails::destroy($id);
	}

}