@extends('layouts.default')

@section('title','Institution Registration - Register with IDOAG to get connected to Brands and Students across India, Promote your Institute |idoag.com')

@section('metatags')
    <meta name="keywords" content="Institution Registration - Register with IDOAG to get connected to Brands and Students across India, Promote your Institute |idoag.com" />
    <meta name="description" content="Institution Registration - Register with IDOAG to get connected to Brands and Students across India, Promote your Institute |idoag.com" />
@stop

@section('css')

@stop

@section('content')

  <div class="fixed_registerbtn">

    <div class="fixed_registerbtn_txt">

      <span class="img1"></span>

      <h5><a href="#institutions_regi" data-toggle="modal" data-target="#institutions_regi">Register with idoag</a></h5>

    </div>

  </div>

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
       <div class="brands_banner">
          <div class="container_info">
            <div class="brand_page_title"> Institutions on idoag </div>
          </div>
        </div>
        <div class="registered_brands_container">
          <div class="container_info">
            <div class="registered_brands">
              <ul class="registered_brandsslider">

                @foreach($insts as $inst)

                  <li><a href="{{URL::route('institution_profile',array($inst->slug))}}">
                          {{   HTML::image(getImage('uploads/institutions/',$inst->image,'noimage.jpg'),$inst->name)}}
                      </a></li>

                @endforeach
              
              </ul>
            </div>
          </div>
        </div>
        <div class="brands_full_wrapper">
          <div class="container_info">
            <div class="row">
              <div class="col-md-8 col-sm-12 col-md-offset-2 text-center why_idog">
                <h2>Why idoag for your Institution</h2>
                <p>IDOAG Provides you the ideal platform for institutions to connect with their students at the touch of button. Your personalized page gives you the ability connect and communicate with all Students and Brands at the same time</p>
              
                <div class="reg_idog"> <a href="#institutions_regi" data-toggle="modal" data-target="#institutions_regi">Register with idoag</a> </div>
              </div>
            </div>
          </div>
        </div>
        <div class="brands_full_wrapper white_bg">
          <div class="container_info">
            <div class="row">
              <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
                <div class="row">
                  <div class="col-md-5 col-sm-5 col-xs-12 fully_verified"> {{ HTML::image('assets/images/brandingfor_institution.png') }} </div>
                  <div class="col-md-7 col-sm-7 col-xs-12 fully_verified_info">
                    <h3>Branding for <br>
                      your institution</h3>
                    <p>IDOAG cards are co-branded cards with your logo as per your needs and thus help you brand your institution throughout the student lifecycle</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="brands_full_wrapper ">
          <div class="container_info">
            <div class="row">
              <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-xs-12 connect_with_students">
                    <h3>Campus Connect</h3>
                    <p>Be a part of campus connect initiative which is specifically designed to strengthen the bond with your Students and also the prospective ones</p>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-12 text-center"> {{ HTML::image('assets/images/campus_connect.png') }} </div>
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
                  <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('assets/images/profile_idoag.png') }} </div>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <h3>Create your Institute <br/>
                      Profile on IDOAG</h3>
                    <p>Create and maintain your exclusive College page that gives you the leverage and the right set of tools to target Students and Brands</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="brands_full_wrapper ">
          <div class="container_info">
            <div class="row">
              <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <h3>Promote yourself <br>
                      across the Country</h3>
                    <p>IDOAG has the scale and reach across the nation and thus provide you with the platform to reach out to Students across the nation as well as promote yourself with Brands</p>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-12 mesure_results"> {{ HTML::image('assets/images/promote_country.png') }} </div>
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
                  <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('assets/images/support_idoagevents.png') }} </div>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <h3>Support from IDOAG <br>
                      in events</h3>
                    <p>We carry the largest umbrella of brands and have done extensive research on Students to support you in your annual events</p>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Testimonials -->
        <div class="brands_full_wrapper testimonials_info">

            <div class="container_info">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-md-offset-2 text-center testimonials_section">
                        <h3>Testimonials</h3>
                        <h5>What do our Partners say about us</h5>

                        <ul class="testimonials_slider">
                            @foreach($testimonials as $testimonial)
                                <li>
                                    <div class="testimonials_img"> {{ HTML::image(getImage('uploads/inst_testimonials/',$testimonial->image,'noimage.jpg')) }} </div>
                                    <p>{{$testimonial->description}}</p>
                                    <h6><strong>{{$testimonial->name}}</strong>, <span>{{$testimonial->institute_name}} - {{$testimonial->study}}</span></h6>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- institutions Register with idoag -->
      
      <div id="institutions_regi" class="modal fade" role="dialog">
        <div class="modal-dialog institutions_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/popup_close.png"/></button>
              <h4 class="modal-title text-center">Register with idoag</h4>
            </div>
            <div class="modal-body institutions_modal_body">
              {{ Form::open(['class' => 'form-horizontal','id' => 'inst-register-form', 'files' => 'true']) }}

                <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('inst_name',null,['placeholder' => 'Institution Name', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('website',null,['placeholder' => 'Website', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 selectdropdown">
                      {{ Form::select('state', array('' => 'Select State') + $states,  null,  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)'])}}
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 selectdropdown">
                {{Form::select('city',array('' => 'Select City'),null,['class'=>'form-control','id'=>'cityId','required'])}}
                    </div>
                </div> <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('name',null,['placeholder' => 'Contact Name', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('designation',null,['placeholder' => 'Designation', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    {{Form::text('email',null,['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    {{Form::text('mobile',null,['placeholder' => 'Mobile', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>

                <div class="g-recaptcha" data-theme="light" data-sitekey="6LdjgRgTAAAAAMp-Ztydlt8NpmG3761HKYeKxLT6" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>

                <div class="form-group registererror_msg">
                  <div class="col-sm-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="checkbox_tc" id="tandc_check">
                        I hereby authorise IDOAG to contact me through email or phone as per the information provided above.</label>
                    </div>
                  </div>
                </div>



                
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="submit" class="btn btn-default" value="Submit">
                  </div>
                </div>
              {{ Form::close() }}

               <div class="load_info">
                <div class="load_img">
                  
                  {{   HTML::image('assets/images/loading.gif')}}
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    <!-- institutions Register with idoag end --> 



    <!-- thankyou Registration -->
      <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            
              <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/popup_close.png"/></button>
            
            <div class="modal-body thankyou_body">
              <p><span class="thanks_heading">Thank you</span> for your interest in getting connected with IDOAG.<br/>  Our team will get in touch with you shortly.    </p>         
            </div>
          </div>
        </div>
      </div>
    <!-- thankyou Registration end -->


        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

@stop

@section('js')

  {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}

  <script>

    $(function(){

      var ww=$(window).innerWidth();
      $(".navbar-default .navbar-nav > li .submenu").width(ww);
          
      $( window ).resize(function() {
          var ww2=$(window).innerWidth();
          $(".navbar-default .navbar-nav > li .submenu").width(ww2);
      });
      
      $('.navbar-default .navbar-nav > li .submenu .mybrandslider_info').bxSlider({
          minSlides: 1,
          maxSlides: 5,
          slideWidth: 154,
          infiniteLoop: false,
          pager: false,
          moveSlides: 1,
          slideMargin: 10
      });             
      
      $('.statistics_slider').bxSlider({
          pager: false
      });



      var reg_idogtop=$(".reg_idog").offset().top;
      var reg_idogh=$(".reg_idog").height();
	  var reg_header=$("header").height();	  
      var reg_idog=(reg_idogtop+reg_header)-reg_header;
      
      $( window ).scroll(function(){
      	reg_idogtop=$(".reg_idog").offset().top;
	  	reg_header=$("header").height();	
	  	reg_idog=(reg_idogtop+reg_header)-reg_header;
        if($(this).scrollTop() > reg_idog){ $(".fixed_registerbtn").show();}
        
        else{ $(".fixed_registerbtn").hide(); } 
                
      });

      $('#inst-register-form').formValidation({
      
        framework: 'bootstrap',
        
        excluded: [':disabled'],
        
        icon: {
          
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        
        trigger: 'change',
                  
        fields: {
          
          name: {
            
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
          
          website: {
            
            validators: {
              
              notEmpty: {
                
                message: 'The website is required and cannot be empty'
                
              },
              regexp: {
                
                regexp: /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i,
                
                message: 'Please fill in you website address like https://www.example.com'
              }
              
            }
          },

          state: {
            
            validators: {
              
              notEmpty: {
                
                message: 'Please Select State'
                
              }
              
            }
          },
            city: {

                validators: {

                    notEmpty: {

                        message: 'Please Select City'

                    }

                }
            },
            contactname: {
            
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
          Designation: {
            
            validators: {
              
              notEmpty: {
                
                message: 'The Designation is required and cannot be empty'
                
              }
              
            }
          },
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
          mobile: {
            
            validators: {
              
              notEmpty: {
                
                message: 'The Mobile Number is required and cannot be empty'
                
              },
              phone: {
                
                country: 'IN',
                
                message: 'The value is not valid India Mobile number'
              },
              
              stringLength: {
              
                max: 10,
                
                message: 'The Mobile number must be at max 10 digits'
                
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
          
      }).on('success.form.fv', function(e) {
            $(".institutions_modal_body .load_info").show();

            // Prevent form submission
            e.preventDefault();

            var reg_form = $(e.target),
                  fv     = reg_form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: '/instRegister',
                type: 'POST',
                data: reg_form.serialize(),
                success: function(result) {
                  $(".institutions_modal_body .load_info").hide();
                  $('#inst-register-form').trigger("reset");
                  $('#institutions_regi').hide();
                  $('#thankyou_reg').modal('show');
                  reg_form.data('formValidation').resetForm();
                  $("body").removeClass("modal-open");                  
                }
            });
        
        });
    });


  $(window).load(function(){
          $('.registered_brandsslider').bxSlider({
            minSlides: 1,
            maxSlides: 8,
            slideWidth: 140,
			slideMargin: 10,
            infiniteLoop: true,
            pager: false,
            moveSlides: 1
        });              
        
  });

  $(document).keyup(function(e) {
      if (e.keyCode == 27) { 
        if( $("#institutions_regi").hasClass("in") || $("#thankyou_reg").hasClass("in") ){

          $("#institutions_regi").hide();
          $('#thankyou_reg').hide();
          $(".reg_idog a").trigger("click");
        }
      }
  });

$(window).load(function(){
    $('.testimonials_slider').bxSlider({
        pager: false,
        auto: true
    });
});




  </script>

@stop