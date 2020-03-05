<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 04-11-2015
 * Time: 14:35
 */
namespace idoag\Repos;

interface InstitutionRepositoryInterface
{
    public function getAll();

    public function getWithLimit($limit);

    public function getInstitutionsByIds($ids);

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
}