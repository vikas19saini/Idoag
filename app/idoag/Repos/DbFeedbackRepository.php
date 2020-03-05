<?php namespace idoag\Repos;

use \Feedback;
use \DB;
use \Brand;
use \Institution;


class DbFeedbackRepository implements FeedbackRepositoryInterface
{

    public function getAll()
    {
        return Feedback::all();
    }

    public function getByBrand($brand_id)
    {
        return Feedback::where('brand_id', '=', $brand_id)->get();
    }
    public function getByUser($user_id)
    {
        return Feedback::where('user_id', '=', $user_id)->get();
    }

    public function getByInstitution($institution_id)
    {
        return Feedback::where('institution_id', '=', $institution_id)->get();
    }
    public function getTotalByBrand($brand_id)
    {
        return Feedback::where('brand_id', '=', $brand_id)->count();
    }
    public function getTotalByUser($user_id)
    {
        return Feedback::where('user_id', '=', $user_id)->count();
    }
    public function getTotalWithoutReplyByBrand($brand_id)
    {
        return Feedback::where('brand_id', '=', $brand_id)->where('replymessage', '=', '')->count();
    }
    public function getTotalByInstitution($institution_id)
    {
        return Feedback::where('institution_id', '=', $institution_id)->count();
    }
    public function getTotalWithoutReplyByInstitution($institution_id)
    {
        return Feedback::where('institution_id', '=', $institution_id)->where('replymessage', '=', '')->count();
    }

    public function find($id)
    {
        return Feedback::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Feedback::create($fields);
    }

    public function reply($id,$reply)
    {
        return Feedback::where('id',$id)->update(array('status' => 1, 'replymessage'=>$reply));
    }

    public function getWhere($column, $value, $trash = null)
    {
        if ($trash != null) {

            return Feedback::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Feedback::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Feedback::destroy($id);
    }

    public function activate($ids)
    {
        return Feedback::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Feedback::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Feedback::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Feedback::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }

    public function withreply($brand_id)
    {
        return Feedback::where('brand_id', '=', $brand_id)->where('replymessage','!=','')->orderBy('created_at','desc')->take(6)->get();
    }

    public function withoutreply($brand_id)
    {
        return Feedback::where('brand_id', '=', $brand_id)->where('replymessage', '')->orderBy('created_at','desc')->take(6)->get();
    }

    public function withInsReply($institution_id)
    {
        return Feedback::where('institution_id', '=', $institution_id)->where('replymessage','!=','')->orderBy('created_at','desc')->take(6)->get();
    }

    public function withoutInsReply($institution_id)
    {
        return Feedback::where('institution_id', '=', $institution_id)->where('replymessage', '')->orderBy('created_at','desc')->take(6)->get();
    }

    public function getExists($user_id, $brand_id)
    {
        return Feedback::where('brand_id', $brand_id)->where('user_id', $user_id)->where('replymessage','')->get();
    }
    public function getInsExists($user_id, $institution_id)
    {
        return Feedback::where('institution_id', $institution_id)->where('user_id', $user_id)->where('replymessage','')->get();
    }
}
	