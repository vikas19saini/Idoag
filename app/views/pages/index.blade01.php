@extends('layouts.default')

@section('title','IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com')

@section('metatags')
    <meta name="keywords" content="IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com" />
    <meta name="description" content="IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com" />

    <meta property="og:description" content="Offers & Discounts for Students |idoag.igenero.in">
    <meta property="og:image" content="http://idoag.igenero.in/assets/images/connectstudents_bg.jpg">
    <meta property="og:title" content="Offers & Discounts for Students |idoag.igenero.in">
    <meta property="og:url" content="{{ Request::fullUrl(); }}">
    <meta property="fb:app_id" content="1664606373750912">
    <meta property="og:type" content="idoagconnect:website">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:creator" content="idoag">
    <meta property="twitter:domain" content="idoag.igenero.in">
    <meta property="twitter:site" content="idoag.igenero.in">
@stop

@section('css')
    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    {{ HTML::style('assets/plugins/pikaday/pikaday.css') }}


@stop

@section('content')
    
    <!-- Content Start Here -->
    <div class="wrapper">
    
        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('partials.flash2')

        @if(!$main_banner_sliders->isEmpty())
        
            <section class="banner_info" style="background-image:url('uploads/{{ $main_banner_sliders[0]->image_name }}')">
        
                <div class="container_info">
          
                    <div class="banner_cont">
            
                        <ul class="banner_contslider">
              
                            @foreach($main_banner_sliders as $slider)
                            
                                <li>{{ $slider->title }}</li>
                            
                            @endforeach
                        
                        </ul>
                    
                    </div>
          
                    <div class="activateyouridoag_info">      
                    @if(!isset($loggedin_user))

                        <h4>Activate your idoag card now!</h4>

                        {{ Form::open(['route' => 'student_activate']) }}

                            {{ Form::text('card_number', null, ['placeholder' => 'idoag Card Number','required'=>'required','autocomplete' => 'off']) }}
                            {{ errors_for('card_number', $errors) }}

                            {{ Form::text('dob', null, ['placeholder' => 'date of birth (dd/mm/yyyy)','id'=>'datepicker','required'=>'required','autocomplete' => 'off']) }}                            
                            {{ errors_for('dob', $errors) }}

                            {{ Form::hidden('_token', csrf_token()) }}

                            {{ Form::submit('Activate')}}
                    
                        {{ Form::close() }}

                   
                        <div class="having_trouble"><a href="javascript:void(0)" class="" data-toggle="modal" data-target="#having_trouble">Having trouble activating your card ?</a></div>

                        @endif
                    </div>
                
                </div>
      
            </section>
        
        @endif
        
        @if(!$second_banner_sliders->isEmpty())
        
            <section class="worldofidoag_info" >
        
                <div class="container_info">
          
                    <ul class="worldofidoagslider">
                        
                        @foreach($second_banner_sliders as $slider)
                        
                            <li>
                  				<div class="row">
                                <div class="col-md-7 col-sm-12 worldofidoag_cont">
                    
                                    {{ $slider->title }}
                  
                                </div>
                  
                                <div class="col-md-5 col-sm-12 worldofidoag_img"> {{ HTML::image('uploads/'.$slider->image_name) }} </div>
                				</div>
                            </li>
                        
                        @endforeach
                                  
                    </ul>
            
                </div>
      
            </section>
        
        @endif
        
        @if(!$third_banner_sliders->isEmpty())

            <section class="disruptivenoise_info" style="background-image:url('uploads/{{ $third_banner_sliders[0]->image_name }}')">
            
                <div class="container_info">
                
                    {{ $third_banner_sliders[0]->title }}

                    @foreach($press as $key => $press_slider)

                       @if($key < 4)

                            <figure> <a href="{{ URL::route('press_details',array('slug'=>$press_slider->slug) )}}" target="_blank" > {{ HTML::image('uploads/press/'.$press_slider->image_logo) }} </a> </figure>
                        
                        @endif

                    @endforeach

                </div>
          
            </section>

        @endif
      

        @if(!$fourth_banner_sliders->isEmpty())

            <section class="everlastingimpact_info">
            
                <div class="container_info">
              
                    <div class="everlastingimpact_cont">

                        @foreach($fourth_banner_sliders as $slider)
                
                        {{ $slider->title}}
                        
                        @endforeach
                            <div class="cnt_readmore">
                        <a href="{{URL::route('brand-register')}}"> Read More... </a>
</div>
                    </div>
            
                </div>
          
            </section>

        @endif

        @if(!$fifth_banner_sliders->isEmpty())
      
            <section class="connectstudents_info">
                
                <div class="container_info">
              
                    <div class="connectstudents_cont">                

                        @foreach($fifth_banner_sliders as $slider)
                        
                            {{ $slider->title}}
                        
                        @endforeach
                        
                        <div class="cnt_readmore white_readmore"><a href="{{ URL::route('inst-register') }}"> Read More... </a> </div>
                    
                    </div>

              
                    <div class="gettheidoag_info">
                
                        <h3>Get the IDOAG Power today!</h3>
              
                    </div>
            
                </div>
          
            </section>

        @endif

    </div>
    <!-- Content Ends Here -->
    
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

    <!-- Modal -->
    <div id="having_trouble" class="modal fade" role="dialog">
      <div class="having_trouble-dialog modal-dialog">

        <!-- Modal content-->
        <div class="having_trouble-content modal-content">
          <div class="modal-header having_trouble-header">
            <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
            <h4 class="modal-title">We are here to help, just send us this info and we will get back as soon as we can </h4>
          </div>
          <div class="modal-body having_trouble-body">

                {{ Form::open(['class' => 'form-horizontal','id' => 'card_activation_issue', 'files' => 'true']) }}

                    <div class="form-group">
                      <div class="col-sm-12">
                        {{Form::text('name',null,['placeholder' => 'Name', 'class' => 'form-control', 'required' => 'required'])}}
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                        {{Form::text('email',null,['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])}}
                      </div>
                    </div>

                    <div class="form-group">

                      <div class="col-sm-12">
                        {{Form::text('card_number',null,['placeholder' => 'Card Number', 'class' => 'form-control', 'required' => 'required'])}}
                      </div>
                    </div>

                    <div class="form-group">

                      <div class="col-sm-12">
                        {{Form::text('roll_number',null,['placeholder' => 'Roll Number', 'class' => 'form-control', 'required' => 'required'])}}
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="submit" class="btn btn-default" value="Submit">
                      </div>
                    </div>
                  
                {{ Form::close() }}

                <div class="load_info">
                  {{   HTML::image('assets/images/loading.gif')}}
                </div>
          </div>
          
        </div>

      </div>
    </div>

    <!-- end of Modal -->


    <!-- thankyou Registration -->
      <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content institutions_modal-content">
            
              <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
            
            <div class="modal-body thankyou_body">
              <h3>Thank you.</h3>
              <p>we will get back to you soon.</p>              
            </div>
          </div>
        </div>
      </div>
    <!-- thankyou Registration end -->


@stop

@section('js')

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
    {{ HTML::script('assets/plugins/pikaday/moment.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.jquery.js') }}

     <script>
    
        $(document).ready(function(e) {


        var picker = new Pikaday(
        {
            field: document.getElementById('datepicker'),
            firstDay: 1,
            format: 'DD-MM-YYYY',
            minDate: new Date(1970, 0, 1),
            maxDate: new Date(2016, 12, 31),
            yearRange: [1970,2016]
        });
        

            /* Banner Slider Script */
            $('.banner_contslider, .worldofidoagslider').bxSlider({
                
                adaptiveHeight: true,
                controls: false,
                auto:true
            
            });

            $('#card_activation_issue').formValidation({
            
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
                    card_number: {
                      
                      validators: {
                        
                        numeric: {
                    
                          message: 'The value is not a number',
                        },
                        
                        stringLength: {
                           
                          min: 16,

                          max: 16,
                           
                          message: 'The Card number must be 16 digits only'
                        }                       
                      }
                    },
                    roll_number: {
                      
                      validators: {
                        
                        notEmpty: {
                          
                          message: 'Roll Number is required and cannot be empty'
                          
                        }                        
                      }
                    }
                }
            
            }).on('success.form.fv', function(e) {

                $(".having_trouble-body .load_info").show();
                
                e.preventDefault();

                var reg_form = $(e.target),fv = reg_form.data('formValidation');

                // Use Ajax to submit form data
                $.ajax({
                  url: '/cardActivationIssue',
                  type: 'POST',
                  data: reg_form.serialize(),
                  success: function(response) {

                    $(".having_trouble-body .load_info").hide();
                    
                    $("#having_trouble").hide();

                    $('#having_trouble').trigger("reset");
                    
                    $('#thankyou_reg').modal('show');
                    
                    $("body").removeClass("modal-open");                        

                  }
                });
            
            });

        });



        $(document).keyup(function(e) {
            if (e.keyCode == 27) {              

                if( $("#having_trouble").hasClass("in") || $("#thankyou_reg").hasClass("in")){

                  $("#having_trouble").hide();

                  $('#thankyou_reg').hide();

                  $(".having_trouble a").trigger("click");
                }
          
            }
        });   

        function refreshCaptcha()
        {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?characters=5&amp;rand="+Math.random()*1000;

        }
    </script>

@stop
