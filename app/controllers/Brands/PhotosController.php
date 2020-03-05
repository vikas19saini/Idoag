<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Forms\NewPhotosForm;
use idoag\Repos\PostsVisitsRepositoryInterface;


class PhotosController extends \BaseController {

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

    private $user_id;

    private $note;
	
	/**
	 * PagesController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, PostsVisitsRepositoryInterface $posts_visits, SettingsRepositoryInterface $setting, BrandRepositoryInterface $brand,
                          CategoryRepositoryInterface $category, NewPhotosForm $NewPhotosForm, FeedbackRepositoryInterface $note,
                          PostRepositoryInterface $post )
	 {

		 $this->user		= $user;
		
		 $this->setting 	= $setting;
		
		 $this->brand 	    = $brand;

         $this->category	= $category;

         $this->NewPhotosForm	= $NewPhotosForm;

         $this->post 	    = $post;

         $this->note        = $note;

         $this->posts_visits = $posts_visits;

         cloudinary();		
	 }


	public function getPhotos($slug)
	{
		$brand_detail	= $this->brand->findBySlug($slug);

        $type = 'photo';

        $photo_detail = $this->post->getPostByTypeAndBrandId($type,$brand_detail->id);

        $notes='';

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

		return View::make('brands.photos.photos_show')->withBrand($brand_detail)->withPhotos($photo_detail)->withNotes($notes);
	}

    public function createLinks($slug){

        $brand_detail	= $this->brand->findBySlug($slug);


        return View::make('brands.photos.create')->withBrand($brand_detail);

    }

    public function edit($slug1, $slug2)
    {
        $brand_detail	= $this->brand->findBySlug($slug1);

        $photo_detail = $this->post->getPostsBySlug($slug2);

        return View::make('brands.photos.edit')->withBrand($brand_detail)->withPhoto($photo_detail);
    }

    public function getPhotoDetails($slug1, $slug2)
    {

        $brand= $this->brand->findBySlug($slug1);

        $type = 'photo';

        $single= $this->post->getPostsBySlug($slug2);

        $photos =Post::where('brand_id',$brand->id)->where('type',$type)->whereNotIn('id', array($single->id))->where('status',1)->orderBy('updated_at','desc')->take(8)->get();

        $post = $this->post->find($single->id);

        $post->timestamps = false;
        
        $post->increment('visits');

        $post->visits += 1;

        $brandoffers =Post::where(['brand_id'=>$brand->id, 'type'=>$type])->where('id','<>',$single->id)->orderBy('created_at','desc')->take(4)->get();

        $notes='';

        if(Sentry::check()) {

            $loggedin_user = Sentry::getUser();

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
			}
			else
			{
                $notes = $this->note->withreply($brand->id);
            } 
        }

        return View::make('brands.photos.photo_details', compact('brand','photos','single','brandoffers','notes'));

    }

}
