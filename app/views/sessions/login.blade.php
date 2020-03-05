@extends('layouts.default')

@section('title','Idoag.com')

@section('classtitle','login_bg')

@section('css')

    
@stop

@section('content')
	
    <!-- Content Start Here -->
	<div class="wrapper">
  	
    	<!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('partials.flash')
        <div class="activationstep2_info loginnew_info">
            <div class="log_for_chan_info">

                <div class="loginnew_innerdiv">

                    <div class="activation_left loginnew_left">
      
      			          <h4>Log in to your idoag account</h4>
                      {{Session::get('redirect')}}
            
              			  {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}

                        <div class="form-group">
                            <div class="input-group">{{ Form::email('email', null, ['placeholder' => 'Email Address', 'required' => 'required', 'autocomplete' => 'off']) }}
                                
                             {{ errors_for('email', $errors) }}
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <div class="input-group"> {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off']) }}
                                        
                            {{ errors_for('password', $errors) }}  </div>
                        
                        </div>

                        {{ Form::submit('Login') }}
        
                        <div class="login_submitcont"> 
                        
                            <a href="{{ URL::to('forgot_password') }}">Forgot Password?</a> 

                        </div>          				        			 

              			  {{ Form::close() }}

    		            </div>

                    <!-- <div class="activation_middle loginnew_middle">

                        {{ HTML::image('assets/images/logindevider_img.png') }}

                        <span class="middle-or">( OR )</span>

                    </div>

                    <div class="activation_right loginnew_right"><div class="fb_gp_btn">

                            <a href="{{ URL::to('facebook') }}" class="fbLogin"><i class="fa fa-facebook"></i>Connect with Facebook</a>

                            <a href="{{ URL::to('google') }}" class="gplusLogin"><i class="fa fa-google-plus"></i>Connect with Google</a>

                        </div>
                    </div> -->
                </div>
                <div class="donthave_idoagcard">
      
      			<h4>Don't have an idoag card?</h4>
      
      			<p> Membership to idoag is through your college or institution.<br>
        			Let us Know a few details of your institute and we will get in touch with them for activation. </p>
      			
               <div class="about_institution"><a href="#aboutyour_inst" data-toggle="modal" class="tellus_btn" data-target="#aboutyour_inst">Tell us about your institution</a></div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

    <div id="aboutyour_inst" class="modal fade" role="dialog">
      <div class="modal-dialog institutions_modal-dialog aboutyourinst_modal-dialog"> 
        
        <!-- Modal content-->
        <div class="modal-content aboutyourinst_modal-content">
          <div class="modal-header aboutyourinst_header">
            <button type="button" class="close" data-dismiss="modal">{{ HTML::image('assets/images/popup_close.png') }}</button>
            <h4>Tell Us About Your Institution</h4>
          </div>

          <div class="modal-body aboutyourinst_modal-body">

            {{Form::open(['id' => 'institute_form', 'role'=>'form', 'files' => 'true'])}}

              <div class="contactmain_top">

                <div class="form-group">
                  <input type="text" name="inst_name" placeholder="College" />
                </div>

                <div class="form-group">

                  {{ Form::select(
                  'state',
                  array('' => '-- Please select State --') + $states,
                    'null' ,
                  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)']
                  )
                  }}

                </div>

                <div class="form-group">
            
                  <select id="cityId" name="city" class="form-control cities" required = "required">
                    <option value="">--Select City --</option>

                  </select>

                </div>

                <h5>Contact Person</h5>

                <div class="form-group">
                  <input type="text" name="name" placeholder="Name" required = "required"/>
                </div>

                <div class="form-group">
                  <input type="text" name="designation" placeholder="Designation" required = "required"/>
                </div>

                <div class="form-group">
                  <input type="text" name="mobile" placeholder="Mobile Number" required = "required"/>
                </div>

                <div class="form-group">
                  <input type="text" name="email" placeholder="Email" required = "required"/>
                </div>

              </div>

              <div class="contactmain_bottom">

                <div class="form-group">
                  <input type="text" name="stud_name" placeholder="Your Name" />
                </div>

                <div class="form-group">
                  <input type="text" name="stud_mobile" placeholder="Mobile Number" />
                </div>

                <div class="form-group">
                  <input type="text" name="stud_email" placeholder="Email" />
                </div>

                <div class="form-group registererror_msg">
                  <div class="studentcmt_chechbox">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="checkbox_tc" id="tandc_check">
                        I hereby authorise IDOAG to contact me through email or phone as per the information provided above.</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  {{ Form::submit('Submit',['class' => 'submit_btn']) }}
                </div>

              </div>

            {{Form::close()}}

            <div class="load_info">
              <div class="load_img">
                
                {{   HTML::image('assets/images/loading.gif')}}
                
              </div>
            </div>            

          </div>

        </div>

      </div>

    </div>

    <!-- thankyou Registration -->
      <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            
              <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/popup_close.png"/></button>
            
            <div class="modal-body thankyou_body">
              <h3>Thank you</h3>
              <p> for your interest in getting connected with IDOAG.<br/>  Our team will get in touch with you Institution shortly.</p>         
            </div>
          </div>
        </div>
      </div>
    <!-- thankyou Registration end -->

    
@stop

@section('js')

  <script>

  $(document).ready(function(){

    $('#institute_form').formValidation({
    
      framework: 'bootstrap',
      
      excluded: [':disabled'],
      
      icon: {
        
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      
      trigger: 'change',
                
      fields: {
        
        college_name: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Name is required and cannot be empty'
              
            }
          }
        },
        
        state: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The state is required and cannot be empty'
              
            }
          }
        },

        city: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The city is required and cannot be empty'
              
            }
            
          }
        },                      
        contact_name: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Contact Name is required and cannot be empty'
              
            }
          }
        },
        contact_designation: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Designation is required and cannot be empty'
              
            }
            
          }
        },
        contact_phone: {
          
          validators: {
              
            notEmpty: {
                
              message: 'The Mobile Number is required and cannot be empty'
                
            },

            numeric: {
              
              message: 'The value is not a number'
            },
            
            stringLength: {
               
              min: 8,

              max: 10,
               
              message: 'The Mobile number must be at max 10 digits'
            }
          }
        },
        contact_email: {
      
          validators: {

            notEmpty: {
              
              message: 'The Email is required and cannot be empty'
              
            },

            regexp: {
              
              regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
              
              message: 'The email input is not a valid email address'
              
            }
          }
        }
      }
        
    }).on('success.form.fv', function(e) {
          // Prevent form submission
          $(".aboutyourinst_modal-body .load_info").show();

          e.preventDefault();

          var reg_form = $(e.target),fv = reg_form.data('formValidation');

          // Use Ajax to submit form data
          $.ajax({
              url: '/about_institute', 
              type: 'POST',
              data: reg_form.serialize(),

              success: function(result) {
                $(".aboutyourinst_modal-body .load_info").hide();                
                $('#institute_form').trigger("reset");
                $('#aboutyour_inst').hide();
                $('#thankyou_reg').modal('show');
                reg_form.data('formValidation').resetForm();                
                $("body").removeClass("modal-open");                  
              }
          });
      });    

  });

  $(document).keyup(function(e) {
      if (e.keyCode == 27) { 
        if( $("#aboutyour_inst").hasClass("in") || $("#thankyou_reg").hasClass("in") ){

          $("#aboutyour_inst").hide();
          $('#thankyou_reg').hide();
          $(".about_institution a").trigger("click");
        }
     }
  });

  </script>
        
@stop