<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 21-11-2015
 * Time: 16:35
 */
namespace idoag\Repos;

interface FaqCategoryRepositoryInterface
{
    public function getAll();

    public function getList();

    public function find($id);

    public function create($fields);

    public function findByName($value);

    public function getWhere($column, $value, $trash = null);

    public function delete($id);

    public function activate($ids);

    public function deactivate($ids);

    public function trash($ids);

    public function untrash($ids);
}