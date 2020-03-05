<?php namespace idoag\Repos;

use \Setting;
use \DB;


class DbSettingsRepository implements SettingsRepositoryInterface 
{

	public function getAll()
	{
		return Setting::all();
	}

	public function find($id)
	{
		return Setting::findOrFail($id);
	}

    public function create($fields)
    {
    	return Setting::create($fields);
    }
	
	public function delete($id)
	{
		return Setting::destroy($id);
	}


}