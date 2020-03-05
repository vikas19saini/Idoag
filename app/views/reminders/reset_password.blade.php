@extends('layouts.default')

@section('title','Idoag.com | Reset Password')

@section('classtitle','forgotpassword_bg')

@section('content')
	
    <!-- Content Start Here -->
	<div class="wrapper">
  	
	  <!-- Header Starts here -->
    @include('layouts.header')
    <!-- Header Ends here -->
    @include('partials.flash')
    
    <div class="forgotpassword_info">

			<div class="log_for_chan_info resetpwd">

					<h4>Yay! Just one more step and it’s done.</h4>

					{{ Form::open(['action' => 'RemindersController@postReset',  'class'=>'form-horizontal', 'id' => 'reset-password-form']) }}
						
            <div class="form-group exits_users">

              <div class="col-sm-12">

                {{ Form::email('email', $user->email, ['placeholder' => 'Email', 'readonly' => 'readonly']) }}
                        
                      {{ errors_for('email', $errors) }}

              </div>

            </div>

            <div class="form-group exits_users">

              <div class="col-sm-12">

                
                {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off']) }}
                                
                      {{ errors_for('password', $errors) }}

              </div>

            </div>
    
            <div class="form-group exits_users">

              <div class="col-sm-12">

                {{ Form::password('password_confirmation', ['placeholder' => 'Password Confirmation']) }}
                        
                            {{ errors_for('password_confirmation', $errors) }}  

              </div>

            </div>
                        
            {{ Form::hidden('token', Session::get('resetToken') ) }}

						<p>Do remember it this time :)</p>

            <div class="form-group">

                <div class="login_submit">

                  <div class="col-sm-12">
      
                    {{ Form::submit('Save New Password') }}

                  </div>

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

<script>

  $(function(){

      $('#reset-password-form').formValidation({
          framework: 'bootstrap',
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {

              password: {
                  validators: {
                      stringLength: {                   
                          min: 6,                   
                          message: 'The password must be at least 6 characters'
                      }
                  }
              },
              password_confirmation: {
                  validators: {
                      identical: {
                          field: 'password',
                          message: 'The passwords do not match'
                      }
                  }
              }
          }
      });

  });

</script>
        
@stop