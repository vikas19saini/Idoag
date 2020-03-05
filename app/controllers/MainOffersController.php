<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\Student\UserCouponRepositoryInterface;


class MainOffersController extends \BaseController
{

  /**
   * @var $user
   *
   */
  protected $user;

  /**
   * @var $post
   *
   */
  protected $post;

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
   * @var $brand
   *
   */
  protected $brand;

  /**
   * @var $note
   *
   */
  protected $note;

  /**
   * @var $store
   *
   */
  protected $store;

  function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand, PostRepositoryInterface $post, OutletRepositoryInterface $store,PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits, FeedbackRepositoryInterface $note, UserCouponRepositoryInterface $user_coupon)
  {
    $this->user = $user;

    $this->post = $post;

    $this->brand = $brand;

    $this->note  = $note;

    $this->store = $store;

    $this->user_coupon = $user_coupon;

    $this->posts_likes = $posts_likes;

    $this->posts_visits = $posts_visits;

    cloudinary();

  }

  public function index()
  {
    $type = 'offer';
    if(Sentry::check()){
        $loggedUserType = Sentry::getUser()->user_type;
        $userType = '';
        if($loggedUserType == 'student'){
            $userType = 'corporates';
        }
        if($loggedUserType == 'corporate'){
            $userType = 'students';
        }
        $posts = Post::join('brands', 'brands.id', '=', 'posts.brand_id')->select('posts.*', 'brands.name as bname')->where('posts.type', $type)->where('posts.status',1)->where('posts.end_date','>',date('Y-m-d'))->where('posts.for_user_type', '!=', $userType)->orderBy('posts.updated_at','desc')->get();
    }else{
        $posts = Post::join('brands', 'brands.id', '=', 'posts.brand_id')->select('posts.*', 'brands.name as bname')->where('posts.type', $type)->where('posts.status',1)->where('posts.end_date','>',date('Y-m-d'))->orderBy('posts.updated_at','desc')->get();
    }

    $post_total = count($posts);

    $latest_offers = PostsExpiredToHide($posts);

    $offers = $latest_offers->shuffle();

    $trending_offers = $this->post->getTrendingPostsType($type);

    if(Sentry::check())
    {
      $brands_follows  = BrandsFollows::where('user_id', (Sentry::getUser()->id))->lists('brand_id');
    
      $top_offers = $this->post->getAllPostByPopularity($brands_follows);
    }
    else
    {
      $top_offers="";
    }
    return View::make('pages.offers', compact('offers','trending_offers','top_offers','post_total'));
  }

  public function getPopular()
  {
    $type = 'offer';

    $sortby= Input::get('keywords');
      $category=Input::get('category');

     if($sortby=='Popular') {
        $query = Post::leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
            ->select('posts.*', DB::raw('count(posts_likes.post_id) as likes'))
            ->where('posts.deleted_at', null)
            ->where('posts.type', $type)
            ->where('posts.status', 1)
            ->groupBy('posts.id')
            ->orderBy('likes', 'desc');
    }
    if($sortby=='Latest')
    {  
      $query = Post::where('type', $type)->where('status',1)->orderBy('updated_at','desc');
    }

    if($sortby=='Most Viewed')
    {  
      $query = Post::where('type', $type)->where('status',1)->orderBy('visits','desc');
    }
      if($category)
      {
          $brand_ids=$this->brand->getListByCategory($category);
          $query->whereIn('posts.brand_id', $brand_ids);
      }
      $posts=$query->get();

      $revised_offers=PostsExpiredToHide($posts);

      if($category)
      {
          $offers=$revised_offers;
      }
      else
      $offers = $revised_offers->take(12);

      return View::make('students.partials.offers_more', compact('offers'));
  }

  public function getmoreOffers()
  {
    $input = Input::all();

    $limit = Input::get('limit');

    $offset = (Input::get('offset')-1)*$limit;

    $type = 'offer'; 

    $sortby= Input::get('select');

    if($sortby=='Popular')
    {  
      $posts = Post::leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
              ->select('posts.*',  DB::raw('count(posts_likes.post_id) as likes'))
              ->where('posts.deleted_at',null)
              ->where('posts.type',$type)
              ->where('posts.status',1)
              ->groupBy('posts.id')
              ->orderBy('likes','desc')->get();
    }

    if($sortby=='Latest')
    {  
      $posts = Post::where('type', $type)->where('status',1)->orderBy('updated_at','desc')->get();
    }

    if($sortby=='Most Viewed')
    {  
      $posts = Post::where('type', $type)->where('status',1)->orderBy('visits','desc')->get();
    }

      $revised_offers=PostsExpiredToHide($posts);

      $offers = $revised_offers->slice(($offset),12);

    return View::make('students.partials.offers_more', compact('offers'));
  }


  public function offerCategory($slug)
  {

      $type = 'offer';

      $offers = $this->post->getPostByTypeAndCategory($type, $slug);

      $post_total=count($offers);


      $trending_offers = $this->post->getTrendingPostsType($type);

      $offers=PostsExpiredToHide($offers);


      if(Sentry::check())
      {
          $brands_follows  = BrandsFollows::where('user_id', (Sentry::getUser()->id))->lists('brand_id');

          $top_offers = $this->post->getAllPostByPopularity($brands_follows);
      }
      else
      {
          $top_offers="";
      }
      $category=$slug;

      return View::make('pages.offers', compact('offers','trending_offers','top_offers','category','post_total'));
  }

  public function getMyBrandsOffers()
  {
      $brands_follows  = BrandsFollows::where('user_id', (Sentry::getUser()->id))->lists('brand_id');

      $top_offers = $this->post->getAllPostByPopularity($brands_follows);

      return View::make('students.mybrands_offers', compact('top_offers'));

  }

  public function getTrendingOffers()
  {
      $trending_offers = $this->post->getTrendingPostsType('offer');
      return View::make('students.trending_offers', compact('trending_offers'));
  }

  public function getLikes()
  {
      $post_id = Input::get('post_id');

      $user_id = Sentry::getUser()->id;

      $input = array('post_id' => $post_id, 'user_id' => $user_id);

      $likes = $this->posts_likes->checkLikes($post_id, $user_id);

      if ($likes) 
      {
        $like_action = $this->posts_likes->delete($likes->id);

        $count = $this->posts_likes->getCount($post_id);

        return Response::json(array(
            'message' => 'unlike',
            'count' => $count,
            'post_id' => $post_id));
      } 
      else 
      {

        $like_action = $this->posts_likes->create($input);

        $count = $this->posts_likes->getCount($post_id);

        return Response::json(array(
            'message' => 'like',
            'count' => $count,
            'post_id' => $post_id));
      }

  }

  public function availableStores()
  {
    if(Request::ajax())
    {
      $state        = getState(Input::get('state'));

      $city         = getCity(Input::get('city'));

      $location     = Input::get('location');

      $post_id      = Input::get('post_id');

      $post         = $this->post->find($post_id);    

      $stores       = explode(',',$post->available_stores);

      $available_stores = $this->store->getStores($stores, $state, $city);

      if($location)
      {
        $avail_stores = new \Illuminate\Database\Eloquent\Collection;

        foreach ($available_stores as $available_store) {

          if(str_contains(Str::lower($available_store), Str::lower($location) ))  {

            $avail_stores->add($available_store);

          }
        }
        
        $available_stores = $avail_stores;
        
        return Response::json(array('available_stores' => $available_stores));
      }
      return Response::json(array('available_stores' => $available_stores));//echo"<pre>";print_r($avail_stores);exit();
    }
  }

}
