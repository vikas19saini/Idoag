<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Forms\adminNewInstitutionForm;
use idoag\Forms\adminEditInstitutionForm;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;


class AdminInstitutionsController extends \BaseController {

	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $institution
	 *
	 */
	protected $institution;
    protected $feedback;
    protected $post;

    /**
	 * @var $category 
	 *
	 */
	protected $category;
	
	/**
	 * @var $adminNewInstitutionForm
	 *
	 */
	protected $adminNewInstitutionForm;
    protected $adminEditInstitutionForm;


    /**
	 * AdminInstitutionsController Constructor function
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, InstitutionRepositoryInterface $institution, FeedbackRepositoryInterface $feedback, PostRepositoryInterface $post,   adminNewInstitutionForm $adminNewInstitutionForm, adminEditInstitutionForm $adminEditInstitutionForm, CategoryRepositoryInterface $category)
	 {
		$this->user					= $user;
		
		$this->institution		    = $institution;
		
		$this->adminNewInstitutionForm	= $adminNewInstitutionForm;

         $this->adminEditInstitutionForm	= $adminEditInstitutionForm;
		
		$this->category				= $category;
         $this->feedback 	= $feedback;
         $this->post 	      = $post;

         cloudinary();
		
	 }
		
	// method to list all the institutions
	public function index()
	{
        $institutions = Institution::withTrashed()->get();

		return View::make('admin.institutions.index')->withInstitutions($institutions);
	}

    public function institutionDashboard($slug)
    {
// dd('ss');
        $institution	    = $this->institution->findBySlug($slug);

        $inst_users	= $this->user->getUsersByInstitution($institution->id);

        $events= $this->post->getPostByTypeAndInstitutionId('event', $institution->id,2);

        $texts= $this->post->getPostByTypeAndInstitutionId('text', $institution->id,2);

        $photos= $this->post->getPostByTypeAndInstitutionId('photo', $institution->id,2);

        $feedbacks= $this->feedback->getByInstitution($institution->id);

        $follow_ids = DB::table('institutions_follows')->where('institution_id',$institution->id)->lists('user_id');

        $followers=$this->user->getUsersByIds($follow_ids);

        $member_ids = DB::table('student_details')->where('institution_id',$institution->id)->lists('user_id');

        $members = $this->user->getUsersByIds($member_ids);

        //Statistics

        $statistics=array();

        $statistics['link_count']  = $this->post->getTotalPostCountByInstitution('link',$institution->id);

        $statistics['photo_count']        = $this->post->getTotalPostCountByInstitution('photo',$institution->id);

        $statistics['event_count']        = $this->post->getTotalPostCountByInstitution('event',$institution->id);

        $statistics['total_feedback_count'] = $this->feedback->getTotalByBrand($institution->id);

        $statistics['total_not_replied'] = $this->feedback->getTotalWithoutReplyByInstitution($institution->id);

        $date3          = date('Y-m-d H:i:s',time()-(31*86400));

        $statistics['month_followers']=InstitutionsFollows::where('institution_id',$institution->id)->where('created_at','>=',$date3)->count();

        $statistics['posts_visits_count'] =PostVisitsOfInstitution($institution->id,$date3);

        $statistics['posts_likes_count']  =PostLikesOfInstitution($institution->id,$date3);

          return View::make('admin.institutions.dashboard', compact('institution','inst_users','members','followers','statistics','feedbacks','events','texts','photos'));
    }

	// method to show brand creation form
	public function create()
	{
		$categories = $this->category->getList();
		
		return View::make('admin.institutions.create')->withCategories($categories);
	}

	// method to proces institution creation
	public function store()
	{

		$input = Input::except('image');
								
		try 
		{
			$this->adminNewInstitutionForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		$input = Input::except('image');
		
		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->institution->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', 1);

                $input 	= array_add($input, 'color1', '#ed6d63');
                $input 	= array_add($input, 'type', Input::get('type'));



        if(Input::hasFile('image'))
		{
			$file = Input::file('image');

					
			// validating each file.
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
								
				$file->move('uploads/institutions/', $filename);
				
				$destionation 	= public_path() .'/uploads/institutions/';
				
				$image 			= IImage::make(sprintf('uploads/institutions/%s', $filename));
				
				$image->save($destionation.$filename);
													
				$input['image'] = $filename;
				
			}else {
															
				// redirect back with errors.
				return Redirect::back()->withInput()->withErrors($validator);
												
			}
			
		}
		
		$institution = $this->institution->create($input);
			
		return Redirect::back()->withFlashMessage('Institution have been successfully created!');		
	}

	// method to show institution update form
	public function edit($id)
	{
		$institution = $this->institution->find($id);

                $cities= City::where('state_id','=',$institution->state)->lists('name', 'id');

		return View::make('admin.institutions.edit')->withInstitution($institution)->withCities($cities);
	}

	// method to process brand updation
	public function update($id)

	{

		$institution = $this->institution->find($id);
		
		$oldbrand	= $institution->slug;
			
		$input 		= Input::except('image');
								
		try 
		{
			$this->adminEditInstitutionForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		

		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->institution->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', 1);
		$input 	= array_add($input, 'type', Input::get('type'));

		
		if(Input::hasFile('image'))
		{
			$file = Input::file('image');
					
			// validating each file.
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
								
				$file->move('uploads/institutions/', $filename);
				
				$destionation 	= public_path() .'/uploads/institutions/';
				
				$image 			= IImage::make(sprintf('uploads/institutions/%s', $filename));
				
				$image->save($destionation.$filename);
													
				$input['image'] = $filename;
											
			}else {
															
				// redirect back with errors.
				return Redirect::back()->withInput()->withErrors($validator);
												
			}
			
		}

		
		$institution->fill($input)->save();
								
		return Redirect::back()->withFlashMessage('Institution have been successfully updated!');
	}
	
	// Create template
	public function createTemplate($id)
	{
		
		$institution = $this->institution->find($id);
		
		$sqlSel = DB::table('tb_institution_template')->where(['college_id' => $id])->get();
			
		return View::make('admin.template')->withInstitution($institution)->with(['data' => $sqlSel]);

	}
	
	public function addUpdateTemplate(){
		
		if($_POST){
			
			//print_r($_FILES);
			
			//die();
			$id = $_POST['cid'];
			$institution = $this->institution->find($id);
			// Logo
			/*$file_name = $_FILES['image']['name'];
			$file_tmp = $_FILES['image']['tmp_name'];
			if(!empty($file_name)){
			move_uploaded_file($file_tmp,"logoimage/".$file_name);
			}*/
			
			// Card design
			$card_file_name = time().$_FILES['carddesign']['name'];
			$card_file_tmp = $_FILES['carddesign']['tmp_name'];
			if(!empty($card_file_name)){
			move_uploaded_file($card_file_tmp,"carddesign/".$card_file_name);
			}			
			
			$sqlSel = DB::table('tb_institution_template')->where(['college_id' => $id])->get();
			if(count($sqlSel) > 0){
				/*if(!empty($file_name)){
					$img = $file_name;
				}else{
					$img = $sqlSel[0]->logo;
				}*/
				
				if(!empty($_FILES['carddesign']['name'])){
					$cardimg = $card_file_name;
				}else{
					$cardimg = $sqlSel[0]->front_card_design;
				}
				
				$sqlUpdate = DB::table('tb_institution_template')->where(['college_id' => $id])->update(['content' => $_POST['content'], 'front_card_design' => $cardimg, 'roll_no_required' => $_POST['rollno']]);
			}else{
				$sqlInsert = DB::table('tb_institution_template')->insert(['college_id' => $id, 'content' => $_POST['content'], 'front_card_design' => $card_file_name, 'roll_no_required' => $_POST['rollno']]);

			}
			
			return Redirect::back()->withInstitution($institution)->with(['data' => $sqlSel]);
			
		}
	}
	
	// route to export all institutions data as an excel sheet
	public function getInstitutionsExcelExport()
	{
		
		$institutions 	= Institution::all();// $this->institution->getAll();

        $institutions	= array_to_object($institutions );

        $institutions 	= json_decode(json_encode($institutions), true);
		
		// Exporting to excel sheet							 
		Excel::create('InstitutionList', function($excel) use($institutions) {
		
			$excel->sheet('Institutions', function($sheet) use($institutions) {
		
				$sheet->fromArray($institutions);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Institutions exported as Excel successfully!');
	 
	}
	
	// method to import all brands data from an excel sheet
	public function postInstitutionsExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/institutionslist.xls', function($reader) {
			
			$results = $reader->select(array('name', 'description', 'image', 'public_id', 'priority', 'status'))->get();
			
			foreach($results as $result)
			{
				if($result->name)
				{

                    $institution 		= $this->institution->findBySlug($result->name);
					
					$oldinstitution	= $institution->slug;

					if($institution)
					{
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->institution->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'image' => $result->image, 'public_id' =>  $result->public_id,  'priority' => $result->priority, 'status' => $result->status);

							//dd($input);

                            $institution->fill($input)->save();

                            $institution->save();

		
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
						
					} else { 
						
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->institution->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'image' => $result->image, 'public_id' =>  $result->public_id,  'priority' => $result->priority, 'status' => $result->status);
							
							$brand = $this->institution->create($input);
							

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
	
	// method to do multi actions on selected institutions
	public function postAdminInstitutionsActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$institutions = Input::get('checkall');
			
			$this->institution->activate($institutions);
			
			return Redirect::back()->withFlashMessage('Selected Institutions Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
            $institutions = Input::get('checkall');
			
			$this->institution->deactivate($institutions);
			
			return Redirect::back()->withFlashMessage('Selected Institutions Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
            $institutions = Input::get('checkall');
			
			$this->institution->trash($institutions);
			
			return Redirect::back()->withFlashMessage('Selected Institutions Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
            $institutions = Input::get('checkall');
			
			$this->institution->untrash($institutions);
			
			return Redirect::back()->withFlashMessage('Selected Institutions Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some Institutions');
	}



}