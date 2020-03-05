<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Student\StudentRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Forms\adminNewStudentForm;
use idoag\Repos\BrandsFollowsRepositoryInterface;
use idoag\Repos\InstitutionsFollowsRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Student\UserCouponRepositoryInterface;


Class AdminStudentsController extends \BaseController {

	/**
	 * @var $user
	 *
	 */
	protected $user;

	/**
	 * @var $adminStudentUserRegistrationForm
	 *
	 */
	protected $adminNewStudentForm;

	/**
	 * @var $institution
	 *
	 */
	protected $student;

    protected $feedback;

    private $note;

    private $user_coupon;


    /**
	 * AdminStudentsController Constructor function
	 *
	 */
	function __construct(UserRepositoryInterface $user, UserCouponRepositoryInterface $user_coupon, FeedbackRepositoryInterface $note,  BrandRepositoryInterface $brand, FeedbackRepositoryInterface $feedback, InstitutionsFollowsRepositoryInterface $institution_follows, BrandsFollowsRepositoryInterface $brands_follows,PostsVisitsRepositoryInterface $posts_visits, PostsLikesRepositoryInterface $posts_likes,  adminNewStudentForm $adminNewStudentForm , StudentRepositoryInterface $student, InstitutionRepositoryInterface $institution)
	{
		$this->user									= $user;

		$this->adminNewStudentForm 					= $adminNewStudentForm;

		$this->student								= $student;

        $this->brand								= $brand;

        $this->institution							= $institution;

        $this->feedback 	= $feedback;

        $this->note             = $note;

        $this->posts_likes 	= $posts_likes;

        $this->posts_visits = $posts_visits;
        $this->user_coupon   			= $user_coupon;

        cloudinary();

		}

	// method to list all the Students users
	public function index()
	{
		$institutions = $this->institution->getList();

		return View::make('admin.students.search')->withInstitutions($institutions);
	}

	// method to show student creation form
	public function create()
	{

		return View::make('admin.students.create');
	}

	// method to proces student creation
	public function store()
	{
		$input = Input::all();

		try
		{
			$this->adminNewStudentForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {

			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		$student = $this->student->create($input);

		return Redirect::back()->withFlashMessage('Student have been successfully created!');

	}

	// method to show student updation form
	public function edit($id)
	{
		$student 		= $this->student->find($id);
		$institutions = $this->institution->getList();
		return View::make('admin.students.edit')->withStudent($student)->withInstitutions($institutions);
	}

	// method to process student updation
	public function update($id)
	{
		$input 			= Input::all();

		$student 		= $this->student->find($id);

		// try
		// {
		// 	$this->adminNewStudentForm->excludeUserId($student->id)->validate($input);

		// } catch (\Laracasts\Validation\FormValidationException $e) {

		// 	return Redirect::back()->withInput()->withErrors($e->getErrors());
		// }

		//echo "<pre>";print_r($categories);exit;

		$student->fill($input)->save();

		return Redirect::back()->withFlashMessage('Student have been successfully updated!');
	}

	// route to export all brands data as an excel sheet

    public function studentDashboard($id)
    {

        $user = User::find($id);

        $student = StudentDetails::where('user_id',$id)->first();

        $brand_ids = BrandsFollows::where('user_id', $id)->lists('brand_id');
        $brands=$this->brand->getBrandsByIds($brand_ids);

        $institution_ids = InstitutionsFollows::where('user_id',$id)->groupBy('institution_id')->lists('institution_id');

        $institutions=$this->institution->getInstitutionsByIds($institution_ids);

        $coupons_used    = $this->user_coupon->getByUserId($id);


        $statistics=array();
        $statistics['total_feedback_count'] = $this->feedback->getTotalByUser($id);
        $statistics['posts_visits_count'] = $this->posts_likes->getCountByUser($id);
        $statistics['posts_likes_count'] = $this->posts_visits->getCountByUser($id);
        $statistics['institutions_count'] = InstitutionsFollows::where('user_id', $id)->count();
        $statistics['brands_count'] = BrandsFollows::where('user_id', $id)->count();
        $statistics['internships_count'] =  Internship::where('user_id', $id)->count();

        $activities = Activity::where('user_id',$id)->groupBy('created_at')->orderBy('created_at','desc')->get();

        $output = array();

        foreach ($activities as $key => $value) {

            // echo('<pre>');print_r($value->created_at->format('Y-m-d'));
            if(isset($output[$value->created_at->format('Y-m-d')]))
            {
                $output[$value->created_at->format('Y-m-d')][] = $value;
            } else
            {
                $output[$value->created_at->format('Y-m-d')][] = $value;
            }
        }

        $feedbacks = $this->note->getByUser($id);

        $internships= Internship::where('user_id', $id)->with('post')->orderBy('id','desc')->get();

       // echo '<pre>';print_r($internships);exit();
       // dd($institution_ids);

        return View::make('admin.students.dashboard', compact('user','student','internships','output','coupons_used','brands','statistics','institutions','feedbacks','internships'));
    }

    public function userDateActivity()
    {
        $input = Input::all();
        $statistics=array();
        $id=$input['user_id'];
        $internships= Internship::where('user_id', $id)->with('post')->whereBetween('created_at',array($input['startdate'].' 00:00:01', $input['enddate'].' 23:59:59'))->orderBy('id','desc')->get();
        $statistics['posts_visits_count'] = $this->posts_likes->getCountByUserWithDateRange($id,$input['startdate'],$input['enddate']);
        $statistics['posts_likes_count'] = $this->posts_visits->getCountByUserWithDateRange($id,$input['startdate'],$input['enddate']);

        return View::make('admin.partials.student_activity', compact('internships','statistics'));
    }
    public function getStudentsExcelExport()
	{

		$students 	= $this->student->getAll();

		$students	= array_to_object($students);

		$students 	= json_decode(json_encode($students), true);

		// Exporting to excel sheet
		Excel::create('StudentsList', function($excel) use($students) {

			$excel->sheet('Students', function($sheet) use($students) {

				$sheet->fromArray($students);

			});

		})->export('xls');

		return Redirect::back()->withFlashMessage('Students exported as Excel successfully!');

	}


	public function getStudentsDuplicateDataExcelExport()
	{

		$students 	= DuplicateStudentData::all();

		$students	= array_to_object($students);

		$students 	= json_decode(json_encode($students), true);

		// Exporting to excel sheet
		Excel::create('StudentsDuplicatesList', function($excel) use($students) {

			$excel->sheet('Students', function($sheet) use($students) {

				$sheet->fromArray($students);

			});

		})->export('xls');

		return Redirect::back()->withFlashMessage('Students exported as Excel successfully!');

	}

	// method to import all institutions users data from an excel sheet
	public function postStudentsExcelImport(){
 		$input = array(); $success = array();
		$file 		= Input::file('file');
		$filename 	= Str::lower(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.'  .$file->getClientOriginalExtension());
		$file->move('imports', $filename);
                
        $results = Excel::selectSheets('StudentUsersDataSample')->load('imports/' . $filename, function($reader) { 
			
        })->toArray();
        
			foreach($results as $result)
			{
				$card_number 		 = $result['card_number'];
				$dob                     = $result['dob'];
				$date_of_issue 		 = $result['date_of_issue']; 
				$expiry_date 		 = $result['expiry_date']; 

				if($result['dob'] == '' || $result['first_name'] == '' || $result['card_number'] == '' || $result['expiry_date'] == '')
				{
					return Redirect::back()->withErrorMessage('Few important fields are missing or There might be Empty Rows inserted in Excel. Please check and try again.');
				}
                                
				if($card_number && $dob)
				{
					$cardnumber_check = $this->student->findByCardNumber($card_number);

					if(!empty($cardnumber_check))
					{
						$exists = DuplicateStudentData::where('card_number' , $card_number)->first();

						if(!$exists)
						{
							DuplicateStudentData::create($result);

							$input[] = $result['card_number'];

						}
						else
						{
							$input[] = $result['card_number'];

						}
					}
					else
					{
						if(is_object($result['dob']))
								$result['dob'] = $dob->format('d-m-Y');
						else
							$result['dob'] = str_replace('p','', $dob);

						if(is_object($result['date_of_issue']))
							$result['date_of_issue'] = $date_of_issue->format('d-m-Y');
						else
							$result['date_of_issue'] = str_replace('p','', $date_of_issue);

						if(is_object($result['expiry_date']))
							$result['expiry_date'] = $expiry_date->format('d-m-Y');
						else
							$result['expiry_date'] = str_replace('p','', $expiry_date);
						
						$result['filename'] = $filename;
						$result['uploaddate'] = date('Y-m-d H:M');
						DB::transaction(function() use($result)
						{
							$this->student->create($result);
						});

						$success[] = $result['card_number'];
					}
				}
				else
				{
					return Redirect::back()->withErrorMessage('Few important fields are missing or There might be Empty Rows inserted in Excel');
				}
			}

		if(!empty($input) && !empty($success))
		{
			return Redirect::back()->withFlashMessage('Few Students('.count($success).') Users Imported Successfully')->withErrorMessage('Few Duplicate records have been found. Please check the Duplicates Data.');
		}
		elseif(!empty($input) && empty($success))
		{
			return Redirect::back()->withErrorMessage('Duplicate records have been found. Please check the Duplicates Data.');
		}
		else
		{
			return Redirect::back()->withFlashMessage(count($success). ' Student Users Imported Successfully');
		}
	}

	public function getStudentUsersDataSampleExcel()
	{
		Excel::create('StudentUsersDataSample', function($excel) {

			$excel->sheet('StudentUsersDataSample', function($sheet) {

				$sheet->fromArray(array(array('card_number', 'rollno', 'rol_no', 'contact_number', 'first_name', 'last_name', 'dob', 'college_id', 'streamorcourse', 'validity_for_how_many_years', 'cluborgrouporsociety', 'residentordayscholar', 'date_of_issue', 'expiry_date', 'section', 'father_name', 'batch_year', 'program_duration', 'email_id', 'gender', 'type'),
				array('1234123412341234','1234123','123123','1231231231','john','legend','11-03-1993','171','B. Architecture','1','','DayScholar','01-01-2015','31-12-2015','X78492','M.B.Pulami','2010','5','aman@gmail.com','M', 'student/corporate'),
				),null,'A1',false,false);

				$sheet->setStyle(array(
                	'font' 		=> array(
                    'name'      =>  'Calibri',
                    'size'      =>  12,
                    'bold'      =>  true
                    )
                ));

				$sheet->setColumnFormat(array(
				    'A' => '@',
				    'B' => '@',
				    'G' => '@',
				));

				$sheet->cells('A2:T2', function($cells) {

				    $cells->setFontSize(10);
				    $cells->setFontWeight('');

				});

			});

		})->export('xls');

		return Redirect::back()->withFlashMessage('Students Users exported as Excel successfully!');
	}

	// method to do multi actions on selected students
	public function postAdminStudentsActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		$students = Input::get('checkall');
		if($students)
		{

			if(Input::has('Activate'))
			{
				//$students = Input::get('checkall');

				$this->student->activate($students);

				return Redirect::back()->withFlashMessage('Selected students Activated');

			}

			if(Input::has('Deactivate'))
			{
				//$students = Input::get('checkall');

				$this->student->deactivate($students);

				return Redirect::back()->withFlashMessage('Selected students Deactivated');

			}

			if(Input::has('Trash'))
			{
				$students = Input::get('checkall');

				$seletQuery = DB::table('student_data')
				->select('student_data.*')
				->where('id', $students)
				->get();
				$alldata = array();
				foreach($seletQuery as $key){
					array_push($alldata, $key->card_number);
				}
				
				DB::table('student_data')->whereIn('card_number', $alldata)->delete();
				DB::table('users')->whereIn('card_number', $alldata)->delete();
				DB::table('student_details')->whereIn('card_number', $alldata)->delete();

				//$this->student->trash($students);

				return Redirect::back()->withFlashMessage('Selected students Trashed');

			}

			if(Input::has('Untrash'))
			{
				//$students = Input::get('checkall');

				$this->student->untrash($students);

				return Redirect::back()->withFlashMessage('Selected students Untrashed');

			}
		}
		else
		{
			return Redirect::back()->withErrorMessage('Select atleast some students');
		}

	}

	public function insertData(){
		ini_set('max_execution_time', 5000);
		
		/* Start - Run this query first */
		
		// $getRecords = DB::select("SELECT count(`card_number`) as repeatdata, `card_number` , `id`, `deleted_at`
									// FROM `student_data`
									// GROUP BY `card_number`
									// HAVING repeatdata >1");
				// foreach($getRecords as $key){
					// if(isset($key->deleted_at)){
						// DB::table('student_data')->where(['id' => $key->id])->delete();
					// }
				// }
				
		/* End - Run this query first */
		
			
		/* Run second query */
		
		//$data = array();
		// $getRecords = DB::select("SELECT student_details.card_number, student_details.roll_no , users.mobile, 
									// users.first_name, users.last_name, 
									// student_details.dob, student_details.institution_id, student_details.course, student_details.validity_for_how_many_years, 
									// student_details.cluborgrouporsociety, student_details.residentordayscholar, student_details.date_of_issue, student_details.expiry, 
									// student_details.section, student_details.father_name, student_details.batch_year, student_details.program_duration, users.email, 
									// users.gender, users.created_at, users.updated_at FROM `users` 
									// Inner Join student_details On student_details.user_id = users.id 
									// WHERE users.first_name != 'Null' AND users.card_number != '' AND users.`card_number` NOT IN (select card_number from student_data)");
									// foreach($getRecords as $key){
							
										// DB::table('student_data')->insert(['card_number' => $key->card_number, 
										// 'rollno' => $key->roll_no,
										// 'contact_number' => $key->mobile, 
										// 'first_name' => $key->first_name, 
										// 'last_name' => $key->last_name,
										// 'dob' => $key->dob,
										// 'college_id' => $key->institution_id,
										// 'streamorcourse' => $key->course,
										// 'validity_for_how_many_years' => $key->validity_for_how_many_years,
										// 'cluborgrouporsociety' => $key->cluborgrouporsociety,
										// 'residentordayscholar' => $key->residentordayscholar,
										// 'date_of_issue' => $key->date_of_issue,
										// 'expiry_date' => $key->expiry,
										// 'section' => $key->section,
										// 'father_name' => $key->father_name,
										// 'batch_year' => $key->batch_year,
										// 'program_duration' => $key->program_duration,
										// 'email_id' => $key->email,
										// 'gender' => $key->gender,
										// 'created_at' => $key->created_at,
										// 'updated_at' => $key->updated_at,
										// 'status' => 1]);
										 
									// }
		/* End of second query*/	
		
		/* Run third query*/
		
		// $getRecords = DB::select("SELECT `card_number`, `deleted_at` FROM `student_data` where `deleted_at` IS NOT Null");
		// foreach($getRecords as $key){
			// DB::table('student_details')->where(['card_number' => $key->card_number])->delete();
			//DB::table('users')->where(['card_number' => $key->card_number])->delete();

		// }
		
		/* End of third query*/	
		
		/* Run fourth query*/	
		
		// $students = DB::select("SELECT `card_number`, `deleted_at`, `first_name`, `last_name`, `college_id` FROM `student_data` where `deleted_at` IS NOT Null");

		// $students	= array_to_object($students);

		// $students 	= json_decode(json_encode($students), true);

		// Excel::create('StudentsDeleteList', function($excel) use($students) {

			// $excel->sheet('Students', function($sheet) use($students) {

				// $sheet->fromArray($students);

			// });

		// })->export('xls');
		
		$dataArray = array();
					//$students = DB::select("SELECT card_number FROM `student_data` where deleted_at IS NULL");
					$students = DB::select("SELECT card_number FROM `student_data`");
					$students = array_to_object($students);
					$students 	= json_decode(json_encode($students), true);
					foreach($students as $key){
						$dataArray[] = $key['card_number'];
					}
	
        $results = Excel::load('INIFD EXTRAS.xlsx', function($reader) {})->toArray();
		$students = array();
		$data['card_number'] = 'Card Number';
		$student[] = $data;
		foreach($results as $key){
					//foreach($key as $datakey){

			$card_number = $key['card_number'];
			if(!in_array($card_number, $dataArray)){
				//array_push($arrayNotInData, $card_number);
				$data['card_number'] = $card_number;
				$students[] = $data;
			}
					//}

		}
		
		Excel::create('StudentsNotInDataList', function($excel) use($students) {

			$excel->sheet('Students', function($sheet) use($students) {

				$sheet->fromArray($students);

			});

		})->export('xls');
					
					
	}
	
	public function searchStudents()
	{
		
	if(Input::has('institution_id') || Input::has('card_number') || Input::has('phone') || Input::has('email') || Input::has('rollno'))
		{
		$institutions = $this->institution->getList();

		$query = DB::table('student_data')
		->leftJoin('institutions', 'student_data.college_id', '=', 'institutions.id')
		->select('student_data.*', 'institutions.name');

		if(Input::has('institution_id'))
		{
			$query->where('college_id',Input::get('institution_id'));
		}
		if(Input::has('card_number'))
		{
			$query->where('card_number',Input::get('card_number'));
		}
		if(Input::has('phone'))
		{
			$query->where('contact_number',Input::get('phone'));
		}
		if(Input::has('email'))
		{
			$query->where('email_id',Input::get('email'));
		}
		if(Input::has('rollno'))
		{
			$query->where('rollno',Input::get('rollno'));
		}

		$students = $query->get();
		
		return View::make('admin.students.index')->withStudents($students)->withInstitutions($institutions);
		
		}else{
			return Redirect::back()->withErrorMessage('Search from atleast one field');
		}
	}

	public function getDuplicateData()
	{
		return View::make('admin.students.duplicate');
	}

	private function testMdata($start,$length,$search)
	{
		$s = $search['value'];
		if(empty($s)){
			$duplicates = DuplicateStudentData::orderBY('created_at','desc')->skip($start)->limit($length)->get();
		}else{
			$duplicates = DuplicateStudentData::where('first_name',$s)
												->orWhere('card_number',$s)
												->orWhere('email_id',$s)
												->orderBY('created_at','desc')
												->skip($start)
												->limit($length)->get();
		}
		$data = array();

		foreach ($duplicates as $key => $value) {

			$temp = array(
				$value -> card_number,
				$value -> rollno,
				$value -> status,
				$value -> rol_no,
				$value -> contact_number,
				$value -> first_name,
				$value -> last_name,
				$value -> dob,
				$value -> college_id,
				$value -> streamorcourse,
				$value ->  validity_for_how_many_years,
				$value ->  cluborgrouporsociety,
				$value ->  residentordayscholar,
				$value ->  date_of_issue,
				$value ->  expiry_date,
				$value ->  section,
				$value ->  father_name,
				$value ->  batch_year,
				$value ->  program_duration,
				$value ->  email_id,
				$value ->  gender,
                '<a href="admin_students_duplicate_delete/'.$value->id.'" class="btn btn-warning"><i class="fa fa-pencil"></i> Delete</a>'
			);

			array_push($data,$temp);
		}
		return $data;
	}


	private function getCount()
	{
		$count = DuplicateStudentData::orderBY('created_at','desc')->count();

		return $count;
	}

	public function testdata()
	{

		$data =  [
		  "draw" => intval(Input::get('draw')),
		  "recordsTotal"=> intval($this->getCount()),
		  "recordsFiltered"=> intval($this->getCount()),
		  "data"=> $this->testMdata(intval(Input::get('start')),intval(Input::get('length')),Input::get('search'))
		];

		return json_encode($data);
	}

	public function deleteDuplicateData($id)
	{
		$student 	= DuplicateStudentData::find($id);

		$student->delete();

		$duplicates = DuplicateStudentData::orderBY('created_at','desc')->get();

		return Redirect::route('admin_students_duplicate_data')->withDuplicates($duplicates)->withFlashMessage('The record has been deleted');
	}

    public function DeleteAllStudentsDuplicateData()
    {
 		$duplicates = DuplicateStudentData::orderBY('created_at','desc')->get();


        if($duplicates->isEmpty())
        {
			$duplicates = DuplicateStudentData::orderBY('created_at','desc')->get();

			return Redirect::route('admin_students_duplicate_data')->withDuplicates($duplicates)->withErrorMessage('There are no records to Delete!');
        }
        else
        {
	        $duplicate_delete = DuplicateStudentData::truncate();

			$duplicates = DuplicateStudentData::orderBY('created_at','desc')->get();

			return Redirect::route('admin_students_duplicate_data')->withDuplicates($duplicates)->withFlashMessage('Duplicate Data deleted successfully !');
        }
    }
	
	
	// method to import all institutions users data from an excel sheet
	public function postMailToAll()
	{
		$d = dir(getcwd());
		$urlname = $d->path.'/cards/';
				
		$institutions = $this->institution->getList();
		$students = array();
				if(Input::get('file_id')){
					
					$query = DB::table('student_data');
					$result = $query->leftJoin('institutions', 'student_data.college_id', '=', 'institutions.id');
					$result = $query->select('student_data.*', 'institutions.name');
					$result = $query->where('college_id',Input::get('college_institution_id'));
					if(Input::get('file_id') == 'Manual'){
						$result = $query->where('student_data.created_at',Input::get('date_id'));
						$result = $query->where('filename', '');
						$result = $query->where('sendmail', 0);
					}else{
						$result = $query->where('uploaddate',Input::get('date_id'));
						$result = $query->where('filename',Input::get('file_id'));
					}
					$students = $result->get();
		            return View::make('admin.admin_send_mail_to_all')->withStudents($students)->withInstitutions($institutions);
					
				}else if(Input::get('fileMiD')){
					
					$fileMiD = Input::get('fileMiD');
					$dateMiD = Input::get('dateMiD');
					$collegeMiD = Input::get('collegeMiD');
					
					//Select data from student_data
					$query = DB::table('student_data');
					$result = $query->leftJoin('institutions', 'student_data.college_id', '=', 'institutions.id');
					$result = $query->select('student_data.id', 'student_data.rol_no', 'student_data.expiry_date', 'student_data.first_name', 'student_data.email_id', 'student_data.contact_number', 'student_data.card_number', 'institutions.name');
					$result = $query->where('college_id', $collegeMiD);
					$result = $query->where('uploaddate', $dateMiD);
					if(Input::get('fileMiD') == 'Manual'){
						$result = $query->where('filename', '');
						$result = $query->where('sendmail', 0);
					}else{
						$result = $query->where('filename', $fileMiD);
					}
					$studentsone = $result->get();
					foreach($studentsone as $key){ 
							
						//Mail will goes here
							$queryTemplate = DB::table('tb_institution_template')
							->leftJoin('institutions', 'tb_institution_template.college_id', '=', 'institutions.id')
							->select('tb_institution_template.*', 'institutions.name');
							$queryTemplate->where('college_id', $collegeMiD);
							$studentTemplate = $queryTemplate->get();
							$name = 	$key->first_name;
							$card_number = 	$key->card_number;
							$email_id = 	$key->email_id;
							$contact_number = 	$key->contact_number;
							$rollnumber = $key->rol_no;
							$validate = $key->expiry_date;

							if ($validate) {
								$d = strtotime($validate);
								$validate = date("m", $d) . '/' . date("Y", $d);
							}
														
							if(count($studentTemplate)>0 && !empty($studentTemplate[0]->content)){
								$college_name = 	$studentTemplate[0]->name;
								$college_id = 	$collegeMiD;
								$content = str_replace(array('%NAME%', '%CARDNUMBER%', '%EMAILID%', '%PHONENUMBER%', '%COLLEGENAME%', '%COLLEGEID%' ), array($name, $card_number, $email_id, $contact_number, $college_name, $college_id), $studentTemplate[0]->content);
											
								//$data['logo'] = $studentTemplate[0]->logo;
								//$data['header_color'] = $studentTemplate[0]->header_color;
								$data['footer_design'] = $studentTemplate[0]->front_card_design;
								$data['background_color'] = $studentTemplate[0]->background_color;
								$data['content'] = $content;
								$data['student_name'] = $name;
								$data['card_number'] = $card_number;
								$data['contact_number'] = $contact_number;
								$data['validate'] = $validate;
								$data['roll_no_required'] = $studentTemplate[0]->roll_no_required;
								$data['roll_no'] = $rollnumber;
								
								//Create image
							    if($studentTemplate[0]->roll_no_required == 1){$rollnm = $rollnumber;}else{$rollnm = 0;}

								$bimage = $studentTemplate[0]->front_card_design;
								
								$imageName = $this->imageDynamic($bimage, $card_number, $name, $validate, $rollnm, 'notDefault');
								$array = array();
								array_push($array, $key->email_id);
								array_push($array, $key->first_name);
								array_push($array, $imageName);
													 			
							 Mailgun::send('emails.emailTemplate', $data, function($message) use($array)
								{
									$message->subject('Card Number Registration Notification');
									$message->to($array[0], $array[1]);
									$message->attach('cards/'.$array[2]);

									
								});
							
							}else{
								$data['collegeID'] = $collegeMiD;
								$data['card_number'] = $key->contact_number;
								$data['name'] = $key->first_name;
								$data['college_name'] = $key->name;
								$data['student_name'] = $name;
								$data['card_number'] = $card_number;
								$data['contact_number'] = $contact_number;
								$data['validate'] = $validate;
								$data['roll_no_required'] = 1;
								$data['roll_no'] = $rollnumber;
								
							$imageName = $this->imageDynamic('default_idoag_card_design.png', $card_number, $name, $validate, $rollnumber, 'Default');
								$array = array();
								array_push($array, $key->email_id);
								array_push($array, $key->first_name);
								array_push($array, $imageName);
								 Mailgun::send('emails.defaultTemplate', $data, function($message) use($array)
								{
									$message->subject('Card Number Registration Notification');
									$message->to($array[0], $array[1]);
									$message->attach('cards/'.$array[2]);

								});
							}
							
							// Update student_data
							DB::table('student_data')->where(['id' => $key->id])->update(['sendmail' => 1]);
					}
					
					// Insert into tb_send_mail_check
				    $selectFile = DB::select("insert INTO tb_send_mail_check (college_id, date, filename) values ('".$collegeMiD."', '".$dateMiD."', '".$fileMiD."')");
					//return View::make('admin.admin_send_mail_to_all')->withStudents($students)->withInstitutions($institutions);
					return Redirect::route( 'post-mail-to-all' )->withFlashMessage('Mail send to student successfully!')->withStudents($students)->withInstitutions($institutions);
					
				
				}
				else
				{
					return View::make('admin.admin_send_mail_to_all')->withStudents($students)->withInstitutions($institutions);
				}
	}	
	
	public function searchDate(){
		$collegeID = Input::get('college_id');
		$type = Input::get('type');
		if($type == 1){
		$result = Student::where('college_id', $collegeID)->where('sendmail', '!=', 1)->where('uploaddate', '!=', '0000-00-00 00:00:00')->groupBy('uploaddate')->get();
	}else{
		$result = Student::where('college_id', $collegeID)->where('uploaddate', '!=', '0000-00-00 00:00:00')->groupBy('uploaddate')->get();

	}
		$str = '<option value="">Please select Date</option>';
		foreach($result as $key){
			
			$str .='<option = value="'.$key->uploaddate.'">'.$key->uploaddate.'</option>';
		}
		return $str;
	}
	
	public function searchFile(){
		$collegeID = Input::get('college_id');
		$date = Input::get('date');
		$array = array();
		$selectFile = DB::select("select filename from tb_send_mail_check where college_id='".$collegeID."' AND date = '".$date."'");
		
		foreach($selectFile as $key){
			if(!empty($key->filename)){
				array_push($array, $key->filename);
			}
			
		}
		$result = Student::where('college_id', $collegeID)->where('uploaddate', $date)->groupBy('filename')->get();
		$str = '<option value="">Select option File/Manual</option><option value="Manual">Manual Search</option>';

		foreach($result as $key){
			if(!in_array($key->filename, $array) && !empty($key->filename)){
				$str .='<option = value="'.$key->filename.'">'.$key->filename.'</option>';
			}
		}
		return $str;
	}
	 
	public function searchFileResend(){
		$collegeID = Input::get('college_id');
		$date = Input::get('date');
		$array = array();
		$selectFile = DB::select("select filename from student_data where college_id='".$collegeID."' AND uploaddate = '".$date."'");
		$str = '<option value="">Please select File</option>';
		foreach($selectFile as $key){
			$str .='<option = value="'.$key->filename.'">'.$key->filename.'</option>';
		}
		
		return $str;
	}
	// Resend mail
	
	public function resendMail(){
		
			$institutions = $this->institution->getList();
			
			if(Input::get('Mail')){
				
				if(count(Input::get('chk')) == 0){
							
				$query = DB::table('tb_send_mail_check')
						->leftJoin('institutions', 'institutions.id', '=', 'tb_send_mail_check.college_id')
						->leftJoin('student_data', 'student_data.uploaddate', '=', 'tb_send_mail_check.date')
						->select('student_data.*', 'institutions.name');
						$students = $query->get();	
					
				//return View::make('admin.admin_resend_mai_to_student')->withStudents($students)->withInstitutions($institutions);
				return Redirect::back()->withErrorMessage('Select atleast one student!')->withStudents($students)->withInstitutions($institutions);

				}
				
			}
			
			if(count(Input::get('chk')) > 0){
				
					$query = DB::table('student_data')
					->leftJoin('institutions', 'student_data.college_id', '=', 'institutions.id')
					->select('student_data.id', 'student_data.rol_no', 'student_data.expiry_date', 'student_data.college_id', 'student_data.first_name', 'student_data.email_id', 'student_data.contact_number', 'student_data.card_number', 'institutions.name');
					$query->whereIN('student_data.id', Input::get('chk'));
					$studentsone = $query->get();
					foreach($studentsone as $key){ 
						
						//Mail will goes here
							$queryTemplate = DB::table('tb_institution_template')
							->leftJoin('institutions', 'tb_institution_template.college_id', '=', 'institutions.id')
							->select('tb_institution_template.*', 'institutions.name');
							$queryTemplate->where('college_id', $key->college_id);
							$studentTemplate = $queryTemplate->get();
							
							$name = 	$key->first_name;
							$card_number = 	$key->card_number;
							$email_id = 	$key->email_id;
							$contact_number = 	$key->contact_number;
							$college_id = 	$key->college_id;
							$validate = $key->expiry_date;
							$rollnumber = $key->rol_no;
							
							if ($validate) {
								$d = strtotime($validate);
								$validate = date("m", $d) . '/' . date("Y", $d);
							}

							if(count($studentTemplate)>0 && !empty($studentTemplate[0]->content)){
								
								$college_name = 	$studentTemplate[0]->name;
								
								$content = str_replace(array('%NAME%', '%CARDNUMBER%', '%EMAILID%', '%PHONENUMBER%', '%COLLEGENAME%', '%COLLEGEID%' ), array($name, $card_number, $email_id, $contact_number, $college_name, $college_id), $studentTemplate[0]->content);
											
								//$data['logo'] = $studentTemplate[0]->logo;
								//$data['header_color'] = $studentTemplate[0]->header_color;
								$data['footer_design'] = $studentTemplate[0]->front_card_design;
								$data['background_color'] = $studentTemplate[0]->background_color;
								$data['content'] = $content;
								$data['student_name'] = $name;
								$data['card_number'] = $card_number;
								$data['contact_number'] = $contact_number;
								$data['validate'] = $validate;
								$data['roll_no_required'] = $studentTemplate[0]->roll_no_required;
								$data['roll_no'] = $rollnumber;
								
								if($studentTemplate[0]->roll_no_required == 1){$rollnm = $rollnumber;}else{$rollnm = 0;}
								
								
								$bimage = $studentTemplate[0]->front_card_design;
								
								$imageName = $this->imageDynamic($bimage, $card_number, $name, $validate, $rollnm, 'notDefault');
								$array = array();
								array_push($array, $key->email_id);
								array_push($array, $key->first_name);
								array_push($array, $imageName);
													 			
							 Mailgun::send('emails.emailTemplate', $data, function($message) use($array)
								{
									$message->subject('Card Number Registration Notification');
									$message->to($array[0], $array[1]);
									$message->attach('cards/'.$array[2]);

									
								});
								
							}else{
								$data['collegeID'] = $college_id;
								$data['card_number'] = $key->contact_number;
								$data['name'] = $key->first_name;
								$data['college_name'] = $key->name;
								$data['student_name'] = $name;
								$data['card_number'] = $card_number;
								$data['contact_number'] = $contact_number;
								$data['validate'] = $validate;
								$data['roll_no_required'] = 1;
								$data['roll_no'] = $rollnumber;
								
								
								$imageName = $this->imageDynamic('default_idoag_card_design.png', $card_number, $name, $validate, $rollnumber, 'Default');
								$array = array();
								array_push($array, $key->email_id);
								array_push($array, $key->first_name);
								array_push($array, $imageName);
								 Mailgun::send('emails.defaultTemplate', $data, function($message) use($array)
								{
									$message->subject('Card Number Registration Notification');
									//$message->to($key->email_id, $key->first_name);
									$message->subject('Card Number Registration Notification');
									$message->to($array[0], $array[1]);
									$message->attach('cards/'.$array[2]);
									
								});
							}
					
					}
					$students = '';
				// $query = DB::table('tb_send_mail_check')
						// ->leftJoin('institutions', 'institutions.id', '=', 'tb_send_mail_check.college_id')
						// ->leftJoin('student_data', 'student_data.uploaddate', '=', 'tb_send_mail_check.date')
						// ->select('student_data.*', 'institutions.name');
						// $students = $query->get();	
					
				//return View::make('admin.admin_resend_mai_to_student')->withStudents($students)->withInstitutions($institutions);
				return Redirect::route('resend-mail')->withFlashMessage('Mail send to student successfully!')->withStudents($students)->withInstitutions($institutions);

				
			}else{
				
				if(!empty(Input::get('institution_id')) || !empty(Input::get('card_number'))|| !empty(Input::get('phone')) || !empty(Input::get('email'))){
						
						// $query = DB::table('student_data')
						// ->leftJoin('institutions', 'institutions.id', '=', 'tb_send_mail_check.college_id')
						// ->select('student_data.*', 'institutions.name')
						// ->where('student_data.college_id', Input::get('institution_id'))
						// ->orWhere('student_data.uploaddate', Input::get('date_id'))
						// ->orWhere('student_data.filename', Input::get('file_id'))
						// ->orWhere('student_data.card_number', Input::get('card_number'))
						// ->orWhere('student_data.contact_number', Input::get('phone'))
						// ->orWhere('student_data.email_id', Input::get('email'))
						// ->orWhere('student_data.rollno', Input::get('rollno'))
						// ->get();	$institutions = $this->institution->getList();

						$query = DB::table('student_data')
						->leftJoin('institutions', 'student_data.college_id', '=', 'institutions.id')
						->select('student_data.*', 'institutions.name');

						if(Input::has('institution_id'))
						{
							$query->where('college_id',Input::get('institution_id'));
						}
						if(Input::has('card_number'))
						{
							$query->where('card_number',Input::get('card_number'));
						}
						if(Input::has('phone'))
						{
							$query->where('contact_number',Input::get('phone'));
						}
						if(Input::has('email'))
						{
							$query->where('email_id',Input::get('email'));
						}
						if(Input::has('rollno'))
						{
							$query->where('rol_no',Input::get('rollno'));
						}
						
						if(Input::has('date_id'))
						{
							$query->where('uploaddate',Input::get('date_id'));
						}
						
						if(Input::has('file_id'))
						{
							$query->where('filename',Input::get('file_id'));
						}

						$students = $query->get();
						//print_r($students);die();
											
						return View::make('admin.admin_resend_mai_to_student')->withStudents($students)->withInstitutions($institutions);

						
				}else{
					$students = '';
						// $query = DB::table('tb_send_mail_check')
						// ->leftJoin('institutions', 'institutions.id', '=', 'tb_send_mail_check.college_id')
						// ->leftJoin('student_data', 'student_data.uploaddate', '=', 'tb_send_mail_check.date')
						// ->select('student_data.*', 'institutions.name');
						// $students = $query->get();
					return View::make('admin.admin_resend_mai_to_student')->withStudents($students)->withInstitutions($institutions);

				}
			}
			
		
	}

	public function checkTemplateDesign(){
		
		return View::make('emails.emailTemplate');

	}
	
	public function imageDynamic($backImage, $card_number, $name, $validity, $rollno, $templateType){
		
		$explode = explode('.', $backImage);
		
		$cardNumber = wordwrap($card_number, 4, "-", true);
		if($explode[1] == 'png'){
			$my_img = imagecreatefrompng( 'carddesign/'.$backImage );
		}else{
			$my_img = imagecreatefromjpeg( 'carddesign/'.$backImage );
		}
		
		$background = imagecolorallocate( $my_img, 0, 0, 255 );
		$text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
		$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		$arialfont = 'cards/arial.ttf';
		$arialbdfont = 'cards/arialbd.ttf';
		$spacing = 10;
	
		//imagettftext($my_img, 16, 0, 30, 210, $text_colour, $arialbdfont, $cardNumber);
		 $temp_x = 30;
        for ($i = 0; $i < strlen($cardNumber); $i++)
        {
            $bbox = imagettftext($my_img, 16, 0, $temp_x, 210, $text_colour, $arialbdfont, $cardNumber[$i]);
            $temp_x += $spacing + ($bbox[2] - $bbox[0]);
        }
		imagettftext($my_img, 12, 0, 30, 250, $text_colour, $arialbdfont, strtoupper($name));
		imagettftext($my_img, 12, 0, 30, 280, $text_colour, $arialbdfont, "VALID UPTO : ".$validity);

		if($rollno !== 'NULL'){
			if($templateType == 'Default'){$x = 400; $y = 65;}else{$x = 430; $y = 117;}
			imagettftext($my_img, 12, 0, $x, $y, $text_colour, $arialfont, $rollno);
		}
		$imageName = time().'.png';
		$save = 'cards'.'/'.$imageName;
		header( "Content-type: image/png" );
		imagepng( $my_img , $save);
		return $imageName;
	}
	
}
