<?php error_reporting(0)?>
@extends('layouts.default')
@section('title','Activate idoag card - Activate idoag card and create account |idoag.com')

@section('metatags')
    <meta name="keywords" content="Activate idoag card - Activate idoag card and create account |idoag.com" />
    <meta name="description" content="Activate idoag card - Activate idoag card and create account |idoag.com" />
@stop

@section('classtitle','activationstep2_bg')

@section('content')
    <?php  if($student->card_number) { Session::set('card_number', $student->card_number);  } ?>

    <!-- Content Start Here -->
    <div class="wrapper">
    
      <!-- Header Starts here -->
      @include('layouts.header')
      <!-- Header Ends here -->

      <div class="activationstep2_info">
       
        <div class="log_for_chan_info">
       
          <div class="stip_headinginfo">
           
            <div class="stip_heading">
            
              <h4>Activation Step 2</h4>
            
            </div>
            
            <span><p>Before you can avail the best of offers from IDOAG,
              you need to activate the card you’ve got. </p></span>
          
          </div>

          <div class="stip_cnt">
          
            <ul>
              
              <li>Institute: <span class="main_head">{{$college->name}}</span></li>
              
              <li>Card Number: <span class="sub_head">{{wordwrap($student->card_number,4," ",true)}}</span></li>
              
              <li>Date of Birth: <span class="sub_head">{{date("jS F, Y", strtotime($student->dob))  }}</span></li>
            
            </ul>

          </div>          

          <div class="activation_left">

            {{ Form::open(['class' => 'form-group','route' => 'student_store','id' => 'add-new-brand-form', 'files' => 'true']) }}

            {{ Form::hidden('_token', csrf_token()) }}

            {{ Form::hidden('card_number', $student->card_number, array('id' => 'card_number')) }}

            {{ Form::hidden('institute', $college->name, array('id' => 'card_number')) }}
                          
            {{ Form::hidden('dob', $student->dob, array('id' => 'dob')) }}
            {{ Form::hidden('user_type', $student->type) }}

            <div class="form-group">
              <div class="input-group">
                {{ Form::text('first_name', $student->first_name,['placeholder' => 'First Name', 'required' => 'required', 'autocomplete' => 'off']) }}                    
                    {{ errors_for('first_name', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group no_btm">
                {{ Form::text('last_name', $student->last_name,['placeholder' => 'Last Name', 'required' => 'required', 'autocomplete' => 'off']) }}                    
                    {{ errors_for('last_name', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group no_btm">
                <span class="gender_select">
                    {{ Form::radio('sex', 'M') }}{{ Form::label('male', 'Male') }}
                    {{ Form::radio('sex', 'F') }}{{ Form::label('female', 'Female') }}
                </span>
              </div>
            </div>    

            <div class="form-group">
              <div class="input-group">
                {{ Form::email('email','',['placeholder' => 'Email', 'required' => 'required', 'autocomplete' => 'off']) }}                    
                    {{ errors_for('email', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                {{ Form::text('mobile','',['placeholder' => 'Mobile', 'required' => 'required', 'autocomplete' => 'off']) }}                    
                    {{ errors_for('mobile', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off']) }}
                    {{ errors_for('password', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'required' => 'required', 'autocomplete' => 'off']) }}
                    {{ errors_for('password_confirmation', $errors) }}
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="captha_input">
                    <div class="g-recaptcha" id="captchaContainer" data-theme="light" data-sitekey="6LdjgRgTAAAAAMp-Ztydlt8NpmG3761HKYeKxLT6" 				 					style="transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>  
                    {{-- Form::captcha() --}}
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12 activation_tandc">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="checkbox_tc" id="tandc_check">
                    Accept <a href="{{URL::route('tos')}}" class="terms_link" target="_blank">Terms & Conditions</a></label>
                </div>
              </div>
            </div>

             <div class="login_submit">
                {{ Form::submit('Activate') }}
            </div>
            {{form::close()}}

          </div>

          <div class="activation_middle">

            {{ HTML::image('assets/images/devider_top.png', '') }} 
            <span class="middle-or">( OR )</span>

          </div>

          <div class="activation_right">
            
            <div class="fb_gp_btn"> 
              
              <a href="{{ URL::to('facebook') }}" class="fbLogin"><i class="fa fa-facebook"></i>Connect with Facebook</a> 
              
              <a href="{{ URL::to('google') }}" class="gplusLogin"><i class="fa fa-google-plus"></i>Connect with Google</a> 
              
            </div>
             
          </div>
            

           
 
        </div>

      </div>

    </div>
 
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

  <script>

    $(document).ready(function() {

        $('#add-new-brand-form').formValidation({
        
          framework: 'bootstrap',
                
          icon: {
            
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },
          addOns: {
              reCaptcha2: {
                  element: 'captchaContainer',
                  theme: 'light',
                  siteKey: '6LdjgRgTAAAAAMp-Ztydlt8NpmG3761HKYeKxLT6',
                  message: 'The captcha is not valid'
              }
          },                  
          fields: {
            
            first_name: {

              validators: {

                  notEmpty: {
                              message: 'The username is required and cannot be empty'
                           }
              }
            },
            last_name: {
                  
              validators: {

                  notEmpty: {
                              message: 'The username is required and cannot be empty'
                          }
              }          
            },
            sex: {

              validators: {
                    
                    notEmpty: {
                                message: 'Please Select you gender'
                            }
              }
            },                      
            email: {

              validators: {
                
                regexp: {

                  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                  
                  message: 'The value is not a valid email address'
                      
                }
              }
            },           
            mobile: {
              
              validators: {
              
                numeric: {
                  
                  message: 'The value is not a number',
                },
                
                stringLength: {
                   
                  min: 10,

                  max:10,
                   
                  message: 'The Mobile number must be 10 digits only'
                }
              }
            },
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
                    
                  message: 'passwords do not match'
                    
                }
            
              }
            },
            checkbox_tc: { 

              validators: {

                notEmpty: {

                  message: 'Please agree to Terms and Conditions'

                }
              }
            }
          }
                      
        });
    });

  </script>
  

@stop
                  

