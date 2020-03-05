<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;

class MainPhotosController extends \BaseController {

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
     * @var $brand
     *
     */
    protected $brand;


    function __construct(UserRepositoryInterface $user,  BrandRepositoryInterface $brand, PostRepositoryInterface $post, PostsLikesRepositoryInterface $posts_likes )
    {
        $this->user		        = $user;

        $this->post 	        = $post;

        $this->posts_likes    = $posts_likes;

        $this->brand   	      = $brand;

        cloudinary();
        
        }

    public function index()
    {
        $type   = 'photo';

        $offers = $this->post->getAllPostByType($type);

        return View::make('pages.photos', compact('offers'));
    }





  /**
   * post Likes update
   *
   * @param  int  $id
   * @return Response
   */
  public function getLikes()
  {   
    $post_id    = Input::get('post_id');

    $user_id    = Sentry::getUser()->id;

    $input      = array('post_id'=>$post_id,'user_id'=>$user_id);

    $likes      = $this->posts_likes->checkLikes($post_id, $user_id);

    if($likes)
    {

      $count          = $this->posts_likes->getCount($post_id);

      return Response::json(array(
        'message'=>'You already like this offer',
        'count'=>$count,
        'post_id'=>$post_id));
    }
    else
    {

      $like_action    = $this->posts_likes->create($input);

      $count          = $this->posts_likes->getCount($post_id);

        return Response::json(array(
        'count'=>$count,
        'post_id'=>$post_id));
      }

  }
}
