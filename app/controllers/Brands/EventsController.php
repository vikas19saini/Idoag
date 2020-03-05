<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;



class EventsController extends \BaseController {
	
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
	 * @var $post 
	 *
	 */
	protected $post;

    protected $note;



    /**
	 * PagesController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, PostsVisitsRepositoryInterface $posts_visits, PostRepositoryInterface $post, SettingsRepositoryInterface $setting, BrandRepositoryInterface $brand, CategoryRepositoryInterface $category, FeedbackRepositoryInterface $note)
	 {
		$this->user		= $user;
		
		$this->setting 	= $setting;
		
		$this->brand 	= $brand; 
		
		$this->post 	= $post; 

        $this->category	= $category;

        $this->note         = $note;

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
	
	 
	public function createEvents($slug){
		
		$brand_detail	= $this->brand->findBySlug($slug);
		
		return View::make('brands.events.create')->withBrand($brand_detail);
		
	}

	public function getEvents($slug)
	{
		$brand_detail	= $this->brand->findBySlug($slug);

        $type = 'event';

        $events= $this->post->getActivePostByTypeAndBrandId($type,$brand_detail->id);

        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

        	 if($loggedin_user->brand_id==$brand_detail->id)
			{
				$notes = $this->note->withoutreply($brand_detail->id);
                $events= $this->post->getPostByTypeAndBrandId($type,$brand_detail->id);
			}
			else
			{
				$notes = $this->note->withreply($brand_detail->id);
			}

            return View::make('brands.events.events_show')->withBrand($brand_detail)->withEvents($events)->withNotes($notes);
        }
        else
        {
            return View::make('brands.events.events_show')->withBrand($brand_detail)->withEvents($events);
        }
	}

	public function getEventDetails($slug1, $slug2)
	{
		$brand_detail	= $this->brand->findBySlug($slug1);

        $type = 'event';

        $events= $this->post->getActivePostByTypeAndBrandId($type,$brand_detail->id);
		
		$single= $this->post->getPostsBySlug($slug2);

        $loggedin_user      = Sentry::getUser();

        $input = array('post_id' => $single->id, 'user_id' => $loggedin_user->id);

		$postvisit = $this->posts_visits->postvisitexists($single->id, $loggedin_user->id);

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

        $user_group         = $loggedin_user->getGroups()->first()->name;

         if($loggedin_user->brand_id==$brand_detail->id)
			{
				$notes = $this->note->withoutreply($brand_detail->id);
			}
			else
			{
				$notes = $this->note->withreply($brand_detail->id);
			}


        return View::make('brands.events.events_single')->withBrand($brand_detail)->withEvents($events)->withSingle($single)->withNotes($notes);
		 
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug1
     * @param string $slug2
     * @return Response
     */

    public function edit($slug1, $slug2)
    {
        $brand_detail	= $this->brand->findBySlug($slug1);

        $event_detail = $this->post->getPostsBySlug($slug2);

        $cities= City::where('state_id','=',$event_detail->state)->lists('name', 'id');

        return View::make('brands.events.edit')->withBrand($brand_detail)->withEvent($event_detail)->withCities($cities);
    }
}
