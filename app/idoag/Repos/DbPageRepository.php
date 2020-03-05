<?php namespace idoag\Repos;

use \Page;
use \DB;


class DbPageRepository implements PageRepositoryInterface
{

	public function getAll()
	{
		return Page::all();
	}

	public function find($id)
	{
		return Page::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return Page::create($fields);
    }
 
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Page::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Page::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return Page::destroy($id);
	}

	public function activate($ids)
	{
		return Page::whereIn('id', $ids)->update(array('activated' => 1));
	}
	
	public function deactivate($ids)
	{
		return Page::whereIn('id', $ids)->update(array('activated' => 0));
	}
	
	public function trash($ids)
	{
		return Page::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return Page::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
	}
}