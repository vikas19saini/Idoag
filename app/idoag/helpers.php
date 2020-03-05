<?php
function return_field($table,$check_column,$check_value,$return_column)
{
    return(DB::table($table)->where($check_column,$check_value)->pluck($return_column));
}

function getBrandFollowsCount($brand_id)
{
    return(number_format(BrandsFollows::where('brand_id',$brand_id)->count()));
}
function getBrandInfoCount($brand_id,$type)
{
        return(Post::where('type',$type)->where('brand_id',$brand_id)->where('status',1)->count());
}
function getInstitutionFollowsCount($institution_id)
{
    return ( number_format(InstitutionsFollows::where('institution_id', $institution_id)->count()) );
}
function getStudentsCountByInstituteId($institution_id)
{
    return(User::where('type',$type)->where('brand_id',$brand_id)->where('status',1)->count());
}
function getCatNameBySlug($value)
{
    return Category::where('slug', $value)->pluck('name');
}
function getBrandSlugByPostId($id)
{
    $brand_id=Post::where('id',$id)->pluck('brand_id');
    return Brand::where('id',$brand_id)->pluck('slug');
}
function getBrandSlugByInternshipId($id)
{
    $post_id=Internship::where('id',$id)->pluck('post_id');
    $brand_id=Post::where('id',$post_id)->pluck('brand_id');
    return Brand::where('id',$brand_id)->pluck('slug');
}
function getPostSlugByInternshipId($id)
{
    $post_id=Internship::where('id',$id)->pluck('post_id');
    return Post::where('id',$post_id)->pluck('slug');
}
function getInternshipCatNameBySlug($value)
{
    return InternshipCategory::where('slug', $value)->pluck('name');
}
function getInstitutionInfoCount($institution_id,$type)
{
    return(Post::where('type',$type)->where('institution_id',$institution_id)->where('status',1)->count());
}
function getImage($path,$original,$noimage)
{
    if($original!='' && File::exists($path.$original))
    return $path.$original;
    else
    return $path.$noimage;
}

function getPostInfoCount($post_id,$type)
{
    if($type=="likes")
    {
        return(PostsLikes::where('post_id',$post_id)->count());
    }
    if($type=="visits")
    {
        return(Post::where('id',$post_id)->pluck('visits'));
    }

}



function errors_for($attribute, $errors)
{
 	
	return $errors->first($attribute, '<div class="text-danger text-center" id="'.$attribute.'_error">:message</div>');

}

function set_active_admin($path, $active='active')
{
	
	return Request::is($path) ? $active: '';

}

function set_active_users_tree($path)
{
	if($path == 'admin/users' || $path == 'admin/brands_users' || $path == 'admin/students_users' || $path == 'admin/institutions_users')
	{
		return "display:block";
	}
    else
        return false;
	
}
function array_to_object($array) 
{
	return (object) $array;
}

function object_to_array($array) 
{
	return json_decode(json_encode($array), true);
}

function cloudinary()
{
	return \Cloudinary::config(array(

	  "cloud_name" 	=> Config::get("constants.cloudinary.cloud_name"),

	  "api_key" 	=> Config::get("constants.cloudinary.api_key"),

	  "api_secret" 	=> Config::get("constants.cloudinary.api_secret"),

	));
}

function saveImage($url, $save_path)
{
	$contents 	= file_get_contents($url);

	file_put_contents($save_path , $contents);
	
}

function setActive($route, $class = 'active')
{
    return (Route::currentRouteName() == $route) ? $class : '';
}
function setActive2($routes, $class = 'active')
{
     $present_route=Route::currentRouteName();
     return (in_array($present_route,$routes)) ? $class : '';
}

function getBrandSlug($brand_id)
{
    return(DB::table('brands')->where('id', $brand_id)->pluck('slug'));
}
function getBrandLogo($brand_id)
{
    return(Brand::where('id', $brand_id)->pluck('image'));

}
function getInstitutionSlug($institution_id)
{
    return(Institution::where('id', $institution_id)->pluck('slug'));
}

function getInstitutionId($name)
{
    return(Institution::where('name', $name)->pluck('id'));
}

function getInstitutionLogo($institution_id)
{
    return(Institution::where('id', $institution_id)->pluck('image'));

}
function getUserPicture($user_id)
{
    return(User::where('id', $user_id)->pluck('profile_image'));

}
function checkLikes($post_id)
{
    if(Sentry::check()) {

        return PostsLikes::where('post_id', $post_id)->where('user_id', Sentry::getUser()->id)->first();

    }
    else
    {
        return false;
    }

}

function PostsExpiredToLast($posts)
{
    $revised_posts = new \Illuminate\Database\Eloquent\Collection;

    foreach($posts as $post)
    {
        if($post->end_date>= date('Y-m-d') || $post->end_date==null || $post->end_date=='' )
            $revised_posts->add($post);
    }

    foreach($posts as $post)
    {
        if($post->end_date< date('Y-m-d') && $post->end_date!=null )
            $revised_posts->add($post);
    }
    return $revised_posts;
}
function PostsExpiredToHide($posts)
{
    $revised_posts = new \Illuminate\Database\Eloquent\Collection;

    foreach($posts as $post)
    {
        if($post->end_date>= date('Y-m-d') || $post->end_date==null || $post->end_date=='' )
            $revised_posts->add($post);
    }

    return $revised_posts;
}
function InternshipPostsExpiredToLast($posts)
{
    $revised_posts = new \Illuminate\Database\Eloquent\Collection;

    foreach($posts as $post)
    {
        if($post->application_date>= date('Y-m-d')  || $post->application_date=='' )
            $revised_posts->add($post);
    }

    foreach($posts as $post)
    {
        if($post->application_date< date('Y-m-d') && $post->end_date!=null )
            $revised_posts->add($post);
    }
    return $revised_posts;
}
function ShortenText($text,$len)
{
// Change to the number of characters you want to display
    $chars = $len;
    $text = $text." ";
    if(strlen($text)>$len)
    {
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
    }
    return $text;
}

function getBrandName($id)
{
    return(Brand::where('id', $id)->pluck('name'));
}
function getUserName($id)
{
    return(User::selectRaw('CONCAT(first_name, " ", last_name) as FullName')->where('id', $id)->pluck('FullName'));
 }
function getInstitutionName($id)
{
    return(Institution::where('id', $id)->pluck('name'));
}
function getBrandFollowCount($id)
{
    return (BrandsFollows::where('brand_id', $id)->count());
}
function getInstitutionFollowCount($id)
{
    return (InstitutionsFollows::where('institution_id', $id)->count());
}
function getPostName($id)
{
    return(Post::where('id', $id)->pluck('name'));
}
function getPostPositions($id)
{
    return(Post::where('id', $id)->pluck('positions'));
}
function getPostLocation($id)
{
    $post=Post::findOrFail($id);
    //return(getCity($post->city).', '.getState($post->state));
    return(getCity($post->city));
}
function getPostSlug($id)
{
    return(Post::where('id', $id)->pluck('slug'));
}
function getPostBrandSlug($id)
{
    return(getBrandSlug(Post::where('id', $id)->pluck('brand_id')));
}
function getPostBrandName($id)
{
    return(getBrandName(Post::where('id', $id)->pluck('brand_id')));
}
function getCity($id)
{
    return(City::where('id', $id)->pluck('name'));
}
function getState($id)
{
    return(State::where('id', $id)->pluck('name'));

}
function IsUserFollowBrand($brand_id)
{
    if(Sentry::check()) {
        $brand_ids = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');

        if (in_array($brand_id, $brand_ids))
            return 1;
        else
            return 0;
    }
     return 0;
}

function IsUserApplied($post_id)
{
    return Internship::where('user_id', Sentry::getUser()->id)->where('post_id',$post_id)->first();
}
function IsUserFollowInstitution($institution_id)
{
    if(Sentry::check()) {
    $institution_ids = DB::table('institutions_follows')->where('user_id',Sentry::getUser()->id )->lists('institution_id');

    if(in_array($institution_id, $institution_ids))
        return 1;
    else
        return 0;
    }
    else
    {
        return 0;
    }
}

function gettotalcount($type)
{
    return (DB::table('posts')->where('type',$type)->count());
}

function gettotalposts()
{
  $mybrands = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');

   $myinstitutions= InstitutionsFollows::where('user_id', Sentry::getUser()->id)->lists('institution_id');

  $brands_posts = Post::where('status',1)->where('featured',0)
          ->where(function($query) use ($mybrands)
          {
              $query->whereIn('brand_id', $mybrands);
          })
          ->orWhere(function($query) use ($myinstitutions)
          {
              $query->whereIn('institution_id', $myinstitutions);
          })
          ->orderBy('updated_at','desc')->get()->count();

  return $brands_posts;
}

function getStudentColor()
{
    $color=(StudentDetails::where('user_id', Sentry::getUser()->id )->pluck('color'));
    if($color=='' ||  is_null($color))
        $color='#00a9ea';
    return $color;
}


function getbrandposts($id)
{
    // $user = Sentry::getUser()->id; //echo "<pre>";print_r($user);exit();

    $brand_detail = Brand::where('id', $id)->first(); //echo "<pre>";print_r($user);exit();

    return Post::where('brand_id','=',$brand_detail->id)->orderBy('created_at','desc')->get()->count();
}
function getinstitutionposts($id)
{
    $institution_detail = Institution::where('id', $id)->first(); //echo "<pre>";print_r($user);exit();

    return Post::where('institution_id','=',$institution_detail->id)->orderBy('created_at','desc')->get()->count();
}
function couponAvailed($post_id,$user_id)
{
    return UserCoupon::where('post_id',$post_id)->where('user_id',$user_id)->orderBy('updated_at','desc')->first()->pluck('code');//->where('updated_at','',)->pluck('code');

}
function PostLikesOfBrand($brand_id,$date)
{
    return Post::join('posts_likes', 'posts_likes.post_id', '=', 'posts.id')->where('posts.brand_id',$brand_id)->where('posts_likes.created_at','>',$date)
        ->groupBy('posts.id')->get([DB::raw('count(posts_likes.id) as likes')])->count();
}
function PostVisitsOfBrand($brand_id,$date)
{
    return Post::join('posts_visits', 'posts_visits.post_id', '=', 'posts.id')->where('posts.brand_id',$brand_id)->where('posts_visits.created_at','>',$date)
        ->groupBy('posts.id')->get([DB::raw('count(posts_visits.id) as visits')])->count();
}
function PostLikesOfInstitution($institution_id,$date)
{
    return Post::join('posts_likes', 'posts_likes.post_id', '=', 'posts.id')->where('posts.institution_id',$institution_id)->where('posts_likes.created_at','>',$date)
        ->groupBy('posts.id')->get([DB::raw('count(posts_likes.id) as likes')])->count();
}
function PostVisitsOfInstitution($institution_id,$date)
{
    return Post::join('posts_visits', 'posts_visits.post_id', '=', 'posts.id')->where('posts.institution_id',$institution_id)->where('posts_visits.created_at','>',$date)
        ->groupBy('posts.id')->get([DB::raw('count(posts_visits.id) as visits')])->count();
}
function OutletsCount($brand_id)
{
    return(number_format(Outlet::where('brand_id',$brand_id)->count()));
}

function CouponCreateOrUpdate($data, $keys) {
    $record = Coupon::where($keys)->first();
    if (is_null($record)) {
        return Coupon::create($data);
    } else {
        return Coupon::where($keys)->update($data);
    }


}

function gettotalfollowers($slug)
{
    $brand      = Brand::where('slug', $slug)->first();

    $follow_ids = DB::table('brands_follows')->where('brand',$slug)->lists('user_id');

    $followers  = User::whereIn('id', $follow_ids)->get();

    return count($followers);
}
function dateformat($date)
{
   return date("d-m-Y", strtotime($date));
}
function dateformat2($date)
{
    return date("d M, Y", strtotime($date));
}
function getInternshipAppliedCount($post_id)
{
   return Internship::where('post_id', $post_id)->count();

}
function getFirstWord($string)
{
    return  current(explode(' ',$string));
}
function getInternshipCountByStatus($id,$status)
{
    return Internship::where('post_id', $id)->where('status', $status)->count();
}
function getUserInstitute($id)
{
    if($id!='')
    return getInstitutionName(StudentDetails::where('user_id', $id)->pluck('institution_id'));
    else 
    return '';
}
function getPostType($id){
    $type = Post::select('type')->where('id', $id)->pluck('type');
    if($type == 'job')
        return 'Fresher job';
    else
        return $type;
}

function getMonths($s_date, $e_data){
    $ts1 = strtotime($s_date);
    $ts2 = strtotime($e_data);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $mon = (($year2 - $year1) * 12) + ($month2 - $month1);
    
    if($mon > 1)
        return $mon . ' Months';
    else
        return $mon . ' Month';
}

function getBrandDescription($id){
    return (Brand::where('id', $id)->pluck('description'));
}

function gerNextPrevPost($id){
    return array(
        'prev' => Post::select('brand_id', 'slug')->where('id', '<', $id)->where('type', 'internship')->where('status', 1)->orWhere('type', 'job')->orWhere('type', 'ambassador')->orderBy('id', 'ASC')->limit(1)->get(),
        'next' => Post::select('brand_id', 'slug')->where('id', '>', $id)->where('type', 'internship')->where('status', 1)->orWhere('type', 'job')->orWhere('type', 'ambassador')->orderBy('id', 'ASC')->limit(1)->get(),
    );
}