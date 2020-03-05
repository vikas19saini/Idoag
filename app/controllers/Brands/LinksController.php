<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Forms\NewLinksForm;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;

class LinksController extends \BaseController {
	
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
     * @var $user_id
     */

    /**
     * @var $post
     *
     */
    protected $post;

    protected $note;
    protected $posts_likes;

    /**
     * @var $posts_likes
     *
     */
    protected $posts_visits;


	/**
	 * PagesController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user,   BrandRepositoryInterface $brand,
                             CategoryRepositoryInterface $category, NewLinksForm $NewLinksForm,
                                 PostRepositoryInterface $post, FeedbackRepositoryInterface $note,  PostsLikesRepositoryInterface $posts_likes, PostsVisitsRepositoryInterface $posts_visits)
	 {

         $this->user		= $user;

         $this->brand 	= $brand;

         $this->category	= $category;

         $this->NewLinksForm	= $NewLinksForm;

         $this->post 	    = $post;

         $this->note         = $note;

         $this->posts_likes  = $posts_likes;

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
        $brand_detail	= $this->brand->findBySlug($slug1);

        $links_detail = $this->post->getPostsBySlug($slug2);

         return View::make('brands.text.edit')->withBrand($brand_detail)->withLinks($links_detail);
	}

	
	public function getLinks($slug)
	{
		$brand_detail	= $this->brand->findBySlug($slug);

        $type = 'text';

        $links_details = $this->post->getPostByTypeAndBrandId($type,$brand_detail->id);

         if (Sentry::check()) {

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

            return View::make('brands.text.links_show')->withBrand($brand_detail)->withLinks($links_details)->withNotes($notes);
        }
        else
        {
            return View::make('brands.text.links_show')->withBrand($brand_detail)->withLinks($links_details);
        }
	}

    public function createLinks($slug){

        $brand_detail	= $this->brand->findBySlug($slug);


        return View::make('brands.text.create')->withBrand($brand_detail);

    }
    public function getLinkDetails($slug1, $slug2)
    {
        $brand_detail = $this->brand->findBySlug($slug1);

        $type = 'text';


        $links= $this->post->getPostByTypeAndBrandId($type, $brand_detail->id);

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

         if($loggedin_user->brand_id==$brand_detail->id)
			{
				$notes = $this->note->withoutreply($brand_detail->id);
			}
			else
			{
				$notes = $this->note->withreply($brand_detail->id);
			}


        return View::make('brands.text.links_single')->withBrand($brand_detail)->withLinks($links)->withSingle($SingleLink)->withNotes($notes);
    }

}
