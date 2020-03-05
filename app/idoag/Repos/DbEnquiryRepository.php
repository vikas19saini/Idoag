<?php namespace idoag\Repos;

use \Enquiry;
use \DB;


class DbEnquiryRepository implements EnquiryRepositoryInterface
{

    public function getAll()
    {
        return Enquiry::all();
    }

    public function find($id)
    {
        return Enquiry::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Enquiry::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Enquiry::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Enquiry::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Enquiry::destroy($id);
    }

    public function activate($ids)
    {
        return Enquiry::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Enquiry::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Enquiry::whereIn('id', $ids)->update(array('status' => 0,'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Enquiry::withTrashed()->whereIn('id', $ids)->update(array('status' => 1,'deleted_at' => null));
    }
}