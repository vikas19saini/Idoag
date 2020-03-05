<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Forms\adminUserRegistrationForm;
use idoag\Forms\adminUserEditForm;

class AdminUsersController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $adminUserRegistrationForm 
	 *
	 */
	protected $adminUserRegistrationForm;
	
	/**
	 * @var $adminUserEditForm 
	 *
	 */
	protected $adminUserEditForm;
	
	/**
	 * AdminUsersController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, adminUserRegistrationForm $adminUserRegistrationForm, adminUserEditForm $adminUserEditForm)
	{
		$this->user							= $user;
				
		$this->adminUserRegistrationForm 	= $adminUserRegistrationForm;
		
		$this->adminUserEditForm 			= $adminUserEditForm;
		
		}
	
	// listing all the admin group users
	public function index()
	{
		
		// all types of user roles data
		$admin 			= $this->user->findGroupByName('Admins');	
		
		// all admin users data
		$users			= $this->user->getUsersByGroup($admin);

		
		return View::make('admin.index')
					->withUsers($users)
					->withAdmin($admin);
	}
	
	// listing all types of user roles
	public function getUsersRoles()
	{
	 	// all groups data
	 	$groups		= Sentry::findAllGroups(); //echo"<pre>";print_r($groups);exit();
	 
	 	return View::make('admin.roles')->withGroups($groups);
	 
	}

	// route to add a new admin user type
	public function create()
	{
		return View::make('admin.create');
	}

	// route to process a new user registration
	public function store()
	{
		$input = Input::all();
							
		try 
		{
			$this->adminUserRegistrationForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		$input 		= Input::only('email', 'first_name', 'last_name', 'mobile');
		
		if(Input::has('import_students'))
		{
			$input['import_students'] = Input::get('import_students');
			
		}else {
			
			$input['import_students'] = 0;
		
		}
		
		if(Input::has('manage_categories'))
		{
			$input['manage_categories'] = Input::get('manage_categories');
			
		}else {
			
			$input['manage_categories'] = 0;
		
		}
		
		if(Input::has('manage_institutions'))
		{
			$input['manage_institutions'] = Input::get('manage_institutions');
			
		}else {
			
			$input['manage_institutions'] = 0;
		
		}
		
		if(Input::has('manage_brands'))
		{
			$input['manage_brands'] = Input::get('manage_brands');
			
		}else {
			
			$input['manage_brands'] = 0;
		
		}
		
		if(Input::has('brand_users'))
		{
			$input['brand_users'] = Input::get('brand_users');
			
		}else {
			
			$input['brand_users'] = 0;
		
		}
		
		if(Input::has('manage_vouchers'))
		{
			$input['manage_vouchers'] = Input::get('manage_vouchers');
			
		}else {
			
			$input['manage_vouchers'] = 0;
		
		}
		
		if(Input::has('manage_pincode'))
		{
			$input['manage_pincode'] = Input::get('manage_pincode');
			
		}else {
			
			$input['manage_pincode'] = 0;
		
		}
		
		if(Input::has('manage_advertisements'))
		{
			$input['manage_advertisements'] = Input::get('manage_advertisements');
			
		}else {
			
			$input['manage_advertisements'] = 0;
		
		}
		
		if(Input::has('manage_testimonials'))
		{
			$input['manage_testimonials'] = Input::get('manage_testimonials');
			
		}else {
			
			$input['manage_testimonials'] = 0;
		
		}
		
		//echo "<pre>";print_r($input);exit;
		
		$password 	= Hash::make('password');;
	
		$input 		= array_add($input, 'password', $password);
		
		$user 		= $this->user->create($input);
		
		// Find the group using the group name
		$usersGroup = Sentry::findGroupByName('Admins');
		
		// Assign the group to the user
		$user->addGroup($usersGroup);

		$resetCode = $user->getResetPasswordCode();
		
		$data = array();
		
		$data['token'] = $resetCode;
        $data['first_name'] =$user->first_name;
		
		Mailgun::send('emails.admin_activate', $data, function($message) use($user)
		{
			$message->subject('Activate your Idoag Account');
			$message->to($user->email, $user->first_name);
			
		});
		
		return Redirect::back()->withFlashMessage('Admin User added successfully');
	
	}

	// route to show user profile page
	public function show($id)
	{
		// findin a user by user id
		$user 				= $this->user->find($id);
		
		$view_user_group 	= $user->getGroups()->first()->name;
		
		return View::make('admin.show')
					->withUser($user)
					->withViewUserGroup($view_user_group);
	}

	// route to show edit user profile page
	public function edit($id)
	{
		$user 				= $this->user->find($id);

		$groups 			= Sentry::findAllGroups();
		
		$user_group_id 		= $user->getGroups()->first()->id;
		
		$user_group_name 	= $user->getGroups()->first()->name;

		$array_groups 		= array();

		foreach ($groups as $group) {
			
			$array_groups = array_add($array_groups, $group->id, $group->name);
			
		}
		
		return View::make('admin.edit')
					->withUser($user)
					->withGroups($array_groups)
					->withUserGroupId($user_group_id)
					->withUserGroupName($user_group_name);
	}

	// route to process update profile action
	public function update($id)
	{
		$user = $this->user->find($id);

		if (! Input::has("password"))
		{
			$input = Input::only('mobile' , 'email', 'first_name', 'last_name');

			try {

				$this->adminUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {
				
				return Redirect::back()->withInput()->withErrors($e->getErrors());
			}
			
			if(Input::has('import_students'))
			{
				$input['import_students'] = Input::get('import_students');
				
			}else {
				
				$input['import_students'] = 0;
			
			}
			
			if(Input::has('manage_categories'))
			{
				$input['manage_categories'] = Input::get('manage_categories');
				
			}else {
				
				$input['manage_categories'] = 0;
			
			}
			
			if(Input::has('manage_institutions'))
			{
				$input['manage_institutions'] = Input::get('manage_institutions');
				
			}else {
				
				$input['manage_institutions'] = 0;
			
			}
			
			if(Input::has('manage_brands'))
			{
				$input['manage_brands'] = Input::get('manage_brands');
				
			}else {
				
				$input['manage_brands'] = 0;
			
			}
			
			if(Input::has('brand_users'))
			{
				$input['brand_users'] = Input::get('brand_users');
				
			}else {
				
				$input['brand_users'] = 0;
			
			}
			
			if(Input::has('manage_vouchers'))
			{
				$input['manage_vouchers'] = Input::get('manage_vouchers');
				
			}else {
				
				$input['manage_vouchers'] = 0;
			
			}
			
			if(Input::has('manage_pincode'))
			{
				$input['manage_pincode'] = Input::get('manage_pincode');
				
			}else {
				
				$input['manage_pincode'] = 0;
			
			}
			
			if(Input::has('manage_advertisements'))
			{
				$input['manage_advertisements'] = Input::get('manage_advertisements');
				
			}else {
				
				$input['manage_advertisements'] = 0;
			
			}
			
			if(Input::has('manage_testimonials'))
			{
				$input['manage_testimonials'] = Input::get('manage_testimonials');
				
			}else {
				
				$input['manage_testimonials'] = 0;
			
			}
			
			if(Input::has('activated'))
			{
				$input['activated'] = Input::get('activated');
				
			}else {
				
				$input['activated'] = 0;
			
			}
								
			$user->fill($input)->save();
			
			return Redirect::back()->withFlashMessage('You have been successfully updated details!');
		}

		else
		{
			$input = Input::all();

			try {

				$this->adminUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {
				
				return Redirect::back()->withInput()->withErrors($e->getErrors());
			}
			
			if(Input::has('import_students'))
			{
				$input['import_students'] = Input::get('import_students');
				
			}else {
				
				$input['import_students'] = 0;
			
			}
			
			if(Input::has('manage_categories'))
			{
				$input['manage_categories'] = Input::get('manage_categories');
				
			}else {
				
				$input['manage_categories'] = 0;
			
			}
			
			if(Input::has('manage_institutions'))
			{
				$input['manage_institutions'] = Input::get('manage_institutions');
				
			}else {
				
				$input['manage_institutions'] = 0;
			
			}
			
			if(Input::has('manage_brands'))
			{
				$input['manage_brands'] = Input::get('manage_brands');
				
			}else {
				
				$input['manage_brands'] = 0;
			
			}
			
			if(Input::has('brand_users'))
			{
				$input['brand_users'] = Input::get('brand_users');
				
			}else {
				
				$input['brand_users'] = 0;
			
			}
			
			if(Input::has('manage_vouchers'))
			{
				$input['manage_vouchers'] = Input::get('manage_vouchers');
				
			}else {
				
				$input['manage_vouchers'] = 0;
			
			}
			
			if(Input::has('manage_pincode'))
			{
				$input['manage_pincode'] = Input::get('manage_pincode');
				
			}else {
				
				$input['manage_pincode'] = 0;
			
			}
			
			if(Input::has('manage_advertisements'))
			{
				$input['manage_advertisements'] = Input::get('manage_advertisements');
				
			}else {
				
				$input['manage_advertisements'] = 0;
			
			}
			
			if(Input::has('manage_testimonials'))
			{
				$input['manage_testimonials'] = Input::get('manage_testimonials');
				
			}else {
				
				$input['manage_testimonials'] = 0;
			
			}
		
			if(Input::has('activated'))
			{
				$input['activated'] = Input::get('activated');
				
			}else {
				
				$input['activated'] = 0;
			
			}
			
            $user->fill($input)->save();

            $user->save();
			
			return Redirect::back()->withFlashMessage('You have been successfully updated details!');

		}
		
	}
		
	// route to export all admin users data as an excel sheet
	public function getUserExcelExport()
	{
		
		// all types of user roles data
		$admin 	= $this->user->findGroupByName('Admins');	
		
		// all admin users data
		$users	= $this->user->getUsersByGroup($admin);
		
		$users 	= array_to_object($users);
		
		$users 	= json_decode(json_encode($users), true);
		
		// Exporting to excel sheet							 
		Excel::create('UsersList', function($excel) use($users) {
		
			$excel->sheet('Users', function($sheet) use($users) {
		
				$sheet->fromArray($users);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Users exported as Excel successfully!');
	 
	}
	
	// method to import all admin users data from an excel sheet
	public function postUserExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/userslist.xls', function($reader) {
			
			$results = $reader->select(array('email', 'first_name', 'last_name', 'mobile', 'import_students', 'manage_categories', 'manage_institutions', 'manage_brands', 'manage_offers', 'brand_users', 'manage_vouchers', 'manage_pincode', 'manage_advertisements', 'manage_testimonials', 'activated'))->get();
			
			foreach($results as $result)
			{
				if($result->email)
				{
											
					$user 	= $this->user->findByEmail($result->email);
					
					if($user)
					{
						try
						{
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile);
												
							if($result->import_students)
							{
								$input['import_students'] = $result->import_students;
								
							}
							
							if($result->manage_categories)
							{
								$input['manage_categories'] = $result->manage_categories;
								
							}
							
							if($result->manage_institutions)
							{
								$input['manage_institutions'] = $result->manage_institutions;
								
							}
							
							if($result->manage_brands)
							{
								$input['manage_brands'] = $result->manage_brands;
								
							}
							
							if($result->brand_users)
							{
								$input['brand_users'] = $result->brand_users;
								
							}
							
							if($result->manage_vouchers)
							{
								$input['manage_vouchers'] = $result->manage_vouchers;
								
							}
							
							if($result->manage_pincode)
							{
								$input['manage_pincode'] = $result->manage_pincode;
								
							}
							
							if($result->manage_advertisements)
							{
								$input['manage_advertisements'] = $result->manage_advertisements;
								
							}
							
							if($result->manage_testimonials)
							{
								$input['manage_testimonials'] = $result->manage_testimonials;
								
							}
						
							if($result->activated)
							{
								$input['activated'] = $result->activated;
								
							}
							
							$user->fill($input)->save();
				
							$user->save();	
							
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
						
					} else { 
						
						try
						{
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile);
												
							if($result->import_students)
							{
								$input['import_students'] = $result->import_students;
								
							}
							
							if($result->manage_categories)
							{
								$input['manage_categories'] = $result->manage_categories;
								
							}
							
							if($result->manage_institutions)
							{
								$input['manage_institutions'] = $result->manage_institutions;
								
							}
							
							if($result->manage_brands)
							{
								$input['manage_brands'] = $result->manage_brands;
								
							}
							
							if($result->brand_users)
							{
								$input['brand_users'] = $result->brand_users;
								
							}
							
							if($result->manage_vouchers)
							{
								$input['manage_vouchers'] = $result->manage_vouchers;
								
							}
							
							if($result->manage_pincode)
							{
								$input['manage_pincode'] = $result->manage_pincode;
								
							}
							
							if($result->manage_advertisements)
							{
								$input['manage_advertisements'] = $result->manage_advertisements;
								
							}
							
							if($result->manage_testimonials)
							{
								$input['manage_testimonials'] = $result->manage_testimonials;
								
							}
						
							if($result->activated)
							{
								$input['activated'] = $result->activated;
								
							}
							
							$password 	= Hash::make('password');;
	
							$input 		= array_add($input, 'password', $password);
							
							$user 		= $this->user->create($input);
							
							// Find the group using the group name
							$usersGroup = Sentry::findGroupByName('Admins');
							
							// Assign the group to the user
							$user->addGroup($usersGroup);

							$resetCode = $user->getResetPasswordCode();

							$data = array();
							
							$data['token'] = $resetCode;
							
							Mailgun::send('emails.admin_activate', $data, function($message) use($user)
							{
								$message->subject('Activate your Idoag Account');
								$message->to($user->email, $user->first_name);
								
							});
											
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
					
					}
				}
			}
			
		});
		
		return Redirect::back()->withFlashMessage('Admin Users Imported Successfully');
		
	}
	
	// method to do multi actions on all admin users
	public function postAdminUsersActions()
	{
		//echo "<pre>";print_r(Input::all());
		
		if(Input::has('Activate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->activate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Admin users Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->deactivate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Admin users Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->trash($user_ids);	
			
			return Redirect::back()->withFlashMessage('Admin users Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->untrash($user_ids);	
			
			return Redirect::back()->withFlashMessage('Admin users Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some user');
	}
	
}