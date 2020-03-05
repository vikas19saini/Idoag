<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;


class TestController extends \BaseController 
{

 	function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand,  OutletRepositoryInterface $outlet, StudentDetailsRepositoryInterface $studentDetails)
    {

		$this->user 					= $user;

        $this->brand					= $brand;
				
		$this->student_details          = $studentDetails;
		
		$this->outlet 					= $outlet;

    }

	public function getDuplicateData($start,$length)
	{	 
		$duplicates = DuplicateStudentData::orderBY('created_at','desc')->skip($start)->limit($length)->get();

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
			);
			array_push($data,$temp);
		}
		return $data;
	}


	public function getCount()
	{
		$count = DuplicateStudentData::orderBY('created_at','desc')->count();

		return $count;
	}

	public function index()
	{ 

		$data =  [
		  "draw" => intval(Input::get('draw')),
		  "recordsTotal"=> intval($this->getCount()),
		  "recordsFiltered"=> intval($this->getCount()),
		  "data"=> $this->getDuplicateData(intval(Input::get('start')),intval(Input::get('length')))
		];

		return json_encode($data);
	}


	// public function addingFollows()
	// {	
	// 	$students	= $this->user->findGroupByName('students');

	// 	$users		= $this->user->getUsersByGroup($students);

	// 	foreach ($users as $user ) {
			
	// 		$user_ids[] = $user->id;
	// 	}

	// 	$brands 	= Brand::where('status','1')->lists('id');
		
	// 	for ($j=8001; $j <= 9000; $j++) {			

	// 		$r = rand(1,25); $s = rand(1,20);

	// 		$b = array_slice($brands,$s,$r);

	// 		for ($i=0; $i < sizeof($b); $i++) {

	// 			$slug = getbrandslug($b[$i]);

	// 			$data[] = array('brand'=>$slug, 'brand_id'=>$b[$i], 'user_id'=> $user_ids[$j], 'created_at'=> date('Y-m-d H:i:s') );
	// 			// BrandsFollows::create(array('brand'=>$slug, 'brand_id'=>$b[$i], 'user_id'=> $user_ids[$j]));
	// 		}
	// 	}
	// 	// echo"<pre>";print_r($data);exit();

	// 	BrandsFollows::insert($data);

	// 	// return $user_ids;
	// }

	// public function addingFollows()
	// {	
	// 	$users = StudentDetails::all();

	// 	foreach ($users as $user ) {
			
	// 		$user_ids[] = $user->user_id;
	// 		$inst_ids[] = $user->institution_id;
	// 	}

	// 	$insts = Institution::where('status','1')->lists('id');
		
	// 	for ($j=10001; $j < count($user_ids); $j++) {			

	// 		$data[] = array('institution_id'=>$inst_ids[$j], 'user_id'=> $user_ids[$j], 'created_at'=> date('Y-m-d H:i:s') );
	// 	}
	// 	// echo"<pre>";print_r($user_ids);exit();

	// 	InstitutionsFollows::insert($data);
	// }

}