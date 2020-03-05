<?php namespace idoag\Repos\Post;

use \Post;
use \DB;


class DbPostRepository implements PostRepositoryInterface 
{

	public function getAll()
	{
		return Post::all();
	}
	 
	public function find($id)
	{
		return Post::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return Post::create($fields);
    }
	
	public function delete($id)
	{
		return Post::destroy($id);
	}

	
	public function getPostsByUserId($id)
	{
		return Post::where('user_id','=',$id)->where('deleted_at',null)->orderBy('created_at','desc')->get();
	}

    public function getPostsByBrandId($id)
    {
        return Post::where('brand_id','=',$id)->orderBy('updated_at','desc')->where('deleted_at',null)->where('status',1)->get();//->take(10)->get();//paginate(10);//
    }
    public function getPostsByInstitutionId($id)
    {
        return Post::where('institution_id','=',$id)->orderBy('updated_at','desc')->where('deleted_at',null)->where('status',1)->get();//->take(10)->get();//paginate(10);//
    }
    public function getPostByTypeAndUserId($type,$user_id)
    {
        return Post::where('user_id',$user_id)->where('type',$type)->where('status',1)->get();
    }

	public function getPostByTypeAndBrandId($type,$brand_id,$status=1)
	{
        if($status==1)
        return Post::where('brand_id',$brand_id)->where('type',$type)->where('status',$status)->orderBy('created_at','desc')->get();
        else
        return Post::where('brand_id',$brand_id)->whereIn('type', array('internship', 'job', 'ambassador'))->orderBy('created_at','desc')->get();
    }
    public function getActivePostByTypeAndBrandId($type,$brand_id,$status=1)
    {
        if($type=='internship'){
            
            $query = Post::where('brand_id', $brand_id)->whereIn('type', array('internship', 'job', 'ambassador'));
        }
        else{
            $query =Post::where('brand_id',$brand_id)->where('type',$type);
        }
        
        if($status==1)
            $query->where('status',$status);
        if($type=='internship')
            $query->where('application_date','>',date('Y-m-d'));

        $query->where(function($query2){
            $query2->where('end_date', '>', date('Y-m-d'));
            $query2->orWhere('end_date', '=', NULL);
            $query2->orWhere('end_date', '=', '');});

        return $query->orderBy('created_at','desc')->get();



    }

    public function getPostByTypeAndInstitutionId($type,$institution_id,$status=1)
    {
        if($status==1)
            return Post::where('institution_id',$institution_id)->where('type',$type)->where('status',$status)->orderBy('created_at','desc')->get();
        else
            return Post::where('institution_id',$institution_id)->where('type',$type)->orderBy('created_at','desc')->get();

    }

    public function getPostByTypeAndIntCategory($type,$slug)
    {
        return Post::where('category', 'LIKE', '%'.$slug.'%')->where('status',1)->whereIn('type',$type)->where('status',1)->get();
    }


    public function getPostByTypeAndCategory($type,$slug)
    {
        return Post::join('brands', 'posts.brand_id', '=', 'brands.id')->select('posts.*')->where('brands.category', 'LIKE', '%'.$slug.'%')->where('posts.type',$type)->where('posts.status',1)->get();
    }

    public function getAllPostByType($type)
    {
        return  Post::where('type',$type)->where('status',1)->orderBy('updated_at','desc')->take(12)->get();//paginate(12);
    }

    public function getPostsByType($type)
    {
        return  Post::where('type',$type)->orderBy('created_at','desc')->get();
    }
    public function getOffersWithCoupons()
    {
        return  Post::where('type','offer')->where('voucher_type','single')->orWhere('voucher_type','multiple')->orderBy('created_at','desc')->get();
    }
    public function getInternshipPosts()
    {
        return  Post::with('internships')->where('type','internship')->orderBy('created_at','desc')->get();
    }

    public function getTrendingPostsType($type)
    {
        return  Post::where('type',$type)->where('status',1)->where(function($query) {
            $query->where('end_date', '>=', date('Y-m-d'));
            $query->orWhere('end_date',NULL);
        })->groupBy('brand_id')->orderBy('visits','desc')->take(4)->get();
    }
    public function getPostByType($type)
    {
        return  Post::where('type',$type)->where('status',1)->orderBy('updated_at','desc')->get();
    }
    public function getPostIdsByBrandAndType($brand_id,$type)
    {
        return  Post::where('brand_id',$brand_id)->where('type',$type)->lists('id');
    }
    public function getPostIdsByType($type)
    {
        return  Post::where('type',$type)->lists('id');
    }
    public function getListByIds($ids)
    {
        return  Post::whereIn('id',$ids)->lists('name','id');

    }
    public function getAllPostByVisits($type, $limit=5)
    {
		// $data = DB::table('posts')->orderBy('visits','desc')->toSql();
		
		$posts = DB::table('posts')->where('deleted_at',null)->where('status',1)->where('end_date','>',date('Y-m-d'))->where('type',$type)->orderBy('visits','desc')->take($limit)->get();
         
        return $posts;
    }

    public function getAllInstPostByVisits($type)
    {

        $data = DB::table('posts')->orderBy('visits','desc')->toSql();

        $posts = DB::table(DB::raw("($data) AS myposts"))->where('deleted_at',null)->where('end_date','>',date('Y-m-d'))->where('type',$type)->groupBy('institution_id')->get();

        return $posts;
    }

    public function getRemainingPosts($offset, $type, $limit)
    {
        return  Post::where('type',$type)->where('status',1)->orderBy('updated_at','desc')->skip($offset)->take($limit)->get();//paginate(12);
    }

	public function getPostsBySlug($slug)
	{
		return Post::where('slug','=',$slug)->first();
	}
	
	
	public function getSlug($slug)
	{
		$slugCount 	= count( Post::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 	
		if($slugCount >= 1)
		{
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
			
			
		} else {
			
			return $slug;
		}
	}
	
	public function activate($ids)
	{
        return Post::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
        return Post::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
        return Post::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s'), 'status' => 0));
	}
	
	public function untrash($ids)
	{
        return Post::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null, 'status' => 1));
	}

    public function getTotalPostCountByUser($type,$user_id)
    {
        return Post::where(['user_id' => $user_id, 'type' => $type])->count();

    }
    public function getTotalPostCountByBrand($type,$brand_id)
    {
        return Post::where(['brand_id' => $brand_id, 'status' => 1, 'type' => $type])->count();

    }
    public function getTotalActivePostCountByBrand($type,$brand_id)
    {
        return Post::where(['brand_id' => $brand_id, 'status' => 1, 'type' => $type])->where(function($query){
            $query->where('end_date', '>', date('Y-m-d'));
            $query->orWhere('end_date', '=', NULL);
            $query->orWhere('end_date', '=', '');})->count();

    }
    public function getTotalPostCountByInstitution($type,$institution_id)
    {
        return Post::where(['institution_id' => $institution_id, 'type' => $type])->count();
    }
    public function getTotalPostCount($type)
    {
        return Post::where(['type' => $type])->count();
    }

    public function getTotalPostCountByStatus($type,$status)
    {
        return Post::where(['type' => $type,'status'=>$status])->count();
    }
    public function getInternshipsByBrandIds($ids, $limit=5)
    {
        return Post::whereIn('brand_id', $ids)->where('status',1)->where('posts.type','internship')->take($limit)->get();
    }
    public function getAllPostByPopularity($ids, $limit=5)
    {
    	return Post::whereIn('brand_id', $ids)->where('status',1)->where('end_date','>',date('Y-m-d'))->orderBy('visits','desc')->take($limit)->get();
    }
    public function getAllInstPostByPopularity($ids, $limit=5)
    {
        return Post::whereIn('institution_id', $ids)->orderBy('visits','desc')->where('end_date','>',date('Y-m-d'))->take($limit)->get();
    }

    public function getPopularposts($type, $offset = 0,$limit = 12)
    {

        return Post::leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
            ->select('posts.*',  DB::raw('count(posts_likes.post_id) as likes'))
            ->where('posts.deleted_at',null)
            ->where('posts.type',$type)
            ->where('posts.status',1)
            ->groupBy('posts.id')
            ->orderBy('likes','desc')
            ->skip($offset)
            ->take($limit)
            ->get();
    }
    public function getLatestposts($type, $offset = 0,$limit = 12)
    {
        return Post::where('type', $type)->where('status',1)->orderBy('updated_at','desc')->skip($offset)->take($limit)->get();
    }
    public function getMostViewedposts($type, $offset = 0,$limit = 12)
    {
        return Post::where('type', $type)->where('status',1)->orderBy('visits','desc')->skip($offset)->take($limit)->get();
    }
    public function getFeatured()
    {
        return Post::where('featured', 1)->get();
    }
}