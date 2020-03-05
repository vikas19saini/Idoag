<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30-10-2015
 * Time: 17:19
 */
namespace idoag\Repos;

interface InstitutionRegistrationRepositoryInterface
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