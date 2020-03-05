<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\BrandsFollowsRepositoryInterface;
use idoag\Repos\BrandRegistrationRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\TestimonialRepositoryInterface;
use idoag\Forms\NewBrandForm;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;



class BrandsController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	/**
	 * @var $setting 
	 *
	 */
	protected $setting;
	
	/**
	 * @var $brand 
	 *
	 */
	protected $brand;

	/**
	 * @var $NewBrandForm 
	 *
	 */
	protected $NewBrandForm;

    /**
     * @var $category 
     *
     */
    protected $category;

    protected $outlet;

    /**
     * @var $register 
     *
     */
    protected $register;

    protected $testimonial;

    protected $internship;

    /**
     * @var $post
     *
     */
    protected $post;

    /**
     * @var $user_id
     *
     */
    private $user_id;

    /**
     * @var $note
     *
     */
    private $note;
	
	/**
	 * BrandsController Constructor function 
	 * 
	 */
    function __construct(UserRepositoryInterface $user, SettingsRepositoryInterface $setting, TestimonialRepositoryInterface $testimonial, BrandRepositoryInterface $brand,CategoryRepositoryInterface $category, NewBrandForm $NewBrandForm,
                      PostRepositoryInterface $post,  OutletRepositoryInterface $outlet,  StudentInternshipRepositoryInterface $internship, FeedbackRepositoryInterface $note, BrandRegistrationRepositoryInterface $register)
    {


        $this->category         = $category;

        $this->user		        = $user;

        $this->setting 	        = $setting;

        $this->brand 	        = $brand;

        $this->outlet 	        = $outlet;

        $this->NewBrandForm     = $NewBrandForm;

        $this->category	        = $category;

        $this->post 	        = $post;

        $this->note             = $note;

        $this->register         = $register;

        $this->testimonial      = $testimonial;

        $this->internship 	= $internship;

        cloudinary(); 
	}
	 
	// route to show brands dashboard page
	public function index($slug)
	{

	$brand_detail = $this->brand->findBySlug($slug);

        $posts = $this->post->getPostsByBrandId($brand_detail->id);


        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

         if($loggedin_user->brand_id==$brand_detail->id)
			{
				$notes = $this->note->withoutreply($brand_detail->id);
			}
			else
			{
				$notes = $this->note->withreply($brand_detail->id);
			}
        }

        $offers = new \Illuminate\Database\Eloquent\Collection;

        foreach($posts as $post)
        {
          if($post->end_date>= date('Y-m-d') || $post->end_date==null || $post->end_date=='')
          {
              if($post->type=='internship' && $post->application_date< date('Y-m-d') )
              {

              }
              else
              $offers->add($post);
          }

        }

        $brands_posts = new \Illuminate\Database\Eloquent\Collection;

        $brands_posts=$offers->take(10);

        $link_count         = $this->post->getTotalPostCountByBrand('link',$brand_detail->id);

        $photo_count        = $this->post->getTotalPostCountByBrand('photo',$brand_detail->id);

        $offer_count        = $this->post->getTotalPostCountByBrand('offer',$brand_detail->id);
        $offer_active_count        = $this->post->getTotalActivePostCountByBrand('offer',$brand_detail->id);


        $follow_ids         = BrandsFollows::where('brand',$slug)->take(20)->lists('user_id');

        $followers          =$this->user->getUsersByIds($follow_ids);

        $internship_count   = $this->post->getTotalPostCountByBrand('internship',$brand_detail->id);
        $internship_active_count   = $this->post->getTotalActivePostCountByBrand('internship',$brand_detail->id);

        $event_count        = $this->post->getTotalPostCountByBrand('event',$brand_detail->id);
        $event_active_count        = $this->post->getTotalActivePostCountByBrand('event',$brand_detail->id);

        $outlet_count        = $this->outlet->getTotalByBrand($brand_detail->id);

        $total_feedback_count = $this->note->getTotalByBrand($brand_detail->id);

        $total_not_replied = $this->note->getTotalWithoutReplyByBrand($brand_detail->id);

        $internship_list = $this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');

        $applied_internships_count = $this->internship->getCountByPostIds($internship_list);

        $date2          = date('Y-m-d H:i:s',time()-(7*86400));
        
        $date3          = date('Y-m-d H:i:s',time()-(31*86400));
        
        $month_followers=BrandsFollows::where('brand_id',$brand_detail->id)->where('created_at','>=',$date3)->count();
        
        $posts_visits_count = PostVisitsOfBrand($brand_detail->id,$date3);

        $posts_likes_count  = PostLikesOfBrand($brand_detail->id,$date3);

        if(Sentry::check()) {

            return View::make('brands.dashboard', compact('applied_internships_count','outlet_count','total_not_replied','total_feedback_count','posts_visits_count', 'posts_likes_count', 'offer_count',  'offer_active_count', 'link_count', 'photo_count', 'internship_count', 'event_count',  'internship_active_count', 'event_active_count', 'followers', 'month_followers'))
                ->withBrand($brand_detail)
                ->withPosts($brands_posts)
                ->withNotes($notes);
        }
        else
        {
            return View::make('brands.dashboard', compact('posts_visits_count', 'posts_likes_count', 'offer_count', 'link_count', 'photo_count', 'internship_count', 'event_count', 'followers', 'month_followers'))
                ->withBrand($brand_detail)
                ->withPosts($brands_posts);
        }
	}


    public function getBrandPosts()
    {
        $brand_id           = Input::get('brand_id');

        $limit              = Input::get('limit');

        $offset             = (Input::get('offset')-1)*$limit;

        $brand_detail       = $this->brand->find($brand_id);

        // $posts              = Post::where('brand_id','=',$brand_detail->id)->where('status',1)->orderBy('created_at','desc')->skip($offset)->take($limit)->get();
        
        $posts              = $this->post->getPostsByBrandId($brand_detail->id); //echo"<pre>";print_r($posts);exit();

        $offers = new \Illuminate\Database\Eloquent\Collection;

        foreach($posts as $post)
        {
          if($post->end_date>= date('Y-m-d') || $post->end_date==null || $post->end_date==''  || ($post->type=='internship' && $post->application_date>= date('Y-m-d') ) )
              if($post->type=='internship' && $post->application_date< date('Y-m-d') )
              {

              }
              else
             $offers->add($post);
        }
//
//        foreach($posts as $post)
//        {
//          if($post->end_date< date('Y-m-d') && $post->end_date!=null )
//              $offers->add($post);
//        }

        $brands_posts = new \Illuminate\Database\Eloquent\Collection;

        $brands_posts = $offers->slice(($offset),10);
        //echo"<pre>";print_r($posts);exit();

        return View::make('students.partials.allposts')->withPosts($brands_posts);
    }

	// method to show brand signup form

    public function getBrandInfo($slug)
    {
        $brand_detail	    = $this->brand->findBySlug($slug);

        return View::make('students.brand_info')->withBrand($brand_detail);
    }

    public function getBrandFeedback($slug)
    {
        $brand_detail	    = $this->brand->findBySlug($slug);
        $notes = $this->note->withreply($brand_detail->id);
        return View::make('students.brand_feedback')->withBrand($brand_detail)
            ->withNotes($notes);
    }
	public function getBrandStatistics($slug)
    {
        $brand_detail	    = $this->brand->findBySlug($slug);

         $offer_count        = $this->post->getTotalPostCountByBrand('offer',$brand_detail->id);

        $link_count         = $this->post->getTotalPostCountByBrand('link',$brand_detail->id);

        $photo_count        = $this->post->getTotalPostCountByBrand('photo',$brand_detail->id);

        $internship_count   = $this->post->getTotalPostCountByBrand('internship',$brand_detail->id);

        $event_count        = $this->post->getTotalPostCountByBrand('event',$brand_detail->id);

        $outlet_count        = $this->outlet->getTotalByBrand($brand_detail->id);

        $total_feedback_count = $this->note->getTotalByBrand($brand_detail->id);

        $total_not_replied = $this->note->getTotalWithoutReplyByBrand($brand_detail->id);

        $internship_list=$this->post->getPostIdsByBrandAndType($brand_detail->id,'internship');

        $applied_internships_count= $this->internship->getCountByPostIds($internship_list);

             return View::make('students.brand_statistics', compact('applied_internships_count','outlet_count','total_not_replied','total_feedback_count', 'offer_count', 'link_count', 'photo_count', 'internship_count', 'event_count', 'followers'))
                ->withBrand($brand_detail);

    }

    public function create()
	{
		//
	}

	// method to process brand signup 
	public function store()
	{
		//
	}

	// method to show brand profile page
	public function show()
	{
		//
	}

    public function followers($slug)
    {
        $brand 	    = $this->brand->findBySlug($slug);

        $follow_ids = DB::table('brands_follows')->where('brand',$slug)->take(12)->lists('user_id');

        $followers=$this->user->getUsersByIds($follow_ids);

        $notes='';

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

          if($loggedin_user->brand_id==$brand->id)
      		{
           		$notes = $this->note->withoutreply($brand->id);
			}
			else
			{
                $notes = $this->note->withreply($brand->id);
            }
        }
        return View::make('brands.followers',compact('followers','brand','notes'));

    }
	

    public function getfollowers()
    {
        $slug       = Input::get('slug');

        $limit      = Input::get('limit');

        $offset     = (Input::get('offset')-1)*$limit;

        $brand      = $this->brand->findBySlug($slug);

        $follow_ids = DB::table('brands_follows')->where('brand',$slug)->skip($offset)->take(12)->lists('user_id');

        $followers = $this->user->getUsersByIds($follow_ids);

        $notes = '';

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

             if($loggedin_user->brand_id==$brand->id)
			{
				$notes = $this->note->withoutreply($brand->id);
			}
			else
			{
				$notes = $this->note->withreply($brand->id);
			}
        }
        return View::make('brands.partial.follower',compact('followers','brand','notes'));

    }

	// method to show edit brand profile page
	public function edit($slug)
	{
		$brand_detail	= $this->brand->findBySlug($slug);

        $categories = $this->category->getList();
		
		//echo "<pre>";print_r($brand_detail);exit;
		
		return View::make('brands.edit')
            ->withBrand($brand_detail)
            ->withCategories($categories);
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
                    $activity = Activity::create(array('type'=>'feedback','brand_id'=>$note_Details->brand_id,'user_id'=>$note_Details->user_id));

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

            $brand_id = Input::get('brand_id');

            $input = array_add($input, 'name', $name);

            //$note = $this->note->getExists($user_id, $brand_id); //echo"<pre>";print_r($note);exit();

            $note = $this->note->create($input);
            
            return "Your message has been sent to the Brand. ThankYou !";
        }
    }


    public function getBrandRegister()
    {
        $categories        = $this->category->getList();

        $testimonials      = $this->testimonial->getAll();

        $brands            = Brand::all(array('name','image','slug'));//echo"<pre>";print_r($brands);exit();

        return view::make('pages.brand_register')->withCategories($categories)->withTestimonials($testimonials)->withBrands($brands);
    }

    public function postBrandRegister()
    {
        $data = Input::all();

        //print_r($data);exit();

        $admin_email = 'info@idoag.com';

        $brand_email = Input::get('email');

        $category = Input::get('category');
        
        $data['category'] = implode(',',$category);   //echo "<pre>";print_r($data);exit();
        
        Mailgun::send('emails.brands_register', $data, function($message) use($data,$admin_email)
        {
            $message->subject('New Brand Registration.');
            
            $message->to($admin_email, $data['name']);
            
        });

        Mailgun::send('emails.register_thankyou', $data, function($message) use($data,$brand_email)
        {

            $message->subject('Thank you for Brand Registration');

            $message->to($brand_email, $data['name']);
            
        });

        $register = $this->register->create($data);

        return Response::Json(array('success'=>true));
     }


	/**
	 * Update the specified resource in storage.
	 * PUT /brand/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update($slug)
	{
        $rules = [
            'name'          => 'required',
            'description'   => 'required',
            'category'		=> 'required',
        ];

        $brand 		= $this->brand->findBySlug($slug);

        $oldbrand	= $brand->slug;

        $input 		= Input::except('image','coverimage');

        $validator  = Validator::make($input,$rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else 
        {
            $input 	= Input::except('image', 'coverimage','category');

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
                    $image 			= IImage::make(sprintf('uploads/brandcover/%s', $filename))->save($destination.$filename);
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

                    $input['image'] = $filename;                  
                }
                else 
                {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }

            $brand->fill($input)->save();
            //echo "<pre>";print_r($input);exit;

            $brand = $this->brand->findBySlug($slug);

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

            return Redirect::route('brand_profile', array($brand->slug))->withFlashMessage('Updated Successfully!');
            }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /brand/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function UploadProfilePicture()
    {

        if(Request::ajax())
        {
            $brand_id       = Sentry::getUser()->brand_id;

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

                $filename = $brand_id.'_'.$filename;

                $filename=str_replace(' ','_',$filename);

                $file->move('uploads/profiles', $filename);

                $destination  = public_path() .'/uploads/profiles';

                $image           = IImage::make(sprintf('uploads/profiles/%s', $filename));

                $image->save($destination.$filename);

                $this->brand->profilePicture($brand_id,$filename);

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
        $brand_detail   = $this->brand->findBySlug($slug);


        return View::make('brands.password_change')->withBrand($brand_detail);
    }

    public function deleteCoverImage()
    {

        $brand_id           = Input::get('brand_id');

        $brand               = Brand::find($brand_id);

        $brand->coverimage     ='';

        $brand->save();

        return Response::json(array(
                'message' =>'<div class="alert alert-success">Cover Image has been deleted.</div>')
        );

    }

    public function postpasswordChange($slug)
    {
        $brand_detail       = $this->brand->findBySlug($slug);

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