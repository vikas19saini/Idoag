<?php namespace idoag\Repos;

use \PostsVisits;
use \DB;


class DbPostsVisitsRepository implements PostsVisitsRepositoryInterface 
{

	public function getAll()
	{
		return PostsVisits::all();
	}

	public function find($id)
	{
		return PostsVisits::findOrFail($id);
	}

    public function create($fields)
    {
    	return PostsVisits::create($fields);
    }
	
	public function delete($id)
	{
		return PostsVisits::destroy($id);
	}	

	public function postvisitexists($post_id,$user_id)
	{
		return PostsVisits::where('post_id',$post_id)->where('user_id',$user_id)->pluck('id');
	}

	public function getrecentviewed($user_id)
	{
		return PostsVisits::where('user_id',$user_id)->take(6)->orderBy('updated_at','desc')->lists('post_id');
	}
    public function getCountByUser($user_id)
    {
        return PostsVisits::where('user_id', $user_id)->count();
    }
    public function getCountByUserWithDateRange($user_id,$startdate,$enddate)
    {
        return PostsVisits::where('user_id', $user_id)->whereBetween('created_at',array($startdate.' 00:00:01', $enddate.' 23:59:59'))->count();
    }
}