<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
    $end = microtime(true) * 1000;
    $ip = $request->ip();

    if (array_key_exists("HTTP_CF_CONNECTING_IP", $_SERVER)) {
        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $record = [
        'uri' => $request->url(),
        'request' => json_encode($request->all()),
        //'response' => $response->getContent(),
        'code' => $response->getStatusCode(),
        'ip' => $ip,
        'took_ms' => $end - (LARAVEL_START * 1000),
        'created_at' => date("Y-m-d H:i:s")
    ];
    \DB::table('request_logs')->insert($record);
});
 
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

/* Authentication Filter for Every User */

Route::filter('auth',  function()
{	 
	if (!Sentry::check()) 
	{
	  	if (Auth::guest()) {
	        // Stores current url on session and redirect to login page
	        Session::put('redirect', URL::full());
	        return Redirect::to('/login');
    	}

	    if ($redirect = Session::get('redirect')) {
	        Session::forget('redirect');
	        return Redirect::to($redirect);
	    }
	}	
});

/* Authentication Filter for Admin User */

Route::filter('admin', function()
{
	$user 	= Sentry::getUser();
	
    $admin 	= Sentry::findGroupByName('Admins');

    if (!$user->inGroup($admin))
    {

    	return Redirect::to('/admin');
    }
	
});

/* Authentication Filter for Student User  */
Route::filter('studentUser', function()
{
	// return "hi2";
	$user 	= Sentry::getUser(); 
	
    $users 	= Sentry::findGroupByName('Students');

    //echo"hi";print_r($user);exit();

    if (!$user->inGroup($users))
    {
    	return Redirect::to('/');
    }

});

/* Authentication Filter for Brand User  */
Route::filter('brandUser', function()
{
	$user 	= Sentry::getUser();
	
    $users 	= Sentry::findGroupByName('Brands');

    if (!$user->inGroup($users))
    {
    	return Redirect::to('/');
    }
});

/* Authentication Filter for Institution User  */
Route::filter('institutionUser', function()
{
	$user 	= Sentry::getUser();
	
    $users 	= Sentry::findGroupByName('Institutions');

    if (!$user->inGroup($users))
    {
    	return Redirect::to('/');
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

/* Guest User Authentication filter */

Route::filter('guest', function()
{
	
	if (Sentry::check())
	{
		
		$user 			= Sentry::getUser();
		
	    $admin 			= Sentry::findGroupByName('Admins');
	    
		$students 		= Sentry::findGroupByName('Students');
		
		$brands 		= Sentry::findGroupByName('Brands');
		
		$institutions 	= Sentry::findGroupByName('Institutions');

	    if ($user->inGroup($admin)) return Redirect::intended('admin');
	    elseif ($user->inGroup($students)) return Redirect::intended('/');
		elseif ($user->inGroup($brands)) 
		{
		$brand = $this->brand->find($user->brand_id);  
			return Redirect::route('brand_profile', array($brand->slug));
		}
		elseif ($user->inGroup($institutions))   {
            $institution = Institution::find($user->institution_id); 
            return Redirect::route('institution_profile', array($institution->slug));
        };
		
	}
	
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

/*Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});*/

Route::filter('csrf', function()
{
    if (Request::ajax())
    {
        if (Session::token() !== Request::header('csrftoken'))
        {
            // Change this to return something your JavaScript can read...
            throw new Illuminate\Session\TokenMismatchException;
        }
    }
    elseif (Session::token() !== Input::get('_token'))
    {

        throw new Illuminate\Session\TokenMismatchException;
    }

});
