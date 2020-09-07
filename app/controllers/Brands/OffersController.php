<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Student\CouponRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;
use idoag\Repos\Student\UserCouponRepositoryInterface;
use idoag\Forms\NewOffersForm;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Repos\ProblemRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;



class OffersController extends \BaseController {
	
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
	 * @var $validateOffers 
	 *
	 */
	protected $offerForm;

  /**
   * @var $post
   *
   */
  protected $post;

  /**
   * @var $note
   *
   */
  protected $note;

  /**
   * @var $outlet
   *
   */
  protected $outlet;

  /**
   * @var $student
   *
   */
  protected $student;

    protected $institution;

    protected $problem;


    /**
     * @var $posts_likes
     *
     */
    protected $posts_likes;

    /**
     * @var $posts_likes
     *
     */
    protected $posts_visits;

  /**
	 * OfferssController Constructor function 
	 * 
	 */
  function __construct(UserRepositoryInterface $user, ProblemRepositoryInterface $problem, PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits, UserCouponRepositoryInterface $user_coupon, StudentDetailsRepositoryInterface $student, SettingsRepositoryInterface $setting, BrandRepositoryInterface $brand,CategoryRepositoryInterface $category,NewOffersForm $offerForm,PostRepositoryInterface $post, FeedbackRepositoryInterface $note, CouponRepositoryInterface $coupon, OutletRepositoryInterface $outlet, InstitutionRepositoryInterface $institution )
  {
    $this->user		     = $user;

    $this->setting 	    = $setting;

    $this->brand   	    = $brand;

    $this->category	    = $category;

    $this->offerForm    = $offerForm;

    $this->post 	      = $post;

    $this->note         = $note;

    $this->coupon       = $coupon;

    $this->outlet       = $outlet;

    $this->student      = $student;

    $this->user_coupon  = $user_coupon;

    $this->institution  = $institution;

    $this->problem      = $problem;

    $this->user_coupon  = $user_coupon;

    $this->posts_likes  = $posts_likes;

    $this->posts_visits = $posts_visits;

    cloudinary();
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

	
	public function getOffers($slug)
  {

    $brand_detail = $this->brand->findBySlug($slug);

    $type = 'offer';

    $offers = $this->post->getPostByTypeAndBrandId($type, $brand_detail->id);

    if (Sentry::check()) {

      $loggedin_user = Sentry::getUser();

      $user_group = $loggedin_user->getGroups()->first()->name;

       if($loggedin_user->brand_id==$brand_detail->id)
			{
				$notes = $this->note->withoutreply($brand_detail->id);
                $offers=PostsExpiredToLast($offers);

            }
			else
			{
				$notes = $this->note->withreply($brand_detail->id);
                $offers=PostsExpiredToHide($offers);
            }

      return View::make('brands.offers.offers_show')->withBrand($brand_detail)->withOffers($offers)->withNotes($notes);
    }
    else
    {
      return View::make('brands.offers.offers_show')->withBrand($brand_detail)->withOffers($offers);
    }
	}
	
	public function createOffers($slug){
	
		$brand_detail	= $this->brand->findBySlug($slug);
		
    $stores = $this->outlet->getList($brand_detail->id);

        $institutions = $this->institution->getList();

		return View::make('brands.offers.create')->withBrand($brand_detail)->withStores($stores)->withInstitutions($institutions);
		
	}

  public function edit($slug1, $slug2)
  {
    $brand_detail = $this->brand->findBySlug($slug1);

    $offer_detail = $this->post->getPostsBySlug($slug2);
    
    $cities= City::where('state_id','=',$offer_detail->state)->lists('name', 'id');

    $stores = $this->outlet->getList($brand_detail->id);

      $institutions = $this->institution->getList();

      if($offer_detail->voucher_type=='single')
      $coupon_code=$this->coupon->getCodeByPostId($offer_detail->id);
      else
      $coupon_code='';

     //dd($coupon_code);
    
    return View::make('brands.offers.edit')->withBrand($brand_detail)->withOffer($offer_detail)->withCities($cities)->withStores($stores)->withInstitutions($institutions)->withCouponCode($coupon_code);

  }

  public function userSingleCoupon()
  {
    $input = Input::all();

      $post_id              = Input::get('post_id');

      $coupon               = $this->coupon->getByPostId($post_id);

      $post                 = $this->post->find($post_id);

      $brand                = getBrandLogo($post->brand_id);

      $loggedin_user        = Sentry::getUser();

      $user_group           = $loggedin_user->getGroups()->first()->name;

      if ($user_group == 'Students')
      {

          $student              = $this->student->findbyUserId($loggedin_user->id);

          $brand_name           = getBrandName($post->brand_id);

          $data = array();

          $data['card_number']  = $student->card_number;
          $data['expiry']       = $student->expiry;
          $data['institute']    = $student->institution;
          $data['name']         = $student->name;
          $data['image']        = $brand;
          $data['postname']     = $post->name;
          $data['code']         = $coupon->code;
          $data['message']      = $post->description;

          $email                =  $loggedin_user->email;

          if($coupon)
          {
              $usercoupon = $this->user_coupon->create(array('coupon_id'=>$coupon->id,'code'=>$coupon->code, 'post_id'=>$post_id,'user_id'=>$loggedin_user->id));

              $activity   = Activity::create(array('type'=>'coupon','brand_id'=>$post->brand_id,'post_id'=>$post->id,'user_id'=>$loggedin_user->id,'offer_name'=>$post->name,'coupon_code'=>$coupon->code));

              Mailgun::send('emails.singlecoupon', $data, function($message) use($email,$brand_name)
              {
                  $message->subject('IDOAG Coupon Code for '.$brand_name.' Offer');

                  $message->to($email);
              });

              return Response::json(array(
                      'code' =>$coupon->code,
                      'post_id' => $post_id,
                      'data' => $data)
              );
          }
      }
      else
      {
          $brand_name           = getBrandName($post->brand_id);

          $data = array();

          $data['name']         = $loggedin_user->first_name;
          $data['image']        = $brand;
          $data['postname']     = $post->name;
          $data['code']         = $coupon->code;
          $email                =  $loggedin_user->email;
          $data['message']      = $post->description;
          if($coupon)
          {
              $usercoupon = $this->user_coupon->create(array('coupon_id'=>$coupon->id,'code'=>$coupon->code, 'post_id'=>$post_id,'user_id'=>$loggedin_user->id));

              Mailgun::send('emails.brandsingle_coupon', $data, function($message) use($email,$brand_name)
              {
                  $message->subject('IDOAG Coupon Code for '.$brand_name.' Offer');

                  $message->to($email);
              });

              return Response::json(array(
                      'code' =>$coupon->code,
                      'post_id' => $post_id,
                      'data' => $data)
              );
          }
      }
    
  }

  public function userMultipleCoupon()
  {
    $input                = Input::all();
    
    $data                 = array();

    $post_id              = Input::get('post_id');

    $coupon               = $this->coupon->getByPostId($post_id);

    $post                 = $this->post->find($post_id);

    $brand                = getBrandLogo($post->brand_id);

    $loggedin_user        = Sentry::getUser();

    $user_group           = $loggedin_user->getGroups()->first()->name;

    if(!empty($coupon->code))
    {
      if ($user_group == 'Students') 
      {

        $student              = $this->student->findbyUserId($loggedin_user->id);

        $data['card_number']  = $student->card_number;
        $data['expiry']       = $student->expiry;
        $data['institute']    = $student->institution;
        $data['name']         = $student->name;
        $data['image']        = $brand;
        $data['postname']     = $post->name;
        $data['code']         = $coupon->code;
        $data['tandc']        = $post->description;

        $email  =  $loggedin_user->email;

        $brand_name  = getBrandName($post->brand_id);

        if($coupon)
        {
          $coupon->status = 1;

          $coupon->save();

          $usercoupon = $this->user_coupon->create(array('coupon_id'=>$coupon->id,'code'=>$coupon->code, 'post_id'=>$post_id,'user_id'=>$loggedin_user->id));

          $activity   = Activity::create(array('type'=>'coupon','brand_id'=>$post->brand_id,'post_id'=>$post->id,'user_id'=>$loggedin_user->id,'offer_name'=>$post->name,'coupon_code'=>$coupon->code));

          Mailgun::send('emails.coupon', $data, function($message) use($email, $brand_name)
          {  
           $message->subject('IDOAG Coupon Code for '.$brand_name.' Offer');
        
           $message->to($email);
          });         

          return Response::json(array(
                'code' =>$coupon->code,
                'post_id' => $post_id)
            );
        }

      }
      else
      {
        $brand_name           = getBrandName($post->brand_id);

        $data = array();

        $data['name']             = $loggedin_user->first_name;
        $data['image']            = $brand;
        $data['postname']         = $post->name;
        $data['code']             = $coupon->code;
        $data['description']      = $post->description;

        $email                =  $loggedin_user->email;

        $brand_name           = getBrandName($post->brand_id);

        if($coupon)
        {
          $coupon->status = 1;

          $coupon->save();

          $usercoupon = $this->user_coupon->create(array('coupon_id'=>$coupon->id,'code'=>$coupon->code, 'post_id'=>$post_id,'user_id'=>$loggedin_user->id));

          Mailgun::send('emails.brandmultiple_coupon', $data, function($message) use($email, $brand_name)
            {  
             $message->subject('IDOAG Coupon Code for '.$brand_name.' Offer');
          
             $message->to($email);
            });         

          return Response::json(array(
                'code' =>$coupon->code,
                'post_id' => $post_id)
            );
        }
      }
    }
    else
    {
       return Response::json(array(
                'code' =>"This Coupon has Expired.Sorry",
                'post_id' => $post_id)
            );
    }
  }


  public function getOfferDetails($slug1, $slug2)
  {  $type = 'offer';
      $type = 'offer';
        $loggedUserType = Sentry::getUser()->user_type;
        $userType = '';
        if($loggedUserType == 'student'){
            $userType = 'corporates';
        }
        if($loggedUserType == 'corporate'){
            $userType = 'students';
        }
      $brand = $this->brand->findBySlug($slug1);
	  
	  $single = $this->post->getPostsBySlug($slug2);
	  
      $offers = Post::where('brand_id',$brand->id)->where('type',$type)->whereNotIn('id', array($single->id))->where('status',1)->where('end_date','>',date('Y-m-d'))->where('posts.for_user_type', '!=', $userType)->orderBy('visits','desc')->take(8)->get();
	  
	  $post = $this->post->find($single->id);

      $post->timestamps = false;

      $post->increment('visits');

      $post->visits += 1;

      
      $user_id = Sentry::getUser()->id;

      $input = array('post_id' => $single->id, 'user_id' => $user_id);

      $postvisit = $this->posts_visits->postvisitexists($single->id, $user_id);

      // echo "<pre>"; print_r($postvisit);exit();  

      if ($postvisit)
      {
        $postsvisits = PostsVisits::find($postvisit);

        $postsvisits->touch();
      }
      else
      {
        $this->posts_visits->create($input);
      }

      $brandoffers        = Post::where(['brand_id' => $brand->id, 'type' => $type])->where('id', '<>', $single->id)->where('end_date', '>', date('Y-m-d'))->where('posts.for_user_type', '!=', $userType)->orderBy('created_at', 'desc')->take(4)->get();
      $loggedin_user      = Sentry::getUser();

      $user_group         = $loggedin_user->getGroups()->first()->name; 

      if($loggedin_user->brand_id==$brand->id)
		{
			$notes = $this->note->withoutreply($brand->id);
		}
		else
		{
			$notes = $this->note->withreply($brand->id);
		}

      $usercoupon = $this->user_coupon->getusercoupon($single->id,$loggedin_user->id);

      // echo"<pre>";print_r($usercoupon);exit();

      if($single->voucher_type == 'single')
      {

        $post_id              = $post->id;

        $coupon               = $this->coupon->getByPostId($post_id);

        $single->coupon_code  = $coupon->code;
      }
      else 
      {
        if($usercoupon)
        {
            $availtime = $usercoupon->updated_at;

            $currenttime = new DateTime();

            $coupon_interval = date_diff($currenttime,$availtime);

            if($coupon_interval->i >= 15)
            {
                $single->coupon_code = '';

            }
            else
            {
                $single->coupon_code = $usercoupon->code;

            }
        }
        else
        {
            $single->coupon_code = '';
        }
      }
      
      $cities= City::where('state_id','=',$single->state)->lists('name', 'id');

      return View::make('brands.offers.offers_single', compact('brand', 'offers', 'single',  'coupon_interval', 'brandoffers','notes','cities'));
  }


  public function reportProblemIssue()
  {
      $data = array();

      $input = array();

      $admin = 'info@idoag.com';

      $userinfo = Sentry::getUser();

      $post = $this->post->find(Input::get('post_id'));

      // echo"<pre>";print_r($post); exit();

      $input['reason'] 			= Input::get('reason');
      $input['comments'] 		= Input::get('message');
      $input['post_id'] 		= Input::get('post_id');
      $input['user_id']     = $userinfo->id;
      $input['section']     = 'Offer';


      $problem= $this->problem->create($input);

      $data['reason'] 			  = Input::get('reason');
      $data['brandname'] 			= getBrandName($post->brand_id);
      $data['offername']      = $post->name;
      $data['name'] 			    = $userinfo->first_name.' '.$userinfo->last_name;
      $data['email']          = $userinfo->email;
      $data['problem_msg'] 		= Input::get('message');
      $data['post_url']       = Input::get('post_url');
      $data['section']        = 'Offer';
      $data['date']           = date('Y-m-d H:i:s');

      Mailgun::send('emails.offer_report_issue', $data, function($message) use($data)
      {
          $message->subject('Offer Report Problem Issue has been submitted');
          $message->to($data['email'], $data['name']);

      });

      Mailgun::send('emails.admin_offer_report_issue', $data, function($message) use($data,$admin)
      {
          $message->subject('Offer Report Issue');
          $message->to($admin, 'Admin');

      });		//pending mail for admin

      return Response::json(array('error'=>'false','message'=>'We regret the inconvenience. We will get back to you as soon as we can'));
  }
}
