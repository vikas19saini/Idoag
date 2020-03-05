<?php
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\PostsLikesRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;


class MainInternshipsController extends \BaseController {

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

    protected $note;

    function __construct(UserRepositoryInterface $user,  BrandRepositoryInterface $brand, PostRepositoryInterface $post, PostsLikesRepositoryInterface $posts_likes, FeedbackRepositoryInterface $note)
    {
        $this->user		        = $user;

        $this->post 	        = $post;

        $this->posts_likes    = $posts_likes;

        $this->brand   	      = $brand;

        $this->note         = $note;


        cloudinary();

        }



    public function index()
    {
        $student_internships="";

        if(Sentry::check())
        {
            $loggedin_user = Sentry::getUser();
            $user_group = $loggedin_user->getGroups()->first()->name;
            if($user_group == 'Students')
                $student_internships = Internship::join('posts', 'posts.id', '=', 'internships.post_id')->where('internships.user_id', Sentry::getUser()->id)->whereNULL('posts.deleted_at')->select('internships.*')->orderBy('internships.created_at','desc')->get();

         }

        $internships = Post::whereIn('type', array('internship', 'job', 'ambassador'))->where('status',1)->orderBy('updated_at','desc')->paginate(10);
        
        return View::make('pages.internships', compact('internships','student_internships'));
    }

    public function getMyBrandsInternships()
    {
        $brands_follows  = BrandsFollows::where('user_id', (Sentry::getUser()->id))->lists('brand_id');

        $mybrands_internships = $this->post->getInternshipsByBrandIds($brands_follows);

        return View::make('students.mybrands_internships', compact('mybrands_internships'));

    }

    public function getTrendingInternships()
    {
        $trending_internships= $this->post->getTrendingPostsType('internship');
        return View::make('students.trending_internships', compact('trending_internships'));
    }

    public function internshipCategory($slug)
    {
        $type   = 'internship';

        $student_internships="";

        if(Sentry::check())
        {
            $loggedin_user      = Sentry::getUser();
            $user_group         = $loggedin_user->getGroups()->first()->name;
            if($user_group == 'Students')
                $student_internships = Internship::join('posts', 'posts.id', '=', 'internships.post_id')->where('internships.user_id', Sentry::getUser()->id)->whereNULL('posts.deleted_at')->select('internships.*')->orderBy('internships.id','desc')->take(4)->get();
        }
        $internships= Post::where('category', 'LIKE', '%'.$slug.'%')->where('status',1)->whereIn('type', array('internship', 'job', 'ambassador'))->where('status',1)->paginate(10);

        $post_total = count($internships);

        //$internships = InternshipPostsExpiredToLast($internships);

        $trending_internships = $this->post->getTrendingPostsType($type);

        $category=$slug;

        return View::make('pages.internships', compact('internships','trending_internships','student_internships','category','post_total'));
    }

    public function getInternshipDetails($slug1, $slug2)
    {

        $brand= $this->brand->findBySlug($slug1);

        $type = 'internship';

        $internships= $this->post->getAllPostByType($type);

        $single= $this->post->getPostsBySlug($slug2);


        $post = $this->post->find($single->id);

        $post->timestamps = false;

        $post->increment('visits');

        $post->visits += 1;

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

        return View::make('brands.internships.internships_single', compact('brand','internships','single','notes'));
    }

    public function getPopular()
    {
        $type = 'internship';

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
            $query->where('category', $category);
        }
        $posts=$query->get();

        $posts=PostsExpiredToLast($posts);


        if($category)
        {
            $internships=$posts;
        }
        else
            $internships = $posts->take(12);


        return View::make('students.partials.internships_more', compact('internships'));
    }

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
                'message'=>'You already like this internship',
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

    public function getmoreInternships()
    {
        $input = Input::all();

        $limit = Input::get('limit');

        $offset = (Input::get('offset')-1)*$limit;

        $type = 'internship';

        $sortby = Input::get('select');


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

        $revised_posts=PostsExpiredToLast($posts);

        $internships = $revised_posts->slice(($offset),12);

        return View::make('students.partials.internships_more', compact('internships'));
    }

}