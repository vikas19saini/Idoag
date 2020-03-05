<?php namespace idoag\Repos\Student;

use \UserCoupon;
use \DB;


class DbUserCouponRepository implements UserCouponRepositoryInterface
{

    public function getAll()
    {
        return UserCoupon::all();
    }
    public function getAllWithPostInfo()
    {
        return UserCoupon::join('posts', 'user_coupons.post_id', '=', 'posts.id')->select('user_coupons.*','posts.name','posts.voucher_type','posts.brand_id', 'posts.offer_value', 'posts.offer_type')->orderBy('created_at','desc')->take(100)->get();
    }
    public function find($id)
    {
        return UserCoupon::withTrashed()->findOrFail($id);
    }

 public function getCount()
    {
        return UserCoupon::count();
    }

    public function create($fields)
    {
        return UserCoupon::create($fields);
    }

    public function getByUserId($user_id)
    {
        return UserCoupon::with('post')->where('user_id', $user_id)->orderBy('created_at','desc')->get();
    }

    public function getByPostId($post_id)
    {
        return UserCoupon::where('post_id', $post_id)->orderBy('updated_at','desc')->get();
    }

    public function getByCouponIds($coupon_ids)
    {
        return UserCoupon::whereIn('coupon_id', $coupon_ids)->orderBy('updated_at','desc')->first();
    }

    public function getWhere($column, $value, $trash = null)
    {

        return UserCoupon::where($column, $value)->get();

    }

    public function getusercoupon($post_id,$user_id)
    {
        return UserCoupon::where('post_id', $post_id)->where('user_id',$user_id)->orderBy('updated_at','desc')->first();
    }

    public function delete($id)
    {
        return UserCoupon::destroy($id);
    }

}