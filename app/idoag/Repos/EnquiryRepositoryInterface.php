<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 17-11-2015
 * Time: 12:55
 */
namespace idoag\Repos;

interface EnquiryRepositoryInterface
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