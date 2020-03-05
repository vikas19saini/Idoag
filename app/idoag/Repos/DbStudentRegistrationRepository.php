<?php namespace idoag\Repos;

use \StudentRegistrations;
use \DB;


class DbStudentRegistrationRepository implements StudentRegistrationRepositoryInterface
{

    public function getAll()
    {
        return StudentRegistrations::all();
    }

    public function find($id)
    {
        return StudentRegistrations::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return StudentRegistrations::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return StudentRegistrations::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return StudentRegistrations::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return StudentRegistrations::destroy($id);
    }

    public function activate($ids)
    {
        return StudentRegistrations::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return StudentRegistrations::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return StudentRegistrations::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return StudentRegistrations::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
}