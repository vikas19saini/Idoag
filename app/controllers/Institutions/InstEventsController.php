<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;

class InstEventsController extends \BaseController {
	
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
	 * @var $institution
	 *
	 */
	protected $institution;
/**
	 * @var $post
	 *
	 */
	protected $post;

    protected $note;
    /**
     * @var $posts_likes
     *
     */
    protected $posts_likes;

    /**
     * @var $posts_visits
     *
     */
    protected $posts_visits;


    /**
	 * PagesController Constructor function
	 *
	 */
	 function __construct(UserRepositoryInterface $user, PostRepositoryInterface $post,   PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits,  InstitutionRepositoryInterface $institution,   FeedbackRepositoryInterface $note)
	 {
		$this->user		= $user;


		$this->institution 	= $institution;

		$this->post 	= $post;


         $this->note         = $note;

         $this->posts_likes = $posts_likes;

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

		$institution_detail	= $this->institution->findBySlug($slug);

		return View::make('institutions.events.create')->withInstitution($institution_detail);

	}

	public function getEvents($slug)
	{
		$institution_detail	= $this->institution->findBySlug($slug);

		// echo"<pre>";print_r($institution_detail);exit();

        $type = 'insevent';

		$events= $this->post->getPostByTypeAndInstitutionId($type,$institution_detail->id);

        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

           if($loggedin_user->institution_id==$institution_detail->id)
			 {
				 $notes = $this->note->withoutInsReply($institution_detail->id);
			 }
			 else
             {
                $notes = $this->note->withInsReply($institution_detail->id);
             }  

            return View::make('institutions.events.events_show')->withInstitution($institution_detail)->withEvents($events)->withNotes($notes);
        }
        else
        return View::make('institutions.events.events_show')->withInstitution($institution_detail)->withEvents($events);
	}

	public function getSingleEvent($slug1, $slug2)
	{
		$institution_detail	= $this->institution->findBySlug($slug1);

        $type = 'insevent';

        $events= $this->post->getPostByTypeAndInstitutionId($type,$institution_detail->id);

		$SingleEvent= $this->post->getPostsBySlug($slug2);

        $post = $this->post->find($SingleEvent->id);

        $post->timestamps = false;

        $post->increment('visits');

        $post->visits += 1;

        $user_id = Sentry::getUser()->id;

        $input = array('post_id' => $SingleEvent->id, 'user_id' => $user_id);

        $postvisit = $this->posts_visits->postvisitexists($SingleEvent->id, $user_id);

        if ($postvisit) {
            $postsvisits = PostsVisits::find($postvisit);
            $postsvisits->touch();
        } else {
            $this->posts_visits->create($input);
        }


        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if($loggedin_user->institution_id==$institution_detail->id)
			 {
				 $notes = $this->note->withoutInsReply($institution_detail->id);
			 }
			 else
             {
                $notes = $this->note->withInsReply($institution_detail->id);
             }  

            return View::make('institutions.events.events_single')->withInstitution($institution_detail)->withEvents($events)->withSingle($SingleEvent)->withNotes($notes);
        }
else
        return View::make('institutions.events.events_single')->withInstitution($institution_detail)->withEvents($events)->withSingle($SingleEvent);

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
        $institution_detail	= $this->institution->findBySlug($slug1);

        $event_detail = $this->post->getPostsBySlug($slug2);

        $cities= City::where('state_id','=',$event_detail->state)->lists('name', 'id');

        return View::make('institutions.events.edit')->withInstitution($institution_detail)->withEvent($event_detail)->withCities($cities);
    }
}
