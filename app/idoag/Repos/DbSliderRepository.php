<?php namespace idoag\Repos;

use \Slider;
use \DB;


class DbSliderRepository implements SliderRepositoryInterface 
{

	public function getAll()
	{
		return Slider::all();
	}

	public function find($id)
	{
		return Slider::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return Slider::create($fields);
    }

	public function findByName($value)
	{
		return Slider::where('name', $value)->first();
	}
	
	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Slider::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Slider::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}

	public function getByCategory($value)
	{
		 	
			return Slider::where('page_name', $value)->whereStatus(1)->orderBy('priority')->get();
		
	}
	
	public function delete($id)
	{
		return Slider::destroy($id);
	}

	public function activate($ids)
    {
        return Slider::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Slider::whereIn('id', $ids)->update(array('status' => 0));
    }

	public function trash($ids)
	{
		return Slider::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
		return Slider::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
	}
}