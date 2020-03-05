<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\InternshipCategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\Student\StudentInternshipDetailsRepositoryInterface;
use idoag\Repos\ActivityRepositoryInterface;


class InternshipsController extends \BaseController {

	protected $user;

	protected $setting;

	protected $brand; 

	protected $post;

    protected $note;

    protected $internship;

    protected $activity;

    /**
	 * PagesController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, ActivityRepositoryInterface $activity, PostsVisitsRepositoryInterface $posts_visits, StudentInternshipDetailsRepositoryInterface $student_internship, StudentInternshipRepositoryInterface $internship, PostRepositoryInterface $post,SettingsRepositoryInterface $setting, BrandRepositoryInterface $brand, InternshipCategoryRepositoryInterface $category, FeedbackRepositoryInterface $note)
	{
		$this->user		= $user;
		
		$this->setting 	= $setting;
		
		$this->brand 	= $brand; 

		$this->post 	= $post; 

        $this->category	= $category;

        $this->note     = $note;

        $this->internship 	= $internship;

        $this->posts_visits = $posts_visits;

        $this->student_internship=$student_internship;

        $this->activity=$activity;

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
	public function edit($slug1, $slug2)
	{
        $brand_detail	= $this->brand->findBySlug($slug1);
        $internship_detail = $this->post->getPostsBySlug($slug2);
        $categories= $this->category->getList();
        $cities= City::where('state_id','=',$internship_detail->state)->lists('name', 'id');
        return View::make('brands.internships.edit')->withBrand($brand_detail)->withInternship($internship_detail)->withCities($cities)->withCategories($categories);

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

	public function createInternships($slug){
		
		$brand_detail	= $this->brand->findBySlug($slug);
		
        $categories= $this->category->getList(); 

        return View::make('brands.internships.create')->withBrand($brand_detail)->withCategories($categories);
		
	}

	public function getInternships($slug)
	{

           error_reporting(0);
            
        $brand_detail	= $this->brand->findBySlug($slug);

        $type = 'internship';

        if (Sentry::check() && Sentry::getUser()->brand_id==$brand_detail->id )
           $internships = $this->post->getPostByTypeAndBrandId($type,$brand_detail->id,0);
        else
            $internships = $this->post->getActivePostByTypeAndBrandId($type,$brand_detail->id);

        $internships_count = Post::where(['brand_id' => $brand_detail->id,   'type' => $type])->count();

        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if($loggedin_user->brand_id==$brand_detail->id)
            {
                $notes = $this->note->withoutreply($brand_detail->id);
                $stats=array();
                $stats['internships_count']   = $this->post->getTotalPostCountByBrand('internship',$brand_detail->id);
                $internship_list=$this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');
                $stats['received_app_count']   = $this->internship->getCountByPostIds($internship_list);
                $stats['app_pending_count']   = $this->internship->getCountByPostIdsAndStatus($internship_list,0);

                return View::make('brands.internships.internships_show')->withBrand($brand_detail)->withInternships($internships)->withNotes($notes)->withStats($stats)->withInternshipsCount($internships_count);
            }
            else
            {
                $notes = $this->note->withreply($brand_detail->id);
                return View::make('brands.internships.internships_show')->withBrand($brand_detail)->withInternships($internships)->withNotes($notes)->withInternshipsCount($internships_count);
            }
        }
        else
        {
            return View::make('brands.internships.internships_show')->withBrand($brand_detail)->withInternships($internships);
        }
	}
	
	public function editStudentInternship($id)
	{

	}
    public function appliedInternships($slug)
    {
        $brand_detail	= $this->brand->findBySlug($slug);
        $internship_list=$this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');
        $posts=$this->post->getListByIds($internship_list);
        $categories= $this->category->getList();
        $internships= $this->internship->getByBrandId($brand_detail->id);
        $institutions= $this->internship->getInstitutionsByPostIds($internship_list);
        $this->activity->brandChangeToVisitStatus($brand_detail->id);

        return View::make('brands.internships.applied.list')->withBrand($brand_detail)->withInternships($internships)->withInstitutions($institutions)->withPosts($posts)->withCategories($categories);

    }
    public function appliedInternshipsByPost($slug,$slug2)
    {

        $brand_detail	= $this->brand->findBySlug($slug);
        $post_detail=$this->post->getPostsBySlug($slug2);
        $ids=array('id'=>$post_detail->id);
        $internships= $this->internship->getByPostIds($ids);

        $post_ids=$this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');
        $posts=$this->post->getListByIds($post_ids);
        $institutions= $this->internship->getInstitutionsByPostIds($ids);
         return View::make('brands.internships.applied.list')->withBrand($brand_detail)->withInternships($internships)->withInstitutions($institutions)->withPosts($posts)->withPost($post_detail);

    }
    public function ViewStudentInternship($slug, $id, $slug2)
    {
        error_reporting(0);
        $brand_detail	= $this->brand->findBySlug($slug);
        $post = $this->post->getPostsBySlug($slug2);
        $internship = $this->internship->find($id);
        $student_details = StudentDetails::where('user_id', $internship->user_id)->first();
        $student= $student_details;
        if($internship)
          return View::make('brands.internships.applied.view')->withBrand($brand_detail)->withInternship($internship)->withPost($post)->withStudent($student);
        else
          return Redirect::back()->withErrorMessage('Error in internship details to show');
    }
    public function ViewStudentInternship2($slug,$slug2)
    {
        error_reporting(0);
         $brand_detail	= $this->brand->findBySlug($slug);
         $post=$this->post->getPostsBySlug($slug2);
         $internship= $this->internship->getByUserAndPost($post->id,Sentry::getUser()->id);
         $student= DB::table('student_details')->where('user_id', Sentry::getUser()->id)->first();
         if($internship)
            return View::make('brands.internships.applied.view')
             ->withBrand($brand_detail)
             ->withInternship($internship)
             ->withPost($post)
             ->withStudent($student);
         else
            return Redirect::back()->withErrorMessage('Error in internship details to show');

    }

    public function updateStudentInternship($id)
    {
        dd('update student internship');
    }
    public function filterInternship($slug)
    {
        $input= Input::only('institution','status','keyword','video','internship');

        $brand_detail	= $this->brand->findBySlug($slug);

        $internship_list=$this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');

        $posts=$this->post->getListByIds($internship_list);

        $query = Internship::with('post')->where('brand_id', $brand_detail->ids);

        if(Input::get('institution'))
            $query->where('institution',$input['institution']);

        if(Input::get('status')!='')
            $query->where('status',$input['status']);

        if(Input::get('internship')!='')
            $query->where('post_id',$input['internship']);

        if(Input::get('video'))
        {
            if($input['video']==0)
                $query->whereNull('video_resume');
            else
            {
                $query->whereNotNull('video_resume');
                $query->orWhereNotNull('video_url');
            }
        }

        if(Input::get('keyword'))
        {
            $query->where('name',$input['keyword']);
        }

        $internships= $query->get();
        $institutions= $this->internship->getInstitutionsByPostIds($internship_list);
         return View::make('brands.internships.applied.list')->withBrand($brand_detail)->withInternships($internships)->withInstitutions($institutions)->withFilter($input)->withPosts($posts);

    }

    public function postAppliedInternshipsActions()
    {

        $internship_ids = Input::get('checkall');

        if($internship_ids)
        {

        if(Input::has('Trash'))
        {
            $this->internship->trash($internship_ids);
            return Redirect::back()->withFlashMessage('Selected Student Internships Trashed');
        }

        if(Input::has('Untrash'))
        {
            $this->internship->untrash($internship_ids);
            return Redirect::back()->withFlashMessage('Selected Student Internships Untrashed');
        }

        if(Input::has('InProcess'))
        {
            $this->internship->changestatus($internship_ids,0);
            return Redirect::back()->withFlashMessage('Selected Student Internships Status Changed to InProcess');
        }

        if(Input::has('Approved'))
        {
            $this->internship->changestatus($internship_ids,1);
            return Redirect::back()->withFlashMessage('Selected Student Internships Status Changed to Approved');
        }

        if(Input::has('OnHold'))
        {
            $this->internship->changestatus($internship_ids,2);
            return Redirect::back()->withFlashMessage('Selected Student Internships Status Changed to OnHold');
        }

        if(Input::has('Rejected'))
        {
            $this->internship->changestatus($internship_ids,3);
            return Redirect::back()->withFlashMessage('Selected Student Internships Status Changed to Rejected');
        }

        }

          return Redirect::back()->withErrorMessage('Select atleast some Student Internships');

    }


    public function changeInternshipStatus()
    {
        $id=Input::get('id');
        $status=Input::get('status');
        $internship_status = array('0' => 'In Process', '1' => 'Approved', '2' => 'On Hold', '3' => 'Rejected');

        $internship=$this->internship->find($id);
        if($internship->status!=$status) {
            $activity = $this->activity->create(array('type' => 'internship_status', 'internship_id' => $id, 'user_id' => $internship->user_id, 'message' => 'Internship (' . getPostName($internship->post_id) . ') status changed to ' . $internship_status[$status]));
            $internship->status = $status;

            $userinfo = Sentry::findUserById($internship->user_id);
            $internship->save();

            $data['postname'] = getPostName($internship->post_id);
            $data['name'] = $userinfo->first_name . ' ' . $userinfo->last_name;
            $data['email'] = $userinfo->email;
            $data['status'] = $internship_status[$status];
            $data['internship']         = $internship;
            $data['brand']         = getBrandName($internship->brand_id);

            if($status==1)
            {
            Mailgun::send('emails.student_internship_status_update', $data, function ($message) use ($data) {
                $message->subject('Congrats – Your Internship application has been shortlisted');
                $message->to($data['email'], $data['name']);
            });
            }
            if($status==2)
            {
                Mailgun::send('emails.student_internship_status_update_onhold', $data, function ($message) use ($data) {
                    $message->subject('Your Internship application at '.$data['brand']);
                    $message->to($data['email'], $data['name']);
                });
            }
            if($status==3)
            {
                Mailgun::send('emails.student_internship_status_update_rejected', $data, function ($message) use ($data) {
                    $message->subject('Your Internship application at '.$data['brand']);
                    $message->to($data['email'], $data['name']);
                });
            }
            return $internship_status[$status];
        }
        return true;
    }

    public function changeStatus($id)
    {
        $post=$this->post->find($id);
        if($post->status==1)
            $post->status=0;
        else
            $post->status=1;
        $post->save();
        return Redirect::back()->withFlashMessage('Updated status of Internship');
    }


	public function getInternshipDetails($slug1, $slug2)
	{
        
        $brand= $this->brand->findBySlug($slug1);

        $type = 'internship';

        $single = $this->post->getPostsBySlug($slug2);

        $internships = $this->post->getActivePostByTypeAndBrandId($type, $brand->id);

        $post = $this->post->find($single->id);

        $post->timestamps = false;

        $post->increment('visits');

        $post->visits += 1;

        $loggedin_user      = Sentry::getUser();

        $input = array('post_id' => $single->id, 'user_id' => $loggedin_user->id);
		
		$postvisit = $this->posts_visits->postvisitexists($single->id, $loggedin_user->id);

		if ($postvisit)
		{
			$postsvisits = PostsVisits::find($postvisit);

			$postsvisits->touch();
		}
		else
		{
			$this->posts_visits->create($input);
		}

        $user_group = $loggedin_user->getGroups()->first()->name;

        if($loggedin_user->brand_id==$brand->id)
        {
            $notes = $this->note->withoutreply($brand->id);
            $stats=array();
            $stats['internships_count']   = $this->post->getTotalPostCountByBrand('internship',$brand->id);
            $internship_list=$this->post->getPostIdsByBrandAndType($brand->id,'internship');
            $stats['received_app_count']   = $this->internship->getCountByPostIds($internship_list);
            $stats['app_pending_count']   = $this->internship->getCountByPostIdsAndStatus($internship_list,0);

            return View::make('brands.internships.internships_single', compact('brand','internships','single','notes','stats'));

        }
        else
        {
            $notes = $this->note->withreply($brand->id);
        }

		return View::make('brands.internships.internships_single', compact('brand','internships','single','notes'));		 
	}

}
