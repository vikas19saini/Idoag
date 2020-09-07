@extends('layouts.default')

@section('title','IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com')

@section('metatags')
<meta name="keywords" content="IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com" />
<meta name="description" content="IDOAG: Save, Create, Connect | Student Discount Card, India | Internships | Opportunities |Events | Brand Connect  | Institute Connect |idoag.com" />

<meta property="og:description" content="Offers & Discounts for Students |idoag.com">
<meta property="og:image" content="http://idoag.com/assets/images/connectstudents_bg.jpg">
<meta property="og:title" content="Offers & Discounts for Students |idoag.com">
<meta property="og:url" content="{{ Request::fullUrl(); }}">
<meta property="fb:app_id" content="1664606373750912">
<meta property="og:type" content="idoagconnect:website">
<meta property="twitter:card" content="summary">
<meta property="twitter:creator" content="idoag">
<meta property="twitter:domain" content="idoag.com">
<meta property="twitter:site" content="idoag.com">
@stop

@section('css')
{{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}    
{{ HTML::style('assets/plugins/pikaday/pikaday.css') }}
<!-- New Stylesheets -->
{{ HTML::style('assets/css/fontawesome-all.min.css') }}
@stop

@section('classtitle')
index-page
@stop
@section('content')

<!-- Content Start Here -->
<div class="wrapper home">

    <!-- Header Starts here -->
    @include('layouts.header')
    <!-- Header Ends here -->

    @include('partials.flash2')

    

    <div class='row'>
        
        <!-- Desktop slider -->
        
         <div class="carousel fade-carousel slide carousel-fade hidden-sm hidden-xs" data-ride="carousel" data-interval="6000" id="bs-carousel">
            <div class="carousel-inner piislider">			   
		<?php
                $counter = 0;
                $indictors = '';
                ?>
                @foreach($main_banner_sliders as $slider)
                <?php $ext = explode('.', $slider->image_name)?>
                    <div class="item slides @if($counter == 0) active bg_div_use @endif" style="background-size: cover;background-repeat: no-repeat;background-image: url('uploads/{{ $slider->image_name }}');">
                        @if($slider->link != '')
                          <a href='{{$slider->link}}' target='_{{$slider->target}}'>
                        @endif
                            @if(end($ext) == 'mp4')
                                <video class='video' width="100%" autoplay loop>
                                    <source src="uploads/{{ $slider->image_name }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <div class='link_url'>
                                    <div class="hero">
                                        <div class="bg_slider_content bounceInLeft">                            
                                           <!--<h3 style="color:{{$slider->text_color}}">{{ $slider->name }}</h3>-->
                                           <p>{{ $slider->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @if($slider->link != '')
                            </a>
                        @endif
                    </div>
                <?php                 
                if($counter == 0)
                    $indictors .= '<li data-target="#bs-carousel" data-slide-to="' . $counter . '" class="active"></li>';
                else
                    $indictors .= '<li data-target="#bs-carousel" data-slide-to="' . $counter . '"></li>';                        
                ?>
                <?php $counter++ ?>
                @endforeach               
            </div>
            <ol class="carousel-indicators">
               {{ $indictors }}
            </ol>
         </div>        
        <!-- Desktop slider end -->        
        <!-- Mobile Slider -->
        
        <div id="myCarousel" class="carousel slide   hidden-lg hidden-md" data-ride="carousel">                   
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                     <?php
                $counter = 0;
                $indictors = '';
                ?>
                @foreach($main_banner_sliders as $slider)
                    <?php $ext = explode('.', $slider->mobile_image)?>
                        <div class="item @if($counter == 0) active bg_div_use @endif div_wso">
                            @if($slider->link != '')
                                <a href='{{$slider->link}}' target='_{{$slider->target}}'>
                            @endif
                                @if(end($ext) == 'mp4')
                                    <video class='video' width="100%" autoplay loop>
                                        <source src="uploads/{{ $slider->mobile_image }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <img src="uploads/{{ $slider->mobile_image }}" class="img-responsive" style="width:100%; height:100vh">
                                    <div class='bg_slider_content bounceInLeft'>
                                        <!--<h3 style="color:{{$slider->text_color}}">{{ $slider->name }}</h3>-->
                                        <p>{{ $slider->title }}</p>
                                    </div>
                                @endif
                            @if($slider->link != '')
                                </a>
                            @endif
                        </div>
                <?php 
                
                if($counter == 0)
                    $indictors .= '<li data-target="#myCarousel" data-slide-to="' . $counter . '" class="active"></li>';
                else
                    $indictors .= '<li data-target="#myCarousel" data-slide-to="' . $counter . '"></li>';
                        
                ?>
                <?php $counter++ ?>
                @endforeach               
            </div>            
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    
                     <!-- Indicators -->
                    <ol class="carousel-indicators">
                        {{ $indictors }}
                    </ol>                    
                </div>
            </div>
        
        <!-- Mobile Slider End -->
        
      </div>
    
    <div class="clearfix"></div>
    <!-- mid enter start -->
            <div class='row bg_div_use_row'>
                <div class='container'>
                    <div class='row_containe_main' id="activateyouridoag_info">
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                            <div class='row  inner_row' onclick="window.location.href='{{Url::route('offers')}}'">
                                <div>
                                    <img src='{{URL::to('/')}}/assets/images/icon_1.png' alt='icon_use'>
                                    <img src='{{URL::to('/')}}/assets/images/icon_1_hover.png'>
                                </div>
                                <h1>Campus Offers</h1>
                            </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                            <div class='row inner_row' onclick="window.location.href='{{Url::route('offers')}}'">
                                <div>
                                    <img src='{{URL::to('/')}}/assets/images/icon_2.png' alt='icon_use'/>
                                    <img src='{{URL::to('/')}}/assets/images/icon_2_hover.png' alt='icon_use'/>
                                </div>
                                <h1>Corporate Offers</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mid enter end  -->

    <div class="clearfix"></div>    

    <div class='row secon_div  d-flex flex-column-reverse desktop_on'>
                <div class='center_div'>
                    <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12 '>
                        <div class='inner_divp'>
                            
                            @if(!isset($loggedin_user))
                            
                                {{ Form::open(['class' => 'form-group activation_mobile','route' => 'student_activate']) }}
                                <div class="card_ani">
                                    <label class='row card_number' style="margin-bottom:0px">                                        
                                        <input type="text" placeholder='Enter your IDOAG card number' id="validatecardnumber" name='card_number' required="true" class='wow fadeInDown animated claw' autocomplete="off" data-wow-delay="0.2s"/>
                                    </label>
                                    <p class="errorCardNumber"></p>
                                {{ errors_for('card_number', $errors) }}
                                    <label class='row enter_btn'>                                        
                                        <button type="button" id="pwd" class='wow fadeInDown animated claw' data-wow-delay="0.4s">Next</button>
                                        <div class='clearfix'></div>
                                    </label> 
                                </div>
                                
                                 <div class="dob_ani">   
                                    <label class='row dob_input'>                                        
                                        <input type="text" name="dob" placeholder='Enter your Date of Birth(dd/mm/yyyy)' autocomplete="off" id="datepicker" class='wow fadeInDown animated claw' data-wow-delay="0.3s"/>
                                        <select name="companyId" autocomplete="off" class='wow fadeInDown animated claw' data-wow-delay="0.3s"/>
                                        </select>
                                    </label>
                                    <div class='clearfix'></div>
                                    {{ errors_for('dob', $errors) }}
                                    {{ Form::hidden('_token', csrf_token()) }}
                                    
                                    <label class='row enter_btn2'>                                        
                                        <button type="submit" id="pwd" class='wow fadeInDown animated claw' data-wow-delay="0.4s">Activate</button>
                                        <div class='clearfix'></div>
                                    </label> 
                                 </div>
                                    <p class='wow fadeInDown animated claw' data-wow-delay="0.5s"><a href="javascript:void(0)" data-toggle="modal" data-target="#having_trouble"  class="wow fadeInDown" data-wow-delay=".75s" style="visibility: visible">Having trouble Activating your card?</a></p>
                                    {{ Form::close() }}

                            @endif
                        </div>
                    </div>
                    <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <div class='inner_divp_s row'>
                            <h1 class='wow fadeInDown animated claw active_still' data-wow-delay="0.9s"> Still Not Active ?</h1>
                        </div>
                    </div>
                </div>
              <div class='clearfix'></div>
            </div>   
    
		<div id="activateyouridoag_info" class='row secon_div asdfjsdlf d-flex flex-column-reverse'>
                <div class=''>
                    <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <div class='inner_divp_s row'>
                            <h1 class='wow fadeInDown animated claw' data-wow-delay="0.9s"> Still Not Active ?</h1>
                        </div>
                    </div>
                    <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12 '>
                        <div class='inner_divp'>
                            @if(!isset($loggedin_user))
                            
                                {{ Form::open(['class' => 'form-group activation_mobile','route' => 'student_activate']) }}
                                <div class="card_ani">
                                    <label class='row card_number' style="margin-bottom:0px">                                        
                                        <input type="text" placeholder='Enter your IDOAG card number' id="validatecardnumber1" name='card_number' required="true" class='wow fadeInDown animated claw' autocomplete="off" data-wow-delay="0.2s"/>
                                        <p class="errorCardNumber"></p>
                                    </label>
                                {{ errors_for('card_number', $errors) }}
                                    <label class='row enter_btn'>                                        
                                        <button type="button" id="pwd" class='wow fadeInDown animated claw' data-wow-delay="0.4s">Next</button>
                                        <div class='clearfix'></div>
                                    </label> 
                                </div>
                                
                                 <div class="dob_ani">   
                                    <label class='row dob_input'>                                        
                                        <input type="text" name="dob" placeholder='Enter your Date of Birth(dd/mm/yyyy)' autocomplete="off" id="datepickerh1" class='wow fadeInDown animated claw' data-wow-delay="0.3s"/>
                                        <select name="companyId" autocomplete="off" class='wow fadeInDown animated claw' data-wow-delay="0.3s"/>
                                        </select>
                                    </label>
                                    <div class='clearfix'></div>
                                    {{ errors_for('dob', $errors) }}
                                    {{ Form::hidden('_token', csrf_token()) }}
                                    
                                    <label class='row enter_btn2'>                                        
                                        <button type="submit" id="pwd" class='wow fadeInDown animated claw' data-wow-delay="0.4s">Activate</button>
                                        <div class='clearfix'></div>
                                    </label> 
                                 </div>
                                    <p class='wow fadeInDown animated claw' data-wow-delay="0.5s"><a href="javascript:void(0)" data-toggle="modal" data-target="#having_trouble"  class="wow fadeInDown" data-wow-delay=".75s" style="visibility: visible">Having trouble Activating your card?</a></p>
                                    {{ Form::close() }}

                            @endif
                        </div>
                    </div>
                </div>
            </div>
    
    <div class="clearfix"></div>   
    
    <div class='row secon_div desktop_on'>

                <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                    <div class="row looking_here" data-wow-delay="0.75s">
                        <div class=' wow fadeInLeft claw'>
                            <h1 class=''>Get IDOAG Offers for your Office</h1>
                        </div>
                    </div>
                </div>
                <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                    <div class='register row'>
                        <div class='wow fadeInRight claw' data-wow-delay="0.75s">
                            <h1>CORPORATES</h1>
                            <button onclick="window.location='{{URL::route('brand-register')}}'">Register</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row secon_div asdfjsdlf'>
                <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                    <div class="row looking_here" data-wow-delay="0.75s">
                        <div class=' wow fadeInLeft claw'>
                            <h1 class=''>Get IDOAG Offers <span>for your Office</span></h1>
                        </div>
                    </div>
                </div>
                <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                    <div class='register row'>
                        <div class='wow fadeInRight claw' data-wow-delay="0.75s">
                            <h1>CORPORATES</h1>
                            <button onclick="window.location='{{URL::route('brand-register')}}'">Register</button>
                        </div>
                    </div>
                </div>
            </div>
    

    <div class="clearfix"></div>    
    
    <div class='row secon_div desktop_on'>
                <div class=''>
                    <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                        <div class='inner_divp'>
                            <div class='wow fadeInDown animated' data-wow-delay="0.9s">
                                <h1>COLLEGE - UNIVERSITY</h1>
                                <div class='clearfix'></div>
                                <label class='row'>
                                    <button onclick="window.location='{{ URL::route('inst-register') }}'">Register</button>
                                    <div class='clearfix'></div>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <div class='inner_divp_s row bg_work'>
                            <h1 class='wow fadeInDown animated claw dfrg' data-wow-delay="0.9s">Get IDOAG Benefits  For your Campus</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row secon_div asdfjsdlf'>
                <div class=''>
                    <div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <div class='inner_divp_s row bg_work'>
                            <h1 class='wow fadeInDown animated claw' data-wow-delay="0.9s">Get IDOAG Benefits  For your Campus</h1>
                        </div>
                    </div>
                    <div class='col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                        <div class='inner_divp'>
                            <div class='wow fadeInDown animated' data-wow-delay="0.9s">
                                <h1>COLLEGE - UNIVERSITY</h1>
                                <div class='clearfix'></div>
                                <label class='row'>
                                    <button onclick="window.location='{{ URL::route('inst-register') }}'">Register</button>
                                    <div class='clearfix'></div>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
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
                        {{Form::text('phone',null,['placeholder' => 'Contact Number', 'class' => 'form-control', 'required' => 'required'])}}
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-12">
                        {{Form::text('card_number',null,['placeholder' => 'Card Number', 'class' => 'form-control', 'required' => 'required'])}}
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-12">
                        {{ Form::textarea('message', null, ['placeholder' => 'Please type your message here in less than 150 characters.', 'maxlength'=>'150','class' => 'form-control', 'required' => 'required','size' => '30x4']) }}
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

<!-- Modal -->
<div id="card_activation" class="modal fade" role="dialog">
    <div class="having_trouble-dialog modal-dialog">

        <!-- Modal content-->
        <div class="having_trouble-content modal-content">
            <div class="modal-header having_trouble-header">
                <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
                <h4 class="modal-title">Activate your idoag card now!</h4>
            </div>
            <div class="modal-body having_trouble-body">

                {{ Form::open(['class' => 'form-horizontal','route' => 'student_activate']) }}

                <div class="form-group">
                    <div class="col-sm-12">
                        {{ Form::text('card_number', null, ['placeholder' => 'idoag Card Number', 'class' => 'form-control','required'=>'required','autocomplete' => 'off']) }}
                        {{ errors_for('card_number', $errors) }}                      
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        {{ Form::text('dob', null, ['placeholder' => 'date of birth (dd/mm/yyyy)', 'class' => 'form-control','id'=>'datepickerh2','required'=>'required','autocomplete' => 'off']) }}                            
                        {{ errors_for('dob', $errors) }}                     
                    </div>
                </div>

                {{ Form::hidden('_token', csrf_token()) }}

                <div class="form-group">

                    <div class="col-sm-12">
                        {{ Form::submit('Activate')}}
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
                <h3>We regret the inconvenience</h3>
                <p> We will get back to you as soon as we can</br>
                </p>              
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

{{ HTML::script('assets/js/smooth-scroll.js') }}
{{ HTML::script('assets/js/bootstrap-carousel-swipe.js') }}
{{ HTML::script('assets/js/custom.js') }}

<script>    
    $(document).ready(function (e) {
        var picker = new Pikaday(
                {
                    field: document.getElementById('datepicker'),
                    firstDay: 1,
                    format: 'DD-MM-YYYY',
                    minDate: new Date(1930, 0, 1),
                    maxDate: new Date(2016, 12, 31),
                    yearRange: [1930, 2016]
                });
        var picker1 = new Pikaday(
                {
                    field: document.getElementById('datepickerh1'),
                    firstDay: 1,
                    format: 'DD-MM-YYYY',
                    minDate: new Date(1930, 0, 1),
                    maxDate: new Date(2016, 12, 31),
                    yearRange: [1930, 2016]
                });
        var picker2 = new Pikaday(
                {
                    field: document.getElementById('datepickerh2'),
                    firstDay: 1,
                    format: 'DD-MM-YYYY',
                    minDate: new Date(1930, 0, 1),
                    maxDate: new Date(2016, 12, 31),
                    yearRange: [1930, 2016]
                });
                
        setBannerHeightAsperWindow();
        /* Banner Slider Script */
        $('.banner_contslider, .worldofidoagslider').bxSlider({
            adaptiveHeight: true,
            controls: false,
            auto: true
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
                        },
                        remote: {
                            message: 'Given Card Number is not valid',
                            url: '/cardNumberExists',
                            data: {type: 'card_number'},
                            type: 'POST',
                            onSuccess: function (e, data) {
                                console.log(data);
                                $('.help-block').filter(function (index) {
                                    return index == 6
                                }).show();
                                $("#card_activation_issue").formValidation("updateMessage", "card_number", "remote", data.result.new_message);
                            },
                            onError: function (e, data) {
                                $("#card_activation_issue").formValidation("updateMessage", "card_number", "remote", data.result.new_message);
                            }
                        }
                    }
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Message is required'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {

            $(".having_trouble-body .load_info").show();

            e.preventDefault();

            var reg_form = $(e.target), fv = reg_form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: '/cardActivationIssue',
                type: 'POST',
                data: reg_form.serialize(),
                success: function (response) {

                    $(".having_trouble-body .load_info").hide();

                    $("#having_trouble").hide();

                    $('#card_activation_issue').trigger("reset");

                    reg_form.data('formValidation').resetForm();

                    $('#thankyou_reg').modal('show');

                    $("body").removeClass("modal-open");

                }
            });

        });

    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27) {

            if ($("#having_trouble").hasClass("in") || $("#thankyou_reg").hasClass("in")) {

                $("#having_trouble").hide();

                $('#thankyou_reg').hide();

                $(".having_trouble a").trigger("click");
            }

        }
    });

    $(window).resize(function () {
        setBannerHeightAsperWindow();
    });

    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?characters=5&amp;rand=" + Math.random() * 1000;

    }

    function setBannerHeightAsperWindow() {
        if ($(window).width() > 1024) {
            var height = $(window).height();
            var headerHeight = $('header').height();
            height = height - headerHeight;
            $('.wrapper.home .container_infos').css('height', height);
        } else {
            $('.wrapper.home .container_infos').removeAttr('style');
        }
    }
    
    $(document).ready(function(){
        $(".enter_btn").click(function(){
            var cardNumber = '';
            ref = this;
            if($("#validatecardnumber").val() != "" && $("#validatecardnumber1").val() == ""){
                cardNumber = $("#validatecardnumber").val();
            }
            if($("#validatecardnumber").val() == "" && $("#validatecardnumber1").val() != ""){
                cardNumber = $("#validatecardnumber1").val();
            }
            $.ajax({
                type: 'post',
                url: '/validateCardAndUserType',
                data: {"card_number": cardNumber},
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.valid){
                        if(data.new_message === ""){
                            if(data.type === 'company'){
                                $(".dob_input select").html('');
                                for(var i=0; i<data.companies.length; i++){
                                    $(".dob_input select").append('<option value="'+ data.companies[i].id +'">'+data.companies[i].name+'</option>');
                                }
                                $(".dob_input select").css('display', 'block');
                                $(".dob_input input[type=text]").css('display', 'none');
                            }
                            if(data.type === 'institution'){
                                $(".dob_input select").css('display', 'none');
                                $(".dob_input input[type=text]").css('display', 'block');
                            }
                            $(ref).addClass("active");            
                            $(".card_ani").addClass("active");
                            $(".dob_ani").addClass("active");
                        }else{
                            $("p.errorCardNumber").text(data.new_message);
                        }
                    }else{
                        $("p.errorCardNumber").text(data.new_message);
                    }
                }
            });          
        })
    })
</script>

@stop
