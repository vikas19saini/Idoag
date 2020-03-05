<?php namespace idoag\Repos;

use \Faq;
use \DB;


class DbFaqRepository implements FaqRepositoryInterface
{

    public function getAll()
    {
        return Faq::all();
    }

    public function find($id)
    {
        return Faq::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Faq::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Faq::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Faq::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Faq::destroy($id);
    }

    public function activate($ids)
    {
        return Faq::whereIn('id', $ids)->update(array('activated' => 1));
    }

    public function deactivate($ids)
    {
        return Faq::whereIn('id', $ids)->update(array('activated' => 0));
    }

    public function trash($ids)
    {
        return Faq::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Faq::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
    public function findByCategory($id)
    {
        return Faq::where('status','1')->where('cat_id', '=', $id)->get();
    }
}