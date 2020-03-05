<?php namespace idoag\Repos;

use \InternshipCategory;
use \DB;


class DbInternshipCategoryRepository implements InternshipCategoryRepositoryInterface 
{

	public function getAll()
	{
		return InternshipCategory::all();
	}
	
	public function getList()
	{
		return InternshipCategory::orderBy('name')->lists('name', 'slug');
	}

    public function getWithLimit($limit)
    {
        return InternshipCategory::take($limit)->get();
    }

	public function find($id)
	{
		return InternshipCategory::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return InternshipCategory::create($fields);
    }

	public function findByName($value)
	{
		return InternshipCategory::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return InternshipCategory::where('slug', $value)->first();
	}
	
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return InternshipCategory::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return InternshipCategory::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return InternshipCategory::destroy($id);
	}

	public function activate($ids)
	{
		return InternshipCategory::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
		return InternshipCategory::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
		return InternshipCategory::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return InternshipCategory::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
	}
	
	public function getSlug($slug)
	{
		$slugCount 	= count( InternshipCategory::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 	
		if($slugCount == 1)
		{
			$category = InternshipCategory::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->first();
			
			return $slug;
			
		} else {
			
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}
	}
	
}