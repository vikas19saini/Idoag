<?php namespace idoag\Repos;

use InstitutionRegistrations;
use \DB;


class DbInstitutionRegistrationRepository implements InstitutionRegistrationRepositoryInterface
{

    public function getAll()
    {
        return InstitutionRegistrations::all();
    }

    public function find($id)
    {
        return InstitutionRegistrations::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return InstitutionRegistrations::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return InstitutionRegistrations::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return InstitutionRegistrations::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return InstitutionRegistrations::destroy($id);
    }

    public function activate($ids)
    {
        return InstitutionRegistrations::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return InstitutionRegistrations::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return InstitutionRegistrations::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return InstitutionRegistrations::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
}