<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\InstitutionRegistrationRepositoryInterface;
use idoag\Repos\InstitutionsFollowsRepositoryInterface;
use idoag\Repos\InstTestimonialRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;


class InstitutionsController extends \BaseController {

	protected $user;

	protected $note;

	protected $register;

    protected $institution;

    protected $institutions_follows;

    protected $testimonial;

	function __construct(UserRepositoryInterface $user, FeedbackRepositoryInterface $note,  PostRepositoryInterface $post, InstitutionRepositoryInterface $institution, InstitutionsFollowsRepositoryInterface $institutions_follows, InstitutionRegistrationRepositoryInterface $register, InstTestimonialRepositoryInterface $testimonial)
	{

		$this->user		 = $user;

		$this->institution	 = $institution;

		$this->register  = $register;

        $this->institutions_follows  = $institutions_follows;

        $this->post = $post;

        $this->note=$note;

        $this->testimonial=$testimonial;
	}
	
	// route to show institutions dashboard
	public function index($slug)
	{

        $institution_detail	    = $this->institution->findBySlug($slug);

        $posts              = $this->post->getPostsByInstitutionId($institution_detail->id);

        $post_count        = $this->post->getTotalPostCountByInstitution('insevent',$institution_detail->id);

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if ($loggedin_user->institution_id == $institution_detail->id) {
                $notes = $this->note->withoutInsReply($institution_detail->id);//echo"<pre>";print_r($notes);exit();
            }
            else
            {
                $notes = $this->note->withInsReply($institution_detail->id);
            }
        }

        $new_posts = new \Illuminate\Database\Eloquent\Collection;

        foreach($posts as $post)
        {
          if($post->end_date>= date('Y-m-d') || $post->end_date==null || $post->end_date=='' )
            $new_posts->add($post);
        }

        foreach($posts as $post)
        {
          if($post->end_date< date('Y-m-d') && $post->end_date!=null )
              $new_posts->add($post);
        }

        $inst_posts = new \Illuminate\Database\Eloquent\Collection;

        $inst_posts=$new_posts->take(10);

        // echo"<pre>";print_r($inst_posts);exit();


        $event_count         = $this->post->getTotalPostCountByInstitution('insevent',$institution_detail->id);

        $photo_count        = $this->post->getTotalPostCountByInstitution('insphoto',$institution_detail->id);

        $text_count        = $this->post->getTotalPostCountByInstitution('instext',$institution_detail->id);

        $follow_ids = InstitutionsFollows::where('institution_id',$institution_detail->id)->take(20)->lists('user_id');

        $followers=$this->user->getUsersByIds($follow_ids);

        $members   = $this->user->getUsersByInstitution($institution_detail->id);

        $date2          = date('Y-m-d H:i:s',time()-(7*86400));

        $date3          = date('Y-m-d H:i:s',time()-(31*86400));

        $month_followers=InstitutionsFollows::where('institution_id',$institution_detail->id)->where('created_at','>=',$date3)->count();


        $posts_visits_count =PostVisitsOfInstitution($institution_detail->id,$date3);

        $posts_likes_count  =PostLikesOfInstitution($institution_detail->id,$date3);

        if(!Sentry::check()) {

        return View::make('institutions.dashboard',compact('members','followers'))
            ->withInstitution($institution_detail)
            ->withPosts($posts);
        }
        else
        {
            return View::make('institutions.dashboard',compact('event_count', 'text_count', 'photo_count','members','followers','posts_visits_count', 'posts_likes_count','month_followers'))
                ->withInstitution($institution_detail)
                ->withPosts($posts)
                ->withNotes($notes);
        }
    }

    public function getInstInfo($slug)
    {
        $institution_detail	    = $this->institution->findBySlug($slug);

        return View::make('students.inst_info')->withInstitution($institution_detail);
    }

    public function getInstFeedback($slug)
    {
        $institution_detail	    = $this->institution->findBySlug($slug);
        $notes = $this->note->withInsReply($institution_detail->id);
        return View::make('students.inst_feedback')->withInstitution($institution_detail)
            ->withNotes($notes);
    }
    public function getInstStatistics($slug)
    {
        $institution_detail	    = $this->institution->findBySlug($slug);

        $event_count         = $this->post->getTotalPostCountByInstitution('insevent',$institution_detail->id);

        $photo_count        = $this->post->getTotalPostCountByInstitution('insphoto',$institution_detail->id);

        $text_count        = $this->post->getTotalPostCountByInstitution('instext',$institution_detail->id);

        $total_feedback_count = $this->note->getTotalByInstitution($institution_detail->id);

        $total_not_replied = $this->note->getTotalWithoutReplyByInstitution($institution_detail->id);

        return View::make('students.inst_statistics', compact('total_not_replied','total_feedback_count', 'text_count', 'photo_count',  'event_count'))
            ->withInstitution($institution_detail);

    }

    public function institutionsList()
    {

        $institutions 			= $this->institution->getAll(); // echo '<pre>';print_r($institutions);exit();

        if(Sentry::check())
        {
            $user_id 			= Sentry::getUser()->id;

            $institutions_follows 	= $this->institutions_follows->getInstitutionsFollowing($user_id);

            return View::make('pages.institutions')->withInstitutions($institutions)->withInstitutionsFollows($institutions_follows);

        }

        return View::make('pages.institutions')->withInstitutions($institutions);

    }

	public function getInstRegister()
	{
        $insts = Institution::where('id','>','150')->get(array('image','slug','name'));

        $testimonials      = $this->testimonial->getAll();

        // echo '<pre>';print_r($testimonials);exit();

        return view::make('pages.inst_register')->withInsts($insts)->withTestimonials($testimonials);
	}

	
	public function postInstRegister()
	{
        $data = Input::all();

        $admin_email = 'info@idoag.com';

        $inst_email = Input::get('email');

        $data['state'] = getState(Input::get('state'));

        $data['city']  = getCity(Input::get('city'));

      //  dd($data);
        
        Mailgun::send('emails.inst_register', $data, function($message) use($data,$admin_email)
        {
            $message->subject('New Institution Registration');
            $message->to($admin_email, $data['name']);
            
        });

        Mailgun::send('emails.register_thankyou', $data, function($message) use($data,$inst_email)
        {
             $message->subject('Thank you for Institution Registration');

            $message->to($inst_email, $data['name']);
            
        });

        $register = $this->register->create($data);
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /institutions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /institutions
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /institutions/{id}
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
	 * GET /institutions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug)
	{
        $institution_detail	= $this->institution->findBySlug($slug);
        return View::make('institutions.edit')
            ->withInstitution($institution_detail);
	}
    public function getInstitutionPosts()
    {
        $institution_id = Input::get('institution_id');

        $limit = Input::get('limit');

        $offset = (Input::get('offset')-1)*$limit;

        $institution_detail       = $this->institution->find($institution_id);

        $posts              = Post::where('institution_id','=',$institution_detail->id)->orderBy('created_at','desc')->skip($offset)->take($limit)->get();

        //echo"<pre>";print_r($posts);exit();

        return View::make('students.partials.allposts')->withPosts($posts);
    }

	/**
	 * Update the specified resource in storage.
	 * PUT /institutions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($slug)
	{
        $rules = [
            'name'          => 'required',
            'description'   => 'required'
        ];

        $institution 		= $this->institution->findBySlug($slug);


        $input 		= Input::only('name','description','color1');

        $validator  = Validator::make($input,$rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->institution->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input 	= array_add($input, 'status', 1);


            if(Input::hasFile('coverimage'))
            {
                $file = Input::file('coverimage');

                $rules 		= array('file' => 'required|image|max:10240');

                $validator 	= Validator::make(array('file'=> $file), $rules);

                if($validator->passes()){

                    $filename = 'ci_'.Str::lower(

                            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                            .'.'
                            .$file->getClientOriginalExtension()
                        );

                    $filename=str_replace(' ','_',$filename);

                    $file->move('uploads/instcover/', $filename);

                    $destination 	= public_path() .'/uploads/instcover/';
                    $image 			= IImage::make(sprintf('uploads/instcover/%s', $filename))->save($destination.$filename);
					$image = IImage::make(sprintf($destination . '/%s', $filename))->resize(1600, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "ci_" . $filename);
                    $input['coverimage'] 	        = $filename;

                }
                else
                {
                    return Redirect::back()->withInput()->withErrors($validator);
                }

            }

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
                    $filename=str_replace(' ','_',$filename);

                    $file->move('uploads/institutions/', $filename);

                    $destination 	= public_path() .'/uploads/institutions/';

                    $image 			= IImage::make(sprintf('uploads/institutions/%s', $filename));

                    $image->save($destination.$filename);

                    $input['image'] = $filename;
                }
                else
                {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            
            }

            if(Input::get('url'))
                $input 	= array_add($input, 'url', Input::get('url'));

            if(Input::get('facebook'))
                $input 	= array_add($input, 'facebook', Input::get('facebook'));

            if(Input::get('twitter'))
                $input 	= array_add($input, 'twitter', Input::get('twitter'));

              $institution->fill($input)->save();

            return Redirect::route('institution_profile', array($institution->slug))->withFlashMessage('Updated Successfully!');
        }

    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /institutions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    public function userInstitutionFollows()
    {
        if(Request::ajax())
        {
            $institution_id     = Input::get('institution_id');

            $user_id 		    = Sentry::getUser()->id;

            $institution		= Institution::find($institution_id);

            //echo"<pre>";print_r($institution->slug);

            $input 			= array('institution'=>$institution->slug,'institution_id'=>$institution_id,'user_id'=>$user_id);

            $follows 		= $this->institutions_follows->checkFollows($institution_id, $user_id);

            if($follows && $institution->slug != 'idoag')
            {
                $follow_action		= $this->institutions_follows->delete($follows->id);

                $activity           = Activity::where('type','inst_follows')->where('inst_id',$institution_id)->where('user_id',$user_id)->delete();

                $count 				=$this->institutions_follows->getCount($institution_id);

                return Response::json(array(
                    'message'=>'FOLLOW',
                    'count' => $count,
                    'institution_id'=>$institution_id));
            }
            else
            {
                if($institution->slug != 'idoag')
                {
                    $follow_action		= $this->institutions_follows->create($input);

                    $activity           = Activity::create(array('type'=>'inst_follows','inst_id'=>$institution_id,'user_id'=>$user_id));

                    $count 				= $this->institutions_follows->getCount($institution_id);

                    return Response::json(array(
                        'message'=>'FOLLOWING',
                        'count' => $count,
                        'institution_id'=>$institution_id));
                }
            }
        }
    }

    public function followers($slug)
    {
        $institution 	    = $this->institution->findBySlug($slug);

        $follow_ids = DB::table('institutions_follows')->where('institution_id',$institution->id)->lists('user_id');

        $followers=$this->user->getUsersByIds($follow_ids);

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if ($loggedin_user->institution_id == $institution->id) {
                $notes = $this->note->withoutInsReply($institution->id);//echo"<pre>";print_r($notes);exit();
            }
            else
             {
                $notes = $this->note->withInsReply($institution->id);
            }
            return View::make('institutions.followers',compact('followers','institution'))->withNotes($notes);
        }
        else
        return View::make('institutions.followers',compact('followers','institution'));

    }

    public function getMembers($slug)
    {
        $institution 	    = $this->institution->findBySlug($slug);

        $member_ids = DB::table('student_details')->where('institution_id',$institution->id)->lists('user_id');

        $members = $this->user->getUsersByIds($member_ids);

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if ($loggedin_user->institution_id == $institution->id) {
                $notes = $this->note->withoutInsReply($institution->id);//echo"<pre>";print_r($notes);exit();
            }
            else
            {
                $notes = $this->note->withInsReply($institution->id);
            }
            return View::make('institutions.members',compact('members','institution'))->withNotes($notes);

        }
        else
         return View::make('institutions.members',compact('members','institution'));

    }

    /**
     * Notes/Feedback
     *
     *
     */

    public function postNotes()
    {
        $input = Input::all();


        if(Input::has('replymessage'))
        {
            $note_id = Input::get('note_id');

            $note_Details = $this->note->find($note_id);

            $reply = Input::get('replymessage');

            $check = $this->note->find($note_id);

            if($check->replymessage)
            {
                return 'already exists';
            }
            else
            {
                $note = $this->note->reply($note_id,$reply);

                if($note)
                {
                    $activity         = Activity::create(array('type'=>'feedback','institution_id'=>$note_Details->institution_id,'user_id'=>$note_Details->user_id));

                    return $note_id;
                }
                else
                {
                    return "Sorry! Please try again";
                }
            }
        }
        else
        {
            $name = Sentry::getUser()->first_name ." " . Sentry::getUser()->last_name;

            $user_id = Input::get('user_id');

            $institution_id = Input::get('institution_id');

            $input = array_add($input, 'name', $name);

            $note = $this->note->create($input);

            return "Your message has been sent to the Institution. ThankYou !";

        }
    }

    public function UploadProfilePicture()
    {

        if(Request::ajax())
        {
            $institution_id = Sentry::getUser()->institution_id;

            $file     = Input::file('profile_image');

            // validating each file.
            $rules        = array('file' => 'required|image|max:10240');

            $validator     = Validator::make(array('file'=> $file), $rules);

            //echo"<pre>";print_r($rules);exit();

            if($validator->passes()){
                //echo"<pre>";print_r($file);exit();
                $filename = Str::lower(

                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );

                $filename = $institution_id.'_'.$filename;

                $filename=str_replace(' ','_',$filename);

                $file->move('uploads/profiles', $filename);

                $destination  = public_path() .'/uploads/profiles';

                $image           = IImage::make(sprintf('uploads/profiles/%s', $filename));

                $image->save($destination.$filename);

                $this->institution->profilePicture($institution_id,$filename);

                $success = "Profile Picture updated Successfully";


                return $success;


            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }

    }

    public function getpasswordChange($slug)
    {
        $institution_detail   = $this->institution->findBySlug($slug);


        return View::make('institutions.password_change')->withInstitution($institution_detail);
    }

    public function postpasswordChange($slug)
    {
        $institution_detail       = $this->institution->findBySlug($slug);

        $prev_password      = Input::get('prev_password');

        $new_password       = Input::get('new_password');

        Validator::extend('hashmatch', function($attribute, $value, $parameters)
        {
            return Hash::check($value, Sentry::getUser()->password);
        });
        $messages = array(
            'hashmatch' => 'Your current password must match your account password.'
        );
        $rules = array(
            'prev_password'      => 'required|hashmatch',
            'new_password'       => 'required|different:prev_password'
        );

        $validator = Validator::make( Input::all(), $rules, $messages);

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        else
        {
            $user               = User::find(Sentry::getUser()->id);

            $prev_password      = Input::get('prev_password');

            $new_password       = Input::get('new_password');

            $user->password     = $new_password;

            $user->save();

            return Redirect::back()->withFlashMessage('Your password has been changed.');
        }

        return Redirect::back()->withErrorMessage('Your password could not be changed.');
    }

}