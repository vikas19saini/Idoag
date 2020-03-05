<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Student\StudentRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Forms\adminStudentUserRegistrationForm;
use idoag\Forms\adminStudentUserEditForm;


Class AdminStudentUsersController extends \BaseController {

	/**
	 * @var $user
	 *
	 */
	protected $user;

	/**
	 * @var $adminStudentUserRegistrationForm
	 *
	 */
	protected $adminStudentUserRegistrationForm;

	/**
	 * @var $adminStudentUserEditForm
	 *
	 */
	protected $adminStudentUserEditForm;

	/**
	 * @var $institution
	 *
	 */
	protected $institution;

	/**
	 * AdminStudentUsersController Constructor function
	 *
	 */
	function __construct(UserRepositoryInterface $user, StudentDetailsRepositoryInterface $studentDetails,adminStudentUserRegistrationForm $adminStudentUserRegistrationForm, adminStudentUserEditForm $adminStudentUserEditForm, StudentRepositoryInterface $student, InstitutionRepositoryInterface $institution)
	{
		$this->user									= $user;

		$this->adminStudentUserRegistrationForm 	= $adminStudentUserRegistrationForm;

		$this->adminStudentUserEditForm 			= $adminStudentUserEditForm;

		$this->student 								= $student;

        $this->student_details              		= $studentDetails;

		$this->institution							= $institution;

		}
	// method to list all the Students users
	public function index()
	{
// 		$students	= $this->user->findGroupByName('students');

//		$users		= $this->user->getUsersByGroup($students);
        $institutions = $this->institution->getList();
        $filter = array('institution' => '', 'status' => '', 'startdate' => '', 'enddate' => '');
        return View::make('admin.stud_users.index', compact('institutions', 'filter'));
	}

	// method to create a new Student user
	public function create()
	{

		$institutions = $this->institution->getList(); //print_r($institutions);exit();

		return View::make('admin.stud_users.create')->withInstitutions($institutions);
	}

	// method to process a new student user creation
	public function store()
	{
		$input = Input::all();
        $student_data  = array();

		try
		{
			$this->adminStudentUserRegistrationForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {

			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		//echo "<pre>";print_r($input);exit;

		$password 	= Hash::make('password');

		$input 		= array_add($input, 'password', $password);

		$name        =Input::get('first_name').' '.Input::get('last_name');

		$user 		= $this->user->create($input);

		// Find the group using the group name
		$usersGroup = Sentry::findGroupByName('Students');

		// Assign the group to the user
		$user->addGroup($usersGroup);

        $student_data  = array_add($student_data,'user_id',$user->id);
        $student_data  = array_add($student_data,'name',$name);
        $student_data  = array_add($student_data,'email',Input::get('email'));
        $student_data  = array_add($student_data,'institution',getInstitutionName(Input::get('institution')));
		$student_data  = array_add($student_data,'institution_id',getInstitutionId(Input::get('institution')));
        // $student_data  = array_add($student_data,'course',$student['streamorcourse']);
        // $student_data  = array_add($student_data,'roll_no',$student['rollno']);
        $student_data  = array_add($student_data,'card_number',Input::get('card_number'));
        // $student_data  = array_add($student_data,'dob',$credentials['dob']);
        $student_data  = array_add($student_data,'expiry',Input::get('expiry_date'));

      	$student_data  = array_add($student_data,'color','#087c8b');

      	$studentdetails = $this->student_details->create($student_data);


		// $student_data  = array_add($student_data,'validity_for_how_many_years',$student['validity_for_how_many_years']);
		// $student_data  = array_add($student_data,'cluborgrouporsociety',$student['cluborgrouporsociety']);
		// $student_data  = array_add($student_data,'residentordayscholar',$student['residentordayscholar']);
		// $student_data  = array_add($student_data,'date_of_issue',$student['date_of_issue']);
		// $student_data  = array_add($student_data,'section',$student['section']);
		// $student_data  = array_add($student_data,'father_name',$student['father_name']);
		// $student_data  = array_add($student_data,'batch_year',$student['batch_year']);
		// $student_data  = array_add($student_data,'program_duration',$student['program_duration']);


		$data = array();

 		$resetCode = $user->getResetPasswordCode();

		$data['token'] 		= $resetCode;
        $data['first_name'] = $user->first_name;
        $data['email'] 		= Input::get('email');

		Mailgun::send('emails.admin_activate', $data, function($message) use($user)
		{
			$message->subject('Activate your Idoag Account');
			$message->to($user->email, $user->first_name);

		});

		return Redirect::back()->withFlashMessage('Student User added successfully');

	}

	// method to show edit form for exisitng institution user
	public function edit($id)
	{
  		$user 	= $this->user->find($id);

        $studentdetails = $this->student_details->findbyUserId($id);

        $institutions = Institution::orderBy('name')->lists('name', 'id');

   //      if($user->email !== $studentdetails->email)
   //      {
   //      	$user_new = new \Illuminate\Database\Eloquent\Collection;

   //      	$user_new = $user;

   //      	$user_new->email = $studentdetails->email;

			// return View::make('admin.stud_users.edit')->withUser($user_new)->withInstitutions($institutions);
   //      }

		return View::make('admin.stud_users.edit',compact('user','institutions','studentdetails'));
	}

	// method to process updation of a institution user
	public function update($id)
	{

		$user 	= $this->user->find($id);

		$newemail = Input::get('email');

		$oldemail = $user->email;

        $studentdetails = $this->student_details->findbyUserId($id);

        if(Input::has('dob'))
        {
        	$studentdetails->dob=Input::get('dob');
			$studentdetails->save();
        }

		if (! Input::has("password"))
		{
			$input = Input::only('mobile' , 'email', 'first_name', 'last_name', 'institution_id');

			try {

				$this->adminStudentUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {
				
				return Redirect::back()->withInput()->withErrors($e->getErrors());
				
			}
			
			if(Input::has('activated'))
			{
				$input['activated'] = Input::get('activated');

			}else {

				$input['activated'] = 0;
			}

			if($newemail !== $oldemail)
			{
		    	    $activationCode  = $user->getActivationCode();

		    	    $input['email'] = $newemail;
			    $input['activated'] = 0;

			    $data = array();

			    $data['token']          = $activationCode;
			    $data['card_number']    = $user->card_number;
			    $data['expiry']         = $user->expiry_date;
			    $data['institution']    = $user->institution;
			    $data['first_name']     = $user->first_name;

			    Mailgun::send('emails.emailchange', $data, function ($message) use ($newemail, $user) {
			    $message->subject('Email change confirmation.');
			    $message->to($newemail, $user->first_name);

			    });
			}

			$user->fill($input)->save();

            $studentdetails->name 			= Input::get('first_name').' '.Input::get('last_name');

            $studentdetails->email 			= Input::get('email');

            $studentdetails->institution_id = Input::get('institution_id');

            $studentdetails->institution    = getInstitutionName(Input::get('institution_id'));

            $studentdetails->save();

			return Redirect::back()->withFlashMessage('You have been successfully updated details!');

		}else
		{
		    $input 		= Input::except('dob');

			try {

				$this->adminStudentUserEditForm->excludeUserId($user->id)->validate($input);

			} catch (\Laracasts\Validation\FormValidationException $e) {

				return Redirect::back()->withInput()->withErrors($e->getErrors());
			}

			if(Input::has('activated'))
			{
				$input['activated'] = Input::get('activated');

			}else {

				$input['activated'] = 0;
			}

			if($newemail !== $oldemail)
			{
		    	$activationCode  = $user->getActivationCode();

		    	$input['email'] = $oldemail;
		    	$input['activated'] = 0;

			    $data = array();

			    $data['token']          = $activationCode;
			    $data['card_number']    = $user->card_number;
			    $data['expiry']         = $user->expiry_date;
			    $data['institution']    = $user->institution;
			    $data['first_name']     = $user->first_name;

			    Mailgun::send('emails.emailchange', $data, function ($message) use ($newemail, $user) {
			    $message->subject('Email change confirmation.');
			    $message->to($newemail, $user->first_name);

			    });
			}
			$input['old_password']=NULL;

            $user->fill($input)->save();

            // echo"<pre>";print_r($studentdetails);exit();

            $studentdetails->name 			= Input::get('first_name').' '.Input::get('last_name');

            $studentdetails->email 			= Input::get('email');

            $studentdetails->institution_id = Input::get('institution_id');

            $studentdetails->institution    = getInstitutionName(Input::get('institution_id'));

            $studentdetails->save();

			return Redirect::back()->withFlashMessage('You have been successfully updated details!');

		}
	}

	// method to show destroy form for exisitng institution user
	public function destroy($id)
	{

	}

	public function deleteStudentData($id)
	{
		User::where('id', '=', $id)->delete();

		return Redirect::route('admin_students_users')->withFlashMessage('The User has been Deleted');//View::make('admin.stud_users.index')->withStudents($students)->withUsers($users);
	}

	// route to export all institutions users data as an excel sheet
	public function getStudentUsersExcelExport()
	{

		// all types of user roles data
		$institution 	= $this->user->findGroupByName('Students');

		// all institutions users data
		$users	= $this->user->getUsersByGroup($institution);

		$users 	= array_to_object($users);

		$users 	= json_decode(json_encode($users), true);

		// Exporting to excel sheet
		Excel::create('StudentsUsersList', function($excel) use($users) {

			$excel->sheet('StudentsUsers', function($sheet) use($users) {

				$sheet->fromArray($users);

			});

		})->export('xls');

		return Redirect::back()->withFlashMessage('Students Users exported as Excel successfully!');

	}

	// method to import all institutions users data from an excel sheet
	public function postStudentUsersExcelImport()
	{
		$file 		= Input::file('file');

		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);

		$file->move('imports', $filename);

		Excel::load('imports/'.$filename, function($reader) {

			$results = $reader->select(array('institution_id','email','first_name','last_name','mobile','card_number','gender','password','dob','expiry','course','roll_no','validity_for_how_many_years','cluborgrouporsociety','residentordayscholar','date_of_issue','section','father_name','batch_year','program_duration'))->get();

			foreach($results as $result)
			{
				if($result->email)
				{
					$user 	= $this->user->findByEmail($result->email);

					if($user)
					{
						try
						{
							$input = array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'card_number'=>$result->card_number,'old_password' => $result->password,'gender'=>$result->gender, 'expiry_date' => $result->expiry);

							if(is_object($result->expiry))
								$input['expiry_date'] = $result->expiry->format('d-m-Y');
							else
								$input['expiry_date'] = $result->expiry;

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
					}
					else
					{
						try
						{
							$data 		= array();

							$input 		= array('email' => $result->email, 'first_name' => $result->first_name, 'last_name' => $result->last_name, 'mobile' => $result->mobile, 'card_number'=>$result->card_number,'old_password' => $result->password,'gender'=>$result->gender, 'expiry_date' => $result->expiry);

							$inst 		= Institution::find($result->institution_id);

							if($input['email'] == '' || $input['first_name'] == '' || $input['card_number'] == '' || $input['old_password'] == '')
							{
								return Redirect::back()->withErrorMessage('Few important fields are missing or There might be Empty Rows inserted in Excel. Please check and try again.');
							}

							if($inst)
							{
								$input['institution'] 		= $inst->slug;

								$data['institution'] 		= $inst->slug;
							}

							if($input['last_name'] == '')
							{
								$input['last_name'] = NULL;
							}

							if($input['mobile'] == '')
							{
								$input['mobile'] = NULL;
							}

							if($input['gender'] == '')
							{
								$input['gender'] = NULL;
							}

							if($input['expiry_date'] == '')
							{
								$input['expiry_date'] = NULL;
							}

							if(is_object($result->expiry))
								$input['expiry_date'] 	= $result->expiry->format('d-m-Y');
							else
								$input['expiry_date'] 	= $result->expiry;

							$password 					= Hash::make('password');;

							$input 						= array_add($input, 'password', $password);

							$user 						= $this->user->create($input);

							$data['user_id'] 						= $user->id;
							$data['institution_id'] 				= $result->institution_id;
							$data['name'] 							= $result->first_name ." ".$result->last_name;
							$data['dob'] 							= $result->dob;
							$data['expiry'] 						= $result->expiry;
							$data['card_number'] 					= $result->card_number;
							$data['course'] 						= $result->course;
							$data['roll_no'] 						= $result->roll_no;
							$data['email'] 							= $result->email;
							$data['validity_for_how_many_years'] 	= $result->validity_for_how_many_years;
							$data['cluborgrouporsociety'] 			= $result->cluborgrouporsociety;
							$data['residentordayscholar'] 			= $result->residentordayscholar;
							$data['date_of_issue'] 					= $result->date_of_issue;
							$data['section'] 						= $result->section;
							$data['father_name'] 					= $result->father_name;
							$data['batch_year'] 					= $result->batch_year;
							$data['program_duration'] 				= $result->program_duration;

							if($data['expiry'] == '')
							{
								$data['expiry'] = NULL;
							}

							if($data['course'] == '')
							{
								$data['course'] = NULL;
							}

							if($data['roll_no'] == '')
							{
								$data['roll_no'] = NULL;
							}

							if($data['validity_for_how_many_years'] == '')
							{
								$data['validity_for_how_many_years'] = NULL;
							}

							if($data['residentordayscholar'] == '')
							{
								$data['residentordayscholar'] = NULL;
							}

							if($data['date_of_issue'] == '')
							{
								$data['date_of_issue'] = NULL;
							}

							if($data['section'] == '')
							{
								$data['section'] = NULL;
							}

							if($data['father_name'] == '')
							{
								$data['father_name'] = NULL;
							}

							if($data['batch_year'] == '')
							{
								$data['batch_year'] = NULL;
							}

							if($data['program_duration'] == '')
							{
								$data['program_duration'] = NULL;
							}

							//echo"<pre>";print_r($data);
							$student 	= StudentDetails::create($data);

							// Find the group using the group name
							$usersGroup = Sentry::findGroupByName('Students');

							// Assign the group to the user
							$user->addGroup($usersGroup);

							// $data = array();

 							$resetCode = $user->getResetPasswordCode();

							// $data['token'] = $resetCode;

							// $data['first_name'] = $result->first_name;

							// Mailgun::send('emails.admin_activate', $data, function($message) use($user)
							// {
							// 	$message->subject('Activate your Idoag Account');
							// 	$message->to($user->email, $user->first_name);

							// });
						}
						catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);

							return 'Sorry! Something is wrong';
						}
					}
				}
			}
		});

		return Redirect::back()->withFlashMessage('Students Users Imported Successfully');

	}

	public function getStudentUsersSampleExcel()
	{
		Excel::create('StudentUsersSampleExcel', function($excel) {

			$excel->sheet('StudentUsersSampleExcel', function($sheet) {

				$sheet->fromArray(array(array('institution_id','email','first_name','last_name','mobile','card_number','gender','password','dob','expiry','course','roll_no','validity_for_how_many_years','cluborgrouporsociety','residentordayscholar','date_of_issue','section','father_name','batch_year','program_duration'),
								  array('171','example@email.com','John','Legend','9000012345','1231231231231231','M','auVWxens=','31-12-2015','31-12-2015','B. Architecture','11006056','1','','Day Scholar','22-11-2015','BE civil-4','mike jordan','2011','')
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
			});

		})->export('xls');

		return Redirect::back()->withFlashMessage('Students Users exported as Excel successfully!');
	}

	// method to do multi actions on all institutions users
	public function postAdminStudentUsersActions()
	{
		// echo "<pre>";print_r(Input::all());exit;
		$user_ids = Input::get('checkall');

		if($user_ids)
		{

			if(Input::has('Activate'))
			{
				$this->user->activate($user_ids);

				return Redirect::back()->withFlashMessage('Selected Students users Activated');

			}

			if(Input::has('Deactivate'))
			{
				$this->user->deactivate($user_ids);

				return Redirect::back()->withFlashMessage('Selected Students users Deactivated');

			}

			if(Input::has('Trash'))
			{
				//print_r($user_ids);exit();

				$this->user->trash($user_ids);

				return Redirect::back()->withFlashMessage('Selected Students users Trashed');

			}

			if(Input::has('Untrash'))
			{
				$this->user->untrash($user_ids);

				return Redirect::back()->withFlashMessage('Selected Students users Untrashed');

			}
		}
		else
		{
			return Redirect::back()->withErrorMessage('Select atleast some user');
		}
	}

	public function demo()
	{
        return View::make('admin.stud_users.demo');
	}
	
	public function deleteStudent()
	{
        return View::make('admin.stud_users.delete-student');
	}
	
	// Show demo function data for display student data
	private function testMdata($start=1,$length=10,$search,$institute=null)
	{
		// $group = Sentry::findGroupByName('Students');

		// $users = Sentry::findAllUsersInGroup($group);

		// $students_users = new \Illuminate\Database\Eloquent\Collection;

		// $students = new \Illuminate\Database\Eloquent\Collection;

		$users = new \Illuminate\Database\Eloquent\Collection;

		// $students_users = $users;

		if($institute){

                $users = User::join('users_groups', 'users_groups.user_id', '=', 'users.id')
                    ->join('student_details', 'student_details.user_id', '=', 'users.id')
                    ->join('groups', 'users_groups.group_id', '=', 'groups.id')
                    ->where('groups.name','Students')
					->where('users.deleted_at', null)
                    ->where('student_details.institution_id',$institute)
                    ->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
                    ->orderBy('users.created_at', 'desc')->get();

		}else{

            $s = $search['value'];
            if($s=='')
            {
                $users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						->join('institutions', 'institutions.id', '=', 'student_details.institution_id')
						->where('users.deleted_at', null)
						->where('users.card_number', '!=', '')
						->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
						->orderBy('users.created_at', 'desc')->skip($start)->take($length)->get();
            }
            else
            {
			$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						 ->join('institutions', 'institutions.id', '=', 'student_details.institution_id')
						 ->where('users.deleted_at', null)
						 ->where('users.card_number', '!=', '')
					     ->where(function ($query) use ($s) {
							$query->orWhere('users.first_name', '=', $s);
							$query->orWhere('users.last_name', '=', $s);
							$query->orWhere('users.card_number', '=', $s);
							$query->orWhere('users.email', '=', $s);
							$query->orWhere('users.mobile', '=', $s);
						})
						->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
					    ->orderBy('users.created_at', 'desc')->skip($start)->take($length)->get();
		}}

		$data = array();
		

		foreach ($users as $key => $value) {
			//if($value->deleted_at == null){
			$temp = array(
				intval($start)+ $key+1,
				$value -> first_name,
				$value -> last_name,
				$value -> email,
				getInstitutionName($value->institution_id),
				intval($value -> activated),
				$value -> card_number,
				'<a href="/admin/students_users/'.$value->id.'/edit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
				<a href="/admin/student/'.$value->id.'" target="_blank"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="fa fa-list"></i></a>',
                '<input name="checkall[]" type="checkbox" class="checkall" value='.$value->id.'">'
			);

			array_push($data,$temp);
			//}
		}

		/*if(empty($data) && !$institute) {
			$users = Student::where('first_name',$s)
			     ->orwhere('last_name',$s)
				 ->orWhere('card_number',$s)
				 ->orWhere('email_id',$s)
				 ->orWhere('contact_number',$s)
	             ->select('first_name','last_name','email_id','id','card_number','college_id')
			     ->orderBy('created_at', 'desc')->get();
			foreach ($users as $key => $value) {
				
				$temp = array(
					intval($start)+ $key+1,
					$value -> first_name,
					$value -> last_name,
					$value -> email_id,
					getInstitutionName($value->college_id),
					0,
					$value -> card_number,
					'<a href="/admin/students/'.$value->id.'/edit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
					<a href="/admin/student/'.$value->id.'" target="_blank"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="fa fa-list"></i></a>',
	                'This student has been found in Students table and not in users table. So please activate this student in Students section '
				);

				array_push($data,$temp);
			}
     	}*/

		return $data;
	}
	
		// Show demo function data for display student data
	private function deleteMdata($start=1,$length=10,$search,$institute=null)
	{
		// $group = Sentry::findGroupByName('Students');

		// $users = Sentry::findAllUsersInGroup($group);

		// $students_users = new \Illuminate\Database\Eloquent\Collection;

		// $students = new \Illuminate\Database\Eloquent\Collection;

		$users = new \Illuminate\Database\Eloquent\Collection;

		// $students_users = $users;

		if($institute){

                $users = User::join('users_groups', 'users_groups.user_id', '=', 'users.id')
                    ->join('student_details', 'student_details.user_id', '=', 'users.id')
                    ->join('groups', 'users_groups.group_id', '=', 'groups.id')
                    ->where('groups.name','Students')
					->where('users.deleted_at', '!=', '')
					->where('student_details.card_number', '!=', '')
                    ->where('student_details.institution_id',$institute)
                    ->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
                    ->orderBy('users.created_at', 'desc')->get();

		}else{

            $s = $search['value'];
            if($s=='')
            {
                $users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
					->where('users.deleted_at', '!=', '')
                    ->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
                    ->orderBy('users.created_at', 'desc')->skip($start)->take($length)->get();
            }
            else
            {
			$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						 ->where('users.deleted_at', '!=', '')
					     ->where(function ($query) use ($s) {
							$query->orWhere('users.first_name', '=', $s);
							$query->orWhere('users.last_name', '=', $s);
							$query->orWhere('users.card_number', '=', $s);
							$query->orWhere('users.email', '=', $s);
							$query->orWhere('users.mobile', '=', $s);
						})
						 
                         ->select('users.first_name', 'users.deleted_at','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
					     ->orderBy('users.created_at', 'desc')->get();
		}}

		$data = array();
		

		foreach ($users as $key => $value) {
			//if($value->deleted_at == null){
			$temp = array(
				intval($start)+ $key+1,
				$value -> first_name,
				$value -> last_name,
				$value -> email,
				getInstitutionName($value->institution_id),
				intval($value -> activated),
				$value -> card_number
			);

			array_push($data,$temp);
			//}
		}

		/*if(empty($data) && !$institute) {
			$users = Student::where('first_name',$s)
			     ->orwhere('last_name',$s)
				 ->orWhere('card_number',$s)
				 ->orWhere('email_id',$s)
				 ->orWhere('contact_number',$s)
	             ->select('first_name','last_name','email_id','id','card_number','college_id')
			     ->orderBy('created_at', 'desc')->get();
			foreach ($users as $key => $value) {
				
				$temp = array(
					intval($start)+ $key+1,
					$value -> first_name,
					$value -> last_name,
					$value -> email_id,
					getInstitutionName($value->college_id),
					0,
					$value -> card_number
				);

				array_push($data,$temp);
			}
     	}*/

		return $data;
	}
	

	private function getCount($type)
	{	
		if($type == 1){
			$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
					 ->where('users.deleted_at', '!=', '')
				     ->select('users.*')
				     ->orderBy('users.created_at', 'desc')->count();
		}else{
			$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
					 ->join('institutions', 'institutions.id', '=', 'student_details.institution_id')
				     ->where('users.deleted_at', null)
					 ->where('users.card_number', '!=', '')
				     ->select('users.*')
				     ->orderBy('users.created_at', 'desc')->count();
		}
		

		return $users;
	}



	public function InstStudents($id)
    {
        $institution=$this->institution->find($id);
        $users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
            ->where('student_details.institution_id',$id)
            ->select('users.first_name','users.last_name','users.email','users.id','users.activated','users.card_number','student_details.institution_id')
            ->orderBy('users.created_at', 'desc')->get();
         return View::make('admin.stud_users.index',compact('institution','users'));
    }

		private function getSearchCount($s, $type)
	{	
			$val = $s['value'];
			if($type == 1){
				$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						 ->where('users.deleted_at', '!=', '')
						 ->where(function ($query) use ($val) {
							$query->orWhere('users.first_name', '=', $val);
							$query->orWhere('users.last_name', '=', $val);
							$query->orWhere('users.card_number', '=', $val);
							$query->orWhere('users.email', '=', $val);
							$query->orWhere('users.mobile', '=', $val);
							})
						 ->select('users.*')
						 ->orderBy('users.created_at', 'desc')->count();
			}else{
				$users = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						 ->join('institutions', 'institutions.id', '=', 'student_details.institution_id')
						 ->where('users.deleted_at', null)
						 ->where('users.card_number', '!=', '')
					     ->where(function ($query) use ($val) {
							$query->orWhere('users.first_name', '=', $val);
							$query->orWhere('users.last_name', '=', $val);
							$query->orWhere('users.card_number', '=', $val);
							$query->orWhere('users.email', '=', $val);
							$query->orWhere('users.mobile', '=', $val);
							})
				     ->select('users.*')
				     ->orderBy('users.created_at', 'desc')->count();
			}
			
		
		return $users;
	}
	
    public function demodata()
	{
		$search = Input::get('search');
		if($search['value'] != "")
		{
			$data =  [
			  "draw" => intval(Input::get('draw')),
			  "recordsTotal"=> intval($this->getSearchCount($search, 0)),
			  "recordsFiltered"=> intval($this->getSearchCount($search, 0)),
			  "data"=> $this->testMdata(intval(Input::get('start')),intval(Input::get('length')),Input::get('search'))
			];
		}
		else
		{
			$data =  [
			  "draw" => intval(Input::get('draw')),
			  "recordsTotal"=> intval($this->getCount(0)),
			  "recordsFiltered"=> intval($this->getCount(0)),
			  "data"=> $this->testMdata(intval(Input::get('start')),intval(Input::get('length')),Input::get('search'))
			];
		}

		return json_encode($data);//$this->getCount();
	}
	
	public function getdeletedata()
	{
		$search = Input::get('search');

		if($search['value'] != "")
		{
			$data =  [
			  "draw" => intval(Input::get('draw')),
			  "recordsTotal"=> intval($this->getSearchCount($search, 1)),
			  "recordsFiltered"=> intval($this->getSearchCount($search, 1)),
			  "data"=> $this->deleteMdata(intval(Input::get('start')),intval(Input::get('length')),Input::get('search'))
			];
		}
		else
		{
			$data =  [
			  "draw" => intval(Input::get('draw')),
			  "recordsTotal"=> intval($this->getCount(1)),
			  "recordsFiltered"=> intval($this->getCount(1)),
			  "data"=> $this->deleteMdata(intval(Input::get('start')),intval(Input::get('length')),Input::get('search'))
			];
		}

		return json_encode($data);//$this->getCount();
	}

}
