<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 08-04-2016
 * Time: 17:29
 */
namespace idoag\Repos\Student;

interface StudentInternshipDetailsRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($fields);

    public function getWhere($column, $value, $trash = null);

    public function delete($id);

    public function trash($ids);

    public function untrash($ids);
}