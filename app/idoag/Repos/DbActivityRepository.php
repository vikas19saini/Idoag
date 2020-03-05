<?php namespace idoag\Repos;

use \Activity;
use \DB;


class DbActivityRepository implements ActivityRepositoryInterface
{

    public function getAll()
    {
        return Activity::all();
    }
    public function find($id)
    {
        return Activity::findOrFail($id);
    }

    public function create($fields)
    {
        return Activity::create($fields);
    }

    public function getByUserId($user_id)
    {
        return Activity::where('user_id',$user_id)->orderBy('created_at','desc')->get();
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {
            return Activity::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Activity::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Activity::destroy($id);
    }

    public function brandChangeToVisitStatus($brand_id)
    {
        return Activity::where('brand_id', $brand_id)->where('type', 'internship')->update(array('visit_status' => 1));
    }
    public function studentChangeToVisitStatus($user_id)
    {
        return Activity::where('user_id', $user_id)->where('type', 'internship_status')->where('visit_status', 0)->update(array('visit_status' => 1));
    }
    public function trash($ids)
    {
        return Activity::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }
    public function deleteByTypeAndUserId($user_id,$type)
    {
        return Activity::where('user_id', $user_id)->where('type', $type)->delete();
    }

    public function untrash($ids)
    {
        return Activity::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }


}