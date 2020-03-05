<?php namespace idoag\Repos;

use \BrandsFollows;
use \DB;


class DbBrandsFollowsRepository implements BrandsFollowsRepositoryInterface 
{

	public function getAll()
	{
		return BrandsFollows::all();
	}
	
	public function getList()
	{
		return BrandsFollows::orderBy('name')->lists('name', 'slug');
	}

    public function getUsers($id)
    {
        return BrandsFollows::where('brand_id', $id)->lists('name', 'slug');
    }

	public function find($id)
	{
		return BrandsFollows::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return BrandsFollows::create($fields);
    }

	public function findByName($value)
	{
		return BrandsFollows::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return BrandsFollows::where('slug', $value)->first();
	}
	
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return BrandsFollows::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return BrandsFollows::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return BrandsFollows::destroy($id);
	}

	public function activate($ids)
	{
        return BrandsFollows::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
        return BrandsFollows::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
        return BrandsFollows::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
        return BrandsFollows::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
	}
	
	public function getBrandsFollowing($user_id)
	{
		return BrandsFollows::where('user_id', $user_id)->lists('brand_id');
	}

	public function checkFollows($brand_id, $user_id)
	{
		return BrandsFollows::where('brand_id', $brand_id)->where('user_id', $user_id)->first();
	}	
	public function follows($brand_id,$user_id)
	{
        return BrandsFollows::insert(array('brand_id' => $brand_id, 'user_id' => $user_id));
	}
	public function getCount($brand_id)
	{
		return BrandsFollows::where('brand_id', $brand_id)->count();
	}
    public function getCountByUser($user_id)
    {
        return BrandsFollows::where('user_id', $user_id)->count();
    }
	public function getTopBrands()
   {
   		return BrandsFollows::select('brand_id', DB::raw('count(id) as total'))->groupBy('brand_id')->orderBy('total','desc')->lists('brand_id','total');
   }
}