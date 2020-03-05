<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class User extends Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface {
		
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	use SoftDeletingTrait;
    
    protected $table = 'users';	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
		
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function boot()
    {
        self::$hasher = new Cartalyst\Sentry\Hashing\NativeHasher;
    }

    public function isCurrent()
    {
        if (!Sentry::check()) return false;

        return Sentry::getUser()->id == $this->id;
    }
	
	public function getPersistCode()
    {
        if (!$this->persist_code)
        {
            $this->persist_code = $this->getRandomString();

            // Our code got hashed
            $persistCode = $this->persist_code;

            $this->save();

            return $persistCode;            
        }
        return $this->persist_code;
    }

	public function brand(){
		return $this->hasMany('Brand');
	}
    public function getProfile()
    {
        return $this->hasOne('StudentDetails','user_id');
    }
    public function brandFollows()
    {
        return $this->belongsToMany('BrandsFollows');
    }
    public function insFollows()
    {
        return $this->belongsToMany('InstitutionsFollows');
    }
    public function group()
    {
        return $this->hasOne('InstitutionsFollows');
    }
    public function getInstitute()
    {
        return StudentDetails::where('user_id', $this->id)->pluck('institution_id');
    }


}