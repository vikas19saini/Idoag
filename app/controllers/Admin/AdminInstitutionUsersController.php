<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Forms\adminInstitutionUserRegistrationForm;
use idoag\Forms\adminInstitutionUserEditForm;


Class AdminInstitutionUsersController extends \BaseController {

	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $adminInstitutionUserRegistrationForm 
	 *
	 */
	protected $adminInstitutionUserRegistrationForm;
	
	/**
	 * @var $adminInstitutionUserEditForm 
	 *
	 */
	protected $adminInstitutionUserEditForm;
	
	/**
	 * @var $institution 
	 *
	 */
	protected $institution;
	
	/**
	 * AdminInstitutionUsersController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, adminInstitutionUserRegistrationForm $adminInstitutionUserRegistrationForm, adminInstitutionUserEditForm $adminInstitutionUserEditForm, InstitutionRepositoryInterface $institution)
	{
		$this->user										= $user;
				
		$this->adminInstitutionUserRegistrationForm 	= $adminInstitutionUserRegistrationForm;
		
		$this->adminInstitutionUserEditForm 			= $adminInstitutionUserEditForm;
		
		$this->institution								= $institution;
		
		}
	// method to list all the Institutions users
	public function index()
	{
	
		$institutions	= $this->user->findGroupByName('institutions');	
		
		$users			= $this->user->getUsersByGroup($institutions);

		return View::make('admin.inst_users.index')
						->withInstitutions($institutions)
						->withUsers($users);	
	}

	// method to create a new Institution user
	public function create()
	{
		$institutions = $this->institution->getList();
		
		return View::make('admin.inst_users.create')
						->withInstitutions($institutions);
	}

	// method to process a new institution user creation
	public function store()
	{
		$input = Input::all();

        $institution_id = Input::get('institution');

        $institution = $this->institution->find($institution_id);

        // echo "<pre>";print_r($input);exit();

        $input 		= array_add($input, 'institution_id', $institution_id);

        $input['institution'] = $institution->name;
							
		try 
		{
			$this->adminInstitutionUserRegistrationForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		
		$password 	= Hash::make('password');
	
		$input 		= array_add($input, 'password', $password);
		
		$user 		= $this->user->create($input);
		
		// Find the group using the group name
		$usersGroup = Sentry::findGroupByName('Institutions');
		
		// Assign the group to the user
		$user->addGroup($usersGroup);
		
		$data = array();

		$resetCode = $user->getResetPasswordCode();		
		
		$data['token'] 				= $resetCode;
        $data['first_name'] 		= $user->first_name;
        $data['institution_name'] 	= getInstitutionName($user->institution_id);
        $data['email'] 				= Input::get('email');

		
		Mailgun::send('emails.admin_activate', $data, function($message) use($user)
		{
			$message->subject('Activate your Idoag  Account - '. $user->institution_name.' Institution');
			$message->to($user->email, $user->first_name);
			
		});
		
		return Redirect::back()->withFlashMessage('Institution User added successfully!');
		
	}

	// method to show edit form for exisitng institution user
	public function edit($id)
	{
		$user 	= $this->user->find($id);
		
		$institutions = $this->institution->getList();
		
		return View::make('admin.inst_users.edit')->withUser($user)->withInstitutions($institutions);
	}

	// method to process updation of a institution user
	public function update($id)
	{
		$user 	= $this->user->find($id);
		
		if (! Input::has("password"))
		{
			$input = Input::only('mobile' , 'email', 'first_name', 'last_name', 'institution');

			try {

				$this->adminInstitutionUserEditForm->excludeUserId($user->id)->validate($input);

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

			try {

				$this->adminInstitutionUserEditForm->excludeUserId($user->id)->validate($input);

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

            $user->save();
			
			return Redirect::back()->withFlashMessage('You have been successfully updated details!');

		}
	}
	
	// route to export all institutions users data as an excel sheet
	public function getInstitutionUsersExcelExport()
	{
		
		// all types of user roles data
		$institution 	= $this->user->findGroupByName('Institutions');	
		
		// all institutions users data
		$users	= $this->user->getUsersByGroup($institution);
		
		$users 	= array_to_object($users);
		
		$users 	= json_decode(json_encode($users), true);
		
		// Exporting to excel sheet							 
		Excel::create('InstitutionsUsersList', function($excel) use($users) {
		
			$excel->sheet('InstitutionsUsers', function($sheet) use($users) {
		
				$sheet->fromArray($users);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Institutions Users exported as Excel successfully!');
	 
	}
	
	// method to import all institutions users data from an excel sheet
	public function postInstitutionUsersExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/'.$filename, function($reader) {
			
			$results = $reader->select(array('email', 'first_name', 'last_name', 'mobile', 'institution', 'activated'))->get();
			
			foreach($results as $result)
			{
				if($result->email)
				{
											
					$user 	= $this->user->findByEmail($result->email);
					
					if($user)
					{
						try
						{
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'institution' => $result->institution);
																		
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
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'institution' => $result->institution);
												
							if($result->activated)
							{
								$input['activated'] = $result->activated;
								
							}
							
							$password 	= Hash::make('password');;
	
							$input 		= array_add($input, 'password', $password);
							
							$user 		= $this->user->create($input);
							
							// Find the group using the group name
							$usersGroup = Sentry::findGroupByName('Institutions');
							
							// Assign the group to the user
							$user->addGroup($usersGroup);
							
							$resetCode = $user->getResetPasswordCode();		
							
							$data = array();
							
							$data['token'] = $resetCode;
                            $data['first_name'] =$user->first_name;
                            $data['institution_name'] = getInstitutionName($user->institution_id);
        					$data['email'] 				=  $result->email;

                            Mailgun::send('emails.activate', $data, function($message) use($user)
							{
                                $message->subject('Activate your Idoag Account  - '. $user->institution_name.' Institution');
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
		
		return Redirect::back()->withFlashMessage('Institutions Users Imported Successfully');
		
	}
	
	public function getInstUsersSampleExcel()
	{
		Excel::create('InstUsersSampleExcel', function($excel) {
		
			$excel->sheet('InstUsersSampleExcel', function($sheet) {
		
				$sheet->fromArray(array(
								  array('email', 'first_name', 'last_name', 'mobile', 'institution'),
								  array('john@gmail.com','john','legend','9023423422','St.Andrews'),
								  array('mike@gmail.com','mike','luke','9023343422','St.Andrews'),
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

	// method to do multi actions on all institutions users
	public function postAdminInstitutionUsersActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->activate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Institutions users Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->deactivate($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Institutions users Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->trash($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Institutions users Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$user_ids = Input::get('checkall');
			
			$this->user->untrash($user_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Institutions users Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some user');
	}
}
