<?php

use idoag\Forms\ForgotPasswordForm;

class RemindersController extends Controller {

	/**
	 * @var forgotPasswordForm
	 */
	private $forgotPasswordForm;

	function __construct(ForgotPasswordForm $forgotPasswordForm)
	{
		$this->forgotPasswordForm = $forgotPasswordForm;
	}

	// route to show resend confirmation form
	public function getResendConfirmation()
	{
		return View::make('reminders.resend_confirmation');
	}
	
	// route to process resend confirmation form
	public function postResendConfirmation()
	{
		$input 	= Input::all();
		
		$user 	= User::where('email', Input::get('email'))->first();
		
		if(isset($user) && $user->activated == 0)
		{
			$data = array();
		
			$data['token'] = base64_encode($user->email);
			
			Mailgun::send('emails.activate', $data, function($message) use($user)
			{
				$message->subject('Activate your Idoag Account');
				$message->to($user->email, $user->first_name);
				
			}); 
			
		} else {
			
			return Redirect::back()->withErrorMessage(' Either User already confirmed or User not registered to the platform');
			
		}
		
	}

        public function getLogin()
        {
                return View::make('reminders.trouble_login');
        }
	
	// route to show forgot password form
	public function getRemind()
	{
		return View::make('reminders.forgot_password');
	}
	
	// method to process forgot password action
	public function postRemind()
	{
		$this->forgotPasswordForm->validate(Input::only('email'));

		// $data = Sentry::findUserByLogin(Input::only('email'));
		// echo "<pre>";print_r(Input::only('email'));exit();
		$email = Input::get('email'); 

		try
		{
		    // Find the user using the user email address

		    $user = Sentry::findUserByLogin($email);

		    // Get the password reset code
		    $resetCode = $user->getResetPasswordCode();

            $data = array();

            $data['token']          = $resetCode;
            $data['first_name']     = $user->first_name;

            Mailgun::send('emails.auth.reminder', $data, function ($message) use ($email) {
            	$message->subject('Reset password of your Idoag account!');
            	$message->to($email);
            });
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::back()->withErrorMessage("We can't find a user with that e-mail address.");
		}

		return Redirect::back()->withFlashMessage("We have sent an email to your email id. Please follow instructions to reset your password");
		// switch ($response = Password::remind(Input::only('email'), function($message) {
			
		// 		$message->subject('Reset password of your Idoag account!'); 
				
		// 	}))
		// {
			
		// 	case Password::INVALID_USER:
		// 		return Redirect::back()->withErrorMessage(Lang::get($response));

		// 	case Password::REMINDER_SENT:
		// 		return Redirect::back()->withFlashMessage(Lang::get($response));
		// }

	}

	// route to show reset password form
	public function getReset($token = null)
	{ 		
		if (is_null($token)) App::abort(404);
		
		$user = Sentry::findUserByResetPasswordCode($token);
		
		if($user)
		{
			Session::put('resetToken', $token);
		
			return View::make('reminders.reset_password')->withUser($user);
		}
		else
		{
			return Redirect::to('/')->withFlashMessage("The given link has Expired.");
		}
	}

	//route to process reset password form
	public function postReset()
	{
		$credentials = Input::only('email', 'password', 'password_confirmation', 'token'); //dd($credentials);

		$new_password = Input::get('password');

		$token = Input::get('token');
		try
		{
		    // Find the user using the user token
		    $user = Sentry::findUserByResetPasswordCode($token);

		    // Check if the reset password code is valid
		    if ($user)
		    {
		        // Attempt to reset the user password
		        if ($user->attemptResetPassword($token, $new_password))
		        {
		            return Redirect::to('/')->withFlashMessage('Password has been reset successfully!');
		        }
		        else
		        {
		            return Redirect::to('/')->withErrorMessage('Something went wrong! Please try again.');
		        }
		    }
		    else
		    {
		        return Redirect::to('/')->withFlashMessage("The given link has Expired.");
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::back()->withErrorMessage("We can't find a user with that e-mail address.");
		}

		
		// $response = Password::reset($credentials, function($user, $password)
		// {
		// 	$user->password = $password; //Hash::make($password);

		// 	if($user->old_password)
		// 	{
		// 		$user->old_password = NULL;

		// 		$user->activated = 1;
		// 	}

		// 	$user->save();
		// });

		// switch ($response)
		// {
		// 	case Password::INVALID_PASSWORD: 

		// 	case Password::INVALID_TOKEN:

		// 	case Password::INVALID_USER:
							
		// 		return Redirect::back()->withErrorMessage(Lang::get($response))->withInput();

		// 	case Password::PASSWORD_RESET:

		// 		return Redirect::to('/')->withFlashMessage('Password has been reset successfully!');
		// }
	}
}
