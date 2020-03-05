<?php namespace idoag\Repos;

use \Outlet;
use \DB;
use \Brand;


class DbOutletRepository implements OutletRepositoryInterface
{

    public function getAll()
    {
        return Outlet::all();
    }

    public function getByBrand($brand_id)
    {
        return Outlet::where('brand_id', '=', $brand_id)->get();
    }

    public function getTotalByBrand($brand_id)
    {
        return Outlet::where('brand_id', '=', $brand_id)->count();
    }

    public function getByCity($city)
    {
        return Outlet::where('city', '=', $city)->get();
    }

    public function getList($brand_id)
    {
        return Outlet::selectRaw('CONCAT(name, " - ", address, ", ", city) as fulladdress, id')->where('brand_id',$brand_id)->orderBy('name')->lists('fulladdress', 'id');
    }

    public function getStores($ids, $state, $city)
    {
        // return Outlet::selectRaw('CONCAT(name, " - ", address, ", ", city) as fulladdress, id')->whereIn('id',$ids)->where('state',$state)->where('city',$city)->orderBy('name')->lists('fulladdress', 'id');
        return Outlet::whereIn('id',$ids)->where('state',$state)->where('city',$city)->orderBy('name')->get();
    }
	
	 public function getStoresByCity($city)
    {
        return Outlet::where('city',$city)->groupBy('brand_id')->lists('brand_id');

    }

    public function find($id)
    {
        return Outlet::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Outlet::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if ($trash != null) {

            return Outlet::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Outlet::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Outlet::destroy($id);
    }

    public function activate($ids)
    {
        return Outlet::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Outlet::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Outlet::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s'), 'status' => 0));
    }

    public function untrash($ids)
    {
        return Outlet::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null, 'status' => 1));
    }
}
	