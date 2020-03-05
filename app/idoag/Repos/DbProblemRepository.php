<?php namespace idoag\Repos;

use \Problem;
use \DB;


class DbProblemRepository implements ProblemRepositoryInterface
{

    public function getAll()
    {
        return Problem::all();
    }

    public function find($id)
    {
        return Problem::withTrashed()->findOrFail($id);
    }

    public function create($fields)
    {
        return Problem::create($fields);
    }

    public function getWhere($column, $value, $trash = null)
    {
        if($trash != null)
        {

            return Problem::where($column, $value)->whereNotNull('deleted_at')->get();

        } else {

            return Problem::where($column, $value)->whereNull('deleted_at')->get();
        }

    }

    public function getByBrand($brand_id)
    {
        return Problem::join('posts', 'report_problem.post_id', '=', 'posts.id')->select('report_problem.*','posts.brand_id','posts.slug','posts.name')->where('posts.brand_id',$brand_id)->get();

    }

    public function delete($id)
    {
        return Problem::destroy($id);
    }

    public function activate($ids)
    {
        return Problem::whereIn('id', $ids)->update(array('status' => 1));
    }

    public function deactivate($ids)
    {
        return Problem::whereIn('id', $ids)->update(array('status' => 0));
    }

    public function trash($ids)
    {
        return Problem::whereIn('id', $ids)->update(array('status' => 0,'deleted_at' => date('y-m-d H:i:s')));
    }

    public function untrash($ids)
    {
        return Problem::withTrashed()->whereIn('id', $ids)->update(array('status' => 1,'deleted_at' => null));
    }
}