@extends('layouts.default')

@section('title','Student Registration - Tell us about your college, Register with IDOAG to get connected to Brands and Institutions across India |idoag.com')
@section('metatags')
    <meta name="keywords" content="Student Registration - Tell us about your college, Register with IDOAG to get connected to Brands and Institutions across India |idoag.com" />
    <meta name="description" content="Student Registration - Tell us about your college, Register with IDOAG to get connected to Brands and Institutions across India |idoag.com" />
@stop

@section('css')

  {{ HTML::style('assets/plugins/multiselect/bootstrap-multiselect.css') }}

@stop

@section('content')    

    <div class="fixed_registerbtn student_registerbtn">

      <div class="fixed_registerbtn_txt">

        <span class="img1"></span>

        <h5><a href="#aboutyour_inst" data-toggle="modal" data-target="#aboutyour_inst">Tell Us About Your Institution</a></h5>

      </div>

    </div>

    <!-- Content Start Here -->
    <div class="wrapper">

      <!-- Header Starts here -->
      @include('layouts.header')
      <!-- Header Ends here -->
        @include('partials.flash')
      <div class="brands_banner student_regbg"></div>
      
      <div class="brands_full_wrapper">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 text-center why_idog">
              <h2>Why idoag</h2>
              <p>IDOAG helps this generation of 'millennials' who are still in college to get access to unique offers and opportunities and proficiently throngs the lacuna amongst Students, Brands and Institutes.</p>
                <p>Membership to idoag is through your college or institution. Let us Know a few details of your institute and we will get in touch with them for activation. </p>
              <div class="reg_idog"><a href="#aboutyour_inst" data-toggle="modal" class="tellus_btn" data-target="#aboutyour_inst">Tell us about your institution</a></div>
            </div>
          </div>
        </div>

      </div>

      <div class="brands_full_wrapper white_bg">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 fully_verified"> {{ HTML::image('/assets/images/student_reg01.png') }}</div>
                <div class="col-md-7 col-sm-7 col-xs-12 fully_verified_info">
                  <h3>Exclusive <br>Offers and Discounts</h3>
                  <p> We help you &ldquo;Save on each and every spend&rdquo;  by availing exclusive Offers and Discounts on best of the brands in the country.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="brands_full_wrapper">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
              <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-12 connect_with_students">
                  <h3>Presence <br>across verticals</h3>
                  <p> IDOAG covers all verticals across Brick&Mortar as well as eCommerce</p>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 text-center"> {{ HTML::image('/assets/images/student_reg02.png') }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="brands_full_wrapper white_bg">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('/assets/images/student_reg03.png') }}</div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <h3>Connect <br>and Collaborate</h3>
                  <p> We help you Connect and Collaborate directly with Brands and Institutes</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="brands_full_wrapper">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
              <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <h3> 	Unlimited <br /> Opportunities</h3>
                  <p>We provide you an interface to fulfil various other needs such as Internships, Workshops and Guest Lectures through our partners</p>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 mesure_results"> {{ HTML::image('/assets/images/student_reg04.png') }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="brands_full_wrapper white_bg events_bg">
        <div class="container_info">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('/assets/images/student_reg05.png') }}</div>
                <div class="col-md-7 col-sm-7 col-xs-12 events_cnt">
                  <h3>Events</h3>
                  <p> Choose the events you would like to attend and get your exclusive entry pass</p>
                </div>
              </div>
            </div>
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

                  <input type="text" name="college" placeholder="College" required = "required"/>

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
                  <input type="text" name="name" placeholder="Contact Name" required = "required"/>
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
              <p><span class="thanks_heading">Thank you</span> for your interest in getting connected with IDOAG.<br/>  Our team will get in touch with your Institution shortly.</p>
            </div>
          </div>
        </div>
      </div>
    <!-- thankyou Registration end -->
@stop

@section('js')

  {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}


  <script>

  $(document).ready(function(){


      var reg_idogtop=$(".reg_idog").offset().top;
      var reg_idogh=$(".reg_idog").height();
      var reg_idog=reg_idogtop+reg_idogh;
      
      $( window ).scroll(function(){
      
        if($(this).scrollTop() > reg_idog){ $(".fixed_registerbtn").show();}
        
        else{ $(".fixed_registerbtn").hide(); } 
                
      });


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
        
        college: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Name is required and cannot be empty'	 
               },
            regexp: {
              
              regexp: /^[a-z\s]+$/i,
              
              message: 'The name can consist of alphabetical characters and spaces only'
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
        name: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Contact Name is required and cannot be empty'
              
            },
             regexp: {
              
              regexp: /^[a-z\s]+$/i,
              
              message: 'The Contact name can consist of alphabetical characters and spaces only'
            }
          }
        },
        designation: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Designation is required and cannot be empty'
              
            }
            
          }
        },
        mobile: {
          
          validators: {
              
            notEmpty: {
                
              message: 'The Mobile Number is required and cannot be empty'
                
            },

           
            
            stringLength: {
               
              min: 10,

              max: 10,
               
              message: 'The Mobile number must be at max 10 digits'
            }
          }
        },
        email: {
      
          validators: {

            notEmpty: {
              
              message: 'The Email is required and cannot be empty'
              
            },

            regexp: {
              
              regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
              
              message: 'The email input is not a valid email address'
              
            }
          }
        },      
        stud_name: {
          
          validators: {
            
            notEmpty: {
              
              message: 'The Contact Name is required and cannot be empty'
              
            }
          }
        },                              
        stud_mobile: {
          
          validators: {
              
            notEmpty: {
                
              message: 'The Mobile Number is required and cannot be empty'
                
            },

            numeric: {
              
              message: 'The value is not a number'
            },
            
            stringLength: {
               
              min: 10,

              max: 10,
               
              message: 'The Mobile number must be at max 10 digits'
            }
          }
        },
        stud_email: {
      
          validators: {

            notEmpty: {
              
              message: 'The Email is required and cannot be empty'
              
            },

            regexp: {
              
              regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
              
              message: 'The email input is not a valid email address'
              
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
        
    })
     .on('success.form.fv', function(e) {
          // Prevent form submission
          $(".aboutyourinst_modal-body .load_info").show();
          e.preventDefault();

          var reg_form = $(e.target),
              fv    = reg_form.data('formValidation');
          
          
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
        if( $("#aboutyour_inst").hasClass("in") || $("#thankyou_reg").hasClass("in")){

          $("#aboutyour_inst").hide();
          $('#thankyou_reg').hide();

          $(".reg_idog a").trigger("click");
        }
     }
  });
  
  </script>

@stop