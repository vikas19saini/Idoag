<?php namespace idoag\Repos;

use \InstitutionsFollows;
use \DB;


class DbInstitutionsFollowsRepository implements InstitutionsFollowsRepositoryInterface
{

    public function getAll()
    {
        return InstitutionsFollows::all();
    }

    public function getList()
    {
        return InstitutionsFollows::orderBy('name')->lists('name', 'slug');
    }

    public function getUsers($id)
    {
        return InstitutionsFollows::where('institution_id', $id)->lists('name', 'slug');
    }

    public function find($id)
    {
        return InstitutionsFollows::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return InstitutionsFollows::create($fields);
    }

    public function findByName($value)
    {
        return InstitutionsFollows::where('name', $value)->first();
    }

    public function findBySlug($value)
    {
        return InstitutionsFollows::where('slug', $value)->first();
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return InstitutionsFollows::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return InstitutionsFollows::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return InstitutionsFollows::destroy($id);
    }

    public function activate($ids)
    {
        return InstitutionsFollows::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return InstitutionsFollows::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return InstitutionsFollows::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return InstitutionsFollows::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
    }

    public function getInstitutionsFollowing($user_id)
    {
        return InstitutionsFollows::where('user_id', $user_id)->lists('institution_id');
    }

    public function checkFollows($institution_id, $user_id)
    {
        return InstitutionsFollows::where('institution_id', $institution_id)->where('user_id', $user_id)->first();
    }
    public function follows($institution_id,$user_id)
    {
        return InstitutionsFollows::insert(array('institution_id' => $institution_id, 'user_id' => $user_id));
    }
    public function getCount($institution_id)
    {
        return InstitutionsFollows::where('institution_id', $institution_id)->count();
    }
    public function getCountByUser($user_id)
    {
        return InstitutionsFollows::where('user_id', $user_id)->count();
    }
}