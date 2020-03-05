<?php namespace idoag\Repos;

use \PostsLikes;
use \DB;


class DbPostsLikesRepository implements PostsLikesRepositoryInterface 
{

	public function getAll()
	{
		return PostsLikes::all();
	}
	
	public function getList()
	{
		return PostsLikes::orderBy('name')->lists('name', 'slug');
	}

	public function find($id)
	{
		return PostsLikes::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return PostsLikes::create($fields);
    }

	public function findByName($value)
	{
		return PostsLikes::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return PostsLikes::where('slug', $value)->first();
	}
	
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return PostsLikes::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return PostsLikes::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return PostsLikes::destroy($id);
	}


	public function trash($ids)
	{
		return PostsLikes::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return PostsLikes::whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
	}
	public function checkLikes($post_id, $user_id)
	{
		return PostsLikes::where('post_id', $post_id)->where('user_id', $user_id)->first();
	}	

	public function getCount($post_id)
	{
		return PostsLikes::where('post_id', $post_id)->count();
	}

    public function getCountByUser($user_id)
    {
        return PostsLikes::where('user_id', $user_id)->count();
    }
    public function getCountByUserWithDateRange($user_id,$startdate,$enddate)
    {
        return PostsLikes::where('user_id', $user_id)->whereBetween('created_at',array($startdate.' 00:00:01', $enddate.' 23:59:59'))->count();
    }
}