@extends('layouts.default')

@section('title','Brands Registration - Register with IDOAG to get connected to Students and Institutions across India, Promote your Brand |idoag.com')
@section('metatags')
    <meta name="keywords" content="Brands Registration - Register with IDOAG to get connected to Students and Institutions across India, Promote your Brand |idoag.com" />
    <meta name="description" content="Brands Registration - Register with IDOAG to get connected to Students and Institutions across India, Promote your Brand |idoag.com" />
@stop

@section('css')

  {{ HTML::style('assets/plugins/multiselect/bootstrap-multiselect.css') }}

@stop

@section('content')

    <div class="fixed_registerbtn">

      <div class="fixed_registerbtn_txt">

        <span class="img1"></span>

        <h5><a href="#brands_regi" data-toggle="modal" data-target="#brands_regi">Register with idoag</a></h5>

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

              <div class="brand_page_title"> Brands on idoag </div>

            </div>

        </div>

        <div class="registered_brands_container">

            <div class="container_info">

                <div class="registered_brands">

                    <ul class="registered_brandsslider">

                      @foreach($brands as $brand)

                      <li>
                      <div class="thumbslider_row">
                      <a href="{{URL::route('brand_profile',array($brand->slug))}}">{{   HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),$brand->name)}} </a>
                      </div>
                      </li>

                      @endforeach

                    </ul>

                </div>

            </div>

        </div>

        <div class="brands_full_wrapper">

            <div class="container_info">

                <div class="row">

                    <div class="col-md-8 col-sm-12 col-md-offset-2 text-center why_idog">

                      <h2>Why idoag for your brand</h2>
                      <p>Top Notch Brands from all around the globe are looking for a way to capture imagination. IDOAG provides the perfect platform for Brands to connect with these young adults in a personalized manner </p>
                 
                        <div class="reg_idog"> <a href="#brands_regi" data-toggle="modal" data-target="#brands_regi">Register with idoag</a> </div>
                    </div>

                </div>

            </div>
                      <!-- <div class="success_thanks"> 
                        <h3>Thank you</h3>
                        <h4>for Registering with us</h4>
                        <p> You’ll be getting a confirmation email soon.<br/>
                        <span class="allthebest_link">All the best</span>
                      </div> -->
        </div>

        <div class="brands_full_wrapper white_bg">

            <div class="container_info">

                <div class="row">

                    <div class="col-md-8 col-sm-12 col-md-offset-2 brands_content_section">

                        <div class="row">

                            <div class="col-md-5 col-sm-5 col-xs-12 fully_verified"> {{ HTML::image('/assets/images/fully_verified.png') }}</div>

                            <div class="col-md-7 col-sm-7 col-xs-12 fully_verified_info">

                                <h3>Fully Verified <br>
                                Target Audience</h3>

                                <p>We give you an ocean of 100% Verified Target Audience as IDOAG has the most authentic data about Students in sync with the campus</p>

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

                                <h3>Connect with <br>
                                Students</h3>
                              
                                <p>Create and maintain your Brand page to connect with Students, This is designed to increase loyalty, attracting the potential customers and reducing the customer acquisition cost</p>
                            
                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-12 text-center"> {{ HTML::image('/assets/images/connect_with_students.png') }}</div>

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
                       
                            <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('/assets/images/loyal_aspirational.png') }}</div>
                            
                            <div class="col-md-7 col-sm-7 col-xs-12">
                              
                                <h3>Make brand loyal and aspirational customers  </h3>
                              
                                <p>We understand the pulse of students like no one else does and have created the platform with the right tools for you to make Brand loyal and aspirational customers</p>
                            
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
                      <h3>Measure Results <br>
                        and ROI</h3>
                      <p>With IDOAG, complete control rests with you to create an impact on your Top line and bottom line and measure the associated ROI</p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 mesure_results"> {{ HTML::image('/assets/images/mesure_results.png') }}</div>
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
                    <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('/assets/images/user_segmantation.png') }}</div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <h3>User <br>
                        Segmentation </h3>
                      <p>We have the ability to segment the users thereby giving you more control over targeting based on statistics, behavior and profile.</p>
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
                      <h3>Scale of IDOAG</h3>
                      <p>We are biggest in our segment in India and carry the scale to get your message across to all users in the most efficient manner and thus resulting in high conversion</p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12"> {{ HTML::image('/assets/images/biggest_idoag.png') }}</div>
                  </div>
                </div>
              </div>
            </div>

        </div>
  
        <!-- Testimonials -->
  
        <div class="brands_full_wrapper white_bg testimonials_info">

            <div class="container_info">
              <div class="row">
                <div class="col-md-8 col-sm-12 col-md-offset-2 text-center testimonials_section">
                    <h3>Testimonials</h3>
                    <h5>Our Happy Customer say’s about us</h5>
                    
                    <ul class="testimonials_slider">
               @foreach($testimonials as $testimonial)
                <li>
                  <div class="testimonials_img"> {{ HTML::image(getImage('uploads/testimonials/',$testimonial->image,'noimage.jpg')) }} </div>
                  <p>{{$testimonial->description}}</p>
                  <h6><strong>{{$testimonial->name}}</strong>, <span>{{$testimonial->company_name}}</span></h6>
                </li>
                        @endforeach
              </ul>
                </div>
              </div>

            </div>

        </div>

    </div>


    <!-- Brands Register with idoag -->
      
      <div id="brands_regi" class="modal fade" role="dialog">
        <div class="modal-dialog institutions_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
              <h4 class="modal-title text-center">Register with idoag</h4>
            </div>
            <div class="modal-body institutions_modal_body">
              {{ Form::open(['class' => 'form-horizontal','id' => 'brand-register-form', 'files' => 'true']) }}

                <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('brand_name',null,['placeholder' => 'Brand Name', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">

                  <div class="col-sm-12">
                    {{Form::text('website',null,['placeholder' => 'Website', 'class' => 'form-control', 'required' => 'required'])}}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 selectdropdown">
                    {{ Form::select('category[]', $categories, '' , ['class' => 'form-control select_input', 'id' => 'category', 'multiple' => 'multiple', 'required' => 'required']) }}                                                
                  </div>
                </div>
                <div class="form-group">

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

    <!-- Brands Register with idoag end --> 


    <!-- thankyou Registration -->
      <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            
              <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
            
            <div class="modal-body thankyou_body">
              <p><span class="thanks_heading">Thank you</span> for your interest in getting connected with IDOAG. Our team will get in touch with you shortly.<br/>
              </p>              
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
    
    $('.testimonials_slider').bxSlider({
        pager: false,
        auto: true
    }); 

    $("#category").multiselect({
    
      maxHeight:200,
      buttonWidth: '650px',
      inheritClass: true,
      includeSelectAllOption: true,
      nonSelectedText: 'Select Categories'  
    });

    var reg_idogtop=$(".reg_idog").offset().top;
    var reg_idogh=$(".reg_idog").height();
    var reg_idog=reg_idogtop+reg_idogh;
    
    $( window ).scroll(function(){
    
      if($(this).scrollTop() > reg_idog){ $(".fixed_registerbtn").show();}
      
      else{ $(".fixed_registerbtn").hide(); } 
              
    });

    $('#brand-register-form').formValidation({
    
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

        category: {
          
          validators: {
            
            notEmpty: {
              
              message: 'Please Select a Category'
              
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
            
              min: 8,

              max: 10,
              
              message: 'The Mobile number must be at max 10 digits'
              
            },           
          }
        },
        checkbox_tc: { 

          validators: {

            notEmpty: {

              message: 'Please agree to Terms and Conditions'

            }
          }
        },                         
      }
        
    })
      .on('success.form.fv', function(e) {
          // Prevent form submission
        $(".institutions_modal_body .load_info").show();

          e.preventDefault();

          var reg_form = $(e.target),
              fv    = reg_form.data('formValidation');

          // Use Ajax to submit form data
          $.ajax({
              url: '/brandRegister',
              type: 'POST',
              data: reg_form.serialize(),
              success: function(response) {
                console.log('here');
                
                $(".institutions_modal_body .load_info").hide();
                
                $('#brand-register-form').trigger("reset");
                
                reg_form.data('formValidation').resetForm();

                $('#brands_regi').hide();
                
                $('#thankyou_reg').modal('show');
                
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
        if( $("#brands_regi").hasClass("in") || $("#thankyou_reg").hasClass("in") ){

          $("#brands_regi").hide();
          $('#thankyou_reg').hide();
          $(".reg_idog a").trigger("click");
        }
     }
  });
</script>

@stop