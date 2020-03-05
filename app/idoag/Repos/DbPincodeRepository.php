<?php namespace idoag\Repos;

use \Pincode;
use \DB;

class DbPincodeRepository implements PincodeRepositoryInterface
{

    public function getAll()
    {
        return Pincode::all();
    }

    public function find($id)
    {
        return Pincode::findOrFail($id);
    }

    public function create($fields)
    {
        return Pincode::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
            return Pincode::where($column, $value)->get();
    }

    public function getByPincode($pincode)
    {
        return Pincode::where('pincode', $pincode)->first();
    }

    public function delete($id)
    {
        return Pincode::destroy($id);
    }


    public function trash($ids)
    {
        return Pincode::whereIn('id', $ids)->delete();
    }
}