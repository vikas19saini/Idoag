<?php namespace idoag\Repos;

use \InstitutionTestimonial;
use \DB;


class DbInstTestimonialRepository implements InstTestimonialRepositoryInterface
{

    public function getAll()
    {
        return InstitutionTestimonial::all();
    }

    public function find($id)
    {
        return InstitutionTestimonial::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return InstitutionTestimonial::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return InstitutionTestimonial::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return InstitutionTestimonial::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return InstitutionTestimonial::destroy($id);
    }

    public function activate($ids)
    {
        return InstitutionTestimonial::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return InstitutionTestimonial::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return InstitutionTestimonial::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return InstitutionTestimonial::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
}