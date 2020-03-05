@extends('layouts.default')

@section('title','Retrieve Email - retrieve your email on idoag |idoag.com')

@section('metatags')
    <meta name="keywords" content="Retrieve Email - retrieve your email on idoag |idoag.com" />
    <meta name="description" content="Retrieve Email - retrieve your email on idoag |idoag.com" />

@stop

@section('classtitle','forgotpassword_bg')

@section('css')

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
              
              	<h4>Forgotten your Email? / Change your Email if you've entered a wrong one?</h4>
              
              	<p> It’s a fickle world we live in. You’ve forgotten the idoag
                	email or entered an incorrect one? No worries, we're here to help. Just tell us
                	your Idoag Card and Date of Birth and you can change your email address.</p>
              

                
                    {{ Form::open(['route' => 'student_card_check', 'class'=>'form-group','id' => 'trouble-login-form']) }}
                      
                      <div class="form-group">

                        {{ Form::text('card_number', null, ['placeholder' => 'idoag Card Number', 'class' => 'forgot_input', 'required' => 'required', 'autocomplete' => 'off']) }}
                        {{ errors_for('card_number', $errors) }}

			{{ Form::text('dob', null, ['placeholder' => 'date of birth (dd/mm/yyyy)','id'=>'datepicker', 'class'=>'forgot_input', 'required'=>'required','autocomplete' => 'off']) }}
                                
                        {{ errors_for('dob', $errors) }}
			{{ Form::email('email', null, ['placeholder' => 'Email Address', 'class' => 'forgot_input', 'required' => 'required', 'autocomplete' => 'off']) }}

                        {{ errors_for('email', $errors) }}

			{{ Form::hidden('_token', csrf_token()) }}

                      </div>

                      <div class="form-group">

                        <div class="login_submit">
                        
                            {{ Form::submit('Submit') }}
                        
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
