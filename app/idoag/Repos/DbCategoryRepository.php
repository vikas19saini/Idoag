<?php namespace idoag\Repos;

use \Category;
use \DB;


class DbCategoryRepository implements CategoryRepositoryInterface
{

	public function getAll()
	{
		return Category::all();
	}
	public function getList()
	{
		return Category::orderBy('name')->lists('name', 'slug');
	}
    public function getWithLimit($limit)
    {
        return Category::take($limit)->get();
    }

	public function find($id)
	{
		return Category::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return Category::create($fields);
    }

	public function findByName($value)
	{
		return Category::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return Category::where('slug', $value)->first();
	}

	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Category::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Category::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return Category::destroy($id);
	}

	public function activate($ids)
	{
		return Category::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
		return Category::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
		return Category::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return Category::whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
	}
	
	public function getSlug($slug)
	{
		$slugCount 	= count( Category::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 	
		if($slugCount == 1)
		{
			$category = Category::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->first();
			
			return $slug;
			
		} else {
			
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}
	}
	
}