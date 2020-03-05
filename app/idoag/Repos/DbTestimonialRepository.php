<?php namespace idoag\Repos;

use \Testimonial;
use \DB;


class DbTestimonialRepository implements TestimonialRepositoryInterface
{

    public function getAll()
    {
        return Testimonial::all();
    }

    public function find($id)
    {
        return Testimonial::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Testimonial::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Testimonial::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Testimonial::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function delete($id)
    {
        return Testimonial::destroy($id);
    }

    public function activate($ids)
    {
        return Testimonial::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Testimonial::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Testimonial::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Testimonial::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null));
    }
}