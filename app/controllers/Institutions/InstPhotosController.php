<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;

class InstPhotosController extends \BaseController {

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
    function __construct(UserRepositoryInterface $user, PostRepositoryInterface $post,   PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits, InstitutionRepositoryInterface $institution,   FeedbackRepositoryInterface $note)
    {
        $this->user		= $user;


        $this->institution 	= $institution;

        $this->post 	= $post;


        $this->note         = $note;
        $this->posts_likes = $posts_likes;

        $this->posts_visits = $posts_visits;

        cloudinary();


    }


	public function getPhotos($slug)
	{
		$institution_detail	= $this->institution->findBySlug($slug);

       // dd($institution_detail);

        $type = 'insphoto';

        $photo_detail = $this->post->getPostByTypeAndInstitutionId($type,$institution_detail->id);

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

            return View::make('institutions.photos.photos_show')->withInstitution($institution_detail)->withPhotos($photo_detail)->withNotes($notes);
        }
        else
		return View::make('institutions.photos.photos_show')->withInstitution($institution_detail)->withPhotos($photo_detail);
	}

    public function createPhotos($slug){

        $institution_detail	= $this->institution->findBySlug($slug);


        return View::make('institutions.photos.create')->withInstitution($institution_detail);

    }

    public function edit($slug1, $slug2)
    {
        $institution_detail	= $this->institution->findBySlug($slug1);

        $photo_detail = $this->post->getPostsBySlug($slug2);

        return View::make('institutions.photos.edit')->withInstitution($institution_detail)->withPhoto($photo_detail);
    }

    public function getPhotoDetails($slug1, $slug2)
    {

        $institution = $this->institution->findBySlug($slug1);

        $type = 'insphoto';

        $photos= $this->post->getAllPostByType($type);

        $single= $this->post->getPostsBySlug($slug2);

        $post = $this->post->find($single->id);

        $post->timestamps = false;

        $post->increment('visits');

        $post->visits += 1;

        $user_id = Sentry::getUser()->id;

        $input = array('post_id' => $single->id, 'user_id' => $user_id);

        $postvisit = $this->posts_visits->postvisitexists($single->id, $user_id);

        if ($postvisit) {
            $postsvisits = PostsVisits::find($postvisit);

            $postsvisits->touch();
        } else {
            $this->posts_visits->create($input);
        }

        $institution_photos =Post::where(['institution_id'=>$institution->id, 'type'=>$type])->where('id','<>',$single->id)->orderBy('created_at','desc')->take(4)->get();

        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if($loggedin_user->institution_id==$institution->id)
			 {
				 $notes = $this->note->withoutInsReply($institution->id);
			 }
			 else
             {
                $notes = $this->note->withInsReply($institution->id);
             }  

            return View::make('institutions.photos.photo_details', compact('institution','photos','single','institution_photos'))->withNotes($notes);
        }
        else
        return View::make('institutions.photos.photo_details', compact('institution','photos','single','institution_photos'));

    }
}
