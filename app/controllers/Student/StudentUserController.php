<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;
use idoag\Repos\Student\StudentRepositoryInterface;
use idoag\Forms\StudentActivationForm;
use idoag\Forms\StudentRegisterForm;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\PostsVisitsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandsFollowsRepositoryInterface;
use idoag\Repos\InstitutionsFollowsRepositoryInterface;
use idoag\Repos\InternshipCategoryRepositoryInterface;
use Laracasts\Validation\FormValidationException;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;
use idoag\Repos\PincodeRepositoryInterface;
use idoag\Repos\CardCouponRepositoryInterface;
use idoag\Repos\ActivityRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;

class StudentUserController extends \BaseController {

    function __construct(PostRepositoryInterface $post, UserRepositoryInterface $user, ActivityRepositoryInterface $activity, CardCouponRepositoryInterface $coupon, PincodeRepositoryInterface $pincode, InstitutionsFollowsRepositoryInterface $institution_follows, InstitutionRepositoryInterface $institution, BrandsFollowsRepositoryInterface $brands_follows, PostsVisitsRepositoryInterface $posts_visits, StudentInternshipRepositoryInterface $student_internship, BrandRepositoryInterface $brand, CategoryRepositoryInterface $category, InternshipCategoryRepositoryInterface $int_category, StudentRegisterForm $studentRegisterForm, StudentActivationForm $studentActivationForm, StudentDetailsRepositoryInterface $studentDetails, StudentRepositoryInterface $student) {
        $this->user = $user;
        $this->post = $post;
        $this->student = $student;

        $this->category = $category;

        $this->brand = $brand;

        $this->institution = $institution;

        $this->int_category = $int_category;

        $this->posts_visits = $posts_visits;

        $this->brands_follows = $brands_follows;

        $this->institution_follows = $institution_follows;

        $this->student_details = $studentDetails;

        $this->student_internship = $student_internship;

        $this->studentRegisterForm = $studentRegisterForm;

        $this->studentActivationForm = $studentActivationForm;

        $this->pincode = $pincode;

        $this->cardcoupon = $coupon;

        $this->activity = $activity;
    }

    public function activateStudent() {
        $data = array();
        $student_data = array();

        $card_number = Input::get('card_number');

        $dob = Input::get('dob');
        $companyId = Input::get('companyId');
        
        if(!empty($dob)){
            $credentials = array('card_number' => $card_number, 'dob' => $dob);
            try {
                $this->studentActivationForm->validate($credentials);
            } catch (\Laracasts\Validation\FormValidationException $e) {
                return Redirect::back()->withInput()->withErrorMessage('IDOAG Card Number and/or Date of Birth/Company name entered are incorrect. Please re-enter');
            }
            
            $user_details = DB::table('student_data')->where('card_number', $card_number)->where('dob', $dob)->first();
        } else{
            $user_details = DB::table('student_data')->where('card_number', $card_number)->where('college_id', $companyId)->first();
        }

        //echo"<pre>";print_r($user_details);exit();

        if ($user_details) {
            $user = $this->user->findByCardNumber($card_number);
            if(!empty($dob)){
                $studentdetails = DB::table('student_details')->where('card_number', $card_number)->where('dob', $dob)->first();
            }else{
                $studentdetails = DB::table('student_details')->where('card_number', $card_number)->where('institution_id', $companyId)->first();
            }


            if (empty($user) && !$studentdetails) {
                Session::set('card_number', $card_number);

                return Redirect::route('student_profile');
            } else if (!empty($user) && !$studentdetails) {
                $studentdetails = DB::table('users')->where('card_number', $card_number)->delete();
                Session::set('card_number', $card_number);
                return Redirect::route('student_profile');
            }

            if (empty($user)) {
                Session::set('card_number', $card_number);

                return Redirect::route('student_profile');
            } else {
                return Redirect::back()->withErrorMessage('You have already activated your card. Please login with your email id and password.');
            }
        } else {
            $user = $this->user->findByCardNumber($card_number);

            if ($user) {
                return Redirect::back()->withErrorMessage('You have already activated your card. Please login with your email id and password.');
            } else {
                return Redirect::back()->withErrorMessage('IDOAG Card Number and/or Date of Birth/Company name entered are incorrect. Please re-enter.');
            }
        }
    }

    public function checkStudentWithCard() {//die("hello");
        $data = array();
        $student_data = array();

        $card_number = Input::get('card_number');

        $dob = Input::get('dob');
        $email = Input::get('email');
        $validationCheck = ['email' => $email, 'card_number' => $card_number, 'dob' => $dob];
        $validator = Validator::make($validationCheck, ['email' => 'required|email|unique:users', 'card_number' => 'required', 'dob' => 'required']);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $credentials = array('card_number' => $card_number, 'dob' => $dob);

        try {
            $this->studentActivationForm->validate($credentials);
        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrorMessage('IDOAG Card Number and/or Date of Birth entered are incorrect. Please re-enter');
        }

        $user_details = DB::table('student_data')->where('card_number', $card_number)->where('dob', $dob)->first();

        //echo"<pre>";print_r($user_details);exit();

        if ($user_details) {
            $user = $this->user->findByCardNumber($card_number);

            if (empty($user)) {
                return Redirect::back()->withErrorMessage('You have not activated your card. Please activate your card on home page.');
            } else {
                if (!$user->activated) {
                    $userMain = Sentry::findUserById($user->id);
                    $userMain->email = $email;
                    $userMain->save();
                    $activationCode = $user->getActivationCode();
                    $data['first_name'] = $userMain->first_name;
                    $data['token'] = $activationCode;
                    $data['email'] = $email;
                    Mailgun::send('emails.activate', $data, function ($message) use ($userMain) {
                        $message->subject('[IDOAG] Please confirm your email address.');
                        $message->to($userMain->email, $userMain->first_name);
                    });
                    return Redirect::route('home')->withFlashMessage('Please check your email : ' . $userMain->email . ' and click on the verification link to activate your account.');
                } else {
                    return Redirect::back()->withErrorMessage('You are already activated user with this idoag card. We cannot update your email.');
                }
            }
        } else {
            $user = $this->user->findByCardNumber($card_number);

            if ($user) {
                if (!$user->activated) {
                    $userMain = Sentry::findUserById($user->id);
                    $userMain->email = $email;
                    $userMain->save();
                    $activationCode = $user->getActivationCode();
                    $data['first_name'] = $userMain->first_name;
                    $data['token'] = $activationCode;
                    $data['email'] = $email;
                    Mailgun::send('emails.activate', $data, function ($message) use ($userMain) {
                        $message->subject('[IDOAG] Please confirm your email address.');
                        $message->to($userMain->email, $userMain->first_name);
                    });
                    return Redirect::route('home')->withFlashMessage('Please check your email : ' . $userMain->email . ' and click on the verification link to activate your account.');
                } else {
                    return Redirect::back()->withErrorMessage('You are already activated user with this idoag card. We cannot update your email.');
                }
            } else {
                return Redirect::back()->withErrorMessage('IDOAG Card Number and/or Date of Birth entered are incorrect. Please re-enter.');
            }
        }
    }

    public function show() {
        if (Session::has('card_number')) {
            $cardnumber = Session::get('card_number');
            // echo"<pre>";print_r($card_number);exit();
            $student = $this->student->findByCardNumber($cardnumber);

            $college = DB::table('institutions')->where('id', $student->college_id)->first();

            //echo"<pre>";print_r($student);exit();

            return View::make('students.show')->withStudent($student)->withCollege($college);
        } else {
            return Redirect::to('login');
        }
    }

    public function store() {
        $data = array();
        $student_data = array();
        $credentials = Input::all();

        //array('email' => Input::get('email'))

        $email = array('email' => Input::get('email'));

        $validator = Validator::make($email, array('email' => 'required|email|unique:users'));

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $card_number = $credentials['card_number'];

        $student = $this->student->findByCardNumber($card_number);

        $data = array_add($data, 'first_name', Input::get('first_name'));
        $data = array_add($data, 'last_name', Input::get('last_name'));
        $name = $data['first_name'] . ' ' . $data['last_name'];
        $data = array_add($data, 'email', $credentials['email']);
        $data = array_add($data, 'mobile', $credentials['mobile']); //added mobile number
        $data = array_add($data, 'card_number', $credentials['card_number']);
        $data = array_add($data, 'expiry_date', $student['expiry_date']);
        $data = array_add($data, 'institution', $credentials['institute']);
        $data = array_add($data, 'gender', $credentials['sex']);
        $data = array_add($data, 'activated', 0);
        $data = array_add($data, 'user_type', Input::get('user_type'));
        //$password    = Hash::make('password');

        $data = array_add($data, 'password', $credentials['password']);

        $user = $this->user->findByCardNumber($data['card_number']);

        if ($user)
            return Redirect::back()->withErrorMessage('We have already sent you an email to verify your email-id. Please click on the link in the email to confirm.');

        try {
            $user = $this->user->create($data);
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return Redirect::back()->withErrorMessage('This email is already registered with us. Please enter another email or send a note to info@idoag.com');
        }

        // Find the group using the group name
        $usersGroup = Sentry::findGroupByName('Students');

        // Assign the group to the user
        $activationCode = $user->getActivationCode();

        $user->addGroup($usersGroup);

        $student_data = array_add($student_data, 'user_id', $user->id);
        $student_data = array_add($student_data, 'name', $name);
        $student_data = array_add($student_data, 'email', $credentials['email']);
        $student_data = array_add($student_data, 'institution', $credentials['institute']);
        $student_data = array_add($student_data, 'institution_id', $student['college_id']);
        $student_data = array_add($student_data, 'course', $student['streamorcourse']);
        $student_data = array_add($student_data, 'roll_no', $student['rollno']);
        $student_data = array_add($student_data, 'card_number', $credentials['card_number']);
        $student_data = array_add($student_data, 'dob', $credentials['dob']);
        $student_data = array_add($student_data, 'expiry', $student['expiry_date']);
        $student_data = array_add($student_data, 'validity_for_how_many_years', $student['validity_for_how_many_years']);
        $student_data = array_add($student_data, 'cluborgrouporsociety', $student['cluborgrouporsociety']);
        $student_data = array_add($student_data, 'residentordayscholar', $student['residentordayscholar']);
        $student_data = array_add($student_data, 'date_of_issue', $student['date_of_issue']);
        $student_data = array_add($student_data, 'section', $student['section']);
        $student_data = array_add($student_data, 'father_name', $student['father_name']);
        $student_data = array_add($student_data, 'batch_year', $student['batch_year']);
        $student_data = array_add($student_data, 'program_duration', $student['program_duration']);

        $data = array_add($data, 'expiry', $student['expiry_date']);

        $student_data = array_add($student_data, 'color', '#5dc1d8');
        if ($student_data['expiry'] == '31-01-1900') {
            $dateOfIssue = strtotime($student['date_of_issue']);
            $expiryFormat = date('Y-m-d', $dateOfIssue);
            $date = date_create($expiryFormat);
            $days = ($student['validity_for_how_many_years'] * 365) - 1;
            date_add($date, date_interval_create_from_date_string($days . " days"));
            $student_data['expiry'] = date_format($date, "d-m-Y");
        }
        $studentdetails = $this->student_details->create($student_data);

        if ($studentdetails) {
            $student->status = 1;

            $student->save();

            $data['token'] = $activationCode;

            Mailgun::send('emails.activate', $data, function($message) use($user) {
                $message->subject('[IDOAG] Please Confirm Your Email Address');
                $message->to($user->email, $user->first_name);
            });

            return Redirect::route('home')->withFlashMessage('Please check your email : ' . $user->email . ' and click on the verification link to activate your account.');
            // Redirect::back()->withFlashMessage('Please check your email and click on the verification link to activate your account.');
        } else {
            return Redirect::route('home')->withErrorMessage('Oops!! Something went wrong please try again.');
        }
    }

    public function getProfile($id) {
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id; //print_r($loggedin_user);exit();

            $user = Sentry::findUserById($id);

            if ($loggedin_user == $id) {
                $student_details = DB::table('student_details')->where('user_id', $id)->first();

                if ($student_details->city) {
                    $cities = City::where('state_id', '=', $student_details->state)->lists('name', 'id');
                } else {
                    $cities = '';
                }

                $brand_ids = DB::table('brands_follows')->where('user_id', $id)->lists('brand_id'); //print_r($brand_ids);exit();
                $mybrand_ids = DB::table('brands_follows')->where('user_id', $id)->limit(12)->lists('brand_id'); //print_r($brand_ids);exit();

                $brands = $this->brand->getBrandsByIds($mybrand_ids);

                $suggested_brands = Brand::whereNotIn('id', $brand_ids)->orderBy('id', 'desc')->get(); //take(4)->get();

                $institution_ids = DB::table('institutions_follows')->where('user_id', $id)->lists('institution_id'); //print_r($brand_ids);exit();

                $institutions = $this->institution->getInstitutionsByIds($institution_ids);

                $suggested_institutions = Institution::whereNotIn('id', $institution_ids)->orderBy('id', 'desc')->get(); //take(4)->get();

                $ads = Ad::where('status', 1)->first();

                return View::make('students.profile')->withAds($ads)->withUser($user)->withStudent($student_details)->withCities($cities)->withBrands($brands)->withSuggestedBrands($suggested_brands)->withSuggestedInstitutions($suggested_institutions);
            } else {
                return Redirect::route('home');
            }
        }
    }

    public function postProfile($id) {
        $input = Input::except('email_id');

        $student_details = $this->student_details->findbyUserId($id);

        $user = Sentry::findUserById($id);

        $newemail = Input::get('email_id');

        $oldemail = $user->email;

        $newcard_number = Input::get('card_number');

        $oldcard_number = $user->card_number;
        
        //$user->gender = Input::get('gender');

        if ($newcard_number != $oldcard_number) {
            return Redirect::back()->withErrorMessage('You cannot change your card number');
        }
        $validationCheck = ['email' => $newemail, 'name' => $input['name'], 'roll_no' => $input['roll_no'], 'course' => $input['course']];
        $validator = Validator::make($validationCheck, ['email' => 'required|email', 'name' => 'required|alpha_spaces', 'roll_no' => 'required|alpha_num', 'course' => 'required|alpha_spaces']);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($student_details->name != $input['name']) {
            $name = explode(" ", $input['name']);

            if (count($name) >= 2) {
                $user->first_name = $name[0];

                $user->last_name = $name[1];

                $user->save();
            } else {
                $user->first_name = $name[0];

                $user->save();
            }
        }

        if ($newemail == $oldemail) {
            $edit_data = $student_details->fill($input)->save();            
            return Redirect::back()->withFlashMessage('Updated details Successfully');
        } else {
            $user_exists = $this->user->findByEmail($newemail);

            if ($user_exists) {
                return Redirect::back()->withErrorMessage('A user with this Email already exists!');
            } else {
                $activationCode = $user->getActivationCode();

                $data = array();

                $data['token'] = $activationCode;
                $data['card_number'] = $student_details->card_number;
                $data['expiry'] = $student_details->expiry;
                $data['institution'] = $student_details->institution;
                $data['first_name'] = $user->first_name;

                Mailgun::send('emails.emailchange', $data, function ($message) use ($newemail, $user) {
                    $message->subject('Email change confirmation.');
                    $message->to($newemail, $user->first_name);
                });

                $input = array_add($input, 'email', $newemail);

                $edit_data = $student_details->fill($input)->save();

                return Redirect::back()->withFlashMessage('Verification link has been sent to ' . $newemail . '. Please check you mail to confirm !!');
            }
        }
    }
    
    public function postEducationalDetails($id){
         $student_details = $this->student_details->findbyUserId($id);
         $edit_data = $student_details->fill(Input::all())->save();
         return Redirect::back()->withFlashMessage('Updated details Successfully');
    }

    public function getDashboard() {

        $brands = $this->brand->getAll();
        
        $institutions = $this->institution->getAll();

        $user = Sentry::getUser();        
        
        $offers_new = DB::table('posts')->select('posts.*', 'brands.name AS bname', 'brands.id AS brand_id')->join('brands', 'brands.id', '=', 'posts.brand_id')->where('posts.type', 'offer')->where('posts.status', '1')->where('posts.end_date', '>', date('Y-m-d'))->orderBy('posts.updated_at', 'desc')->take(12)->get();
        
        $internships_new = DB::table('posts')->select('posts.*', 'brands.image AS blogo', 'brands.id AS brand_id')->join('brands', 'brands.id', '=', 'posts.brand_id')->where('posts.status', 1)->whereIn('posts.type', array('internship', 'job', 'ambassador'))->orderBy('created_at', 'desc')->take(15)->get();
        
        $student_details = DB::table('student_details')->where('user_id', Sentry::getUser()->id)->first();        

        $today = date('Y-m-d');

        $popup = Popup::where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('status', '=', 1)->first(); //echo"<pre>";print_r($popup);exit();

        $mybrands = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');        

        $myinstitutions = InstitutionsFollows::where('user_id', Sentry::getUser()->id)->lists('institution_id');        
                
        $posts = Post::where('status', 1)->where('featured', 0)
                        ->where(function($query) use ($mybrands) {
                            $query->whereIn('brand_id', $mybrands);
                        })
                        ->orWhere(function($query) use ($myinstitutions) {
                            $query->whereIn('institution_id', $myinstitutions);
                        })
                        ->orderBy('updated_at', 'desc')->get();

        $offers = new \Illuminate\Database\Eloquent\Collection;

        foreach ($posts as $post) {
            if ($post->end_date >= date('Y-m-d') || $post->end_date == null || $post->end_date == '')
                if ($post->type == 'internship' && $post->application_date < date('Y-m-d')) {
                    
                } else
                    $offers->add($post);
        }

        $brands_posts = new \Illuminate\Database\Eloquent\Collection;
        $brands_posts = $offers->take(8);        
        $date = new Carbon\Carbon;
        $date->subDays(2);
        $trending_offers = $this->post->getTrendingPostsType('offer');
        $settings = DB::table('settings')->where('id', 1)->first();
        
        $sliders = DB::table('sliders')->select('*')->where('page_name', 'StudentDashboardSlider')->where('status', 1)->get(); 
        return View::make('students.dashboard')->withBrandsPosts($brands_posts)
                ->withStudentDetails($student_details)
                ->withUser($user)                
                ->withBrands($brands)
                ->withMybrands($mybrands)
                ->withInstitutions($institutions)                
                ->withPopup($popup)                
                ->withSettings($settings)
                ->withOffersNew($offers_new)
                ->withInternshipsNew($internships_new)
                ->withSliders($sliders)
                ->withTrendingOffers($trending_offers);
    }

    public function getRecentUpdates() {
        $user = Sentry::findUserById(Sentry::getUser()->id);

        $student_details = DB::table('student_details')->where('user_id', $user->id)->first();

        $mybrands = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');

        $brands_posts = Post::whereIn('brand_id', $mybrands)->orWhere(function($query) {
                    $query->whereIn('institution_id', InstitutionsFollows::where('user_id', Sentry::getUser()->id)->lists('institution_id'));
                })->orderBy('updated_at', 'desc')->take(20)->get();
        //dd($brands_posts);

        $suggested_brands = Brand::whereNotIn('id', $mybrands)->orderBy('id', 'desc')->take(4)->get();

        $institution_ids = DB::table('institutions_follows')->where('user_id', Sentry::getUser()->id)->lists('institution_id'); //print_r($brand_ids);exit();

        $institutions = $this->institution->getInstitutionsByIds($institution_ids);

        $suggested_institutions = Institution::whereNotIn('id', $institution_ids)->orderBy('id', 'desc')->take(4)->get();


        return View::make('students.recent_updates')->withBrandsPosts($brands_posts)->withUser($user)->withStudent($student_details)->withSuggestedBrands($suggested_brands)->withSuggestedInstitutions($suggested_institutions);
    }

    public function getRecentViewedOffers() {

        $user = Sentry::findUserById(Sentry::getUser()->id);

        $student_details = DB::table('student_details')->where('user_id', $user->id)->first();


        $recently_viewed = $this->posts_visits->getrecentviewed(Sentry::getUser()->id);


        $brand_ids = DB::table('brands_follows')->where('user_id', Sentry::getUser()->id)->lists('brand_id');

        $suggested_brands = Brand::whereNotIn('id', $brand_ids)->orderBy('id', 'desc')->take(4)->get();


        $institution_ids = DB::table('institutions_follows')->where('user_id', Sentry::getUser()->id)->lists('institution_id'); //print_r($brand_ids);exit();

        $institutions = $this->institution->getInstitutionsByIds($institution_ids);

        $suggested_institutions = Institution::whereNotIn('id', $institution_ids)->orderBy('id', 'desc')->take(4)->get();


        $recently_viewed_post = Post::whereIn('id', $recently_viewed)->get();


        return View::make('students.recent_offers')->withRecentlyViewedPost($recently_viewed_post)->withUser($user)->withStudent($student_details)->withSuggestedBrands($suggested_brands)->withSuggestedInstitutions($suggested_institutions);
    }

    public function getRemainingPosts() {
        $input = Input::all();

        $limit = Input::get('limit');

        $offset = (Input::get('offset') - 1) * $limit;

        $mybrands = BrandsFollows::where('user_id', Sentry::getUser()->id)->lists('brand_id');

        $myinstitutions = InstitutionsFollows::where('user_id', Sentry::getUser()->id)->lists('institution_id');

        $posts = Post::where('status', 1)->where('featured', 0)
                        ->where(function($query) use ($mybrands) {
                            $query->whereIn('brand_id', $mybrands);
                        })
                        ->orWhere(function($query) use ($myinstitutions) {
                            $query->whereIn('institution_id', $myinstitutions);
                        })
                        ->orderBy('updated_at', 'desc')->get();

        $offers = new \Illuminate\Database\Eloquent\Collection;

        foreach ($posts as $post) {
            if ($post->end_date >= date('Y-m-d') || $post->end_date == null || $post->end_date == '')
                if ($post->type == 'internship' && $post->application_date < date('Y-m-d')) {
                    
                } else
                    $offers->add($post);
        }

//      foreach($posts as $post)
//      {
//          if($post->end_date< date('Y-m-d') && $post->end_date!=null )
//              $offers->add($post);
//      }

        $brands_posts = new \Illuminate\Database\Eloquent\Collection;

        $brands_posts = $offers->slice(($offset), 8);

        return View::make('students.partials.allposts')->withPosts($brands_posts);
    }

    public function getBrandFollows() {

        $user = Sentry::findUserById(Sentry::getUser()->id);

        $student_details = DB::table('student_details')->where('user_id', $user->id)->first();

        $brand_ids = DB::table('brands_follows')->where('user_id', Sentry::getUser()->id)->lists('brand_id');

        $suggested_brands = DB::table('brands')->whereNotIn('id', $brand_ids)->orderBy('id', 'desc')->take(4)->get();


        $institution_ids = DB::table('institutions_follows')->where('user_id', Sentry::getUser()->id)->lists('institution_id'); //print_r($brand_ids);exit();

        $institutions = $this->institution->getInstitutionsByIds($institution_ids);

        $suggested_institutions = Institution::whereNotIn('id', $institution_ids)->orderBy('id', 'desc')->take(4)->get();


        $brands = $this->brand->getBrandsByIds($brand_ids);

        return View::make('students.brands')->withUser($user)->withBrands($brands)->withStudent($student_details)->withSuggestedBrands($suggested_brands)->withSuggestedInstitutions($suggested_institutions);
    }

    public function updateColor() {
        $color = Input::get('color');

        $user = Sentry::findUserById(Sentry::getUser()->id);

        DB::table('student_details')->where('user_id', $user->id)->update(['color' => $color]);

        return Redirect::back()->withFlashMessage('Color has been updated successfully!');
    }

    public function UploadProfilePicture() {
        if (Request::ajax()) {
            $id = Sentry::getUser()->id;

            $file = Input::file('profile_image');
            
            // validating each file.
            $rules = array('file' => 'required|image|max:10240');

            $validator = Validator::make(array('file' => $file), $rules);

            if ($validator->passes()) {

                $filename = Str::lower(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension());

                //echo"<pre>";print_r($file);exit();

                $filename = time() . $id . $filename;

                $filename = str_replace(' ', '_', $filename);

                $file->move('uploads/profiles/', $filename);

                $destionation = public_path() . '/uploads/profiles';

                $image = IImage::make(sprintf('uploads/profiles/%s', $filename));

                $image->save($destionation . $filename);

                $this->user->profilePicture($id, $filename);

                return Response::Json(array('success' => true, 'message' => 'Profile Picture updated Successfully')); //->withFlashMessage("Profile Picture updated Successfully");
            } else {

                // redirect back with errors.
                return Response::Json(array('success' => false, 'message' => "The file must be an image")); //->withInput()->withErrors($validator);
            }
        }
    }

    public function profileData() {
        if (Request::ajax()) {

            $user = Sentry::getUser();

            $file = Input::file('upload');

            //$fields        = Input::all();

            $name = Input::get('name');

            $email = Input::get('email');

            if ($file) {
                $rules = array('file' => 'required|image|max:10240');

                $validator = Validator::make(array('file' => $file), $rules);

                if ($validator->passes()) {
                    //echo"<pre>";print_r($file);exit();
                    $filename = Str::lower(
                                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                                    . '.'
                                    . $file->getClientOriginalExtension()
                    );

                    $filename = $user->id . $filename;
                    $filename = str_replace(' ', '_', $filename);


                    $file->move('uploads/profiles/', $filename);

                    $destionation = public_path() . '/uploads/profiles/';

                    $image = IImage::make(sprintf('uploads/profiles/%s', $filename));

                    $image->save($destionation . $filename);

                    $this->user->profilePicture($user->id, $filename);

                    $success = "Profile Picture updated Successfully";

                    return $file;
                } else {
                    // redirect back with errors.
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }

            $studentdetails = $this->student_details->findbyUserId($user->id);

            if ($studentdetails->name != $name) {
                $studentdetails->name = $name;

                $studentdetails->save();
            }
            if ($studentdetails->email != $email) {
                $studentdetails->email = $email;

                $studentdetails->save();
            }

            $studentdetails->course = Input::get('course');

            $studentdetails->interests = Input::get('interests');

            $studentdetails->aboutme = Input::get('aboutme');

            $studentdetails->save();

            $user->mobile = Input::get('phone');

            $user->save();

            return Response::json(array('message' => 'Successfully updated')); //echo"<pre>";print_r($file);exit();
        }
    }

    public function brandData() {
        if (Request::ajax()) {
            $ids = Input::get('ids');

            $user_id = Sentry::getUser()->id;

            $brands_follows = BrandsFollows::where('user_id', $user_id)->delete();

            $user_activity = $this->activity->deleteByTypeAndUserId($user_id, 'brand_follows');

            for ($i = 0; $i < sizeof($ids); $i++) {
                $input = array();

                $brand = Brand::find($ids[$i]);

                $input = array('brand' => $brand->slug, 'brand_id' => $ids[$i], 'user_id' => $user_id);

                $activity = $this->activity->create(array('type' => 'brand_follows', 'brand_id' => $ids[$i], 'user_id' => $user_id));

                $follow_action = $this->brands_follows->create($input);
            }

            $brand_us = Brand::where('slug', 'idoag')->first();

            $brand_follows = $this->brands_follows->create(array('brand' => $brand_us->slug, 'brand_id' => $brand_us->id, 'user_id' => $user_id));

            return Response::json(array(
                        'message' => true)
            );
        }

        return Response::json(array('message' => 'Sorry Please try again.'));
    }

    public function instData() {
        if (Request::ajax()) {
            $ids = Input::get('ids');

            $user_id = Sentry::getUser()->id;

            for ($i = 0; $i < sizeof($ids); $i++) {
                $input = array();

                $institution = InstitutionsFollows::find($ids[$i]);

                $input = array('institution_id' => $ids[$i], 'user_id' => $user_id);

                $activity = $this->activity->create(array('type' => 'inst_follows', 'inst_id' => $ids[$i], 'user_id' => $user_id));

                $follow_action = $this->institution_follows->create($input);
            }

            return Response::json(array(
                        'message' => true)
            );
        }

        return Response::json(array('message' => 'Sorry Please try again.'));
    }

    public function aboutInstitute() {
        $data = Input::all();

        $admin_email = 'info@idoag.com';

        $email = Input::get('stud_email');

        $data['state'] = getCity(Input::get('state'));

        $data['city'] = getState(Input::get('city'));

        // echo "<pre>";print_r($data);exit();

        Mailgun::send('emails.student_reg', $data, function($message) use($data, $admin_email) {
            $message->subject('New Institution Contact by user');

            $message->to($admin_email, $data['name']);
        });

        Mailgun::send('emails.student_register_thankyou', $data, function($message) use($data, $email) {

            $message->subject('Thank You for Submitting your Institution to IDOAG');

            $message->to($email, $data['stud_name']);
        });

        $register = StudentRegistrations::create($data); //$this->register->create($data);
    }

    public function getActivityLog($id) {
        $user = Sentry::findUserById($id);

        $student_details = DB::table('student_details')->where('user_id', Sentry::getUser()->id)->first();

        $brand_ids = DB::table('brands_follows')->where('user_id', Sentry::getUser()->id)->lists('brand_id');

        $brands = $this->brand->getBrandsByIds($brand_ids);

        $suggested_brands = Brand::whereNotIn('id', $brand_ids)->orderBy('id', 'desc')->get();

        $activities = $this->activity->getByUserId($id);

        $this->activity->studentChangeToVisitStatus($id);

        $institution_ids = DB::table('institutions_follows')->where('user_id', Sentry::getUser()->id)->lists('institution_id'); //print_r($brand_ids);exit();

        $suggested_institutions = Institution::whereNotIn('id', $institution_ids)->orderBy('id', 'desc')->take(4)->get();


        return View::make('students.activity')->withSuggestedBrands($suggested_brands)->withStudent($student_details)->withOutput($activities)->withSuggestedInstitutions($suggested_institutions);
    }

    public function changeUserPassword($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            return View::make('students.changepassword')->withUser($user);
        }
    }
    
    public function updatePassword($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            
            $email = Input::get('email');
            $password = Input::get('old_password');
            $newPassword = Input::get('new_password');
            $user1 = User::where('email', $email)->first();
            $check = Hash::check($password, $user1->password);
            
            if(!$check){
                Session::flash('error_message', 'Invalid old password. Please, check and try again');
            }else{
                $password = Input::get('new_password');
                $user->password = $password;
                $user->save();
                Session::flash('flash_message', 'Your password has been changed.');
            }
            return Redirect::route('student_changepassword', $user->id);
        }
    }
    
    public function changePassword() {
        if (Request::ajax()) {
            $email = Input::get('email');

            $password = Input::get('password');

            $user = User::where('email', $email)->first();

            $check = Hash::check($password, $user->password);

            if ($check) {
                return Response::Json(array('valid' => true, 'message' => 'Correct password'));
            } else {
                return Response::Json(array('valid' => false, 'message' => 'Please enter correct Password.'));
            }
        }
    }

    public function userPasswordChange() {
        if (Request::ajax()) {
            $email = Input::get('email_password');

            $user = $this->user->findByEmail($email);

            $password = Input::get('new_password');

            // echo"<pre>";print_r(Input::all());exit();

            $user->password = $password;

            $user->save();

            return "Your password has been changed successfully";
        }
    }

    public function getStudentRegister() {
        return view::make('pages.student_register');
    }

    public function lostcard() {
        if (Sentry::check() && Sentry::getUser()->getGroups()->first()->name == "Students") {
            return Redirect::route('applycard');
        } else {
            Session::put('lostcard', '1');
            return View::make('students.lostcard_guest');
        }
    }

    public function applycard() {
        if(Sentry::check()){
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($loggedin_user);
            $student_details = DB::table('student_details')->where('user_id', $loggedin_user)->first();
            return View::make('students.lostcard')->withUser($user)->withStudent($student_details);
        }else{
            return Redirect::route('home');
        }
    }

    public function cardRecoverIssue() {

        $data = Input::only('name', 'college', 'roll_number', 'dob', 'card_number', 'message');
        $admin = 'info@idoag.com';
        Mailgun::send('emails.admin_recover_card_issue', $data, function($message) use($data, $admin) {
            $message->subject('Recover Card Issue');
            $message->to($admin, 'Admin');
        });
        return Response::json(array('error' => 'false', 'message' => 'We will check and get back to you as soon as we can'));
    }

    public function CheckPinCode() {
        $pincode = Input::get('pincode');
        $pin = $this->pincode->getByPincode($pincode);

        if ($pin)
            return Response::json(array('data' => 'Delivery Available at pincode ' . $pincode, 'status' => '1'));
        else
            return Response::json(array('data' => 'Not available for delivery at your location yet (' . $pincode . ')', 'status' => '0'));
    }

    public function CheckCardCoupon() {
        $coupon = $this->cardcoupon->getByCouponCode(Input::get('coupon'));
        if ($coupon) {
            $price = 100;
            $shipping = 40;
            if ($coupon->type == 'percentage') {
                $couponamount = $price * $coupon->value / 100;
            } else if ($coupon->type == 'fixed') {
                $couponamount = $price + $shipping - $coupon->value;
            } else {
                $couponamount = $coupon->value;
            }

            return Response::json(array('data' => 'Coupon Applied Successfully. Rs.' . $couponamount . ' discount applied.', 'status' => '1', 'amount' => $couponamount));
        } else
            return Response::json(array('data' => 'Invalid Coupon', 'status' => '0'));
    }
    
    public function getEducationalDetails($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            
            if ($loggedin_user == $id) {
                $student_details = DB::table('student_details')->where('user_id', $id)->first();

                return View::make('students.education_details')
                        ->withUser($user)
                        ->withStudent($student_details);
            } else {
                return Redirect::route('home');
            }
        }
    }
    
    public function getWorkSamples($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            
            if ($loggedin_user == $id) {
                $student_details = DB::table('student_details')->where('user_id', $id)->first();

                return View::make('students.work_samples')
                        ->withUser($user)
                        ->withStudent($student_details);
            } else {
                return Redirect::route('home');
            }
        }
    }
    public function postWorkSamples($id){
        $data = array('work_samples' => json_encode(Input::except('_token')));
        $student_details = $this->student_details->findbyUserId($id);
        $student_details->fill($data)->save();
        return Redirect::back()->withFlashMessage('Updated details Successfully');
    }
    
    public function getAdditionalDetails($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            
            if ($loggedin_user == $id) {
                $student_details = DB::table('student_details')->where('user_id', $id)->first();

                return View::make('students.additional_details')
                        ->withUser($user)
                        ->withStudent($student_details);
            } else {
                return Redirect::route('home');
            }
        }
    }
    
    public function postAdditionalDetails($id){
        $data = array('additional_details' => json_encode(Input::except('_token')));
        $student_details = $this->student_details->findbyUserId($id);
        $student_details->fill($data)->save();
        return Redirect::back()->withFlashMessage('Updated details Successfully');
    }
    
    public function getProfessionalDetails($id){
        if (Sentry::check()) {
            $loggedin_user = Sentry::getUser()->id;
            $user = Sentry::findUserById($id);
            
            if ($loggedin_user == $id) {
                $student_details = DB::table('student_details')->where('user_id', $id)->first();

                return View::make('students.professional_details')
                        ->withUser($user)
                        ->withStudent($student_details);
            } else {
                return Redirect::route('home');
            }
        }
    }
    
    public function postProfessionalDetails($id){
        $data = array('project_details' => json_encode(Input::except('_token')));        
        $student_details = $this->student_details->findbyUserId($id);
        $student_details->fill($data)->save();
        return Redirect::back()->withFlashMessage('Updated details Successfully');
    }
    
    public function getWishlist(){
        
        if(Sentry::check()){
            $loggedin_user = Sentry::getUser()->id;            
            $data = DB::table('posts_likes')->join('posts', 'posts_likes.post_id', '=', 'posts.id')->select('posts.*')->where('posts_likes.user_id', $loggedin_user)->orderBy('posts_likes.updated_at', 'desc')->paginate(50);
            
            $trending_offers = $this->post->getTrendingPostsType("offer");
            
            return View::make('pages.wishlist')
                    ->withOffers($data)
                    ->withTrendingOffers($trending_offers);
        }
    }

}
