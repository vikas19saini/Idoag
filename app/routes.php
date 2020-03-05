<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* This script will write all query transactions to laravel log file */

Event::listen('illuminate.query', function($sql, $bindings)
{
	
    foreach ($bindings as $val) 
	{
        $sql = preg_replace('/\?/', "'{$val}'", $sql, 1);
    }

    Log::info($sql);
	
}); 

#Landing Page Route
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);


#Login Page Route
Route::get('/login', ['as' => 'login', 'uses' => 'SessionsController@create']);

Route::get('/lostcard', ['as' => 'lostcard', 'uses' => 'StudentUserController@lostcard']);

Route::get('/applycard', ['as' => 'applycard', 'uses' => 'StudentUserController@applycard']);

#Offers Page Route
Route::get('/offers', ['as' => 'offers', 'uses' => 'MainOffersController@index']);

#Institutions Page Route
Route::get('/institutions', ['as' => 'institutions', 'uses' => 'InstitutionsController@institutionsList']);

#Brands Page Route
Route::get('/brands', ['as' => 'brands', 'uses' => 'MainBrandsController@index']);

#internships Page Route
Route::get('/internships', ['as' => 'internships', 'uses' => 'MainInternshipsController@index']);

#Faq's Page Route
Route::get('/faq', ['as' => 'faq', 'uses' => 'PagesController@getFaq']);

#Blog Page Route
Route::get('/blog', ['as' => 'blog', 'uses' => 'PagesController@getBlog']);

#Sitemap Page Route
Route::get('/sitemap', ['as' => 'sitemap', 'uses' => 'PagesController@getSitemap']);

#Contact us Page Route
Route::get('/contactus', ['as' => 'contactus', 'uses' => 'PagesController@getContactus']);

// route to process reset password page
Route::post('/contactus', ['as' => 'contactus', 'uses' => 'PagesController@postEnquiry']);
Route::post('/needhelp', ['as' => 'needhelp', 'uses' => 'PagesController@postHelpRequest']);

#TOS Page Route
Route::get('/terms-of-service', ['as' => 'tos', 'uses' => 'PagesController@getTermsOfService']);

#About Us Page Route
Route::get('/about', ['as' => 'about', 'uses' => 'PagesController@getAbout']);

#Services Page Route
Route::get('/services', ['as' => 'services', 'uses' => 'PagesController@getServices']);

#Offline Activation Page Route
Route::get('/offline-activation', ['as' => 'offline-activation', 'uses' => 'PagesController@getOfflineActivation']);

#Offline Activation Page Route
Route::get('/privacy-policy', ['as' => 'privacy-policy', 'uses' => 'PagesController@getPrivacyPolicy']);

#Support Page Route
Route::get('/support', ['as' => 'support', 'uses' => 'PagesController@getSupport']);

//brand Register page
Route::get('/brand-register', ['as' => 'brand-register', 'uses' => 'BrandsController@getBrandRegister']);

//student Register page
Route::get('/student-register', ['as' => 'student-register', 'uses' => 'StudentUserController@getStudentRegister']);

//Institution Register page
Route::get('/inst-register', ['as' => 'inst-register', 'uses' => 'InstitutionsController@getInstRegister']);

#Email Confirmation Page Route
Route::get('email-confirmation/{token}', ['as'=> 'email-confirmation', 'uses' => 'SessionsController@getVerified']);

#Email Confirmation Page Route
Route::get('email-change/{token}', ['as'=> 'email-change', 'uses' => 'SessionsController@getVerifiedEmail']);

# Authentication Page Routes for brand user 
Route::group(['prefix' => 'brands'], function()
{
	
	// route to list brand user profile page
	Route::get('/{slug}', ['as' => 'brand_profile', 'uses' => 'BrandsController@index']);

	Route::get('/{slug}/demo', ['as' => 'brand_demo', 'uses' => 'BrandsController@demo']);
	
});

Route::group(['prefix' => 'institutions'], function()
{

    // route to list brand user profile page
    Route::get('/{slug}', ['as' => 'institution_profile', 'uses' => 'InstitutionsController@index']);

});


	#Brands with Specific Category Page Route
	Route::get('/brands/category/{slug}', ['as' => 'brand_category', 'uses' => 'MainBrandsController@brandCategory']);

	Route::get('local-brands',['as' => 'local_brands', 'uses' => 'MainBrandsController@getLocalBrands']);
	
	Route::get('brands-near-you',['as' => 'near_brands', 'uses' => 'MainBrandsController@getNearBrands']);

	#Brands student follow
	Route::post('userBrandFollows', ['as' => 'userBrandFollows', 'uses' => 'MainBrandsController@userBrandFollows']);
	 	
	#Brands student follow
	Route::post('userInstitutionFollows', ['as' => 'userInstitutionFollows', 'uses' => 'InstitutionsController@userInstitutionFollows']);

	#Brands student follow
	Route::post('getLikes', ['as' => 'getLikes', 'uses' => 'MainOffersController@getLikes']);

        #Brands post status change
        Route::post('changePostStatus', ['as' => 'changePostStatus', 'uses' => 'PostsController@changePostStatus']);

	#Offer Details Page Route
	Route::get('/offers/category/{slug}', ['as' => 'offer_category', 'uses' => 'MainOffersController@OfferCategory']);

	Route::get('trending-offers',['as' => 'trending_offers', 'uses' => 'MainOffersController@getTrendingOffers']);
	
	Route::get('mybrands-offers',['as' => 'mybrands_offers', 'uses' => 'MainOffersController@getMyBrandsOffers']);

	Route::get('trending-internships',['as' => 'trending_internships', 'uses' => 'MainInternshipsController@getTrendingInternships']);
	
	Route::get('mybrands-internships',['as' => 'mybrands_internships', 'uses' => 'MainInternshipsController@getMyBrandsInternships']);

	Route::get('/brands/{slug}/brand-info', ['as' => 'brand_info', 'uses' => 'BrandsController@getBrandInfo']);
	
	Route::get('/brands/{slug}/brand-statistics', ['as' => 'brand_statistics', 'uses' => 'BrandsController@getBrandStatistics']);
	
	Route::get('/brands/{slug}/brand-feedback', ['as' => 'brand_feedback', 'uses' => 'BrandsController@getBrandFeedback']);

	#Brands student follow
	Route::post('getIntLikes', ['as' => 'getIntLikes', 'uses' => 'MainInternshipsController@getIntLikes']);

	#Offers Page Route
	Route::get('/internships/category/{slug}', ['as' => 'internship_category', 'uses' => 'MainInternshipsController@InternshipCategory']);

	Route::get('/brands/{slug}/text', ['as' => 'get_text', 'uses' => 'LinksController@getLinks']);
    
        Route::get('/brands/{slug}/photos', ['as' => 'get_photos', 'uses' => 'PhotosController@getPhotos']);
    
        Route::get('/brands/{slug}/events', ['as' => 'get_events', 'uses' => 'EventsController@getEvents']);
    
        Route::get('/brands/{slug}/internships', ['as' => 'get_internships', 'uses' => 'InternshipsController@getInternships']);
    
        Route::get('/brands/{slug}/offers', ['as' => 'get_offers', 'uses' => 'OffersController@getOffers']);
    
        Route::get('/brands/{slug}/feedback', ['as' => 'get_feedback', 'uses' => 'FeedbackController@getFeedback']);
    
        Route::get('/brands/{slug}/followers', ['as' => 'brand_followers', 'uses' => 'BrandsController@followers']);
	
	Route::get('/brands/{slug}/outlets', ['as' => 'get_outlets', 'uses' => 'OutletsController@getOutlets']);

	Route::get('/institutions/{slug}/followers', ['as' => 'institution_followers', 'uses' => 'InstitutionsController@followers']);

	Route::get('/institutions/{slug}/photos', ['as' => 'get_inst_photos', 'uses' => 'InstPhotosController@getPhotos']);
	
	Route::get('/institutions/{slug}/events', ['as' => 'get_inst_events', 'uses' => 'InstEventsController@getEvents']);
	
	Route::get('/institutions/{slug}/text', ['as' => 'get_inst_links', 'uses' => 'InstLinksController@getLinks']);
	
	Route::get('/institutions/{slug}/feedback', ['as' => 'get_inst_feedback', 'uses' => 'FeedbackController@getInstFeedback']);
	
	Route::get('/institutions/{slug}/followers', ['as' => 'institution_followers', 'uses' => 'InstitutionsController@followers']);
	
	Route::get('/institutions/{slug}/members', ['as' => 'get_members', 'uses' => 'InstitutionsController@getMembers']);

        Route::get('/institutions/{slug}/institution-info', ['as' => 'institution_info', 'uses' => 'InstitutionsController@getInstInfo']);

        Route::get('/institutions/{slug}/inst-statistics', ['as' => 'inst_statistics', 'uses' => 'InstitutionsController@getInstStatistics']);

        Route::get('/institutions/{slug}/inst-feedback', ['as' => 'instfeedback', 'uses' => 'InstitutionsController@getInstFeedback']);

	// route to start registration page
	Route::get('/register', ['as' => 'registration.create', 'uses' => 'RegistrationController@create']);
	
	// route to process registration page
	Route::post('/register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);

	Route::post('brandRegister',array('uses'=>'BrandsController@postBrandRegister'));

	Route::post('instRegister',array('uses'=>'InstitutionsController@postInstRegister'));

	Route::post('searchOffer',array('uses'=>'SearchController@searchOffer'));

	Route::post('searchFaq',array('uses'=>'SearchController@searchFaq'));

	Route::post('searchInternship',array('uses'=>'SearchController@searchInternship'));

        Route::post('/brands/{slug}/internships/appliedfilter',array('as'=>'filterInternship','uses'=>'InternshipsController@filterInternship'));


	Route::post('searchBrand',array('uses'=>'SearchController@searchBrand'));

	Route::post('searchInstitution',array('uses'=>'SearchController@searchInstitution'));

	Route::post('searchOutlet',array('uses'=>'SearchController@searchOutlet'));

	Route::post('getmoreOffers',array('uses'=>'MainOffersController@getmoreOffers'));

	Route::post('getmoreInternships',array('uses'=>'MainInternshipsController@getmoreInternships'));

	Route::post('getBrandPosts',array('uses'=>'BrandsController@getBrandPosts'));

	Route::post('getInstitutionPosts',array('uses'=>'InstitutionsController@getInstitutionPosts'));

	Route::post('getInstPosts',array('uses'=>'InstitutionsController@getInstPosts'));

	Route::post('getPopular',array('uses'=>'MainOffersController@getPopular'));

	Route::post('getPopularInternships',array('uses'=>'MainInternshipsController@getPopular'));

	Route::post('about_institute',array('uses'=>'StudentUserController@aboutInstitute'));

	Route::get('/press/{slug}', ['as' => 'press_details', 'uses' => 'AdminSliderPressController@pressDetailPage']);

	Route::get('/press', ['as' => 'press_list', 'uses' => 'AdminSliderPressController@pressList']);

	Route::post('cardActivationIssue', ['as' => 'cardActivationIssue', 'uses' => 'PagesController@cardActivationIssue']);

	Route::post('reportProblemIssue', ['as' => 'reportProblemIssue', 'uses' => 'OffersController@reportProblemIssue']);

	Route::post('cardNumberExists', ['as' => 'cardNumberExists', 'uses' => 'PagesController@cardNumberExists']);
	Route::post('validateCardAndUserType', ['as' => 'validateCardAndUserType', 'uses' => 'PagesController@validateCardAndUserType']);

        Route::post('cardRecoverIssue', ['as' => 'cardRecoverIssue', 'uses' => 'StudentUserController@cardRecoverIssue']);

# Logout Page Route
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);

# Forgot Password Page Routes  
Route::group(['before' => 'guest'], function()
{
	// route to start forgot password page
	//Route::get('resend-confirmation',['as' => 'resend_confirmation', 'uses' => 'RemindersController@getResendConfirmation']);
	
	// route to start forgot password page
	//Route::post('resend-confirmation',['as' => 'post_resend_confirmation', 'uses' => 'RemindersController@postResendConfirmation']);
	
	// route to start forgot password page
	Route::get('forgot_password',['as' => 'forgot_password', 'uses' => 'RemindersController@getRemind']);
	
	// route to process forgot password page
	Route::post('forgot_password', ['as' => 'post_forgot_password' ,'uses' => 'RemindersController@postRemind']);
	
	// route to start reset password page
	Route::get('reset_password/{token}', 'RemindersController@getReset');
	
	// route to process reset password page
	Route::post('reset_password/{token}', 'RemindersController@postReset');
	
});

# Trouble Login Page Routes  
Route::group(['before' => 'guest'], function()
{
        // route to start trouble logging in page
        Route::get('trouble_login',['as' => 'trouble_login', 'uses' => 'RemindersController@getLogin']);

        // route to start trouble logging in page
        Route::get('trouble_email',['as' => 'trouble_email', 'uses' => 'RemindersController@getEmail']);

        // route to process trouble logging in page
        Route::post('trouble_login', ['as' => 'post_trouble_login' ,'uses' => 'RemindersController@postLogin']);
});

# Authentication Page Routes
Route::group(['before' => 'guest'], function()
{

	Route::get('resend-confirmation',['as' => 'resend_confirmation', 'uses' => 'PagesController@index']);
	// route to show login page
	Route::get('/sessions', ['as' => 'sessions.create', 'uses' => 'SessionsController@create']);
	
	// route to start facebook login
	Route::get('/facebook', array('uses' => 'SessionsController@loginWithFacebook'));
	
	// route to start google login
	Route::get('/google', array('uses' => 'SessionsController@loginWithGoogle'));

	// route to start reset password page
	Route::get('new_password/{token}', 'SessionsController@getNewPassword');

	// route to process reset password page
	Route::post('new_password/{token}', 'SessionsController@postNewPassword');	
	
});

Route::group(['before' => 'guest|csrf'], function()
{
	// route to process login page
	Route::post('/sessions', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);
	
	//route to process facebook login
	Route::post('/facebook/', array('uses' => 'SessionsController@loginWithFacebook'));
	
	// route to process google login
	Route::post('/google', array('uses' => 'SessionsController@loginWithGoogle'));
	
	// route to process google login
	Route::post('/student_activate',  array('as'=>'student_activate','uses' => 'StudentUserController@activateStudent'));

        // route to start trouble logging in page
        Route::post('/student_card_check',  array('as'=>'student_card_check','uses' => 'StudentUserController@checkStudentWithCard'));
		
	Route::post('/students', ['as' => 'student_store', 'uses' => 'StudentUserController@store']);	

});

# Authentication Page Routes for student user 

Route::group(['before' => 'guest'], function()
{
	Route::get('/student', ['as' => 'student_profile', 'uses' => 'StudentUserController@show']);
	
});

# Authentication Page Routes for institutions user
Route::group(['before' => 'auth|institutionUser', 'prefix' => 'institutions'], function()
{
	// route to list institutions user dashboard

});

# Authentication Page Routes for brand user
Route::group(['before' => 'auth|brandUser'], function()
{
	// resource route to brand users
    Route::resource('brands', 'BrandsController', ['only' => ['edit']]);
    
    Route::get('/brands/{slug}/edit', ['as' => 'brand_edit_profile', 'uses' => 'BrandsController@edit']);
	
	Route::get('/brands/{slug}/passwordChange', ['as' => 'passwordChange', 'uses' => 'BrandsController@getpasswordChange']);
	
	Route::post('/brands/{slug}/passwordChange', ['as' => 'passwordChange', 'uses' => 'BrandsController@postpasswordChange']);

	//resource route to brand offers
	Route::get('/brands/{slug}/offers/create', ['as' => 'create_offers', 'uses' => 'OffersController@createOffers']);

    Route::get('/brands/{slug1}/offers/{slug2}/edit', ['as' => 'update_offers', 'uses' => 'OffersController@edit']);

	//resource route to brand internships
	Route::get('/brands/{slug}/internships/create', ['as' => 'create_internships', 'uses' => 'InternshipsController@createInternships']);
    
    Route::get('/brands/{slug1}/internships/{slug2}/edit', ['as' => 'update_internships', 'uses' => 'InternshipsController@edit']);

    Route::get('/brands/{slug}/internships/applied', ['as' => 'internships_applied', 'uses' => 'InternshipsController@appliedInternships']);

//    Route::get('/brands/{slug}/internships/applied/{id}/edit', ['as' => 'student_internship_edit', 'uses' => 'InternshipsController@editStudentInternship']);

    Route::get('/brands/{slug}/internship/{slug2}/applied', ['as' => 'internships_applied_post', 'uses' => 'InternshipsController@appliedInternshipsByPost']);

    Route::get('change_post_status/{id}', ['as' => 'change_post_status', 'uses' => 'InternshipsController@changeStatus']);

    Route::post('applied_internships_actions', array('as' => 'applied_internships_actions', 'uses' => 'InternshipsController@postAppliedInternshipsActions'));

    Route::resource('internships', 'InternshipsController', ['only' => ['create','store','update','destroy']]);

	//resource route to brand events
	Route::get('/brands/{slug}/events/create', ['as' => 'create_events', 'uses' => 'EventsController@createEvents']);
    
    Route::get('/brands/{slug1}/events/{slug2}/edit', ['as' => 'update_events', 'uses' => 'EventsController@edit']);

	Route::resource('events', 'EventsController', ['only' => ['create','store','update','destroy']]);

	//resource route to brand links
    Route::get('/brands/{slug}/text/create', ['as' => 'create_text', 'uses' => 'LinksController@createLinks']);
     
    Route::get('/brands/{slug1}/text/{slug2}/edit', ['as' => 'update_text', 'uses' => 'LinksController@edit']);

	//resource route to brand photos
    Route::get('/brands/{slug}/photos/create', ['as' => 'create_photos', 'uses' => 'PhotosController@createLinks']);
    
    Route::get('/brands/{slug}/photos/{id}/edit', ['as' => 'update_photos', 'uses' => 'PhotosController@edit']);

    //resource route to brand outlets
    Route::get('/brands/{slug}/outlets/create', ['as' => 'create_outlet', 'uses' => 'OutletsController@createOutlet']);
    
    Route::get('/brands/{slug}/outlets/{id}/edit', ['as' => 'update_outlet', 'uses' => 'OutletsController@edit']);

    Route::get('feedback_delete/{id}', array('as' => 'feedback_delete', 'uses' => 'FeedbackController@deleteFeedback'));


    // route to import sample excel for outlets upload
	Route::get('outlets-export', ['as' => 'sample_outlets', 'uses' => 'OutletsController@getOutletExport']);

});

Route::group(['before' => 'auth|institutionUser'], function()
{

    Route::resource('inst_posts', 'InstPostsController', ['only' => ['store','update','destroy']]);

    Route::resource('institutions', 'InstitutionsController', ['only' => ['update','destroy']]);

    Route::get('/institutions/{slug}/passwordChange', ['as' => 'InstPasswordChange', 'uses' => 'InstitutionsController@getpasswordChange']);
   
    Route::post('/institutions/{slug}/passwordChange', ['as' => 'InstPasswordChange', 'uses' => 'InstitutionsController@postpasswordChange']);

    // resource route to brand users
    Route::resource('institutions', 'InstitutionsController', ['only' => ['edit']]);
   
    Route::get('/institutions/{slug}/edit', ['as' => 'institution_edit_profile', 'uses' => 'InstitutionsController@edit']);


    //resource route to brand offers
    Route::get('/institutions/{slug}/offers/create', ['as' => 'create_inst_offers', 'uses' => 'InstOffersController@createOffers']);

    Route::get('/institutions/{slug1}/offers/{slug2}/edit', ['as' => 'update_inst_offers', 'uses' => 'InstOffersController@edit']);


    Route::resource('inst_offers', 'InstOffersController', ['only' => ['create','store','update','destroy']]);
    //resource route to brand internships
    Route::get('/institutions/{slug}/internships/create', ['as' => 'create_inst_internships', 'uses' => 'InstInternshipsController@createInternships']);
    
    Route::get('/institutions/{slug1}/internships/{slug2}/edit', ['as' => 'update_inst_internships', 'uses' => 'InstInternshipsController@edit']);

    Route::resource('inst_internships', 'InstInternshipsController', ['only' => ['create','store','update','destroy']]);

    //resource route to brand events
    Route::get('/institutions/{slug}/events/create', ['as' => 'create_inst_events', 'uses' => 'InstEventsController@createEvents']);
    Route::get('/institutions/{slug1}/events/{slug2}/edit', ['as' => 'update_inst_events', 'uses' => 'InstEventsController@edit']);

    Route::resource('inst_events', 'InstEventsController', ['only' => ['create','store','update','destroy']]);

    //resource route to brand photos
    Route::get('/institutions/{slug}/photos/create', ['as' => 'create_inst_photos', 'uses' => 'InstPhotosController@createPhotos']);
    Route::get('/institutions/{slug}/photos/{id}/edit', ['as' => 'update_inst_photos', 'uses' => 'InstPhotosController@edit']);

    Route::resource('inst_photos', 'InstPhotosController', ['only' => ['create','store','update','destroy']]);

    Route::get('/institutions/{slug}/text/create', ['as' => 'create_inst_text', 'uses' => 'InstLinksController@createText']);
    Route::get('/institutions/{slug}/text/{id}/edit', ['as' => 'update_inst_text', 'uses' => 'InstLinksController@edit']);

    Route::resource('inst_links', 'InstLinksController', ['only' => ['create','store','update','destroy']]);

});

Route::group(['before' => 'auth'], function() { 

    #Offer Details Page Route
	Route::get('/brands/{slug1}/offer/{slug2}', ['as' => 'offer_details', 'uses' => 'OffersController@getOfferDetails']);

	#Offer Details Page Route
	Route::get('/brands/{slug1}/internship/{slug2}', ['as' => 'internship_details', 'uses' => 'InternshipsController@getInternshipDetails']);

 	#Offer Details Page Route
	Route::get('/brands/{slug1}/photo/{slug2}', ['as' => 'photo_details', 'uses' => 'PhotosController@getPhotoDetails']);

	#Offer Details Page Route
	Route::get('/brands/{slug1}/text/{slug2}', ['as' => 'link_details', 'uses' => 'LinksController@getLinkDetails']);

	#Offer Details Page Route
	Route::get('/brands/{slug1}/event/{slug2}', ['as' => 'event_details', 'uses' => 'EventsController@getEventDetails']);

        Route::get('/brands/{slug}/internships/applied/{slug2}', ['as' => 'student_internship_view2', 'uses' => 'InternshipsController@ViewStudentInternship2']);
        Route::get('/brands/{slug}/internships/applied/{id}/{slug2}', ['as' => 'student_internship_view', 'uses' => 'InternshipsController@ViewStudentInternship']);


    #Offer Details Page Route
    Route::get('/institutions/{slug1}/offer/{slug2}', ['as' => 'inst_offer_details', 'uses' => 'InstOffersController@getOfferDetails']);

    #Offer Details Page Route
    Route::get('/institutions/{slug1}/internship/{slug2}', ['as' => 'inst_internship_details', 'uses' => 'InstInternshipsController@getInternshipDetails']);

    #Offer Details Page Route
    Route::get('/institutions/{slug1}/photo/{slug2}', ['as' => 'inst_photo_details', 'uses' => 'InstPhotosController@getPhotoDetails']);

    Route::get('/institutions/{slug1}/text/{slug2}', ['as' => 'inst_text_details', 'uses' => 'InstLinksController@getLinkDetails']);

    #Offer Details Page Route
    Route::get('/institutions/{slug1}/event/{slug2}', ['as' => 'inst_event_details', 'uses' => 'InstEventsController@getSingleEvent']);

    // route to import sample excel for Coupons upload
    Route::get('coupons-export', ['as' => 'sample_coupons', 'uses' => 'PostsController@getCouponExport']);

});


Route::group(['before' => 'auth|brandUser|csrf'], function()
{
    // resource route to brand users
    Route::resource('brands', 'BrandsController', ['only' => ['update','destroy']]);

    // resource route to Post
    Route::resource('posts', 'PostsController', ['only' => ['store','update','destroy']]);

    // resource route to Outlet
    Route::resource('outlets', 'OutletsController', ['only' => ['store','update','destroy']]);

    Route::resource('feedback', 'FeedbackController', ['only' => ['destroy']]);

    Route::resource('internships', 'InternshipsController', ['only' => ['destroy']]);


});

# Admin Routes
Route::group(['before' => 'auth|admin', 'prefix' => 'admin'], function()
{	
	// route to list admin user dashboard
	Route::get('/', ['as' => 'admin_dashboard', 'uses' => 'AdminController@getDashboard']);

	Route::post('testdata', array('as'=>'testdata','uses'=>'AdminStudentsController@testdata'));
	
	Route::post('demodata', array('as'=>'demodata','uses'=>'AdminStudentUsersController@demodata'));
	Route::post('getdeletedata', array('as'=>'getdeletedata','uses'=>'AdminStudentUsersController@getdeletedata'));

	
	// route to list of admin users to admin
	Route::get('users', ['as' => 'admin_users', 'uses' => 'AdminUsersController@index']);
	
	// route to list of brand users to admin
	Route::get('brandsusers', ['as' => 'admin_brands_users', 'uses' => 'AdminBrandUsersController@index']);
	
	// resource route to brand users
	Route::resource('brandsusers', 'AdminBrandUsersController', ['only' => ['create', 'show', 'edit']]);
	 
	// resource route to brand users
	Route::resource('institutions_users', 'AdminInstitutionUsersController', ['only' => ['create', 'show', 'edit']]);
	 
	// resource route to student users
	Route::resource('students_users', 'AdminStudentUsersController', ['only' => ['create', 'edit']]);

	// route to import export list of brand users as excel
	Route::get('brand-users-export', ['as' => 'admin_brand_users_export', 'uses' => 'AdminBrandUsersController@getBrandUsersExcelExport']);

	// route to import sample of brand excel
	Route::get('admin_brand_users_sample', array('as' => 'admin_brand_users_sample', 'uses' => 'AdminBrandUsersController@getBrandUsersSampleExcel'));
	
	// route to import sample of Institution excel
	Route::get('admin_inst_users_sample', array('as' => 'admin_inst_users_sample', 'uses' => 'AdminInstitutionUsersController@getInstUsersSampleExcel'));

	// route to import sample of Institution excel
	Route::get('admin_student_users_sample', array('as' => 'admin_student_users_sample', 'uses' => 'AdminStudentUsersController@getStudentUsersSampleExcel'));

	// route to import sample of Institution excel
	Route::get('admin_students_data_sample', array('as' => 'admin_students_data_sample', 'uses' => 'AdminStudentsController@getStudentUsersDataSampleExcel'));

	Route::get('admin_students_duplicate_data', array('as' => 'admin_students_duplicate_data', 'uses' => 'AdminStudentsController@getDuplicateData'));

	Route::get('admin_students_duplicate_delete/{id}', array('as' => 'admin_students_duplicate_delete', 'uses' => 'AdminStudentsController@deleteDuplicateData'));

	Route::get('admin_students_user_delete/{id}', array('as' => 'admin_students_user_delete', 'uses' => 'AdminStudentUsersController@deleteStudentData'));

	// route to import export list of institution users as excel
	Route::get('institution-users-export', ['as' => 'admin_institution_users_export', 'uses' => 'AdminInstitutionUsersController@getInstitutionUsersExcelExport']);
	
	// route to import export list of student users as excel
	Route::get('student-users-export', ['as' => 'admin_student_users_export', 'uses' => 'AdminStudentUsersController@getStudentUsersExcelExport']);
	
	// route to list of institutions users to admin
	Route::get('institutions_users', ['as' => 'admin_institutions_users', 'uses' => 'AdminInstitutionUsersController@index']);
	
	// route to list of students users to admin
	Route::get('students_users', ['as' => 'admin_students_users', 'uses' => 'AdminStudentUsersController@demo']);
    Route::get('delete_students_users', ['as' => 'admin_delete_students_users', 'uses' => 'AdminStudentUsersController@deleteStudent']);
	Route::get('students_users/{id}', ['as' => 'admin_inst_students_users', 'uses' => 'AdminStudentUsersController@InstStudents']);
    Route::get('get_student_users/{id}', ['as' => 'get_student_users', 'uses' => 'AdminStudentUsersController@getStudentUsers']);
    Route::post('activate_user', ['as' => 'activate_user', 'uses' => 'AdminController@ActivateUser']);
	//Route::post('filterStUserReport', ['as' => 'filterStUserReport', 'uses' => 'AdminStudentUsersController@filterStUserReport']);

	// Route::get('students_users_demo', ['as' => 'admin_students_users_demo', 'uses' => 'AdminStudentUsersController@demo']);
	
	// resource route to users
	Route::resource('profiles', 'AdminUsersController', ['only' => ['create', 'show', 'edit']]);
	 
	// route to import export list of users as excel
	Route::get('users-export', ['as' => 'admin_users_export', 'uses' => 'AdminUsersController@getUserExcelExport']);
	
	// route to list all types of user roles
	Route::get('roles', ['as' => 'admin_users_roles', 'uses' => 'AdminUsersController@getUsersRoles']);
	
	// route to list settings for admin
	Route::get('settings', ['as' => 'admin_settings', 'uses' => 'AdminSettingsController@index']);
	
	// resource route to settings for admin
	Route::resource('settings', 'AdminSettingsController', ['only' => ['create', 'show', 'edit']]);
	
	// route to list settings for admin
	Route::get('sliders', ['as' => 'admin_sliders', 'uses' => 'AdminSlidersController@index']);

    // route to list pages for admin
    Route::get('pages', ['as' => 'admin_pages', 'uses' => 'AdminPagesController@index']);

	// route to multi update on bulk no of pages
    Route::post('admin_pages_actions', array('as' => 'admin_pages_actions', 'uses' => 'AdminPagesController@postAdminPagesActions'));

    //  route to pages
    Route::resource('pages', 'AdminPagesController', ['only' => ['create', 'show', 'edit']]);


    // route to list popup for admin
    Route::get('popup', ['as' => 'admin_popup', 'uses' => 'AdminPopupController@index']);

    //  route to pages
    Route::resource('popup', 'AdminPopupController', ['only' => ['create', 'show', 'edit']]);
    //  route to logs
    Route::get('logs', ['as' => 'admin_logs', 'uses' => 'AdminLogsController@index']);

    // route to list faqs for admin
    Route::get('faqs', ['as' => 'admin_faqs', 'uses' => 'AdminFaqsController@index']);

	// route to multi update on bulk no of faqs
    Route::post('admin_faqs_actions', array('as' => 'admin_faqs_actions', 'uses' => 'AdminFaqsController@postAdminFaqsActions'));

    //  route to Faqs
    Route::resource('faqs', 'AdminFaqsController', ['only' => ['create', 'show', 'edit']]);

    // route to list faqs for admin
    Route::get('testimonials', ['as' => 'admin_testimonials', 'uses' => 'AdminTestimonialsController@index']);

    Route::get('ads', ['as' => 'admin_ads', 'uses' => 'AdminAdsController@index']);

    Route::post('admin_ads_actions', array('as' => 'admin_ads_actions', 'uses' => 'AdminAdsController@postAdminAdsActions'));

    Route::resource('ads', 'AdminAdsController', ['only' => ['create', 'show', 'edit']]);


    // route to multi update on bulk no of faqs
    Route::post('admin_testimonials_actions', array('as' => 'admin_testimonials_actions', 'uses' => 'AdminTestimonialsController@postAdminTestimonialsActions'));

    //  route to Faqs
    Route::resource('testimonials', 'AdminTestimonialsController', ['only' => ['create', 'show', 'edit']]);

    Route::get('inst_testimonials', ['as' => 'admin_inst_testimonials', 'uses' => 'AdminInstTestimonialsController@index']);

    // route to multi update on bulk no of faqs
    Route::post('admin_inst_testimonials_actions', array('as' => 'admin_inst_testimonials_actions', 'uses' => 'AdminInstTestimonialsController@postAdminInstTestimonialsActions'));

    //  route to Faqs
    Route::resource('inst_testimonials', 'AdminInstTestimonialsController', ['only' => ['create', 'show', 'edit']]);

    // route to list enquiries for admin
    Route::get('enquiries', ['as' => 'admin_enquiries', 'uses' => 'AdminEnquiriesController@index']);

	// route to multi update on bulk no of enquiries
    Route::post('admin_enquiries_actions', array('as' => 'admin_enquiries_actions', 'uses' => 'AdminEnquiriesController@postAdminEnquiriesActions'));

    //  Enquiries Resource
    Route::resource('enquiries', 'AdminEnquiriesController', ['only' => ['show', 'edit']]);

    Route::get('enquiries-export', ['as' => 'admin_enquiries_export', 'uses' => 'AdminEnquiriesController@getEnquiriesExcelExport']);

    Route::get('problems', ['as' => 'admin_problems', 'uses' => 'AdminProblemsController@index']);

    Route::post('admin_problems_actions', array('as' => 'admin_problems_actions', 'uses' => 'AdminProblemsController@postAdminProblemsActions'));

    Route::resource('problems', 'AdminProblemsController', ['only' => ['show', 'edit']]);

    Route::get('problems-export', ['as' => 'admin_problems_export', 'uses' => 'AdminProblemsController@getProblemsExcelExport']);


    // route to list student registrations for admin
    Route::get('student_registrations', ['as' => 'admin_student_registrations', 'uses' => 'AdminStudentRegistrationsController@index']);

    // route to multi update on bulk no of student registrations
    Route::post('admin_student_registrations_actions', array('as' => 'admin_student_registrations_actions', 'uses' => 'AdminStudentRegistrationsController@postAdminStudentRegistrationActions'));

    Route::resource('student_registrations', 'AdminStudentRegistrationsController', ['only' => ['show', 'edit']]);

    Route::get('student-registrations-export', ['as' => 'admin_student_registrations_export', 'uses' => 'AdminStudentRegistrationsController@getStudentRegistrationsExcelExport']);


    // route to list settings for admin
	Route::get('adminpress', ['as' => 'admin_sliders_press', 'uses' => 'AdminSliderPressController@index']);

    // route to list student registrations for admin
    Route::get('inst_registrations', ['as' => 'admin_inst_registrations', 'uses' => 'AdminInstRegistrationsController@index']);

    // route to multi update on bulk no of student registrations
    Route::post('admin_inst_registrations_actions', array('as' => 'admin_inst_registrations_actions', 'uses' => 'AdminInstRegistrationsController@postAdminInstRegistrationActions'));

    Route::resource('inst_registrations', 'AdminInstRegistrationsController', ['only' => ['show', 'edit']]);

    Route::get('inst-registrations-export', ['as' => 'admin_inst_registrations_export', 'uses' => 'AdminInstRegistrationsController@getInstRegistrationsExcelExport']);

    // route to list student registrations for admin
    Route::get('brand_registrations', ['as' => 'admin_brand_registrations', 'uses' => 'AdminBrandRegistrationsController@index']);

    // route to multi update on bulk no of student registrations
    Route::post('admin_brand_registrations_actions', array('as' => 'admin_brand_registrations_actions', 'uses' => 'AdminBrandRegistrationsController@postAdminBrandRegistrationsActions'));

    Route::resource('brand_registrations', 'AdminBrandRegistrationsController', ['only' => ['show', 'edit']]);

    Route::get('brand-registrations-export', ['as' => 'admin_brand_registrations_export', 'uses' => 'AdminBrandRegistrationsController@getBrandRegistrationsExcelExport']);

	// resource route to Press
	Route::resource('slider_press', 'AdminSliderPressController', ['only' => ['create', 'show', 'edit']]);

	// resource route to sliders
	Route::resource('sliders', 'AdminSlidersController', ['only' => ['create', 'show', 'edit']]);
	
	// route to import export list of sliders as excel
	Route::get('sliders-export', ['as' => 'admin_sliders_export', 'uses' => 'AdminSlidersController@getSliderExcelExport']);
	

	// route to list of brands to admin
	Route::get('brands', ['as' => 'admin_brands', 'uses' => 'AdminBrandsController@index']);
    Route::get('brand/{slug}', ['as' => 'admin_brand_dashboard', 'uses' => 'AdminBrandsController@brandDashboard']);

    Route::get('institution/{slug}', ['as' => 'admin_institution_dashboard', 'uses' => 'AdminInstitutionsController@institutionDashboard']);
	
    Route::get('student/{id}', ['as' => 'admin_student_dashboard', 'uses' => 'AdminStudentsController@studentDashboard']);


    // resource route to brands
	Route::resource('brands', 'AdminBrandsController', ['only' => ['create', 'show', 'edit']]);

    // route to import export list of brands as excel
	Route::get('brands-export', ['as' => 'admin_brands_export', 'uses' => 'AdminBrandsController@getBrandsExcelExport']);
	
	// route to list of categories to admin
	Route::get('categories', ['as' => 'admin_categories', 'uses' => 'AdminCategoriesController@index']);

    //route to list of internship categories to admin
    Route::get('internship_categories', ['as' => 'admin_internship_categories', 'uses' => 'AdminInternshipCategoriesController@index']);

    // resource route to categories
    Route::resource('internship_categories', 'AdminInternshipCategoriesController', ['only' => ['create', 'show', 'edit']]);

    //route to list of internship categories to admin
    Route::get('faq_categories', ['as' => 'admin_faq_categories', 'uses' => 'AdminFaqCategoriesController@index']);

    // resource route to categories
    Route::resource('faq_categories', 'AdminFaqCategoriesController', ['only' => ['create', 'show', 'edit']]);

    Route::resource('faq_categories', 'AdminFaqCategoriesController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('inst_registrations', 'AdminInstRegistrationsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('student_registrations', 'AdminStudentRegistrationsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('brand_registrations', 'AdminBrandRegistrationsController', ['only' => ['store', 'update', 'destroy']]);

    Route::get('reports/college', ['as' => 'admin_reports_college', 'uses' => 'AdminController@getCollegeReport']);
    Route::get('reports/students', ['as' => 'admin_reports_students', 'uses' => 'AdminController@getStudentReport']);
    Route::get('reports/studentsdata', ['as' => 'admin_reports_students_data', 'uses' => 'AdminController@getStudentDataReport']);    
    Route::get('reports/users', ['as' => 'admin_reports_users', 'uses' => 'AdminController@getUsersReport']);
    Route::get('reports/brands', ['as' => 'admin_reports_brand', 'uses' => 'AdminController@getBrandReport']);
    Route::get('reports/internships', ['as' => 'admin_reports_internship', 'uses' => 'AdminController@getInternshipReport']);
    Route::get('reports/offers', ['as' => 'admin_reports_offers', 'uses' => 'AdminController@getOfferReport']);
    Route::post('reports/users', ['as' => 'filterUserReport', 'uses' => 'AdminController@filterUserReport']);
    Route::post('reports/offers', ['as' => 'filterOfferReport', 'uses' => 'AdminController@filterOfferReport']);

    Route::get('admin_report_offers_export', ['as' => 'admin_report_offers_export', 'uses' => 'AdminController@getOffersReportExcelExport']);
    Route::get('admin_report_internships_export', ['as' => 'admin_report_internships_export', 'uses' => 'AdminController@getInternshipsReportExcelExport']);
    Route::get('admin_report_brands_export', ['as' => 'admin_report_brands_export', 'uses' => 'AdminController@getBrandsReportExcelExport']);
    Route::get('admin_report_colleges_export', ['as' => 'admin_report_colleges_export', 'uses' => 'AdminController@getCollegesReportExcelExport']);
    Route::get('admin_report_students_export', ['as' => 'admin_report_students_export', 'uses' => 'AdminController@getStudentsReportExcelExport']);
    Route::get('admin_report_not_registered_students_export', ['as' => 'admin_report_not_registered_students_export', 'uses' => 'AdminController@getStudentsNotRegisteredReportExcelExport']);
    Route::get('admin_report_registered_students_export', ['as' => 'admin_report_registered_students_export', 'uses' => 'AdminController@getRegisteredStudentsReportExcelExport']);
    Route::get('admin_report_all_students_export', ['as' => 'admin_report_all_students_export', 'uses' => 'AdminController@getAllStudentsReportExcelExport']);
    Route::get('admin_report_mismatch_students_export', ['as' => 'admin_report_mismatch_students_export', 'uses' => 'AdminController@getMismatchStudentExcelSheet']);

    

    // resource route to categories
	Route::resource('categories', 'AdminCategoriesController', ['only' => ['create', 'show', 'edit']]);
	
	// route to import export list of categories as excel
	Route::get('categories-export', ['as' => 'admin_categories_export', 'uses' => 'AdminCategoriesController@getCategoriesExcelExport']);

    // route to import export list of categories as excel
    Route::get('internship_categories-export', ['as' => 'admin_internship_categories_export', 'uses' => 'AdminInternshipCategoriesController@getCategoriesExcelExport']);

    // route to list of offers to admin
	Route::get('offers', ['as' => 'admin_offers', 'uses' => 'AdminOffersController@index']);
	// resource route to offers
	Route::resource('offers', 'AdminOffersController', ['only' => ['create', 'show', 'edit']]);

    // route to list of events to admin
    Route::get('events', ['as' => 'admin_events', 'uses' => 'AdminEventsController@index']);
    Route::get('internship_applications', ['as' => 'internship_applications', 'uses' => 'AdminInternshipsController@getApplications']);
    Route::get('internship_applications/{id}', ['as' => 'applications_by_internship', 'uses' => 'AdminInternshipsController@getApplicationsByPost']);
    Route::post('searchApplications', ['as' => 'searchApplications', 'uses' => 'AdminInternshipsController@searchApplications']);

    // resource route to offers
    Route::get('applications-export', ['as' => 'admin_applications_export', 'uses' => 'AdminInternshipsController@getApplicationsExcelExport']);

    Route::get('offers/{id}/coupon', ['as' => 'admin_offer_coupons', 'uses' => 'AdminOffersController@getCouponDetails']);


    Route::resource('events', 'AdminEventsController', ['only' => ['create', 'show', 'edit']]);

	// Route::get('resizephotos', ['as' => 'admin_resize_photos', 'uses' => 'AdminPhotosController@resizeAllPhotos']);

    // route to list of offers to admin
	Route::get('links', ['as' => 'admin_links', 'uses' => 'AdminLinksController@index']);
	
	// resource route to offers
	Route::resource('links', 'AdminLinksController', ['only' => ['create', 'show', 'edit']]);
	
	// route to list of photos to admin
	Route::get('photos', ['as' => 'admin_photos', 'uses' => 'AdminPhotosController@index']);

	// resource route to offers
	Route::resource('photos', 'AdminPhotosController', ['only' => ['create', 'show', 'edit']]);

	// route to list of internships to admin
	Route::get('internships', ['as' => 'admin_internships', 'uses' => 'AdminInternshipsController@index']);
	
	// resource route to internships
	Route::resource('internships', 'AdminInternshipsController', ['only' => ['create', 'show', 'edit']]);

    // route to list of institutions to admin
    Route::get('institutions', ['as' => 'admin_institutions', 'uses' => 'AdminInstitutionsController@index']);

    // resource route to brands
    Route::resource('institutions', 'AdminInstitutionsController', ['only' => ['create', 'show', 'edit']]);

	Route::get('template/{slug}', ['as' => 'admin_template', 'uses' => 'AdminInstitutionsController@createTemplate']);
	
	Route::get('emailtemplate', ['as' => 'emailtemplate', 'uses' => 'AdminStudentsController@checkTemplateDesign']);
	
	Route::post('template/addUpdateTemplate', ['as' => 'template_addUpdateTemplate', 'uses' => 'AdminInstitutionsController@addUpdateTemplate']);

    // route to list of events to admin
    Route::get('inst_events', ['as' => 'admin_inst_events', 'uses' => 'AdminInstEventsController@index']);
    // resource route to offers
    Route::resource('inst_events', 'AdminInstEventsController', ['only' => ['create', 'show', 'edit']]);


    // route to list of offers to admin
    Route::get('inst_links', ['as' => 'admin_inst_links', 'uses' => 'AdminInstLinksController@index']);

    // resource route to offers
    Route::resource('inst_links', 'AdminInstLinksController', ['only' => ['create', 'show', 'edit']]);

    // route to list of photos to admin
    Route::get('inst_photos', ['as' => 'admin_inst_photos', 'uses' => 'AdminInstPhotosController@index']);

    // resource route to offers
    Route::resource('inst_photos', 'AdminInstPhotosController', ['only' => ['create', 'show', 'edit']]);



    // route to list of institutions to admin
    Route::get('featured', ['as' => 'admin_featured', 'uses' => 'AdminFeaturedController@index']);

    Route::get('featured/{id}', ['as' => 'admin_featured_deactivate', 'uses' => 'AdminFeaturedController@featuredDeactivate']);

    Route::get('featured/activate/{id}', ['as' => 'admin_featured_activate', 'uses' => 'AdminFeaturedController@featuredActivate']);

    Route::get('add_featured', ['as' => 'add_featured', 'uses' => 'AdminFeaturedController@AddFeatured']);

    Route::post('searchFeatured', ['as' => 'searchFeatured', 'uses' => 'AdminFeaturedController@searchFeatured']);

    

    // route to import export list of brands as excel
    Route::get('institutions-export', ['as' => 'admin_institutions_export', 'uses' => 'AdminInstitutionsController@getInstitutionsExcelExport']);

    // route to list of Students to admin
    Route::get('students', ['as' => 'admin_students', 'uses' => 'AdminStudentsController@index']);

	// resource route to students
	Route::resource('students', 'AdminStudentsController', ['only' => ['create', 'show', 'edit']]);
	
	// route to import export list of students as excel
	Route::get('students-export', ['as' => 'admin_students_export', 'uses' => 'AdminStudentsController@getStudentsExcelExport']);
	
	Route::get('students-duplicate-export', ['as' => 'admin_students_duplicate_export', 'uses' => 'AdminStudentsController@getStudentsDuplicateDataExcelExport']);

    Route::get('students-duplicate-deleteall', ['as' => 'admin_students_duplicate_deleteall', 'uses' => 'AdminStudentsController@DeleteAllStudentsDuplicateData']);

	Route::get('searchStudents', ['as' => 'searchStudents', 'uses' => 'AdminStudentsController@searchStudents']);
	Route::get('insertData', ['as' => 'insertData', 'uses' => 'AdminStudentsController@insertData']);
	Route::post('userDateActivity', ['as' => 'userDateActivity', 'uses' => 'AdminStudentsController@userDateActivity']);
	Route::get('post-mail-to-all', ['as' => 'post-mail-to-all', 'uses' => 'AdminStudentsController@postMailToAll']);
	Route::get('resend-mail', ['as' => 'resend-mail', 'uses' => 'AdminStudentsController@resendMail']);
	Route::get('search-date', ['as' => 'search-date', 'uses' => 'AdminStudentsController@searchDate']);
	Route::get('search-file', ['as' => 'search-file', 'uses' => 'AdminStudentsController@searchFile']);
	Route::get('search-file-resend', ['as' => 'search-file', 'uses' => 'AdminStudentsController@searchFileResend']);


});

# Admin Routes
Route::group(['before' => 'auth|admin|csrf', 'prefix' => 'admin'], function()
{	
	// route to import bulk no of users through excel
	Route::post('admin_users_import', array('as' => 'admin_users_import', 'uses' => 'AdminUsersController@postUserExcelImport'));
	
	// route to multi update on bulk no of users
	Route::post('admin_users_actions', array('as' => 'admin_users_actions', 'uses' => 'AdminUsersController@postAdminUsersActions'));
	
	// resource route to process users related actions
	Route::resource('profiles', 'AdminUsersController', ['only' => ['store', 'update', 'destroy']]);
	
	// route to import bulk no of brand users through excel
	Route::post('admin_brand_users_import', array('as' => 'admin_brand_users_import', 'uses' => 'AdminBrandUsersController@postBrandUsersExcelImport'));
	
	// route to multi update on bulk no of  brand users
	Route::post('admin_brand_users_actions', array('as' => 'admin_brand_users_actions', 'uses' => 'AdminBrandUsersController@postAdminBrandUsersActions'));
	
	// route to import bulk no of institution users through excel
	Route::post('admin_institution_users_import', array('as' => 'admin_institution_users_import', 'uses' => 'AdminInstitutionUsersController@postInstitutionUsersExcelImport'));
	
	// route to multi update on bulk no of  institution users
	Route::post('admin_institution_users_actions', array('as' => 'admin_institution_users_actions', 'uses' => 'AdminInstitutionUsersController@postAdminInstitutionUsersActions'));
	
	// route to import bulk no of student users through excel
	Route::post('admin_student_users_import', array('as' => 'admin_student_users_import', 'uses' => 'AdminStudentUsersController@postStudentUsersExcelImport'));
	
	// route to multi update on bulk no of  student users
	Route::post('admin_student_users_actions', array('as' => 'admin_student_users_actions', 'uses' => 'AdminStudentUsersController@postAdminStudentUsersActions'));
	// Route::post('adminstudentusersactions', array('as' => 'adminstudentusersactions', 'uses' => 'AdminStudentUsersController@postAdminStudentUsersActions'));
	
	Route::post('admin_featured_post_actions', array('as' => 'admin_featured_post_actions', 'uses' => 'AdminFeaturedController@postAdminFeaturedActions'));

	// resource route to process brand users related actions
	Route::resource('brandsusers', 'AdminBrandUsersController', ['only' => ['store', 'update', 'destroy']]);
	
	// resource route to process brand users related actions
	Route::resource('institutions_users', 'AdminInstitutionUsersController', ['only' => ['store', 'update', 'destroy']]);

	// resource route to process student users related actions
	Route::resource('students_users', 'AdminStudentUsersController', ['only' => ['store', 'update', 'destroy']]);

	// resource route to process settings for admin
	Route::resource('settings', 'AdminSettingsController', ['only' => ['store', 'update', 'destroy']]);
	
	// resource route to process sliders related actions
	Route::resource('sliders', 'AdminSlidersController', ['only' => ['store', 'update', 'destroy']]);

    // resource route to process sliders related actions
    Route::resource('pages', 'AdminPagesController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('popup', 'AdminPopupController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('faqs', 'AdminFaqsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('ads', 'AdminAdsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('testimonials', 'AdminTestimonialsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('inst_testimonials', 'AdminInstTestimonialsController', ['only' => ['store', 'update', 'destroy']]);

    Route::resource('enquiries', 'AdminEnquiriesController', ['only' => [ 'update', 'destroy']]);

    Route::resource('problems', 'AdminProblemsController', ['only' => [ 'update', 'destroy']]);


    // resource route to process sliders related actions
	Route::resource('slider_press', 'AdminSliderPressController', ['only' => ['store', 'update', 'destroy']]);

	// route to multi update on bulk no of sliders
	Route::post('admin_press_actions', array('as' => 'admin_press_actions', 'uses' => 'AdminSliderPressController@postAdminSliderPressActions'));
	
	// route to multi update on bulk no of sliders
	Route::post('admin_sliders_actions', array('as' => 'admin_sliders_actions', 'uses' => 'AdminSlidersController@postAdminSlidersActions'));
	
	// route to import bulk no of sliders through excel
	Route::post('admin_sliders_import', array('as' => 'admin_sliders_import', 'uses' => 'AdminSlidersController@postSliderExcelImport'));
	
	// route to import bulk no of brands through excel
	Route::post('admin_brands_import', array('as' => 'admin_brands_import', 'uses' => 'AdminBrandsController@postBrandsExcelImport'));
	
	// route to multi update on bulk no of brands
	Route::post('admin_brands_actions', array('as' => 'admin_brands_actions', 'uses' => 'AdminBrandsController@postAdminBrandsActions'));

	// route to multi update on bulk no of brands
	Route::post('admin_popup_actions', array('as' => 'admin_popup_actions', 'uses' => 'AdminPopupController@postAdminPopupActions'));

	// resource route to process brands related actions
	Route::resource('brands', 'AdminBrandsController', ['only' => ['store', 'update', 'destroy']]);


    // route to import bulk no of categories through excel
	Route::post('admin_categories_import', array('as' => 'admin_categories_import', 'uses' => 'AdminCategoriesController@postCategoriesExcelImport'));
	
	// route to multi update on bulk no of categories
	Route::post('admin_categories_actions', array('as' => 'admin_categories_actions', 'uses' => 'AdminCategoriesController@postAdminCategoriesActions'));


    // route to import bulk no of categories through excel
    Route::post('admin_internship_categories_import', array('as' => 'admin_internship_categories_import', 'uses' => 'AdminInternshipCategoriesController@postInternshipCategoriesExcelImport'));

    // route to multi update on bulk no of categories
    Route::post('admin_internship_categories_actions', array('as' => 'admin_internship_categories_actions', 'uses' => 'AdminInternshipCategoriesController@postAdminInternshipCategoriesActions'));

    // resource route to process categories related actions
    Route::resource('internship_categories', 'AdminInternshipCategoriesController', ['only' => ['store', 'update', 'destroy']]);

    // resource route to process categories related actions
	Route::resource('categories', 'AdminCategoriesController', ['only' => ['store', 'update', 'destroy']]);
	
	// resource route to process offers related actions
	Route::resource('offers', 'AdminOffersController', ['only' => ['store', 'update', 'destroy']]);
	
	// route to multi update on bulk no of offers
	Route::post('admin_offers_actions', array('as' => 'admin_offers_actions', 'uses' => 'AdminOffersController@postAdminOffersActions'));
	Route::post('admin_coupons_actions', array('as' => 'admin_coupons_actions', 'uses' => 'AdminOffersController@postAdminCouponsActions'));


    Route::resource('events', 'AdminEventsController', ['only' => ['store', 'update', 'destroy']]);

    // route to multi update on bulk no of events
    Route::post('admin_events_actions', array('as' => 'admin_events_actions', 'uses' => 'AdminEventsController@postAdminEventsActions'));
	
	// resource route to process links related actions
	Route::resource('links', 'AdminLinksController', ['only' => ['store', 'update', 'destroy']]);

    // route to multi update on bulk no of offers
    Route::post('admin_faq_categories_actions', array('as' => 'admin_faq_categories_actions', 'uses' => 'AdminFaqCategoriesController@postAdminFaqCategoriesActions'));


    // route to multi update on bulk no of offers
	Route::post('admin_links_actions', array('as' => 'admin_links_actions', 'uses' => 'AdminLinksController@postAdminLinksActions'));
	
	// resource route to process photos related actions
	Route::resource('photos', 'AdminPhotosController', ['only' => ['store', 'update', 'destroy']]);

	// route to multi update on bulk no of photos
	Route::post('admin_photos_actions', array('as' => 'admin_photos_actions', 'uses' => 'AdminPhotosController@postAdminPhotosActions'));

	// resource route to process internships related actions
	Route::resource('internships', 'AdminInternshipsController', ['only' => ['store', 'update', 'destroy']]);
	
	// route to multi update on bulk no of offers
	Route::post('admin_internships_actions', array('as' => 'admin_internships_actions', 'uses' => 'AdminInternshipsController@postAdminInternshipsActions'));


    // route to import bulk no of institutions through excel
    Route::post('admin_institutions_import', array('as' => 'admin_institutions_import', 'uses' => 'AdminInstitutionsController@postInstitutionsExcelImport'));

    // route to multi update on bulk no of institutions
    Route::post('admin_institutions_actions', array('as' => 'admin_institutions_actions', 'uses' => 'AdminInstitutionsController@postAdminInstitutionsActions'));

    // resource route to process institutions related actions
    Route::resource('institutions', 'AdminInstitutionsController', ['only' => ['store', 'update', 'destroy']]);



    Route::resource('inst_photos', 'AdminInstPhotosController', ['only' => ['store', 'update', 'destroy']]);

    // route to multi update on bulk no of photos
    Route::post('admin_inst_photos_actions', array('as' => 'admin_inst_photos_actions', 'uses' => 'AdminInstPhotosController@postAdminInstPhotosActions'));

    Route::resource('inst_events', 'AdminInstEventsController', ['only' => ['store', 'update', 'destroy']]);

    // route to multi update on bulk no of photos
    Route::post('admin_inst_events_actions', array('as' => 'admin_inst_events_actions', 'uses' => 'AdminInstEventsController@postAdminInstEventsActions'));

    Route::resource('inst_links', 'AdminInstLinksController', ['only' => ['store', 'update', 'destroy']]);

    // route to multi update on bulk no of photos
    Route::post('admin_inst_links_actions', array('as' => 'admin_inst_links_actions', 'uses' => 'AdminInstLinksController@postAdminInstLinksActions'));



    // route to import bulk no of students through excel
	Route::post('admin_students_import', array('as' => 'admin_students_import', 'uses' => 'AdminStudentsController@postStudentsExcelImport'));
	
	// route to multi update on bulk no of students
	Route::post('admin_students_actions', array('as' => 'admin_students_actions', 'uses' => 'AdminStudentsController@postAdminStudentsActions'));
	
	// resource route to process students related actions
	Route::resource('students', 'AdminStudentsController', ['only' => ['store', 'update', 'destroy']]);

});

# Ajax Call
Route::group(array('prefix' => 'ajax'), function()
{
    Route::post('/getCityByStateId','DataController@getCityByStateId');
});

Route::group(['before' => 'auth|studentUser'], function()
{
    Route::get('/student/dashboard', ['as' => 'student_dashboard', 'uses' => 'StudentUserController@getDashboard']);
    
    Route::get('/student/wishlist', array( 'as' => 'student_wishlist', 'uses' => 'StudentUserController@getWishlist' ));

    Route::get('/student/brands',['as' => 'studentbrands', 'uses' => 'StudentUserController@getBrandFollows']);

    Route::get('/student/internships', ['as' => 'student_internships', 'uses' => 'StudentInternshipsController@getStudentInternships']);
    
    Route::get('/student/applied_jobs', ['as' => 'student_applied_jobs', 'uses' => 'StudentInternshipsController@getStudentAppliedJobs']);

    Route::get('/student/recent-updates',['as' => 'studentupdates', 'uses' => 'StudentUserController@getRecentUpdates']);

    Route::get('/student/recent-viewed-offers',['as' => 'studentoffers', 'uses' => 'StudentUserController@getRecentViewedOffers']);

    Route::get('/student/{id}',['as' => 'studentprofile', 'uses' => 'StudentUserController@getProfile']);
    
    Route::get('/student/education_details/{id}',['as' => 'student_educational_details', 'uses' => 'StudentUserController@getEducationalDetails']);
    Route::post('/student/education_details/{id}',['as' => 'student_educational_details_post', 'uses' => 'StudentUserController@postEducationalDetails']);
    
    Route::get('/student/work_samples/{id}', array('as' => 'student_work_samples', 'uses' => 'StudentUserController@getWorkSamples'));
    Route::post('/student/work_samples/{id}', array('as' => 'student_work_samples_post', 'uses' => 'StudentUserController@postWorkSamples'));

    Route::get('/student/additional_details/{id}', array('as' => 'student_additional_details', 'uses' => 'StudentUserController@getAdditionalDetails'));
    Route::post('/student/additional_details/{id}', array('as' => 'student_additional_details_post', 'uses' => 'StudentUserController@postAdditionalDetails'));
    
    Route::get('/student/changepassword/{id}', array('as' => 'student_changepassword', 'uses' => 'StudentUserController@changeUserPassword'));
    Route::post('/student/changepassword/{id}', array('as' => 'student_changepassword_post', 'uses' => 'StudentUserController@updatePassword'));
    
    Route::get('/student/professional_details/{id}', array('as' => 'student_professional_details', 'uses' => 'StudentUserController@getProfessionalDetails'));
    Route::post('/student/professional_details/{id}', array('as' => 'student_professional_details_post', 'uses' => 'StudentUserController@postProfessionalDetails'));

    Route::post('/student/{id}',['as' => 'studentprofile', 'uses' => 'StudentUserController@postProfile']);

    Route::get('/student/activity/{id}',['as' => 'activitylog', 'uses' => 'StudentUserController@getActivityLog']);

    Route::post('uploadProfilePicture',['as' => 'uploadProfilePicture', 'uses' => 'StudentUserController@uploadProfilePicture']);

    //Route::get('/student/{slug1}/internships/{slug2}', ['as' => 'student_single_internship', 'uses' => 'StudentInternshipsController@getSingleInternship']);

    Route::get('/student/{slug1}/internships/{slug2}/apply/{intern_id?}', ['as' => 'apply_internship', 'uses' => 'StudentInternshipsController@getApplyInternship']);
    Route::get('/student/{slug1}/internships/{slug2}/question', ['as' => 'apply_internship_question', 'uses' => 'StudentInternshipsController@getQuestionsInternship']);
    Route::post('/student/{slug1}/internships/{slug2}/question', ['as' => 'post_apply_internship_question', 'uses' => 'StudentInternshipsController@postQuestionsInternship']);

    Route::resource('internships', 'StudentInternshipsController', ['only' => ['store']]);

});

//Route::resource('/student', 'StudentUserController', ['only' => ['show','edit','update']]);


Route::group(['before' => 'auth'], function()
{
	Route::post('userProfile_ChangePassword',array('uses'=>'StudentUserController@changePassword'));

	Route::post('userPasswordChange',array('uses'=>'StudentUserController@userPasswordChange'));

    Route::post('postNotes',array('uses'=>'BrandsController@postNotes'));

    Route::post('postInstNotes',array('uses'=>'InstitutionsController@postNotes'));

	Route::post('studentColor',array('uses'=>'StudentUserController@updateColor'));

	Route::post('availableStores',array('uses'=>'MainOffersController@availableStores'));

	// route to import bulk no of students through excel
	Route::post('brands_outlets_import', array('as' => 'brands_outlets_import', 'uses' => 'OutletsController@postOutletsExcelImport'));
    
    Route::post('brands_outlets_delete', array('as' => 'brands_outlets_delete', 'uses' => 'OutletsController@postOutletsDelete'));

    Route::post('changeInternshipStatus',array('uses'=>'InternshipsController@changeInternshipStatus'));

});

//No csrf token given
Route::post('getRemainingPosts',array('uses'=>'StudentUserController@getRemainingPosts'));

Route::post('getfollowers',array('uses'=>'BrandsController@getfollowers'));

// Route for posting student information first time login
Route::post('profile_data',array('uses'=>'StudentUserController@profileData'));

Route::post('brand_data',array('uses'=>'StudentUserController@brandData'));

Route::post('inst_data',array('uses'=>'StudentUserController@instData'));

Route::post('userSingleCoupon', array( 'uses' => 'OffersController@userSingleCoupon'));

Route::post('userMultipleCoupon', array('uses' => 'OffersController@userMultipleCoupon'));

Route::post('brandDeleteCoverImage', array('uses' => 'BrandsController@deleteCoverImage'));

Route::post('CheckPinCode', array('as'=>'CheckPinCode','uses' => 'StudentUserController@CheckPinCode'));
Route::post('CheckCardCoupon', array('as'=>'CheckCardCoupon','uses' => 'StudentUserController@CheckCardCoupon'));



Route::get('/campagin', ['as' => 'campagin', 'uses' => 'PagesController@campagin']);
Route::post('/campagin', ['as' => 'post_campagin', 'uses' => 'PagesController@post_campagin']);


// Route::get('dummydata', array('uses' => 'TestController@addingFollows'));
