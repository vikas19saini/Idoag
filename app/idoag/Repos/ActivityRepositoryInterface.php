<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 17-05-2016
 * Time: 17:05
 */
namespace idoag\Repos;

interface ActivityRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($fields);

    public function getByUserId($user_id);

    public function getWhere($column, $value, $trash = null);

    public function delete($id);

    public function brandChangeToVisitStatus($brand_id);

    public function studentChangeToVisitStatus($user_id);

    public function trash($ids);

    public function deleteByTypeAndUserId($user_id, $type);

    public function untrash($ids);
}