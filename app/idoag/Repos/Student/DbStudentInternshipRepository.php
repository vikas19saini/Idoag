<?php namespace idoag\Repos\Student;

use \Internship;
use \DB;


class DbStudentInternshipRepository implements StudentInternshipRepositoryInterface
{

	public function getAll()
	{
		return Internship::all();
	}
	
	public function getList()
	{
		return Internship::orderBy('name')->lists('name', 'slug');
	}
	
	public function find($id)
	{
		return Internship::withTrashed()->findOrFail($id);
	}

	public function findbyUserId($id)
	{
        return Internship::where('user_id',$id)->orderBy('id', 'DESC')->first();
	}
    public function getByPostIds($ids)
    {
        return Internship::with('post')->whereIn('post_id', $ids)->orderBy('created_at','desc')->get();
    }
    public function isUserApplied($user_id,$post_id)
    {
        return Internship::where('post_id', $post_id)->where('user_id',$user_id)->where('status', '!=', '2')->first();
    }
    public function getInstitutionsByPostIds($ids)
    {
    return Internship::whereIn('post_id', $ids)->groupBy('institution')->lists('institution','institution');
    }
    public function getByBrandId($brand_id)
    {
        return Internship::where('brand_id', $brand_id)->get();
    }
    public function getCountByPostIds($ids)
    {
        return Internship::whereIn('post_id', $ids)->count();
    }
    public function getCountByPostIdsAndStatus($ids,$status)
    {
        return Internship::whereIn('post_id', $ids)->where('status',$status)->count();
    }
    public function create($fields)
    {
    	return Internship::create($fields);
    }
    public function getByUserAndPost($post_id,$user_id)
    {
         return Internship::where('user_id',$user_id)->where('post_id',$post_id)->first();
    }

	public function delete($id)
	{
		return Internship::destroy($id);
	}
    public function trash($ids)
    {
        return Internship::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Internship::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
    public function changestatus($ids,$status)
    {
        return Internship::whereIn('id', $ids)->update(array('status' => $status));
    }

}