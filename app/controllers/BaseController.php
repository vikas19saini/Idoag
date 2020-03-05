<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);

		}

        $post_sizes = array('FSW' => 'Full Size Widget', 'M' => 'Medium', 'S' => 'Small');
        $local_brands=array('India'=>'All India', 'Local'=>'All Colleges in City', 'College'=>'Specific College');
        $internship_types=array('parttime'=>'Part-Time', 'fulltime'=>'Full-Time', 'virtual'=>'Virtual');
        $resume_preferences=array('Document Resume'=>'Document Resume', 'Video Resume'=>'Video Resume','Any'=>'Any');
        $offer_problems=array('No Coupon generated'=>'No Coupon generated', 'Coupon expired'=>'Coupon expired', 'Coupon not working'=>'Coupon not working','Internet problem'=>'Internet problem','Store did not entertain discount'=>'Store did not entertain discount','Other'=>'Other');
        $internship_status = array('0' => 'In Process', '1' => 'Approved', '2' => 'On Hold', '3' => 'Rejected');
        $internship_status_class = array('0' => 'inprogress', '1' => 'approved', '2' => 'onhold', '3' => 'rejected');
        $states= State::where('country_id','=','101')->lists('name', 'id');
        $states=  array(4121=>'Anywhere')+$states;
        View::share('post_sizes', $post_sizes);
        View::share('resume_preferences', $resume_preferences);
        View::share('local_brands', $local_brands);
        View::share('states', $states);
        View::share('offer_problems', $offer_problems);
        View::share('internship_status', $internship_status);
        View::share('internship_status_class', $internship_status_class);
        View::share('internship_types', $internship_types);

        $ad_image=Ad::where('status',1)->first();

        View::share('ad_image', $ad_image);

        if(Sentry::check())
        {
            // Fetch the User object
            $loggedin_user 	= Sentry::getUser();

            $user_group 	= $loggedin_user->getGroups()->first()->name;

            // Sharing is caring
            View::share('loggedin_user', $loggedin_user);

            View::share('user_group', $user_group);

            $settings = Setting::find(1);

            View::share('settings', $settings);

            if($user_group == 'Brands') {

                $internship_list =Post::where('brand_id',Sentry::getUser()->brand_id)->where('type','internship')->lists('id');

                $applied_internships_count = Activity::whereIn('post_id', $internship_list)->where('type','internship')->where('visit_status',0)->count();
                View::share('brand_received_internships', $applied_internships_count);
            }


            if($user_group == 'Students') {
            // $brands = Brand::select('name', 'slug')->get(); echo "<pre>";dd($brands);
            // $brand_ids = BrandsFollows::select('id','brand_id', DB::raw('count(id) as total'))->groupBy('brand_id')->orderBy('total','desc')->limit(10)->lists('brand_id'); //echo "<pre>";print_r($brand_ids);
            // $brands = Brand::whereIn('id',$brand_ids)->select('name', 'slug')->orderBy()->get();

             $brands_with_internships=Post::whereIn('type', array('internship', 'job', 'ambassador'))->where('status', '1')->lists('brand_id');
             $brands = BrandsFollows::join('brands','brands.id', '=', 'brands_follows.brand_id')->select('brands.id','brands.slug','brands.name', DB::raw('count(brands_follows.id) as total'))->groupBy('brands_follows.brand_id')->orderBy('total','desc')->limit(10)->get();
             $brands2 = BrandsFollows::join('brands','brands.id', '=', 'brands_follows.brand_id')->whereIn('brands_follows.brand_id', $brands_with_internships)->select('brands.id','brands.slug','brands.name', DB::raw('count(brands_follows.id) as total'))->groupBy('brands_follows.brand_id')->orderBy('total','desc')->limit(10)->get();
             $categories = Category::select('name', 'slug')->get();
            $int_categories = InternshipCategory::select('name', 'slug')->get();
            $brand_ids = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');
            $user_activity=Activity::where('type', 'internship_status')->where('visit_status', '0')->where('user_id', Sentry::getUser()->id)->count();

            $mybrands = Brand::select('image', 'slug', 'name','id')->whereIn('id', $brand_ids)->orderBy('id','desc')->get();

                $mybrands_nav = DB::table('brands')
                        ->select('image', 'slug', 'name','id',DB::raw('(SELECT  count(*)  FROM    brands_follows  WHERE   brands_follows.brand_id = brands.id) AS followCount'))
                        ->whereIn('id',$brand_ids)
                        ->orderBy('followCount','desc')->take(20)->get();

                $mybrands_nav2 = DB::table('brands')
                    ->select('image', 'slug', 'name','id',DB::raw('(SELECT  count(*)  FROM    brands_follows  WHERE   brands_follows.brand_id = brands.id) AS followCount'))
                    ->whereIn('id',$brands_with_internships)
                    ->orderBy('followCount','desc')->take(20)->get();
             View::share('brands_nav', $brands);
            View::share('internship_brands_nav', $brands2);
            View::share('categories_nav', $categories);
            View::share('int_categories_nav', $int_categories);
            View::share('mybrands_nav', $mybrands_nav);
            View::share('mybrands_nav2', $mybrands_nav2);
            View::share('user_activity', $user_activity);
        }
        }
        else
        {
            return Redirect::route('home');
        }
	}
}
