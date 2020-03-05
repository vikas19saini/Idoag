<?php namespace idoag\Repos\Student;

use \Coupon;
use \DB;


class DbCouponRepository implements CouponRepositoryInterface
{

    public function getAll()
    {
        return Coupon::all();
    }
    public function find($id)
    {
        return Coupon::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Coupon::create($fields);
    }

    public function findByCode($value)
    {
        return Coupon::where('code', $value)->first();
    }

    public function getByPostId($post_id)
    {
        return Coupon::where('post_id', $post_id)->where('status','=',0)->first();
    }
    public function getListByPostId($post_id)
    {
        return Coupon::where('post_id', $post_id)->where('status','=',0)->get();
    }

    public function getCodeByPostId($post_id)
    {
        return Coupon::where('post_id', $post_id)->pluck('code');
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Coupon::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Coupon::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Coupon::destroy($id);
    }

    public function activate($ids)
    {
        return  Coupon::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return  Coupon::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return  Coupon::whereIn('id', $ids)->update(array('status' => 1, 'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return  Coupon::withTrashed()->whereIn('id', $ids)->update(array('status' => 0, 'deleted_at' => null));
    }

}