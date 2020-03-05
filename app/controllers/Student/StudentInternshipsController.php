<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;
use idoag\Forms\InternshipApplyForm;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\Student\StudentInternshipDetailsRepositoryInterface;
use idoag\Repos\ActivityRepositoryInterface;
use Illuminate\Http\Request;

class StudentInternshipsController extends \BaseController {

	/**
	 * @var $user 
	 *
	 */
	protected $user;
	

	
	/**
	 * @var $brand 
	 *
	 */
	protected $brand; 

	/**
	 * @var $post 
	 *
	 */
	protected $post; 

	/**
	 * @var $post 
	 *
	 */
	protected $student;

	/**
	 * @var $post 
	 *
	 */
	protected $internship;

    protected $internshipApplyForm;




    /**
	 * PagesController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user,  ActivityRepositoryInterface $activity, BrandRepositoryInterface $brand, StudentInternshipDetailsRepositoryInterface $student_internship, InstitutionRepositoryInterface $institution, PostsVisitsRepositoryInterface $posts_visits,CategoryRepositoryInterface $category, PostRepositoryInterface $post, StudentDetailsRepositoryInterface $student, StudentInternshipRepositoryInterface $internship, InternshipApplyForm $internshipApplyForm)
	{
		$this->user		= $user; 
				
		$this->brand 	= $brand; 

        $this->category	= $category;

        $this->post 	= $post;

        $this->institution = $institution;

        $this->student 	= $student; 

        $this->internship = $internship;

        $this->posts_visits = $posts_visits;

        $this->internshipApplyForm = $internshipApplyForm;

        $this->student_internship=$student_internship;

        $this->logged_user=Sentry::getUser();

        $this->activity     = $activity;

    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
        $input=Input::except('_token');        

        $post = $this->post->find(Input::get('post_id'));

        if($post->resume_preference=="Any" && !Input::hasFile('resume') && !Input::hasFile('video_resume')&& !Input::get('video_url'))
        return Redirect::back()->withInput()->withErrorMessage('Required any resume');

        try
        {
           $this->internshipApplyForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrorMessage($e->getErrors());
        }
         $input = array_add($input, 'user_id', $this->logged_user->id);
         $input = array_add($input, 'brand_id', $post->brand_id);        

        if(Input::get('answer1')!='')
           $input = array_add($input, 'answer1', Input::get('answer1'));

        if(Input::get('answer2')!='')
            $input = array_add($input, 'answer2', Input::get('answer2'));

        if(Input::get('answer3')!='')
            $input = array_add($input, 'answer3', Input::get('answer3'));

        if(Input::get('answer4')!='')
            $input = array_add($input, 'answer4', Input::get('answer4'));

        if(Input::get('answer5')!='')
            $input = array_add($input, 'answer5', Input::get('answer5'));

        if(Input::get('video_url')!='') {
            $video_url = Input::get('video_url');
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches);
            if($matches)
            $input = array_add($input, 'video_url', 'https://www.youtube.com/embed/'.$matches[1]);
            else{                
                return Redirect::back()->withInput()->withErrorMessage('Invalid youtube url');
            
            }

        }


        if(Input::hasFile('resume'))
        {
            $file = Input::file('resume');

            // validating each file.
            $validator 	= Validator::make( array('file' => $file), array('file' => 'required|max:3000|mimes:doc,docx,pdf') );

            if($validator->passes()){


                $filename = time().'_'.$file->getClientOriginalName();

                $filename = str_replace(' ','_',$filename);

                $file->move('uploads/resumes/', $filename);

                $input['resume'] = $filename;
            }
            else 
            {
                // redirect back with errors.
                $errors = $validator->messages();

                return Redirect::back()->withInput()->withErrorMessage('Document Resume should be doc/docx/pdf only');
            }
        }

        if(Input::hasFile('video_resume'))
        {
            $file = Input::file('video_resume');

            // validating each file.
            $validator 	= Validator::make( array('file' => $file), array('file' => 'required|max:50000|mimes:wmv,asf,mp4') );

            if($validator->passes()){

                $filename = time().'_'.$file->getClientOriginalName();

                $filename = str_replace(' ','_',$filename);

                $file->move('uploads/video_resumes/', $filename);

                $input['video_resume'] = $filename;
            }
            else
            {                
                $errors = $validator->messages();
                return Redirect::back()->withInput()->withErrorMessage('Video Resume should be mp4/wmv only');
            }
        }
        
        $internship = Internship::where('post_id', Input::get('post_id'))->where('user_id', $this->logged_user->id)->where('status', 2)->first();
        
        if($internship == null)
            $internship = $this->internship->create($input);
        else{
            $input['status'] = 0;
            $internship->fill($input);
            $internship->save();
        }

        $this->activity->create(array('type'=>'internship','post_id'=>$post->id,'brand_id'=>$post->brand_id,'internship_id'=>$internship->id,'user_id'=>$this->logged_user->id,'message'=>'Applied Internship/Job - '.getPostName($internship->post_id)));

        $data['postname']      = getPostName($internship->post_id);
        $data['name'] 	       = $this->logged_user->first_name.' '.$this->logged_user->last_name;
        $data['email']         = $this->logged_user->email;
        $data['brand']         = getBrandName($post->brand_id);
        $data['internship']    = $internship;

        Mailgun::send('emails.student_apply_internship', $data, function($message) use($data){
            $message->subject('Your Application for Internship at '.$data['brand']);
            $message->to($data['email'], $data['name']);
        });
        
        Mailgun::send('emails.student_apply_internship_admin', $data, function($message) use($data){            
            $message->subject($data['name'] . ' applied at ' . $data['brand'] . ' for internship/job');
            $message->to('info@idoag.com', $data['name']);
        });


        $url='/brands/'.getPostBrandSlug($internship->post_id).'/internships/applied/'.getPostSlug($internship->post_id);

        return Redirect::route('student_internships')->withFlashMessage('ThankYou!! We have received your application for '. getPostType($internship->post_id) . ' ' .getPostName($internship->post_id).'. You could check the status of your application <a href="'.$url.'">here</a>.');
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
         Internship::destroy($id);
        return Redirect::back()->withFlashMessage('Student Internship has been deleted successfully.');
    }

    public function getStudentInternships(){

        $user = Sentry::findUserById(Sentry::getUser()->id);
        $post_ids= Internship::where('user_id', Sentry::getUser()->id)->lists('post_id');

        $myinternships = Internship::join('posts', 'posts.id', '=', 'internships.post_id')->where('internships.user_id', Sentry::getUser()->id)->whereNULL('posts.deleted_at')->select('internships.*')->orderBy('internships.created_at','desc')->get();
        $brand_ids = DB::table('brands_follows')->where('user_id',Sentry::getUser()->id )->lists('brand_id');

        $internships = Post::whereIn('type', array('internship', 'job', 'ambassador'))->whereNotIn('id',$post_ids)->where('status',1)->groupBy('brand_id')->orderBy('id','desc')->take(12)->get();        
        $institution_ids = DB::table('institutions_follows')->where('user_id',$user->id)->lists('institution_id');
        
        $institutions=$this->institution->getInstitutionsByIds($institution_ids);
        $ads = Ad::where('status',1)->first();

        return View::make('students.internships')
                ->withAds($ads)
                ->withInternships($internships)
                ->withMyinternships($myinternships)
                ->withUser($user);
        }
    
    public function getStudentAppliedJobs(){
        $myinternships = Internship::join('posts', 'posts.id', '=', 'internships.post_id')->where('internships.user_id', Sentry::getUser()->id)->whereNULL('posts.deleted_at')->select('internships.*')->orderBy('internships.created_at','desc')->get();
        $time = time() - 2592000;
        $app_counts = Internship::where('created_at', '>', date("Y-m-d h:i:s",$time))->get()->count();
        return View::make('students.applied_all')->withMyinternships($myinternships)->withAppliejobs($app_counts);
    }


	public function getApplyInternship($slug1, $slug2, $intern_id = null){
		
            $brand = $this->brand->findBySlug($slug1);
            $post_detail = $this->post->getPostsBySlug($slug2);
            $internship = $this->internship->isUserApplied(Sentry::getUser()->id,$post_detail->id);
            
              if($internship)
                  return Redirect::route('student_internship_view2',array(getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)))->withErrorMessage('You already applied this internship.');
                
              if($post_detail->end_date < date('Y-m-d'))
                return Redirect::route('student_internship_view2',array(getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)))->withErrorMessage('This internship is expired.');

            $student_detail = $this->student_internship->findbyUserId(Sentry::getUser()->id);
            $student= DB::table('student_details')->where('user_id',$this->logged_user->id)->first();
             
            if(!$student_detail){
                $stu=array('user_id'=>$this->logged_user->id,'course'=>$student->course,'city'=>$student->city,'state'=>$student->state,'email'=>$student->email,'edu_college'=>getInstitutionName($student->institution_id),'edu_course'=>$student->course,'phone'=>Sentry::getUser()->mobile);
                $this->student_internship->create($stu);
                $student_detail = $this->student_internship->findbyUserId(Sentry::getUser()->id);
            }
            $answers = null;
            if(isset($intern_id))
                $answers = DB::table('internships')->select('answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'answer6')->where('id', $intern_id)->where('status', 2)->get();
            
            return View::make('brands.internships.internships_apply')->withBrand($brand)->withPost($post_detail)->withStudentDetail($student_detail)->withStudent($student)->withAnswers($answers);

	}
        
        public function getQuestionsInternship($slug1, $slug2){
            
            $brand = $this->brand->findBySlug($slug1);
            $post_detail = $this->post->getPostsBySlug($slug2);
            $internship = $this->internship->isUserApplied(Sentry::getUser()->id,$post_detail->id);
            
            if($internship)
                return Redirect::route('student_internship_view2',array(getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)))->withErrorMessage('You already applied this internship.');
                
            if($post_detail->end_date < date('Y-m-d'))
                return Redirect::route('student_internship_view2',array(getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)))->withErrorMessage('This internship is expired.');

            $student_detail = $this->student_internship->findbyUserId(Sentry::getUser()->id);
            $student= DB::table('student_details')->where('user_id',$this->logged_user->id)->first();
             
            if(!$student_detail){
                $stu=array('user_id'=>$this->logged_user->id,'course'=>$student->course,'city'=>$student->city,'state'=>$student->state,'email'=>$student->email,'edu_college'=>getInstitutionName($student->institution_id),'edu_course'=>$student->course,'phone'=>Sentry::getUser()->mobile);
                $this->student_internship->create($stu);
                $student_detail = $this->student_internship->findbyUserId(Sentry::getUser()->id);
            }            
            
            $answers = Internship::where('post_id', $post_detail->id)->where('user_id', Sentry::getUser()->id)->where('status', 2)->get();
            
            return View::make('brands.internships.internships_question')->withBrand($brand)
                    ->withPost($post_detail)
                    ->withStudentDetail($student_detail)
                    ->withStudent($student)
                    ->withAnswers($answers);
        }
        
        public function postQuestionsInternship($slug1, $slug2){
            
            $brand = $this->brand->findBySlug($slug1);
            $post_detail = $this->post->getPostsBySlug($slug2);
            
            $answers = Internship::where('post_id', $post_detail->id)->where('user_id', Sentry::getUser()->id)->where('status', 2)->first();
            
            if(count($answers) > 0){
                $answers->fill(Input::except('_token'));
                $answers->save();
                return Redirect::route('apply_internship', array($slug1, $slug2, $answers->id));
            }else{
                $data = new Internship();            
                $data_1['status'] = 2;
                $data_1['post_id'] = $post_detail->id;
                $data_1['brand_id'] = $brand->id;
                $data_1['user_id'] = Sentry::getUser()->id;
                $data->fill(Input::except('_token'));
                $data->fill($data_1)->save();
            
                return Redirect::route('apply_internship', array($slug1, $slug2, $data->id));
            }            
            
        }

}
