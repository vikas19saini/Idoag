<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 14-12-2015
 * Time: 14:36
 */
namespace idoag\Repos;

interface ProblemRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($fields);

    public function getWhere($column, $value, $trash = null);

    public function delete($id);

    public function activate($ids);

    public function deactivate($ids);

    public function trash($ids);

    public function untrash($ids);
}