<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 04-11-2015
 * Time: 15:52
 */
namespace idoag\Repos;

interface InstitutionsFollowsRepositoryInterface
{
    public function getAll();

    public function getList();

    public function getUsers($id);

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

    public function getInstitutionsFollowing($user_id);

    public function checkFollows($institution_id, $user_id);

    public function follows($institution_id, $user_id);
}