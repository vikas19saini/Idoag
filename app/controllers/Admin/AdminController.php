<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Forms\adminUserRegistrationForm;
use idoag\Forms\adminUserEditForm;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Student\UserCouponRepositoryInterface;
use idoag\Repos\PressRepositoryInterface;

class AdminController extends \BaseController
{

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

    protected $post;

    protected $brand;
    private $user_coupon;


    /**
     * AdminController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand, UserCouponRepositoryInterface $user_coupon, StudentInternshipRepositoryInterface $internship, InstitutionRepositoryInterface $institution, PostRepositoryInterface $post, adminUserRegistrationForm $adminUserRegistrationForm, adminUserEditForm $adminUserEditForm, PressRepositoryInterface $press)
    {
        $this->user = $user;

        $this->adminUserRegistrationForm = $adminUserRegistrationForm;

        $this->adminUserEditForm = $adminUserEditForm;

        $this->post = $post;

        $this->institution = $institution;
        $this->internship = $internship;
        $this->brand = $brand;
        $this->user_coupon = $user_coupon;
        $this->press = $press;

    }

    // showing admin user dashboard
    public function getDashboard()
    {
        // total users count

        $admins = $this->user->findGroupByName('Admins');
        $institutions = $this->user->findGroupByName('Institutions');
        $brands = $this->user->findGroupByName('Brands');
        $students = $this->user->findGroupByName('Students');

        $statistics = array();
        $statistics['all_press_count'] = $this->press->getCount();
        $statistics['active_offers_count'] = $this->post->getTotalPostCountByStatus('offer', 1);
        $statistics['offers_count'] = $this->post->getTotalPostCount('offer');
        $statistics['active_internships_count'] = $this->post->getTotalPostCountByStatus('internship', 1);
        $statistics['inactive_internships_count'] = $this->post->getTotalPostCount('internship', 0);
        $statistics['events_count'] = $this->post->getTotalPostCount('event');
        $statistics['photos_count'] = $this->post->getTotalPostCount('photo');
        $statistics['texts_count'] = $this->post->getTotalPostCount('text');
        $statistics['internship_application_count'] = Internship::count();
        $statistics['enquiry_count'] = Enquiry::count();
        $statistics['unread_enquiry_count'] = Enquiry::where('status', 0)->count();
        $statistics['problems_count'] = Problem::count();
        $statistics['unread_problems_count'] = Problem::where('status', 0)->count();
        $statistics['users_count'] = $this->user->getCountByGroup($admins);
        $statistics['ins_count'] = $this->user->getCountByGroup($institutions);
        $statistics['brands_count'] = $this->user->getCountByGroup($brands);
        //$statistics['all_students'] = $this->getAllStudent();
		$statistics['students'] = $this->getActiveInactiveData();
		//$statistics['inactive_students'] = $this->getActiveInactiveData(0);
        $statistics['insphotos_count'] = $this->post->getTotalPostCount('insphoto');
        $statistics['insevents_count'] = $this->post->getTotalPostCount('insevent');
        $statistics['instexts_count'] = $this->post->getTotalPostCount('instext');
        return View::make('admin.dashboard', compact('statistics'));
    }
	
	public function getActiveInactiveData(){
		
		$count = 0;
		// $query = DB::select("SELECT id FROM institutions");
			// foreach($query as $key){
				
				$queryActive = DB::select("SELECT users.card_number FROM users
                                                     JOIN student_details
                                                     ON student_details.user_id = users.id 
													 JOIN institutions
													 ON institutions.id = student_details.institution_id
													 Where users.card_number != '' AND (users.activated = 1 || users.activated = 0) AND users.deleted_at IS NULL");
				$count = $count + count($queryActive);									
			//}
		return $count;
	}
	
	public function getAllStudent(){
		$count = 0;
		$query = DB::select("SELECT id FROM institutions");
			foreach($query as $key){
				
				$queryNonReg = DB::select("select card_number from student_data 
							 WHERE college_id = '".$key->id."' 
							 AND card_number NOT IN (SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id
													 WHERE student_details.institution_id = '".$key->id."')");
													 
				$queryActive = DB::select("select card_number from student_data 
									WHERE college_id = '".$key->id."' 
									AND card_number IN (SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id 
													 WHERE student_details.institution_id = '".$key->id."' 
													 AND (users.activated = 0 OR users.activated = 1) AND users.deleted_at IS NULL)");
				
				
				$queryDelete = DB::select("SELECT users.card_number FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id 
													 WHERE student_details.institution_id = '".$key->id."' 
													 AND users.deleted_at IS NOT NULL");
													 
			   $count = $count + count($queryNonReg) + count($queryActive) + count($queryDelete);
			   
			}
		return $count;
	}


    public function getCollegeReport()
    {
        $institutions = $this->institution->getAll();
        return View::make('admin.reports.colleges', compact('institutions'));
    }

    public function getStudentReport()
    {
        $institutions = $this->institution->getAll();
        return View::make('admin.reports.students', compact('institutions'));
    }
    public function getStudentDataReport()
    {
        ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
        $institutions = $this->institution->getAll();
        $card_numbers = User::whereNotNull('card_number')->remember(60,'card_numbers')->lists('card_number');
        $delete_users = User::whereNotNull('deleted_at')->count();
		$mismatch_records = DB::select("SELECT card_number 
										FROM `users` 
										where card_number IN (SELECT card_number FROM `student_data` where `deleted_at` != '')");
		$data_mismatch = count($mismatch_records);
		$delete_student_records = $mismatch_records;
        return View::make('admin.reports.students-data', compact('institutions','card_numbers', 'delete_users', 'data_mismatch', 'delete_student_records'));
		
	
   }

    public function getBrandReport()
    {
        $brands = $this->brand->getAll();
        return View::make('admin.reports.brands', compact('brands'));
    }

    public function getInternshipReport()
    {
        $internships = $this->post->getInternshipPosts();
        return View::make('admin.reports.internships', compact('internships'));
    }

    public function getUsersReport()
    {
        $institutions = $this->institution->getList();
        $filter = array('institution' => '', 'status' => '', 'startdate' => '', 'enddate' => '');
        return View::make('admin.reports.users', compact('institutions', 'filter'));
    }

    public function ActivateUser()
    {
        $id=Input::get('user_id');
        $user=$this->user->find($id);
        $user->activated=1;
        $user->activated_at=date('Y-m-d H:i:s');
        $user->save();
        return Redirect::back()->withFlashMessage('Updated activation status of User');
    }

    public function filterUserReport()
    {
        $institutions = $this->institution->getList();
        $filter = Input::all();
		if(Input::get('status') != 2){
			
		if(Input::get('status') == ''){ 
		$query = Student::leftjoin('users', 'users.card_number', '=', 'student_data.card_number')
				 ->where('student_data.deleted_at', null)
				 ->select('student_data.college_id', 'student_data.first_name', 'student_data.last_name', 'student_data.email_id', 'users.mobile', 'users.activated','student_data.card_number', 'users.activated_at', 'users.created_at', 'users.id', DB::raw('(SELECT  count(id)  FROM    users  WHERE   users.card_number=student_data.card_number) AS userStatus'));
				    if (Input::get('institution'))
            $query->where('student_data.college_id', $filter['institution']);
		}else{
        $query = User::join('student_details', 'student_details.user_id', '=', 'users.id')
						->where('users.deleted_at', null)
						->where('users.card_number', '!=', '')
						->select('student_details.institution_id as college_id', 'users.first_name', 'users.last_name', 'users.email', 'users.mobile', 'users.activated','student_details.card_number', 'users.activated_at', 'users.created_at', 'users.id', DB::raw('(SELECT  count(id)  FROM    users  WHERE   users.card_number=student_details.card_number) AS userStatus'));
			    if (Input::get('institution'))
            $query->where('student_details.institution_id', $filter['institution']);
		}
		   if (Input::get('startdate') != '' && Input::get('enddate') != '')
            $query->whereBetween('users.created_at', array(Input::get('startdate') . ' 00:00:01', Input::get('enddate') . ' 23:59:59'));

			if (Input::get('status') != '') {
				$status = Input::get('status');
				if ($status == 1 || $status == 0)
					$query->where('users.activated', $status);
				
			}
			$users = $query->get();
		}else{
			
			if($filter['institution'] == 'kkkkk'){
				$array = array();
				$allData = array();
				$dataTest = array();
							$selectone = DB::select("SELECT student_data.card_number FROM student_data
												  where deleted_at IS Null And college_id = '".$filter['institution']."' AND card_number != ''
												  ");
												  
				foreach($selectone as $key){
					array_push($dataTest, $key->card_number);
				}
				//echo count($dataTest);die();
				$select = DB::select("SELECT users.card_number FROM student_details
														 Join users
														 On users.id = student_details.user_id
														 Where users.card_number != '' AND student_details.institution_id = '".$filter['institution']."' AND (activated = 0 OR activated = 1)");			
		
				foreach($select as $key){
					if(!in_array($key->card_number, $dataTest)){
					array_push($array, $key->card_number);
					}
				}
				
				$users = Student::whereIn('card_number', $array)->select('college_id', 'card_number')->get();
						foreach($users as $key){
							DB::table('student_details')->where('card_number', $key->card_number)->update(['institution_id' => $key->college_id]);
						}
						
						die();
			}else{
				
						
							$array = array();
			$select = DB::select("SELECT users.card_number FROM student_details
								 join users
								 On users.id = student_details.user_id
								 Where users.card_number IS NOT NULL AND student_details.institution_id = '".$filter['institution']."' 
								 AND (activated = 0 OR activated = 1) AND users.deleted_at IS NULL");			
			foreach($select as $key){
				
				array_push($array, $key->card_number);
				
				}
			
			$users = Student::where('student_data.deleted_at', null)
						->where('card_number', '!=', '')
						->where('college_id', $filter['institution'])
						->whereNotIn('card_number', $array)
						->select('college_id', 'first_name', 'last_name', 'email_id', 'contact_number', 'card_number', 'student_data.created_at')->get();
		
				
			}
		}
    

     

//         echo '<pre>';print_r($users);exit();

	if(Input::has('Filter'))
		{
        return View::make('admin.reports.users', compact('institutions', 'filter', 'users'));
		}
		else
		{
		 Excel::create('UsersReport', function($excel) use($users) {

            $excel->sheet('Report', function($sheet) use($users) {
                $sheet->loadView('admin.reports.export_users', ['users' => $users]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
		}
    }

    public function getOfferReport()
    {
        $coupons = $this->user_coupon->getAllWithPostInfo();
        $brands = $this->brand->getBrandList();
        $total_coupons=$this->user_coupon->getCount();
        $filter = array('brand' => '', 'voucher_type' => '', 'startdate' => '', 'enddate' => ''); 
        // dd($coupons);

        return View::make('admin.reports.offers', compact('coupons', 'brands', 'filter','total_coupons'));
    }

    public function filterOfferReport()
    {
        $query = UserCoupon::join('posts', 'posts.id', '=', 'user_coupons.post_id');
        $filter = Input::all();
        if (Input::get('brand'))
            $query->where('posts.brand_id', $filter['brand']);

        if (Input::get('startdate') != '' && Input::get('enddate') != '')
            $query->whereBetween('user_coupons.created_at', array(Input::get('startdate') . ' 00:00:01', Input::get('enddate') . ' 23:59:59'));

        if (Input::get('voucher_type'))
            $query->where('posts.voucher_type', $filter['voucher_type']);

        $brands = $this->brand->getBrandList();
        $filter2=1;
        $coupons = $query->get();

        return View::make('admin.reports.offers', compact('coupons', 'brands', 'filter','filter2'));
    }

    public function getOffersReportExcelExport()
    {
        $coupons = $this->user_coupon->getAll();

        Excel::create('CouponsReport', function($excel) use($coupons) {

            $excel->sheet('Report', function($sheet) use($coupons) {
                $sheet->loadView('admin.reports.export_coupons', ['coupons' => $coupons]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
    }

    public function getStudentsNotRegisteredReportExcelExport()
    {
		ini_set('max_execution_time', 3000);
		
		$array = array();
			$select = DB::select("SELECT users.card_number FROM student_details
                                                     JOIN users
													 On users.id = student_details.user_id
													 JOIN institutions
													 ON institutions.id = student_details.institution_id
													 Where (users.activated = 1 || users.activated = 0) 
													 AND users.deleted_at IS NULL");
			
			foreach($select as $key){
				if($key->card_number != ''){
				array_push($array, $key->card_number);
				}
			}
			
		  $implode = implode(',', $array);
		  $students = DB::select("SELECT email_id, contact_number, college_id
											FROM `student_data`
											Join institutions
											On institutions.id = student_data.college_id
											where student_data.deleted_at IS NULL 
											AND student_data.card_number IS NOT NULL
											AND student_data.card_number Not IN ($implode)");	
		//echo count($students);											
        $students     =  array_to_object($students);
        $students     = json_decode(json_encode($students), true);
		Excel::create('NonRegStudentsList', function($excel) use($students) {
        
            $excel->sheet('Students', function($sheet) use($students) {
        
                $sheet->fromArray($students);
        
            });
        
        })->export('xls');
		
        return Redirect::back()->withFlashMessage('Not Registered Students exported as Excel successfully!');
    }

    public function getRegisteredStudentsReportExcelExport()
    {
       $students= User::join('student_details', 'student_details.user_id', '=', 'users.id')
						->join('institutions', 'institutions.id', '=', 'student_details.institution_id')
						->where('users.deleted_at', null)
						->where('users.card_number', '!=', '')
				->select('users.card_number','users.first_name','users.last_name','student_details.institution_id','users.email','users.mobile')->get();
        $students     =  array_to_object($students);
        
        $students     = json_decode(json_encode($students), true);
        
        // Exporting to excel sheet                          
        Excel::create('ActiveStudentsList', function($excel) use($students) {
        
            $excel->sheet('Students', function($sheet) use($students) {
        
                $sheet->fromArray($students);
        
            });
        
        })->export('xls');
        
        return Redirect::back()->withFlashMessage('Registered Students exported as Excel successfully!');
    }
	
		public function getMismatchStudentExcelSheet(){
		
		$count = 0;
		$students = DB::select("SELECT users.card_number, student_details.institution_id as institution_id,users.first_name, 
								users.last_name,users.gender, users.email, users.mobile, student_details.validity_for_how_many_years as validity,
								student_details.date_of_issue, student_details.expiry
								FROM `users`
								Inner Join student_details
								ON student_details.user_id = users.id
								where users.card_number IN (SELECT card_number FROM `student_data` where `deleted_at` != '')");
		$query = DB::select("SELECT id FROM institutions");
			$users = array();
			$userID = array();
			foreach($query as $inkey){
				
				$queryDelete = DB::select("SELECT users.*, student_details.validity_for_how_many_years as validity,
								student_details.date_of_issue, student_details.expiry FROM `student_details`
                                                     JOIN users
                                                     ON users.id = student_details.user_id 
													 WHERE student_details.institution_id = '".$inkey->id."' 
													 AND users.deleted_at IS NOT NULL");
					foreach($queryDelete as $key){	
					
					  $data['card_number'] = $key->card_number;
					  $data['institution_id'] = $inkey->id;
					  $data['first_name'] = $key->first_name;
					  $data['last_name'] = $key->last_name;
					  $data['gender'] = $key->gender;
					  $data['email'] = $key->email;
					  $data['mobile'] = $key->mobile;
					  $data['validity'] = $key->validity;
					  $data['date_of_issue'] = $key->date_of_issue;
					  $data['expiry'] = $key->expiry;
					  $users[] = $data;
					  array_push($userID, $key->id);
					}

			}
			
			
		  $students     =  array_to_object($students);
		  $students     = json_decode(json_encode($students), true);
		  $deleteUser   = array();
		  $delete_users =DB::select("SELECT users.* FROM `users` where deleted_at IS NOT NULL");
		  $count = 0;
		  foreach($delete_users as $key){
			  
			  if($key->first_name == 'NULL' || !in_array($key->id, $userID)){
					  $dataOne['card_number'] = $key->card_number;
					  $dataOne['institution_id'] = 0;
					  $dataOne['first_name'] = $key->first_name;
					  $dataOne['last_name'] = $key->last_name;
					  $dataOne['gender'] = $key->last_name;
					  $dataOne['email'] = $key->email;
					  $dataOne['mobile'] = $key->mobile;
					  $dataOne['validity'] = 0;
					  $dataOne['date_of_issue'] = 0;
					  $dataOne['expiry'] = 0;
					  $deleteUser[] = $dataOne;
					  $students[] = array_unshift($students, $dataOne);
					  $count++;
			   }
			  
		  }
		
		  if(count($deleteUser)>0){
			$students = array_slice($students,0,count($students)-$count);
		  }
		
		//echo '<pre>';print_r($students);die();

        // Exporting to excel sheet                          
        Excel::create('MismatchStudentsList', function($excel) use($students) {
        
            $excel->sheet('Students', function($sheet) use($students) {
        
                $sheet->fromArray($students);
        
            });
        
        })->export('xls');
        
        return Redirect::back()->withFlashMessage('Mismatched Students exported as Excel successfully!');
	}
	

    public function getAllStudentsReportExcelExport()
    {
		ini_set('max_execution_time', 3000);
//$institution_ids=Institution::where('id','<>',101)->lists('id');
      
        $students = DB::select("select email_id, contact_number, student_data.type
								from student_data
								join institutions 
								ON student_data.college_id = institutions.id
								WHERE student_data.deleted_at IS NULL
								");
        
		$students     = json_decode(json_encode($students), true);
        
        // Exporting to excel sheet                          
        Excel::create('AllStudentsList', function($excel) use($students) {
        
            $excel->sheet('Students', function($sheet) use($students) {
        
                $sheet->fromArray($students);
        
            });
        
        })->export('xls');
        
        return Redirect::back()->withFlashMessage('All Students exported as Excel successfully!');
    }

    public function getInternshipsReportExcelExport()
    {
        $internships = $this->post->getInternshipPosts();

        Excel::create('InternshipsReport', function($excel) use($internships) {

            $excel->sheet('Report', function($sheet) use($internships) {
                $sheet->loadView('admin.reports.export_internships', ['internships' => $internships]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
    }

    public function getBrandsReportExcelExport()
    {
        $brands = $this->brand->getAll();

        Excel::create('BrandsReport', function($excel) use($brands) {

            $excel->sheet('Report', function($sheet) use($brands) {
                $sheet->loadView('admin.reports.export_brands', ['brands' => $brands]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
    }

    public function getCollegesReportExcelExport()
    {
        $institutions = $this->institution->getAll();

        Excel::create('CollegesReport', function($excel) use($institutions) {

            $excel->sheet('Report', function($sheet) use($institutions) {
                $sheet->loadView('admin.reports.export_colleges', ['institutions' => $institutions]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
    }

    public function getStudentsReportExcelExport()
    {
        $institutions = $this->institution->getAll();

        Excel::create('StudentsReport', function($excel) use($institutions) {

            $excel->sheet('Report', function($sheet) use($institutions) {
                $sheet->loadView('admin.reports.export_students', ['institutions' => $institutions]);
            });
        })->export('xls');

        return Redirect::back()->withFlashMessage('Exported as Excel successfully!');
    }
		
}