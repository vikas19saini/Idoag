<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\BrandsFollowsRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;

class MainBrandsController extends \BaseController {

    /**
     * @var $brand
     *
     */
    protected $brand;

    /**
     * @var $category
     *
     */
    protected $category;

    /**
     * @var $brands_follows
     *
     */
    protected $brands_follows;

    protected $institution;

	protected $outlet;


    function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand, InstitutionRepositoryInterface  $institution, OutletRepositoryInterface $outlet,  CategoryRepositoryInterface $category, BrandsFollowsRepositoryInterface $brands_follows, StudentDetailsRepositoryInterface $studentDetails)
    {

		$this->user 					= $user;

        $this->brand					= $brand;
		
        $this->category					= $category;

        $this->brands_follows			= $brands_follows;
		
		$this->student_details          = $studentDetails;

        $this->institution              = $institution;
		
		$this->outlet 					= $outlet;

        cloudinary();

		}

	public function index()
	{
        //$brands 			= $this->brand->getAll();
 		
 		//$brands =  Brand::select(DB::raw("SELECT * FROM brands as a LEFT JOIN (SELECT `brand_id`,COUNT(`brand_id`) as c FROM `brands_follows` GROUP BY `brand_id`) as x ON x.brand_id = a.id ORDER BY c DESC"))->get(); 		

		$brands= Brand::select(DB::raw('brands.*, count(fol.brand_id) as c'))
			->leftJoin(DB::raw('(select * from brands_follows where deleted_at is null) as fol'), 'brands.id', '=', 'fol.brand_id')
			->groupBy('brands.id')
			->orderBy('c', 'desc')->orderBy('created_at', 'desc')->get();
 		// echo"<pre>";print_r($brands);exit();

        if(Sentry::check())
        {
        	$user 	 			= Sentry::getUser(); 

            $user_group 		= $user->getGroups()->first()->name;

        	$brands_follows 	= $this->brands_follows->getBrandsFollowing($user->id);
			

            if($user_group == 'Students') {
		 
				$student_details 	=  $this->student_details->findbyUserId($user->id);

				if($student_details->city)
				{
					$brand_ids= $this->outlet->getStoresByCity(getCity($student_details->city));

					$near_brands=$this->brand->getBrandsByIds($brand_ids);
 				}
				else
				{
					$near_brands=$this->brand;
				}

                $institution =  $this->institution->find($student_details->institution_id);					


                if($institution->city)
                {

                    $brand_ids= $this->outlet->getStoresByCity(getCity($institution->city));
                     if($brand_ids)
                    {	
                    	$local_brands=$this->brand->getBrandsByIds($brand_ids);
                    }
                    else 
                    {	
                        $brand_ids= $this->outlet->getStoresByCity($student_details->city);
                        
                        $local_brands=$this->brand->getBrandsByIds($brand_ids);
                    }
                }
                else
                {	 
                    $local_brands= $this->brand;
                }
//                 print_r($local_brands);exit();
                return View::make('pages.brands')->withBrands($brands)->withNearBrands($near_brands)->withLocalBrands($local_brands)->withBrandsFollows($brands_follows)->withStudentDetails($student_details);
			}
		 

	       return View::make('pages.brands')->withBrands($brands)->withBrandsFollows($brands_follows);
        }

        return View::make('pages.brands')->withBrands($brands);
	}

    public function brandCategory($slug)
    {

        $brands 			= $this->brand->findByCategory($slug);

        $user_id 			= Sentry::getUser()->id;

        $brands_follows 	= $this->brands_follows->getBrandsFollowing($user_id);
		
		if(Sentry::check())
        {
        	$user_id 			= Sentry::getUser()->id; 
			
			 $student_details =  $this->student->where('user_id',$user_id)->first();
			
			if($student_details->city!='')
			{
			$brand_ids= $this->outlet->getStoresByCity($student_details->city);
			$near_brands=$this->brand->getBrandsByIds($brand_ids);
			}
			else
			$near_brands='';
			 
	        return View::make('pages.brands')->withBrands($brands)->withNearBrands($near_brands)->withBrandsFollows($brands_follows);
        }
        
        return View::make('pages.brands')->withBrands($brands)->withBrandsFollows($brands_follows);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getNearBrands()
    {
        $user_id 			= Sentry::getUser()->id;

        $student_details =  StudentDetails::where('user_id',$user_id)->first();

        if($student_details->city!='') {
            $brand_ids = $this->outlet->getStoresByCity($student_details->city);
        }
        else
            $brand_ids=array();
         if($brand_ids)
            $near_brands=Brand::getBrandsByIds($brand_ids);
        else
            $near_brands=$this->brand;

        return View::make('students.near_brands')->withNearBrands($near_brands)->withStudentDetails($student_details);

    }

    public function getLocalBrands()
    {

        $user_id 			= Sentry::getUser()->id;

        $student_details = StudentDetails::where('user_id',$user_id)->first();

        $institution =  $this->institution->find($student_details->institution_id);

        if($institution->city)
        {
            $brand_ids= $this->outlet->getStoresByCity($institution->city);

            if($brand_ids)
            {
                $local_brands=$this->brand->getBrandsByIds($brand_ids);
            }
            else
            {
                $brand_ids= $this->outlet->getStoresByCity($student_details->city);
                $local_brands=$this->brand->getBrandsByIds($brand_ids);
            }
        }
        else
        {
            $local_brands= $this->brand;
        }
        // print_r($local_brands);print_r($near_brands);exit();
        return View::make('students.local_brands')->withLocalBrands($local_brands)->withStudentDetails($student_details);

    }

	/**
	 * Brand Follows update
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function userBrandFollows()
	{		
		if(Request::ajax())
		{
		    $brand_id 		= Input::get('brand_id');

		    $user_id 		= Sentry::getUser()->id;
		    
		    $brand 			= Brand::find($brand_id);
		   
		    $input 			= array('brand'=>$brand->slug,'brand_id'=>$brand_id,'user_id'=>$user_id);

		    $follows 		= $this->brands_follows->checkFollows($brand_id, $user_id);


			if($follows && $brand->slug != 'idoag')
			{
				$follow_action		= $this->brands_follows->delete($follows->id);
         		
         		$activity 			= Activity::where('type','brand_follows')->where('brand_id',$brand_id)->where('user_id',$user_id)->delete();

				$count 				= $this->brands_follows->getCount($brand_id);

				return Response::json(array(
					'message'=>'FOLLOW',
					'count' => $count,
					'brand_id'=>$brand_id));
			}
			else
			{	
				// if($brand->slug != 'idoag')
				// {
					$follow_action		= $this->brands_follows->create($input);

					$activity 			= Activity::create(array('type'=>'brand_follows','brand_id'=>$brand_id,'user_id'=>$user_id));

					$count 				= $this->brands_follows->getCount($brand_id);

			   		return Response::json(array(
						'message'=>'FOLLOWING',
						'count' => $count,
						'brand_id'=>$brand_id));
			   	// }
		    }
		}
	}

}
