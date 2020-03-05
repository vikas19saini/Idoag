<?php

use idoag\Forms\LoginForm;
use Laracasts\Validation\FormValidationException;
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Student\StudentRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;

class SessionsController extends \BaseController {

	/**
	 * @var $loginForm 
	 *
	 */
	protected $loginForm;
	
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
	 * @var $student 
	 *
	 */
	protected $student;
	
	/**
	 * SessionsController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, LoginForm $loginForm, BrandRepositoryInterface $brand, StudentRepositoryInterface $student, StudentDetailsRepositoryInterface $student_details)
	{
		$this->user 				= $user;
		
		$this->brand 				= $brand;

		$this->student 				= $student;

		$this->student_details 		= $student_details;
		
		$this->loginForm 			= $loginForm;
		
		}
	
	// route to show login form
	public function create()
	{
 
		if(Sentry::check())
		{
			$user 			= Sentry::getUser();
			$admin 			= Sentry::findGroupByName('Admins');
	    	$students 		= Sentry::findGroupByName('Students');
			$brands 		= Sentry::findGroupByName('Brands');
			$institutions 	= Sentry::findGroupByName('Institutions');
			
			if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');
		
	    	elseif ($user->inGroup($students)) return Redirect::intended();
			elseif ($user->inGroup($brands)) 
			{
				$brand = $this->brand->find($user->brand_id);
				
				return Redirect::route('brand_profile', array($brand->slug));
			}
			elseif ($user->inGroup($institutions)) 
			{
				$institution = $this->institution->find($user->institution_id);
				return Redirect::route('institution_profile',array($institution->slug));
			}
		}

		
		return View::make('sessions.login'); 
	}


	
	// processing login form
	public function store()
	{		
		$email = Input::get('email');

		$user  = $this->user->findByEmail($email);	//echo"<pre>";print_r($user);exit();

		if(!(isset($user)))
		{
			return Redirect::back()->withErrorMessage('Given Username and Password do not match.');		
		}

        if($user->last_login==NULL)
        {    
            Session::put('isfirstlogin','1');
        } 
		if($user->old_password)
		{
			$password = base64_encode(Input::get('password'));

			if($user->old_password == $password)
			{	
				$token = $user->reset_password_code;  
				if(!$token)
				{

					$user->reset_password_code = str_random('40');
					$user->save();
					$token=$user->reset_password_code;
				} 
 				return $this->getNewPassword($token);
			}
			else
			{
				return Redirect::back()->withErrorMessage('Given Username and Password do not match.');
			}
		}
		else
		{
			$input = Input::only('email', 'password');

			$password = Hash::make(Input::get('password'));			

			/* Validate User Information using Validation rules */
			try
			{
				$this->loginForm->validate($input = Input::only('email', 'password'));

				Sentry::authenticate($input,false);

			}
			catch (\Laracasts\Validation\FormValidationException $e) 
			{
				return Redirect::back()->withInput(Input::only('email'))->withErrors($e->getErrors());
				
			}catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('Login field is required');
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
				return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('Password field is required.');
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
				return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('Wrong password, try again.');
			}catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
			{ 
			   	return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('You are not registered with us. Please activate your IDOAG card to create your account.');
				
			}catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			   	return Redirect::back()->withInput(Input::only('email'))->withErrorMessage(' You have activated your card but not verified the email-id. Click on link that was sent to you on this email :'.Input::get('email'));
			}
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{ 
			    return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('User is suspended.');
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
			    return Redirect::back()->withInput(Input::only('email'))->withErrorMessage('User is banned.');
			}
			
			/* Successful loggedin User will be redirected based on the type of User */
			$user 			= Sentry::getUser();
			$admin 			= Sentry::findGroupByName('Admins');
		    $students 		= Sentry::findGroupByName('Students');
			$brands 		= Sentry::findGroupByName('Brands');
			$institutions 	= Sentry::findGroupByName('Institutions');
			
			if (Input::get('url')) {
				return Redirect::to(Input::get('url'));
			}
			if (Session::get('redirect')) {
				return Redirect::to(Session::get('redirect'));
			}
		    if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');
			
		    elseif ($user->inGroup($students)) {

		    	Session::put('popup_first','1');
				return Redirect::route('student_dashboard');
		    }
			elseif ($user->inGroup($brands)) 
			{
				$brand = $this->brand->find($user->brand_id);
				return Redirect::route('brand_profile', array($brand->slug));
			}
			elseif ($user->inGroup($institutions))
	        {
	            $institution = Institution::find($user->institution_id);

	            return Redirect::route('institution_profile', array($institution->slug));
	        }
	    }
	}

	// processing logout request
	public function destroy($id = null)
	{
		Sentry::logout();

		return Redirect::route('home');
	}
	
	// route to verify users via email
	public function getVerified($token)
	{	
		try
		{
		    $user = Sentry::findUserByActivationCode($token);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::route('home')->withFlashMessage('This Account has been Activated.');
		}
		if($user)
		{	
			$user->activated = 1; 
			$user->activation_code = NULL;
			$user->save();

			$data['first_name'] 	= $user->first_name;
			$data['card_number']	= $user->card_number;
			$data['expiry'] 		= $user->expiry_date;
			$data['institution']  	= $user->institution;

			Mailgun::send('emails.welcome_student_user', $data, function($message) use($user)
	        {
	            $message->subject('Welcome');
	            $message->to($user->email, $user->first_name);
	            
	        });
		         			
			return Redirect::route('home')->withFlashMessage('Congratulations!! You have successfully activated your account. Please logon with your email id.');
			
		}else {
			
			return Redirect::route('home')->withErrorMessage('Verification Failed. Please check your email again');
			
		}
		
	}
	
	// route to verify users via email for Email change
	public function getVerifiedEmail($token)
	{		
		$user = Sentry::findUserByActivationCode($token);

		$student_details = $this->student_details->findbyUserId($user->id);

		$email = $student_details->email;

		if($user->email !== $email)
		{
			$user->email = $email;

			$user->activated = 1;

			$user->save();

			$data['card_number'] 	= $user->card_number;
			$data['expiry'] 		= $user->expiry_date;
			$data['institution'] 	= $user->institution;
			$data['first_name'] 	= $user->first_name;

			Mailgun::send('emails.welcome_student_user', $data, function($message) use($user)
	        {
	            $message->subject('Welcome');
	            $message->to($user->email, $user->first_name);
	            
	        });

			return Redirect::route('home')->withFlashMessage('Verification Successful. Please login with you New Email.');
		}
		else 
		{
			return Redirect::route('home')->withErrorMessage('Your Email has already been Verified.');			
		}
		
	}	

	public function getNewPassword($token)
	{ 			
		try
		{
		    $user = Sentry::findUserByResetPasswordCode($token);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return  Redirect::route('home')->withErrorMessage('The link is expired. Please try again');
		}
						
		// if($user->activated == 0)
		
			return View::make('reminders.create_password')->withUser($user);

		// else

		// 	return  Redirect::route('home')->withFlashMessage('Congratulations !! You have successfully activated your account. Please Login to access your account.');
	
	}

	//route to process reset password form
	public function postNewPassword()
	{
		$credentials = Input::only('email', 'password', 'password_confirmation'); //dd($credentials);

		// $user = $this->user->findByEmail(Input::get('email'));

		$user = Sentry::findUserByLogin(Input::get('email'));

		$students = Sentry::findGroupByName('Students');

		$brands = Sentry::findGroupByName('Brands');

        $institutions = Sentry::findGroupByName('Institutions');

		if($user)
		{		
			$user->password = Input::get('password'); //Hash::make($password);

			$user->activated = 1;

			$user->reset_password_code = NULL;

			if($user->old_password)
			{
				$user->old_password = NULL;
			}

			$user->save();

			if ($user->inGroup($students))
			{
				$student_details = $this->student_details->findByEmail($user->email);

				$data = array('first_name'=>$user->first_name, 'card_number'=>$user->card_number, 'expiry' => $student_details->expiry, 'institution' =>$user->institution);

			}	
			elseif ($user->inGroup($brands))
			{
				$data = array('first_name'=>$user->first_name);

				Mailgun::send('emails.welcome_brand_user', $data, function($message) use($user)
		         {
		            $message->subject('Welcome');

		            $message->to($user->email, $user->first_name);
		            
		         });
			}

            elseif ($user->inGroup($institutions))
            {
                $data = array('first_name'=>$user->first_name);

                Mailgun::send('emails.welcome_institution_user', $data, function($message) use($user)
                {
                    $message->subject('Welcome');

                    $message->to($user->email, $user->first_name);

                });
            }

			return  Redirect::route('home')->withFlashMessage('Your account is Active. Please login to access your account');
		}
		else
		{
			return  Redirect::route('home')->withFlashMessage('User with this Email not found.');
		}
	
	}

	// route to process facebook login
	public function loginWithFacebook() {
	
		// get data from input
		$code 	= Input::get( 'code' );
	
		// get fb service
		$fb 	= OAuth::consumer( 'Facebook' );
	
		// check if code is valid
	
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {
	
			// This was a callback request from facebook, get the token
			$token 		= $fb->requestAccessToken( $code );
	
			// Send a request with it
			$result 	= json_decode( $fb->request( '/me?fields=name,email,id'), true );

			$email 				= $result['email'];

			$user 				= $this->user->findByEmail($email);

			if($user)
			{
				if($user->card_number)
				{
					DB::table('users')->where('id', '=', $user->id)->update(array('faebook_id' => $result["id"],'activated' => 1));
				
					$user = $this->user->findByEmail($email);				

					//echo"<pre>";print_r($user);exit();

					Sentry::login($user, false);	
			
					$user 			= Sentry::getUser();

                    if(Session::has('lostcard'))
                    {
                        return Redirect::route('applycard');
                    }

					$admin 			= Sentry::findGroupByName('Admins');
					$students 		= Sentry::findGroupByName('Students');
					$brands 		= Sentry::findGroupByName('Brands');
					$institutions 	= Sentry::findGroupByName('Institutions');
					
					if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');
					
					elseif ($user->inGroup($students)) 
					{
						Session::put('popup_first','1');
						return Redirect::route('student_dashboard');
					}
					elseif ($user->inGroup($brands)) 
					{
						$brand = $this->brand->find($user->brand_id);
						return Redirect::route('brand_profile', array($brand->slug));
					}
					elseif ($user->inGroup($institutions))
			        {
			            $institution = Institution::find($user->institution_id);

			            return Redirect::route('institution_profile', array($institution->slug));
			        }				
			    }
				else
				{
					Sentry::login($user, false);	
					//echo"hi<pre>$email";print_r($user);exit();
					$user 			= Sentry::getUser();
					$admin 			= Sentry::findGroupByName('Admins');
					$brands 		= Sentry::findGroupByName('Brands');
					$institutions 	= Sentry::findGroupByName('Institutions');

					if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');

					elseif ($user->inGroup($brands)) 
					{
						$brand = $this->brand->find($user->brand_id);
						return Redirect::route('brand_profile', array($brand->slug));
					}
					elseif ($user->inGroup($institutions))
			        {
			            $institution = Institution::find($user->institution_id);

			            return Redirect::route('institution_profile', array($institution->slug));
			        }				
			    }
			}
			else if(Session::has('card_number'))
			{
				$name 				= explode(' ',$result['name'], 2);

				if(count($name) > 1)
				{
					$first_name 	= $name[0];
					$last_name 		= $name[1]; 
				}
				else
				{
					$first_name 	= $name[0];
					$last_name 		=  "";
				}

				$student_data 		= array();

				$card_number 		= Session::get('card_number');

				$user        = $this->user->findByCardNumber($card_number);

		        if($user)
		        return Redirect::intended()->withErrorMessage('This card number is already active. Please logon with your user id or recheck the entered details');

				$student  			= $this->student->findByCardNumber($card_number);

				$dob 				= $student->dob;

				$institution  		= DB::table('institutions')->where('id',$student->college_id)->first();			

				$input = array(
					'email' 		=> $result['email'],
					'first_name' 	=> $first_name,
					'last_name' 	=> $last_name,
					'institution' 	=> $institution->name,
					'activated' 	=> true,
					'card_number' 	=> $card_number,
					'password' 		=> Hash::make($result['id']),
					'expiry_date'   => $student['expiry_date'],
					'faebook_id' 	=> $result['id']
				);
		
				$user 			= $this->user->create($input);

				// Find the group using the group name
				$usersGroup = Sentry::findGroupByName('Students');
		
				// Assign the group to the user
				$user->addGroup($usersGroup);	
				
				$student_data 	= array_add($student_data,'user_id',$user->id);
				$student_data 	= array_add($student_data,'name',$input['first_name']." ".$input['last_name']);
				$student_data 	= array_add($student_data,'email',$input['email']);
				$student_data 	= array_add($student_data,'institution',$input['institution']);
                                $student_data   = array_add($student_data,'institution_id',$student['college_id']);
                                $student_data   = array_add($student_data,'course',$student['streamorcourse']);
                                $student_data   = array_add($student_data,'roll_no',$student['rollno']);				
				$student_data 	= array_add($student_data,'card_number',$input['card_number']);
                                $student_data   = array_add($student_data,'color','#5dc1d8');
				$student_data 	= array_add($student_data,'dob',$dob);
                                $student_data   = array_add($student_data,'expiry',$student['expiry_date']);
				$student_data  = array_add($student_data,'validity_for_how_many_years',$student['validity_for_how_many_years']);
				$student_data  = array_add($student_data,'cluborgrouporsociety',$student['cluborgrouporsociety']);
				$student_data  = array_add($student_data,'residentordayscholar',$student['residentordayscholar']);
				$student_data  = array_add($student_data,'date_of_issue',$student['date_of_issue']);
				$student_data  = array_add($student_data,'section',$student['section']);
				$student_data  = array_add($student_data,'father_name',$student['father_name']);
				$student_data  = array_add($student_data,'batch_year',$student['batch_year']);
				$student_data  = array_add($student_data,'program_duration',$student['program_duration']);

				$studentdetails = $this->student_details->create($student_data);

				if($studentdetails)
				{         
					$student->status = 1;

					$student->save();

					$data['card_number'] 	= $user->card_number;
					$data['expiry'] 		= $user->expiry_date;
					$data['institution'] 	= $user->institution;
					$data['first_name'] 	= $user->first_name;

					Mailgun::send('emails.welcome_student_user', $data, function($message) use($user)
			        {
			            $message->subject('Welcome');
			            $message->to($user->email, $user->first_name);
			            
			        });
 
				}

				Sentry::login($user, false);
				
				$user 			= Sentry::getUser();
				$admin 			= Sentry::findGroupByName('Admins');
				$students 		= Sentry::findGroupByName('Students');
				$brands 		= Sentry::findGroupByName('Brands');
				$institutions 	= Sentry::findGroupByName('Institutions');
				
				Session::forget('card_number');

				if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');
				
				elseif ($user->inGroup($students)) 
				{
					Session::put('popup_first','1');
					return Redirect::route('student_dashboard');
				}
				elseif ($user->inGroup($brands)) 
				{
					$brand = $this->brand->find($user->brand_id);
					return Redirect::route('brand_profile', array($brand->slug));
				}
				elseif ($user->inGroup($institutions))
		        {
		            $institution = Institution::find($user->institution_id);

		            return Redirect::route('institution_profile', array($institution->slug));
		        }		
		    }
			else
			{
				return Redirect::route('home')->withErrorMessage('Please Contact idoag for cardnumber');
			}		
		}
		// if not ask for permission first
		else {
			// get fb authorization
			$url = $fb->getAuthorizationUri();
	
			// return to facebook login url
			 return Redirect::to( (string)$url );
		}
	
	}

	// route to process Google login
	public function loginWithGoogle() {		
		//get data from input
		$code = Input::get( 'code' );                
		$OAuth = new OAuth(); $OAuth::setHttpClient('CurlClient');
		$googleService = OAuth::consumer( 'Google' );	
		// check if code is valid	
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {	
			// This was a callback request from google, get the token
			$token = $googleService->requestAccessToken( $code );	
			// Send a request with it
			$result 			= json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

			$email 				= $result['email'];

			$user 				= $this->user->findByEmail($email);

			if($user)
			{
				if($user->card_number)
				{
					DB::table('users')->where('id', '=', $user->id)->update(array('google_id' => $result["id"],'activated' => 1));

					$user = $this->user->findByEmail($email);				
				
					Sentry::login($user, false);	
					
					$user 			= Sentry::getUser();
					$admin 			= Sentry::findGroupByName('Admins');
					$students 		= Sentry::findGroupByName('Students');
					$brands 		= Sentry::findGroupByName('Brands');
					$institutions 	= Sentry::findGroupByName('Institutions');

                    if(Session::has('lostcard'))
                    {
                        return Redirect::route('applycard');
                    }
					
					if ($user->inGroup($admin)) return Redirect::route('admin_dashboard'); 
					elseif ($user->inGroup($students)) 
					{
						Session::put('popup_first','1');						
						return Redirect::route('student_dashboard');
					}
					elseif ($user->inGroup($brands)) 
					{
						$brand = $this->brand->find($user->brand_id);
						return Redirect::route('brand_profile', array($brand->slug));
					}
					elseif ($user->inGroup($institutions))
			        {
			            $institution = Institution::find($user->institution_id);

			            return Redirect::route('institution_profile', array($institution->slug));
			        }				
    			}
				else
				{
					Sentry::login($user, false);	
					
					$user 			= Sentry::getUser();
					$admin 			= Sentry::findGroupByName('Admins');
					$brands 		= Sentry::findGroupByName('Brands');
					$institutions 	= Sentry::findGroupByName('Institutions');

					if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');

					elseif ($user->inGroup($brands)) 
					{
						$brand = $this->brand->find($user->brand_id);
						return Redirect::route('brand_profile', array($brand->slug));
					}
					elseif ($user->inGroup($institutions))
			        {
			            $institution = Institution::find($user->institution_id);

			            return Redirect::route('institution_profile', array($institution->slug));
			        }				
			    }
						
			}
			else if(Session::has('card_number'))
			{
				$student_data 		= array();

				$card_number 		= Session::get('card_number');

				$user        = $this->user->findByCardNumber($card_number);

		        if($user)
		        return Redirect::intended()->withErrorMessage('You have already activated your card. Please login with your email id and password.');

				$student  			= $this->student->findByCardNumber($card_number);

				$dob 				= $student->dob;

				$institution  		= DB::table('institutions')->where('id',$student->college_id)->first();			

				$input = array(
					'email' 		=> $result['email'],
					'first_name' 	=> $result['given_name'],
					'last_name' 	=> $result['family_name'],
					'institution' 	=> $institution->name,
					'activated' 	=> true,
					'card_number' 	=> $card_number,
					'password' 		=> Hash::make($result['id']),
					'expiry_date'   => $student['expiry_date'],
					'google_id' 	=> $result['id']
				);
		
				$user 			= $this->user->create($input);

				//Find the group using the group name
				$usersGroup = Sentry::findGroupByName('Students');
		
				// Assign the group to the user
				$user->addGroup($usersGroup);
				
				$student_data  = array_add($student_data,'user_id',$user->id);
				$student_data  = array_add($student_data,'name',$input['first_name']." ".$input['last_name']);
				$student_data  = array_add($student_data,'email',$input['email']);
				$student_data  = array_add($student_data,'institution',$input['institution']);
                                $student_data  = array_add($student_data,'institution_id',$student['college_id']);
                                $student_data  = array_add($student_data,'course',$student['streamorcourse']);
                                $student_data  = array_add($student_data,'roll_no',$student['rollno']);				
				$student_data  = array_add($student_data,'card_number',$input['card_number']);
                                $student_data  = array_add($student_data,'color','#5dc1d8');
				$student_data  = array_add($student_data,'dob',$dob);
                                $student_data  = array_add($student_data,'expiry',$student['expiry_date']);
				$student_data  = array_add($student_data,'validity_for_how_many_years',$student['validity_for_how_many_years']);
				$student_data  = array_add($student_data,'cluborgrouporsociety',$student['cluborgrouporsociety']);
				$student_data  = array_add($student_data,'residentordayscholar',$student['residentordayscholar']);
				$student_data  = array_add($student_data,'date_of_issue',$student['date_of_issue']);
				$student_data  = array_add($student_data,'section',$student['section']);
				$student_data  = array_add($student_data,'father_name',$student['father_name']);
				$student_data  = array_add($student_data,'batch_year',$student['batch_year']);
				$student_data  = array_add($student_data,'program_duration',$student['program_duration']);
				$studentdetails = $this->student_details->create($student_data);

				if($studentdetails)
				{         
					$student->status = 1;

					$student->save();

					$data['card_number'] 	= $user->card_number;
					$data['expiry'] 		= $user->expiry_date;
					$data['institution'] 	= $user->institution;
					$data['first_name'] 	= $user->first_name;

					Mailgun::send('emails.welcome_student_user', $data, function($message) use($user)
			        {
			            $message->subject('Welcome');
			            $message->to($user->email, $user->first_name);
			            
			        });
				}
			
				Sentry::login($user, false);
				
				$user 			= Sentry::getUser();
				$admin 			= Sentry::findGroupByName('Admins');
				$students 		= Sentry::findGroupByName('Students');
				$brands 		= Sentry::findGroupByName('Brands');
				$institutions 	= Sentry::findGroupByName('Institutions');
				
				Session::forget('card_number');

				if ($user->inGroup($admin)) return Redirect::route('admin_dashboard');
				
				elseif ($user->inGroup($students)) 
				{
					Session::put('popup_first','1');
					return Redirect::route('student_dashboard');
				}
				elseif ($user->inGroup($brands)) 
				{
					$brand = $this->brand->find($user->brand_id);
					return Redirect::route('brand_profile', array($brand->slug));
				}
				elseif ($user->inGroup($institutions))
		        {
		            $institution = Institution::find($user->institution_id);

		            return Redirect::route('institution_profile', array($institution->slug));
		        }	
		    }
			else
			{
				return Redirect::route('home')->withErrorMessage('Please Contact idoag for cardnumber');
			}
		}
		// if not ask for permission first
		else {
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();
	
			// return to google login url
			return Redirect::to( (string)$url );
		}
	
	}
	
}