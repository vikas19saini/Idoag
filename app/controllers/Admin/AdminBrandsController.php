<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Forms\adminNewBrandForm;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\ProblemRepositoryInterface;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;


class AdminBrandsController extends \BaseController {

	/**
	 * @var $user 
	 *
	 */
	protected $user;

    protected $feedback;

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

    protected $post;

    protected $problem;

    protected $outlet;

    /**
	 * @var $adminNewBrandForm 
	 *
	 */
	protected $adminNewBrandForm;

    protected $institution;

    protected $internship;


    /**
	 * AdminBrandsController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user,   StudentInternshipRepositoryInterface $internship, PostRepositoryInterface $post,  ProblemRepositoryInterface $problem, FeedbackRepositoryInterface $feedback, OutletRepositoryInterface $outlet, BrandRepositoryInterface $brand, adminNewBrandForm $adminNewBrandForm, CategoryRepositoryInterface $category, InstitutionRepositoryInterface $institution)
	 {
		$this->user					= $user;
		
		$this->brand				= $brand;
		
		$this->adminNewBrandForm	= $adminNewBrandForm;
		
		$this->category				= $category;

        $this->institution			= $institution;

         $this->outlet 	        = $outlet;

         $this->post 	      = $post;

         $this->feedback 	= $feedback;

         $this->problem				= $problem;

         $this->internship 	= $internship;



         cloudinary();
		
	 }
		
	// method to list all the brands
	public function index()
	{
        $brands =Brand::withTrashed()->get();
		
		return View::make('admin.brands.index')->withBrands($brands);
	}


	// method to show brand creation form
	public function create()
	{		

		$categories = $this->category->getList();

        $institutions = $this->institution->getList();
		
		return View::make('admin.brands.create')->withCategories($categories)->withInstitutions($institutions);
	}

	// method to proces brand creation
	public function store()
	{		
		$input = Input::except('image','coverimage','category','state','city','institution_id');
		//echo '<pre>';print_r($input);	exit();
		try 
		{
			$this->adminNewBrandForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->category->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', 1);
		
		$input 	= array_add($input, 'category', implode(",",Input::get('category')));
		
		$categories = Input::get('category');
		
		foreach($categories as $key => $category)
		{
			$categories[$key] = $this->category->findBySlug($category);
		}

        $input 	= array_add($input, 'color1', '#ed6d63');

		if(Input::hasFile('image'))
		{
			$file = Input::file('image');

			//echo"<pre>";print_r($file);exit();
					
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
				$file->move('uploads/brands/', $filename);
					
				$destination 	= public_path() .'/uploads/brands/';
				
				$image 			= IImage::make(sprintf('uploads/brands/%s', $filename));
				
				$image->save($destination.$filename);
													
				$input['image'] = $filename;

				//$input['color1'] = $image->pickColor(100, 100, 'hex');

				// $response 		= \Cloudinary\Uploader::upload('uploads/brands/'.$filename, array("colors" => TRUE));
				
				// // echo "<pre>";print_r($response);exit;
				
				// try
				// {

				// 	if($response['public_id'])
				// 	{
				// 		$input['public_id'] = $response['public_id'];

				// 		$input['colors']	= json_encode($response['colors']);//['predominant']['google']);

				// 	    $obj = json_decode(json_encode($response['colors']), true);

				// 	    $input['color1'] = $obj[0][0];				

				// 	    $input['color2'] = $obj[1][0];		

				// 		saveImage('http://res.cloudinary.com/'.Config::get("constants.cloudinary.cloud_name").'/image/upload/c_lpad,h_130,w_98/v'.$response['version'].'/'.$response['public_id'], 'uploads/130_98_'.$filename);

				// 		saveImage('http://res.cloudinary.com/'.Config::get("constants.cloudinary.cloud_name").'/image/upload/c_lpad,h_179,w_179/v'.$response['version'].'/'.$response['public_id'], 'uploads/179_179_'.$filename);

				// 	}
					 

				// } catch(Exception $e)
				// {
				// 	Log::error($e);
				// }

				// echo"<pre>";print_r($input);exit();		
				
			}else {														
				// redirect back with errors.
				return Redirect::back()->withInput()->withErrors($validator);												
			}		
		}

        if(Input::hasFile('coverimage'))
        {
            $file = Input::file('coverimage');

            $rules 		= array('file' => 'required|image|max:10240');

            $validator 	= Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){

                $filename = time().Str::lower(

                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );
       
                $filename = 'ci_'.$filename;

                $filename = str_replace(' ','_',$filename);

                $file->move('uploads/brandcover/', $filename);

                $destination 	= public_path() .'/uploads/brandcover/';

                $image 			= IImage::make(sprintf('uploads/brandcover/%s', $filename));

                $image->save($destination.$filename);

                $input['coverimage'] = $filename;

            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }		

        //echo "<pre>";print_r($input);exit();

		$brand = $this->brand->create($input);

		$brand->categories()->detach();
		
		foreach($categories as $category)
		{
			$brand->categories()->attach($category->id);
		}

		$students	= $this->user->findGroupByName('students');

		$users		= $this->user->getUsersByGroup($students);

		foreach ($users as $user ) {	

			if($user->old_password == NULL)
			{
				$user_ids[] = $user->id;
			}
		}

		//  print_r($user_ids);exit;

		for ($j=1; $j <= sizeof($user_ids); $j++) {

			$data = array('brand'=>$brand->slug, 'brand_id'=>$brand->id, 'user_id'=> $user_ids[$j-1] );
            BrandsFollows::create($data);
        }


		return Redirect::route('admin_brands')->withFlashMessage('Brand have been successfully created!');		
	}

	// method to show brand updation form
	public function edit($id)
	{
		$brand 		= $this->brand->find($id);
		
		$categories = $this->category->getList();

        $institutions = $this->institution->getList();

        $cities= City::where('state_id','=',$brand->state)->lists('name', 'id');
		
		return View::make('admin.brands.edit')->withBrand($brand)->withCategories($categories)->withInstitutions($institutions)->withCities($cities);
	}


    public function brandDashboard($slug)
    {	//echo"hi";exit();
        $brand	    = $this->brand->findBySlug($slug);

        $brand_users	= $this->user->getUsersByBrand($brand->id);

        $offers = $this->post->getPostByTypeAndBrandId('offer', $brand->id,2);

        $internships = $this->post->getPostByTypeAndBrandId('internship', $brand->id,2);

        $events= $this->post->getPostByTypeAndBrandId('event', $brand->id,2);

        $texts= $this->post->getPostByTypeAndBrandId('text', $brand->id,2);

        $photos= $this->post->getPostByTypeAndBrandId('photo', $brand->id,2);

        $outlets= $this->outlet->getByBrand($brand->id);

        $feedbacks= $this->feedback->getByBrand($brand->id);

        $problems = $this->problem->getByBrand($brand->id);

        $follow_ids = DB::table('brands_follows')->where('brand_id',$brand->id)->lists('user_id');

        $followers=$this->user->getUsersByIds($follow_ids);

        //Statistics

        $statistics=array();

        $statistics['offer_count']        = $this->post->getTotalPostCountByBrand('offer',$brand->id);

        $statistics['link_count']  = $this->post->getTotalPostCountByBrand('link',$brand->id);

        $statistics['photo_count']        = $this->post->getTotalPostCountByBrand('photo',$brand->id);

        $statistics['internship_count']   = $this->post->getTotalPostCountByBrand('internship',$brand->id);

        $statistics['event_count']        = $this->post->getTotalPostCountByBrand('event',$brand->id);

        $statistics['outlet_count']        = $this->outlet->getTotalByBrand($brand->id);

        $statistics['total_feedback_count'] = $this->feedback->getTotalByBrand($brand->id);

        $statistics['total_not_replied'] = $this->feedback->getTotalWithoutReplyByBrand($brand->id);

        $internship_list = $this->post->getPostIdsByBrandAndType($brand->id,'internship');

        $statistics['applied_internships_count'] = $this->internship->getCountByPostIds($internship_list);

        $date3          = date('Y-m-d H:i:s',time()-(31*86400));

        $statistics['month_followers']=BrandsFollows::where('brand_id',$brand->id)->where('created_at','>=',$date3)->count();

        $statistics['posts_visits_count'] =PostVisitsOfBrand($brand->id,$date3);

        $statistics['posts_likes_count']  =PostLikesOfBrand($brand->id,$date3);


        return View::make('admin.brands.dashboard', compact('brand','brand_users','followers','statistics','outlets','feedbacks','problems','offers','internships','events','texts','photos'));
    }

	// method to process brand updation
	public function update($id)
	{

		$brand 		= $this->brand->find($id);
		
		$oldbrand	= $brand->slug;
			
		$input 		= Input::except('image','coverimage');
								
		try 
		{
			$this->adminNewBrandForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		$input 	= Input::except('image', 'category');
		
		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->category->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', 1);
		
		$input 	= array_add($input, 'category', implode(",",Input::get('category')));
		
		$categories = Input::get('category');
		
		foreach($categories as $key => $category)
		{
			$categories[$key] = $this->category->findBySlug($category);
		}
		
		//echo "<pre>";print_r($categories);exit;
		
		if(Input::hasFile('image'))
		{
			$file = Input::file('image');
					
			// validating each file.
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = time().Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
       
                $filename = str_replace(' ','_',$filename);

				$file->move('uploads/brands/', $filename);
				
				$destination 	= public_path() .'/uploads/brands/';
				
				$image 			= IImage::make(sprintf('uploads/brands/%s', $filename));
				
				$image->save($destination.$filename);

                $input 	= array_add($input, 'image', $filename);

				//$input['color1'] = $image->pickColor(100, 100, 'hex');
				
				//dd($filename);
				
			}else {
															
				// redirect back with errors.
				return Redirect::back()->withInput()->withErrors($validator);
												
			}
			
		}
		
        if(Input::hasFile('coverimage'))
        {
            $file = Input::file('coverimage');

            // validating each file.
            $rules 		= array('file' => 'required|image|max:10240');

            $validator 	= Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){

                $filename2 = time().Str::lower(

                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );

                $filename2 = 'ci_'.$filename2;

                $filename2 = str_replace(' ','_',$filename2);

                $file->move('uploads/brandcover/', $filename2);

                $destionation 	= public_path() .'/uploads/brandcover/';

                $image 			= IImage::make(sprintf('uploads/brandcover/%s', $filename2));

                $image->save($destionation.$filename2);

                $input['coverimage'] = $filename2;

            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }
		
		$brand->fill($input)->save();
		
		$brand = $this->brand->find($id);
		
		DB::transaction(function() use ($brand, $oldbrand, $categories)
		{
			$brand->categories()->detach();
			
			$users	= 	$this->user->getWhere('brand', $oldbrand);
														
			foreach($users as $user_info)
			{													
				if($user_info->brand == $oldbrand)
				{
					$input = array();
					
					$input['brand']	= $brand->slug;
										
					$user_info->fill($input)->save();
				}
			}
			
			foreach($categories as $category)
			{
				$brand->categories()->attach($category->id);
			}
			
		});
								
		return Redirect::route('admin_brands')->withFlashMessage('Brand have been successfully updated!');
	}
	
	// route to export all brands data as an excel sheet
	public function getBrandsExcelExport()
	{
		
		$brands 	= $this->brand->getAll();
		
		$brands		= array_to_object($brands);
		
		$brands 	= json_decode(json_encode($brands), true);
		
		// Exporting to excel sheet							 
		Excel::create('BrandsList', function($excel) use($brands) {
		
			$excel->sheet('Brands', function($sheet) use($brands) {
		
				$sheet->fromArray($brands);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Brands exported as Excel successfully!');
	 
	}
	
	// method to import all brands data from an excel sheet
	public function postBrandsExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/brandslist.xls', function($reader) {
			
			$results = $reader->select(array('name', 'description', 'image', 'public_id', 'category',  'priority', 'status'))->get();
			
			foreach($results as $result)
			{
				if($result->name)
				{
											
					$brand 		= $this->brand->findBySlug($result->name);
					
					$oldbrand	= $brand->slug;

					if($brand)
					{
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->brand->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'image' => $result->image, 'public_id' =>  $result->public_id, 'category' => $result->category, 'priority' => $result->priority, 'status' => $result->status);
							
							$categories = $result->category;
		
							foreach($categories as $key => $category)
							{
								$categories[$key] = $this->category->findBySlug($category);
							}
		
							//dd($input);
							
							$brand->fill($input)->save();
				
							$brand->save();	
							
							DB::transaction(function() use ($brand, $oldbrand, $categories)
							{
								$users	= 	$this->user->getWhere('brand', $oldbrand);
																
								foreach($users as $user_info)
								{													
									if($user_info->brand == $oldbrand)
									{
										$input = array();
					
										$input['brand']	= $brand->slug;
															
										$user_info->fill($input)->save();
									}
								}
								
								$brand->categories()->detach();
								
								foreach($categories as $category)
								{
									$brand->categories()->attach($category->id);
								}
			
							});
		
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
						
					} else { 
						
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->brand->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'image' => $result->image, 'public_id' =>  $result->public_id, 'category' => $result->category, 'priority' => $result->priority, 'status' => $result->status);
							
							$brand = $this->brand->create($input);
							
							$categories = $result->category;
		
							foreach($categories as $key => $category)
							{
								$categories[$key] = $this->category->findBySlug($category);
							}
		
							$brand->categories()->detach();
								
							foreach($categories as $category)
							{
								$brand->categories()->attach($category->id);
							}
											
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
					
					}
				}
			}
			
		});
		
		return Redirect::back()->withFlashMessage('Brands Imported Successfully');
	}
	
	// method to do multi actions on selected brands
	public function postAdminBrandsActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$brands = Input::get('checkall');
			
			$this->brand->activate($brands);	
			
			return Redirect::back()->withFlashMessage('Selected brands Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$brands = Input::get('checkall');
			
			$this->brand->deactivate($brands);	
			
			return Redirect::back()->withFlashMessage('Selected brands Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$brands = Input::get('checkall');
			
			$this->brand->trash($brands);	
			
			return Redirect::back()->withFlashMessage('Selected brands Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$brands = Input::get('checkall');
			
			$this->brand->untrash($brands);	
			
			return Redirect::back()->withFlashMessage('Selected brands Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some brands');
	}

}
