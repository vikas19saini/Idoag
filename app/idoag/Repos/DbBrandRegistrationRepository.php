<?php namespace idoag\Repos;

use \BrandRegistrations;
use \DB;


class DbBrandRegistrationRepository implements BrandRegistrationRepositoryInterface
{

    public function getAll()
    {
        return BrandRegistrations::all();
    }

    public function find($id)
    {
        return BrandRegistrations::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return BrandRegistrations::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return BrandRegistrations::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return BrandRegistrations::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return BrandRegistrations::destroy($id);
    }

    public function activate($ids)
    {
        return BrandRegistrations::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return BrandRegistrations::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return BrandRegistrations::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return BrandRegistrations::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
}