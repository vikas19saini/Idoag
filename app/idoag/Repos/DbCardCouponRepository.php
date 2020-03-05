<?php namespace idoag\Repos;

use \CardCoupon;
use \DB;

class DbCardCouponRepository implements CardCouponRepositoryInterface
{

    public function getAll()
    {
        return CardCoupon::all();
    }

    public function find($id)
    {
        return CardCoupon::findOrFail($id);
    }

    public function create($fields)
    {
        return CardCoupon::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        return CardCoupon::where($column, $value)->get();
    }

    public function getByCouponCode($code)
    {
        return CardCoupon::where('code', $code)->first();
    }

    public function delete($id)
    {
        return CardCoupon::destroy($id);
    }
    public function trash($ids)
    {
        return CardCoupon::whereIn('id', $ids)->update(array('status' => 0,'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return CardCoupon::withTrashed()->whereIn('id', $ids)->update(array('status' => 1,'deleted_at' => null));
    }
}