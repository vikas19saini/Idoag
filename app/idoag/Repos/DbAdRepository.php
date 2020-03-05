<?php namespace idoag\Repos;

use \Ad;
use \DB;


class DbAdRepository implements AdRepositoryInterface
{

    public function getAll()
    {
        return Ad::all();
    }

    public function getList()
    {
        return Ad::orderBy('name')->lists('name', 'id');
    }



    public function find($id)
    {
        return Ad::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Ad::create($fields);
    }

    public function findByName($value)
    {
        return Ad::where('name', $value)->first();
    }


    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Ad::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Ad::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Ad::destroy($id);
    }

    public function activate($ids)
    {
        return Ad::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Ad::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Ad::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Ad::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
    }


}