@extends('layouts.defaultv2')

@section('title','Contact Us |idoag.com')

@section('metatags')
<meta name="keywords" content="Contact Us |idoag.com" />
<meta name="description" content="Contact Us |idoag.com" />
@stop
@section('css')
    <style>
        .has-error .help-block,
        .has-error .control-label,
        .has-error .radio,
        .has-error .checkbox,
        .has-error .radio-inline,
        .has-error .checkbox-inline,
        .has-error.radio label,
        .has-error.checkbox label,
        .has-error.radio-inline label,
        .has-error.checkbox-inline label {
         color: #a94442;
        }
    </style>
@stop
@section('content')
    @include('layouts.headerv2')
    <div class="container">    
        <div id="accordion" class="myaccordion">
            <h1>Contact idoag</h1>
            <p><span>Get in touch with us to get the ball rolling</span></p>
            <div class="row contact_locationinfo">
                <div class="col-md-4">
                    <div class="contact_locationinfo wow fadeInUp">
                        {{ HTML::image('assets/imagesv2/contactlocation_img1.png') }}                 
                        <p>B-131 Basement Floor, Sector 50 Noida, UP - 201301</p>    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_locationinfo wow fadeInUp" data-wow-delay="0.3s">
                        {{ HTML::image('assets/imagesv2/contactlocation_img2.png') }}
                        <a href="mailto:info@idoag.com"><p>info@idoag.com</p></a>   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_locationinfo wow fadeInUp" data-wow-delay="0.6s">
                        {{ HTML::image('assets/imagesv2/contactlocation_img3.png') }}
                        <ul>
                        <li><a href="https://www.facebook.com/idoag" target="_blank">{{ HTML::image('assets/imagesv2/facebook.svg') }}
                            <span>Facebook</span>  </a>  
                        </li>
                            <li><a href="http://instagram.com/social.idoag" target="_blank">{{ HTML::image('assets/imagesv2/instagram.svg') }}
                            <span>Instagram</span> </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container_info wow fadeInUp">
                <h1>Drop us a message...</h1>
                <p><span>We're always happy to hear from you. Just fill in the form below and we 'll get back to you as soon as we can.</span></p>
                {{ Form::open(['class' => 'contactus_fullform','id' => 'contact-form-validate']) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group custom_fd">
                                {{Form::text('firstname',null,['placeholder' => 'First Name', 'required' => 'required', 'class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group custom_fd">
                                {{Form::text('lastname',null,['placeholder' => 'Last Name',  'required' => 'required', 'class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group custom_fd">
                                {{Form::text('email',null,['placeholder' => 'Email',  'required' => 'required', 'class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group custom_fd">
                                {{Form::text('phone',null,['placeholder' => 'Phone','required' => 'required', 'class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group custom_txt_aria">
                                {{Form::textarea('message',null,['placeholder' => 'Message', 'class'=>'form-control' ])}} 
                            </div>
                        </div>
                        <div class="modal-footer custom-btn sub_bttn">
                            <button type="submit" class="btn-primary">Submit</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @include('layouts.footerv2')

@stop

@section('js')

<script>
    $('#brand_icon').owlCarousel( {
        loop:true,
        margin:10,
        nav:false,
        dots:false,
        autoplay:true,
        smartSpeed: 1000,
        autoplayTimeout:4000,
        responsive: {
            1900: {
                items: 5.4
            },
            1024: {
                items: 5.4
            },
            667: {
                items: 3.2
            },
            0: {
                items: 3.2
            }
        }
    });  
    $(document).ready(function () {

        $('#contact-form-validate').formValidation({

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

                firstname: {

                    validators: {

                        notEmpty: {
                            message: 'The first name is required and cannot be empty'
                        }
                    }
                },
                lastname: {

                    validators: {

                        notEmpty: {

                            message: 'The last name is required and cannot be empty'
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
                phone: {

                    validators: {

                        numeric: {

                            message: 'The value is not a number'
                        },

                        stringLength: {

                            min: 10,

                            max: 10,

                            message: 'The Mobile number must be 10 digits only'
                        }
                    }
                }
            }

        })

    });

</script>    

@stop