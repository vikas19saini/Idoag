<?php namespace idoag\Repos;

use \FaqCategory;
use \DB;


class DbFaqCategoryRepository implements FaqCategoryRepositoryInterface
{

    public function getAll()
    {
        return FaqCategory::all();
    }

    public function getList()
    {
        return FaqCategory::orderBy('name')->lists('name', 'id');
    }



    public function find($id)
    {
        return FaqCategory::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return FaqCategory::create($fields);
    }

    public function findByName($value)
    {
        return FaqCategory::where('name', $value)->first();
    }


    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return FaqCategory::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return FaqCategory::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return FaqCategory::destroy($id);
    }

    public function activate($ids)
    {
        return FaqCategory::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return FaqCategory::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return FaqCategory::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return FaqCategory::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
    }


}