<?php namespace idoag\Repos;

use \Press;
use \DB;


class DbPressRepository implements PressRepositoryInterface
{

	public function getAll()
	{
		return Press::all();
	}

	public function find($id)
	{
		return Press::withTrashed()->findOrFail($id);
	}
	public function getCount()
	{
		return Press::count();
	}

    public function create($fields)
    {
    	return Press::create($fields);
    }

	public function findByName($value)
	{
		return Press::where('name', $value)->first();
	}

	public function getBySlug($slug)
	{
		return Press::where('slug', $slug)->first();
	}

	public function getActive()
	{
		return Press::where('activated','=', 1)->get();
	}

	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Press::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Press::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}

	public function getSlug($slug)
	{
		$slugCount 	= count( Press::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 	
		if($slugCount >= 1)
		{
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
			
			
		} else {
			
			return $slug;
		}
	}
	public function delete($id)
	{
		return Press::destroy($id);
	}

	public function activate($ids)
	{
		return Press::whereIn('id', $ids)->update(array('activated' => 1));
	}
	
	public function deactivate($ids)
	{
		return Press::whereIn('id', $ids)->update(array('activated' => 0));
	}
	
	public function trash($ids)
	{
		return Press::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return Press::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
	}
}