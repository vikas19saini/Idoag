<?php namespace idoag\Repos\Institution;

use \Institution;
use \DB;


class DbInstitutionRepository implements InstitutionRepositoryInterface 
{

	public function getAll()
	{
		return Institution::all();
	}

	public function getList()
	{
		return Institution::orderBy('name')->lists('name', 'id');
	}
	
	public function find($id)
	{
		return Institution::withTrashed()->findOrFail($id);
	}
    public function getInstitutionsByIds($ids)
    {
        return Institution::where('status','1')->whereIn('id', $ids)->get();
    }
    public function create($fields)
    {
    	return Institution::create($fields);
    }

	public function findByName($value)
	{
		return Institution::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return Institution::where('slug', $value)->first();
	}
	
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Institution::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Institution::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return Institution::destroy($id);
	}

	public function activate($ids)
	{
		return Institution::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
		return Institution::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
		return Institution::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return Institution::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
	}
	
	public function getSlug($slug)
	{
		$slugCount 	= count( Institution::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 
		if($slugCount == 1)
		{
			$Institution = Institution::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->first();
			
			return $slug;
			
		} else {
			
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}
	}
	
	public function findByCategory($slug)
	{
		return Institution::where('category', 'LIKE', '%'.$slug.'%')->get();
	}

}