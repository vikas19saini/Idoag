<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Forms\NewLinksForm;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;

class InstLinksController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	

	protected $institution;

    /**
     * @var $user_id
     */

    /**
     * @var $post
     *
     */
    protected $post;

    protected $note;

    protected $posts_likes;

    protected $posts_visits;


	/**
	 * PagesController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, NewLinksForm $NewLinksForm, PostRepositoryInterface $post, FeedbackRepositoryInterface $note, PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits, InstitutionRepositoryInterface $institution)
	 {

         $this->user		= $user;

         $this->institution 	= $institution;

         $this->NewLinksForm	= $NewLinksForm;

         $this->post 	    = $post;

         $this->note         = $note;

         $this->posts_likes = $posts_likes;

         $this->posts_visits = $posts_visits;

         cloudinary();

	 }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug1, $slug2)
	{
        $institution_detail	= $this->institution->findBySlug($slug1);

        $links_detail = $this->post->getPostsBySlug($slug2); 
        
         return View::make('institutions.text.edit')->withInstitution($institution_detail)->withLinks($links_detail);
	}

	
	public function getLinks($slug)
	{
		$institution_detail	= $this->institution->findBySlug($slug);

        $type = 'instext';

        $links_details = $this->post->getPostByTypeAndInstitutionId($type,$institution_detail->id);

        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if ($user_group == 'Students') {
                $notes = $this->note->withInsreply($institution_detail->id);
            } else {
                $notes = $this->note->withoutInsreply($institution_detail->id);
            }

            return View::make('institutions.text.links_show')->withInstitution($institution_detail)->withLinks($links_details)->withNotes($notes);
        }
        else
        {
            return View::make('institutions.text.links_show')->withInstitution($institution_detail)->withLinks($links_details);
        }
	}

    public function createText($slug){

        $institution_detail	= $this->institution->findBySlug($slug);


        return View::make('institutions.text.create')->withInstitution($institution_detail);

    }
    public function getLinkDetails($slug1, $slug2)
    {

        $institution_detail = $this->institution->findBySlug($slug1);

        $type = 'instext';

        $links= $this->post->getPostByTypeAndInstitutionId($type, $institution_detail->id);
        
        $SingleLink= $this->post->getPostsBySlug($slug2);

        $post = $this->post->find($SingleLink->id);

        $loggedin_user      = Sentry::getUser();

        $user_group         = $loggedin_user->getGroups()->first()->name;

        $post->timestamps = false;
        
        $post->increment('visits');

        $post->visits += 1;

        $user_id = $loggedin_user->id;

        $input = array('post_id' => $SingleLink->id, 'user_id' => $user_id);

        $postvisit = $this->posts_visits->postvisitexists($SingleLink->id, $user_id);

        if ($postvisit)
        {
            $postsvisits = PostsVisits::find($postvisit);

            $postsvisits->touch();
        }
        else
        {
            $this->posts_visits->create($input);
        }

        if($user_group == 'Students')
        {
            $notes      = $this->note->withInsreply($institution_detail->id);
        }
        else
        {
            $notes      = $this->note->withoutInsreply($institution_detail->id);
        }

        return View::make('institutions.text.links_single')->withInstitution($institution_detail)->withLinks($links)->withSingle($SingleLink)->withNotes($notes);
    }

}
