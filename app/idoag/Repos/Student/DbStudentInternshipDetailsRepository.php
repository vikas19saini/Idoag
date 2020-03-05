<?php namespace idoag\Repos\Student;

use \StudentInternship;
use \DB;

class DbStudentInternshipDetailsRepository implements StudentInternshipDetailsRepositoryInterface
{

    public function getAll()
    {
        return StudentInternship::all();
    }


    public function find($id)
    {
        return StudentInternship::withTrashed()->findOrFail($id);
    }

    public function findByUserId($user_id)
    {
        return StudentInternship::withTrashed()->where('user_id',$user_id)->first();
    }
    public function create($fields)
    {
        return StudentInternship::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return StudentInternship::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return StudentInternship::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return StudentInternship::destroy($id);
    }

    public function trash($ids)
    {
        return  StudentInternship::whereIn('id', $ids)->update(array( 'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return  StudentInternship::withTrashed()->whereIn('id', $ids)->update(array( 'deleted_at' => null));
    }
}