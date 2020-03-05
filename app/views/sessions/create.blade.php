@extends('admin.layouts.default')

@section('title','Idoag.com | Login')

@section('class', 'login-page')

@section('css')

	{{ HTML::style('assets/plugins/iCheck/square/blue.css') }}
    
@stop

@section('content')

	<div class="login-box">
      
      <div class="login-logo">
        
        	<a href="{{ URL::route('home') }}"><b>Idoag</b></a>
      
      </div><!-- /.login-logo -->
      
      <div class="login-box-body">
        	
            <p class="login-box-msg">Sign in to start your session</p>
        	
            @if (Session::has('error_message'))
                        
               <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    
                    <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                    
                    {{ Session::get('error_message') }}
                        
                </div>
                  
            @endif
            
            @if (Session::has('flash_message'))
                    
               <div class="alert alert-success">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    
                    <h4><i class="icon fa fa-check"></i> Yay!</h4>
                    
                    {{ Session::get('flash_message') }}
                        
                </div>
                
            @endif
                        
        	{{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}
          
          		<div class="form-group has-feedback">
            
            		{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) }}
                            
                    {{ errors_for('email', $errors) }}
          		
                </div>
          
          		<div class="form-group has-feedback">
            
            		{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) }}
                                    
                    {{ errors_for('password', $errors) }}
          		
                </div>
          
          		<div class="row">
            
            		<div class="col-xs-8">    
              
              			<div class="checkbox icheck">
                
                			<label>
                  
                  				<input name="remember" type="checkbox" value="true"> Remember Me
                			
                            </label>
              			
                        </div>                        
            		
                    </div><!-- /.col -->
            
            		<div class="col-xs-4">
              			
                        {{ Form::submit('Sign In', ['class' => 'btn btn-primary btn-block btn-flat']) }}
                                    
            		</div><!-- /.col -->
          
          		</div>
        
        	{{ Form::close() }}
        
        	<div class="social-auth-links text-center">
          
          		<p>- OR -</p>
          
          		<a href="{{ URL::to('facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          
          		<a href="{{ URL::to('google') }}" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        
        	</div><!-- /.social-auth-links -->

        	<div class="text-center"><a href="{{ URL::to('forgot_password') }}">I forgot my password</a></div><br>
        
        	<div class="text-center"><a href="{{ URL::route('resend_confirmation') }}" class="text-center">Resend Verification Email</a></div>

      	</div><!-- /.login-box-body -->
    
    </div>
    <!-- /.login-box -->
    
@stop

@section('js')
	
    {{ HTML::script('assets/plugins/iCheck/icheck.min.js') }}
    
    <script>
	
      $(document).ready(function(e) {
        
		/* Checkbox intialization code */
		 $('input').iCheck({
          
		  checkboxClass: 'icheckbox_square-blue',
          
		  radioClass: 'iradio_square-blue',
          
		  increaseArea: '20%' // optional
        
		});
		
		/* Login Form Validation Code Start Here */
			
		$('#login-form').formValidation({
        
			framework: 'bootstrap',
			
			icon: {
				
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			
			trigger: 'change',
								
			fields: {
				
				email: {
			
					validators: {
						
						notEmpty: {
							
							message: 'The email input is required and cannot be empty'
							
						},
						
						regexp: {
							
							regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
							
							message: 'The email input is not a valid email address'
							
						}
			
					}
				},
				
				password: {
											
					validators: {
						
						notEmpty: {
							
							message: 'The password is required and cannot be empty'
							
						},
						
						stringLength: {
							
							min: 5,
							
							message: 'The password must be at least minimum 5 characters'
							
						}
						
					}
					
				}
					
			}
				
		});
		
		/* Login Form Validation Code Ends Here */
		
    });
    
    </script>
    
@stop
