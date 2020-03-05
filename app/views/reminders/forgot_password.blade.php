@extends('layouts.default')

@section('title','Forget Password - retrieve your password on idoag |idoag.com')

@section('metatags')
    <meta name="keywords" content="Forget Password - retrieve your password on idoag |idoag.com" />
    <meta name="description" content="Forget Password - retrieve your password on idoag |idoag.com" />

@stop

@section('classtitle','forgotpassword_bg')

@section('css')
<style>
    .main-footer-wrapper{
        position:fixed;
    }
</style>
	{{ HTML::style('assets/plugins/iCheck/square/blue.css') }}
    
@stop

@section('content')
	
    <!-- Content Start Here -->
	<div class="wrapper">
  	
    	<!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        <div class="forgotpassword_info">
            
            <div class="log_for_chan_info">
              
              	<h4>Forgot your password?</h4>
              
              	<p> It’s a fickle world we live in. You’ve forgotten the idoag
                	password? No worries, we’re here to help. Just tell us
                	your email address and we’ll send a special someone
                	with a link to changing your password. </p>
              

                
                    {{ Form::open(['route' => 'post_forgot_password', 'class'=>'form-group','id' => 'forgot-password-form']) }}
                      
                      <div class="form-group">

                        {{ Form::email('email', null, ['placeholder' => 'Email Address', 'class' => 'forgot_input', 'required' => 'required', 'autocomplete' => 'off']) }}
                                
                        {{ errors_for('email', $errors) }}

                      </div>

                      <div class="form-group">

                        <div class="login_submit">
                        
                            {{ Form::submit('Send Password Change Request') }}
                        
                        </div>
                                      
                      </div>

              		{{ Form::close() }}
            
            	</div>
          
          	</div>
        
        </div>

        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->
    
@stop

@section('js')

        
@stop
