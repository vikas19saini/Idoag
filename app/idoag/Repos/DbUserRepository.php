<?php namespace idoag\Repos;

use \User;
use \DB;
use \Sentry;

class DbUserRepository implements UserRepositoryInterface {


	public function getAll()
	{
		return User::all();
	}
    public function getCount()
    {
        return User::count();
    }
	
	public function getUsersByGroup($group)
	{
		return Sentry::findAllUsersInGroup($group);
	}

    public function getUsersByIds($ids)
    {
        return User::whereIn('id', $ids)->get();
    }
	
	public function find($id)
	{
		return User::findOrFail($id);
	}

	public function getUsersByInstitution($institution_id)
	{
	    return User::where('institution_id', $institution_id)->get();
	}

    public function getUsersByBrand($brand_id)
    {
        return User::where('brand_id', $brand_id)->get();
    }


    public function updateGroup($user_id, $group_id)
    {
    	DB::table('users_groups')
            ->where('user_id', $user_id)
            ->update(array('group_id' => $group_id));
    }

	public function findByCardNumber($value)
	{
		return User::where('card_number', $value)->first();
	}
    public function create($fields)
    {
    	return Sentry::createUser($fields);
    }
	
		public function getCountByGroup($group)
	{
		return count(Sentry::findAllUsersInGroup($group));
	}


	public function getTotalCount()
	{
		return User::count();
	}
	
	public function findGroupByName($group)
	{
		return Sentry::findGroupByName($group);
	}
	
	public function findByEmail($field)
	{
		return User::where('email', $field)->first();
	}
	
	public function getWhere($column, $value)
	{
		return User::where($column, $value)->get();
	}
	
	public function delete($id)
	{
		return User::destroy($id);
	}
	
	public function activate($ids)
	{
		return User::whereIn('id', $ids)->update(array('activated' => 1));
	}
	
	public function deactivate($ids)
	{
		return User::whereIn('id', $ids)->update(array('activated' => 0));
	}
	
	public function trash($ids)
	{
		return User::whereIn('id', $ids)->update(array('activated' => 0, 'deleted_at' => date('y-m-d H:i:s')));
	}
	
	public function untrash($ids)
	{
   		return DB::table('users')->whereIn('id', $ids)->update(array('activated' => 1, 'deleted_at' => null));
	}
	
	public function profilePicture($id,$image)
	{
		return User::where('id', $id)->update(array('profile_image' => $image));
	}


}