<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 20-03-2016
 * Time: 19:36
 */
namespace idoag\Repos;

interface CardCouponRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($fields);

    public function getWhere($column, $value, $trash = null);

    public function getByCouponCode($code);

    public function delete($id);

    public function trash($ids);

    public function untrash($ids);
}