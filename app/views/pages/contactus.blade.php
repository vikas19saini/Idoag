@extends('layouts.default')

@section('title','Contact Us |idoag.com')

@section('metatags')
<meta name="keywords" content="Contact Us |idoag.com" />
<meta name="description" content="Contact Us |idoag.com" />
@stop

@section('content')

<!-- Content Start Here -->
<div class="wrapper">

    <!-- Header Starts here -->
    @include('layouts.header')
    <!-- Header Ends here -->




    <div class="brandoffer_info contactwrapper_info">
        @include('partials.flash')
        <div class="container_info contactus_info">

            <h1>Contact idoag</h1>
            <p>Get in touch with us to get the ball rolling</p>
            <div class="row contact_locationinfo">
                <div class="col-md-4 col-sm-4 col-xs-12 contact_list">
                    <figure class="figure">
                        {{ HTML::image('assets/images/contactlocation_img1.png','',['class'=>'img-rounded'])}}
                        <figcaption class="figure-caption text-center">
                            B-131 Basement Floor,<br/>
                            Sector 50 Noida,<br/>
                            UP - 201301</figcaption>
                    </figure>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 contact_list">
                    <figure class="figure">
                        {{ HTML::image('assets/images/contactlocation_img2.png','',['class'=>'img-rounded'])}}
                        <figcaption class="figure-caption text-center">
                            <a href="mailto:info@idoag.com?Subject=Contact">info@idoag.com</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 contact_list">
                    <figure class="figure">
                        {{ HTML::image('assets/images/contactlocation_img3.png','',['class'=>'img-rounded'])}}
                        <figcaption class="figure-caption text-center figure-scocialicons">
                            <span><a href="https://www.facebook.com/idoag" target="_blank"> {{ HTML::image('assets/images/contact_fb.png')}}<i>Facebook</i></a></span>
                            <span><a href="http://instagram.com/social.idoag" target="_blank">{{ HTML::image('assets/images/ig_icon.png', 'Instagram') }}<i>Instagram</i></a></span>
                        </figcaption>
                    </figure>
                </div>
            </div>





        </div>

        <div class="contactus_from">
            <div class="container_info">
                <h1>Drop us a message...</h1>
                <p>We're always happy to hear from you. Just fill in the form below and we 'll get back to you as soon as we can. </p>


                <div class="form-area contactus_fullform">
                    {{ Form::open(['class' => 'form-group form-inline','id' => 'contact-form-validate']) }}
                    <div class="form-group">
                        {{Form::text('firstname',null,['placeholder' => 'First Name', 'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('lastname',null,['placeholder' => 'Last Name',  'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('email',null,['placeholder' => 'Email',  'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('phone',null,['placeholder' => 'Phone','required' => 'required'])}}
                    </div>
                    <div class="form-group form-textarea">
                        {{Form::textarea('message',null,['placeholder' => 'Message' ])}} 
                    </div>

                    <div class="form-group grecaptcha_adjust">
                        <div class="input-group">
                            <div class="captha_input">
                                <div class="g-recaptcha" id="captchaContainer"  data-theme="light" data-sitekey="6LdjgRgTAAAAAMp-Ztydlt8NpmG3761HKYeKxLT6" style="transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>  
                            </div>
                        </div>
                    </div>

                    <div class="form-inline"> 
                        <div class="input-group">
                            {{ Form::submit('Submit', array('class' => 'btn btn-primary text-center')) }}
                        </div>
                    </div> 

                    {{ Form::close() }}
                </div>


            </div>
        </div>


    </div>
</div>        <!-- Footer Starts here -->
@include('layouts.footer')
<!-- Footer Ends here -->

@stop

@section('js')

<script>

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