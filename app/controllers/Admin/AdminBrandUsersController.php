<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Forms\adminBrandUserRegistrationForm;
use idoag\Forms\adminBrandUserEditForm;

class AdminBrandUsersController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $adminBrandUserRegistrationForm 
	 *
	 */
	protected $adminBrandUserRegistrationForm;
	
	/**
	 * @var $adminBrandUserEditForm 
	 *
	 */
	protected $adminBrandUserEditForm;
	
	/**
	 * @var $brand 
	 *
	 */
	protected $brand;
	
	/**
	 * AdminBrandUsersController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, adminBrandUserRegistrationForm $adminBrandUserRegistrationForm, adminBrandUserEditForm $adminBrandUserEditForm, BrandRepositoryInterface $brand)
	{
		$this->user								= $user;
				
		$this->adminBrandUserRegistrationForm 	= $adminBrandUserRegistrationForm;
		
		$this->adminBrandUserEditForm 			= $adminBrandUserEditForm;
		
		$this->brand							= $brand;
		

	}
	
	// method to list all the brands users
	public function index()
	{
		// all types of brands roles data
		$brands	= $this->user->findGroupByName('Brands');
		
		// all brands users data
		$users	= $this->user->getUsersByGroup($brands);
				
		return View::make('admin.brand_users.index')
					->withUsers($users);
	}

	// method to create a new brand user
	public function create()
	{
		$brands = $this->brand->getList(); //echo"<pre>"; print_r($brands);exit();
		
		return View::make('admin.brand_users.create')->withBrands($brands);
	}

	// method to process a new brand user creation
	public function store()
	{
		$input = Input::all();

		$brand = Input::get('brand');

		$brand_id = $this->brand->findBySlug($brand);

		$input 		= array_add($input, 'brand_id', $brand_id->id);

		try 
		{
			$this->adminBrandUserRegistrationForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		//echo "<pre>";print_r($input);exit;
		
		$password 	= Hash::make('password'); //echo $password;exit;
	
		$input 		= array_add($input, 'password', $password);
		
		$user 		= $this->user->create($input);
		
		// Find the group using the group name
		$usersGroup = Sentry::findGroupByName('Brands');
		
		// Assign the group to the user
		$user->addGroup($usersGroup);
		
		$data = array();

 		$resetCode = $user->getResetPasswordCode();		
		
		//$data['token'] = base64_encode($user->email);

		$data['token'] 		= $resetCode;

		$data['first_name'] = $user->first_name;

        $data['brand_name'] = getBrandName($user->brand_id);

        $data['email'] 		= Input::get('email');


        Mailgun::send('emails.admin_activate', $data, function($message) use($user)
		{
			$message->subject('IDOAG Account for - '. $user->brand_name.' Brand');
			$message->to($user->email, $user->first_name);
			
		});
		
		return Redirect::back()->withFlashMessage('Brand User added successfully!');
		
	}

	// method to show edit form for exisitng brand user
	public function edit($id)
	{
		$user 	= $this->user->find($id);
		
		$brands = $this->brand->getList();
		
		return View::make('admin.brand_users.edit')->withUser($user)->withBrands($brands);
	}

	// method to process updation of a brand user
	public function update($id)
	{
		$user 	= $this->user->find($id);
		
		$brand = Input::get('brand');

		$brand_id = $this->brand->findBySlug($brand);
		// echo"<pre>";print_r($user);exit();

		if (! Input::has("password"))
		{
			$input = Input::only('mobile' , 'email', 'first_name', 'last_name', 'brand');

			$input = array_add($input, 'brand_id', $brand_id->id);

			try {

				$this->adminBrandUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {
				
				return Redirect::back()->withInput()->withErrors($e->getErrors());
			}
			
			if(Input::has('activated'))
			{
				$input['activated'] = Input::get('activated');
				
			}else {
				
				$input['activated'] = 0;
			
			}
								
			$user->fill($input)->save();
			
			return Redirect::back()->withFlashMessage('You have been successfully updated details!');
		
		}else
		{
			$input = Input::all();

			$input = array_add($input, 'brand_id', $brand_id->id);

			try {

				$this->adminBrandUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {
				
				return Redirect::back()->withInput()->withErrors($e->getErrors());
			}
			// echo"<pre>";print_r($input);exit();

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

	// route to export all brands users data as an excel sheet
	public function getBrandUsersExcelExport()
	{
		
		// all types of user roles data
		$brand 	= $this->user->findGroupByName('Brands');	
		
		// all brands users data
		$users	= $this->user->getUsersByGroup($brand);
		
		$users 	= array_to_object($users);
		
		$users 	= json_decode(json_encode($users), true);
		
		// Exporting to excel sheet							 
		Excel::create('BrandsUsersList', function($excel) use($users) {
		
			$excel->sheet('BrandsUsers', function($sheet) use($users) {
		
				$sheet->fromArray($users);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Brands Users exported as Excel successfully!');
	 
	}
	
	// method to import all brands users data from an excel sheet
	public function postBrandUsersExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/'.$filename, function($reader) {
			
			$results = $reader->select(array('email', 'first_name', 'last_name', 'mobile', 'brand', 'activated'))->get();
			
			foreach($results as $result)
			{
				if($result->email)
				{
											
					$user 	= $this->user->findByEmail($result->email);
					
					if($user)
					{
						try
						{
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'brand' => $result->brand);
																		
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
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'brand' => $result->brand);
												
							if($result->activated)
							{
								$input['activated'] = $result->activated;
								
							}
							
							$password 	= Hash::make('password');;
	
							$input 		= array_add($input, 'password', $password);
							
							$user 		= $this->user->create($input);
							
							// Find the group using the group name
							$usersGroup = Sentry::findGroupByName('Brands');
							
							// Assign the group to the user
							$user->addGroup($usersGroup);

 							$resetCode = $user->getResetPasswordCode();		
							
							$data = array();
							
							$data['token'] 		= $resetCode;
							
							$data['first_name'] = $user->first_name;

                            $data['brand_name'] = getBrandName($user->brand_id);

                            $data['email'] 		=  $result->email;

							Mailgun::send('emails.admin_activate', $data, function($message) use($user)
							{
                                $message->subject('Activate your Idoag Account  - '. $user->brand_name.' Brand');
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
		
		return Redirect::back()->withFlashMessage('Brands Users Imported Successfully');
		
	}
	
	public function getBrandUsersSampleExcel()
	{
		Excel::create('BrandsUsersSampleExcel', function($excel) {
		
			$excel->sheet('BrandsUsersSampleExcel', function($sheet) {
		
				$sheet->fromArray(array(
								  array('email', 'first_name', 'last_name', 'mobile', 'brand', 'activated'),
								  array('john@gmail.com','john','legend','9023423422','Amazon','1'),
								  array('mike@gmail.com','mike','luke','9023343422','Amazon','0'),
								  ),null,'A1',false,false);
				
				$sheet->setStyle(array(
                	'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  12,
                    'bold'      =>  true
                    )
                ));

				$sheet->cells('A2:T2', function($cells) {

				    $cells->setFontSize(10);
				    $cells->setFontWeight('');

				});                     

				$sheet->cells('A3:T3', function($cells) {

				    $cells->setFontSize(10);
				    $cells->setFontWeight('');

				}); 
			});

		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Students Users exported as Excel successfully!');		
	}	
	// method to do multi actions on all brands users
	public function postAdminBrandUsersActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->activate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Brands users Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->deactivate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Brands users Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->trash($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Brands users Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{


			$user_ids = Input::get('checkall');

			 $this->user->untrash($user_ids);

			return Redirect::back()->withFlashMessage('Selected Brands users Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some user');
	}

}