<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 17-10-2015
 * Time: 16:45
 */
namespace idoag\Repos;

interface BrandRepository
{
    public function getAll();

    public function getWithLimit($limit);

    public function getBrandsByIds($ids);

    public function getList();

    public function find($id);

    public function create($fields);

    public function findByName($value);

    public function findBySlug($value);

    public function getWhere($column, $value, $trash = null);

    public function delete($id);

    public function activate($ids);

    public function deactivate($ids);

    public function trash($ids);

    public function untrash($ids);

    public function getSlug($slug);

    public function findByCategory($slug);
}