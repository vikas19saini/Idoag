<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 18-03-2016
 * Time: 17:33
 */
namespace idoag\Repos;

interface PincodeRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($fields);

    public function getWhere($column, $value, $trash = null);

    public function getByPincode($pincode);

    public function delete($id);

    public function trash($ids);
}