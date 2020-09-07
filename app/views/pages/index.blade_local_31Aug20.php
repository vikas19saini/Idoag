@extends('layouts.defaultv2')

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

@stop


@section('content')
@include('layouts.headerv2')
<div class="header-bg container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="top_baner_owl" class="owl-carousel owl-theme baner_slider">
                    <div class="item">
                        <div class="banner-txt wow fadeInleft">
                            <h1>We Bring Benefits in Your ID’s</h1>
                            <p id="activecart">No Loyalty Programmes - No Reward Points - Only Direct <span>Savings</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="banner-txt">
                            <h1>10 At a Time.</h1>
                            <p id="activecart">We do 10 best offer from 10 best Brands at any given point of time.</p>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>
<div class="in_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-10 bx-mrg-center">
                <div class="inner-ovrly wow fadeInUp">
                    <div class="overlay-on-bg">
                        <h2>Simply enter your unique 16 digit number and you are all set to <span> access unique offers and do big savings with us .</span></h2>
                         {{ Form::open(['class' => 'form-group activation_mobile','route' => 'student_activate']) }}
						<div class="form-group custom_field card_input" >
                            <input type="text" name='card_number' required="true" id="validatecardnumber" class="form-control inpt_br_hidden" placeholder="XXXX XXXX XXXX XX45">
                            <button type="button" id="pwd" class="loern-btn enter_btn">Next</button>
						</div>
						<p class="errorCardNumber"></p>
						{{ errors_for('card_number', $errors) }}
						<div class="form-group custom_field row dob_input" style="display:none;">
                            <input type="text" name='dob'  readonly placeholder='Enter your Date of Birth(dd/mm/yyyy)' autocomplete="off" id="datepicker" class="form-control inpt_br_hidden" >
							<select name="companyId" autocomplete="off" class='wow fadeInDown animated claw' data-wow-delay="0.3s"/>
							</select>
							<button type="submit" id="pwd" class="loern-btn enter_btn2">Activate</button>
						</div>
						{{ errors_for('dob', $errors) }}
                        {{ Form::hidden('_token', csrf_token()) }}
						{{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container wow fadeInUp">
    <div class="row">
        <div class="col-md-12">
            <div class="inner-sec1 inner-sec txt-btn-rght inner-mobTx">
                <h3>FAVOURITE OFFERS</h3>  
                <p>We have curated offers on your favourite Brands - Products <span>and Services .... Grab Now !!</span></p>
                <button class="view-bttn" id="loadMore">View All</button>
            </div>
        </div>
    </div>    
</div>
    
    <!-- TESTIMONIALS desktop -->
<section class="testimonial_desk">
	<div class="container">
        <div class="row">
            <div class="col-sm-3  wow fadeInUp">
                <div class="shadow-effect">                 
                    {{ HTML::image('assets/imagesv2/offer_pictur.png','',['class'=>'img-fluid'])}}
                    <button><a href="other-letest.html">Claim Now</a></button>
                </div>
            </div>
            
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="shadow-effect">
                    {{ HTML::image('assets/imagesv2/offer-picture_1.png','',['class'=>'img-fluid'])}}
                    <button><a href="other-letest.html">Claim Now</a></button>
                </div>
            </div>
                
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="shadow-effect">
                    {{ HTML::image('assets/imagesv2/offer-picture_2.png','',['class'=>'img-fluid'])}}
                    <button><a href="other-letest.html">Claim Now</a></button>
                </div>
            </div>

            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.9s">
                <div class="shadow-effect">
                    {{ HTML::image('assets/imagesv2/offer-picture_1.png','',['class'=>'img-fluid'])}}
                    <button><a href="other-letest.html">Claim Now</a></button>
                </div>
            </div>
        </div>
        <div class="show_offer">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shadow-effect">
                        {{ HTML::image('assets/imagesv2/offer_pictur.png','',['class'=>'img-fluid'])}}
                        <button><a href="other-letest.html">Claim Now</a></button>
                    </div>
                </div>
            
                <div class="col-md-3" data-wow-delay="0.2s">
                <div class="shadow-effect">
                    {{ HTML::image('assets/imagesv2/offer-picture_1.png','',['class'=>'img-fluid'])}}
                    <button><a href="other-letest.html">Claim Now</a></button>
                </div>
                </div>
                
                <div class="col-md-3" data-wow-delay="0.4s">
                    <div class="shadow-effect">
                        {{ HTML::image('assets/imagesv2/offer-picture_2.png','',['class'=>'img-fluid'])}}
                        <button><a href="other-letest.html">Claim Now</a></button>
                    </div>
                </div>

                <div class="col-md-3" data-wow-delay="0.6s">
                    <div class="shadow-effect">
                        {{ HTML::image('assets/imagesv2/offer-picture_1.png','',['class'=>'img-fluid'])}}
                        <button><a href="other-letest.html">Claim Now</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<!-- TESTIMONIALS Mob-->
<section class="testimonial_mob">
	<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="customers-testimonials" class="img_custom owl-carousel wow fadeInRight">
                    <div class="item wow fadeInUp">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer_pictur.png') }}
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-delay="0.3s">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer-picture_1.png') }}   
                            
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>
              
                    <div class="item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer-picture_2.png') }}  
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>

                    <div class="item wow fadeInUp" data-wow-delay="0.9s">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer-picture_1.png') }}  
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>
                    <div class="item wow fadeInUp">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer_pictur.png') }}
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-delay="0.3s">
                        <div class="shadow-effect">
                            {{ HTML::image('assets/imagesv2/offer-picture_1.png') }}  
                            <button><a href="#">Claim Now</a></button>
                        </div>
                    </div>
                    <!--END OF TESTIMONIAL 5 -->
                 </div>
            </div>
        </div>
    </div>
</section>
    
    
<section class="how_works wow fadeInUp"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-sec">
                    <h3>How Idoag works</h3> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="works-sec inner-sec image-zm wow fadeInUp">
                    {{ HTML::image('assets/imagesv2/Image-127.png') }}
                    <h3>ACTIVATE</h3> 
                    <p>Avail all our unique offers by simply entering your 16 digit number in the activate box .</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="works-sec inner-sec image-zm wow fadeInUp" data-wow-delay="0.3s">
                    {{ HTML::image('assets/imagesv2/img_9.png') }}
                    <h3>CLAIM</h3> 
                    <p>Click on any offer to reach to the coupon code / valid product link and enjoy our world of unlimited savings.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="works-sec inner-sec image-zm wow fadeInUp" data-wow-delay="0.6s">
                    {{ HTML::image('assets/imagesv2/img_10.png') }}
                    <h3>SAVE</h3> 
                    <p>At Idoag we work dedicatedly to provide every user savings on things they love to buy.</p>
                </div>
            </div>
        </div>    
    </div>
</section>
 
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-sec carousel_user wow fadeInUp">
                    <h3>What Idoag users are saying</h3> 
                    <p>Some fun reads put together for us to understand our relationship with our users </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="Partners_slider" class="img_custom owl-carousel img_mrg">
                   
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="sec-5 image-zm wow fadeInUp" data-wow-delay="0.3s">
                                <img src="images/icon-1.png" alt="">
                                <h3>{{$testimonial->name}}</h3>
                                {{ HTML::image("uploads/press/".$testimonial->image_logo) }}
                                <p>{{ str_limit(strip_tags($testimonial->description), $limit = 600, $end = '...')}}</p>
                            </div>    
                        </div> 
                    @endforeach  
                    
                </div>
            </div>
        </div>

        <div class="desk_s wow fadeInUp">
            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-sm-4 col-lg-3">
                        <div class="sec-5 wow fadeInUp">
                            <p>  {{ HTML::image("uploads/press/".$testimonial->image_logo,'',['style'=>'height:auto;width:50%'] )}}</p>
                            <h3>{{$testimonial->name}}</h3>
                            <img src="images/Image%20100.png" alt="">
                            <p>{{ str_limit(strip_tags($testimonial->description), $limit = 100, $end = '...')}}</p>
                        </div> 
                    </div>
                @endforeach
            </div>
        </div>
    </div> 
</section>
    
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-sec inner_bttm_mg wow fadeInUp wow fadeInUp">
                    <h3>Our Brand Partners </h3> 
                    <p>Those valuable organisations that help us bring a smile on our face everyday.</p>
                </div>
            </div>
        </div>
        <div id="brand_icon" class="owl-carousel">
            @foreach($brands as $brand)
                <div class="item">
                    <div class="image-zm"><a href="{{URL::route('brand_profile',array($brand->slug))}}">{{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'img-fluid'])}}</a></a></div>
                </div>
            @endforeach  

        </div>
    </div>
</section>
    
   
    
    <section class="partner_bttm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-sec wow fadeInUp">
                        <h3>Partners with us</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 con_left custom_wd wow fadeInUp">
                    <div class="col-marchant">
                        <h4>Merchant Partnership</h4>
                        <p>Gain Visibility to over 200000+ verified users.</p>
                        <button data-toggle="modal" data-target="#popUpWindow1" class="get_in_button">Get in touch</button>
                    </div>

                </div>
                <div class="col-sm-6 col-lg-4 con_left custom_wd wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-marchant">
                        <h4>College/Uni Partners.</h4>
                        <p>Connect with us to help every student save everytime they buy there favourite Products- Services & Brands .</p>
                        <button data-toggle="modal" data-target="#popUpWindow1" class="get_in_button">Get in touch</button>
                    </div>    
                </div>
                <div class="col-sm-6 col-lg-4 con_left custom_wd wow fadeInUp" data-wow-delay="0.6s">
                    <div class="col-marchant">
                        <h4>Corporate</h4>
                        <p>Connect with us to collaborate in making every employee a happy employee.</p>
                        <button data-toggle="modal" data-target="#popUpWindow1" class="get_in_button">Get in touch</button>
                    </div>    
                </div>
            </div>
        </div>
    </section>
@include('layouts.footerv2')


@stop

@section('js')
{{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
{{ HTML::script('assets/plugins/pikaday/moment.js') }}
{{ HTML::script('assets/plugins/pikaday/pikaday.js') }}
{{ HTML::script('assets/plugins/pikaday/pikaday.jquery.js') }}
<script>
$('#customers-testimonials').owlCarousel( {
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    responsive: {
        1900: {
            items: 4.2
        },
        1024: {
            items: 4.2
        },
        
        568: {  
            items: 2.2,
            },
        
        667: {
            items: 2.1
        },
        640: {
            items: 2.2
        },
        0: {
            items: 1.2
        }
    }
});
    </script>
    
<script>
$(document).ready(function(){
  $("#loadMore").click(function(){
    $(".show_offer").slideToggle();
  });
});   
</script>
    
    
<script>
$('#top_baner_owl').owlCarousel( {
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    autoplay:true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    responsive: {
        1900: {
            items: 1
        },
        1024: {
            items: 1
        },
        667: {
            items: 1
        },
        0: {
            items: 1
        }
    }
});    
</script>
    
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
</script>

    
<script>
$('#Partners_slider').owlCarousel( {
		loop: true,
		autoplay:false,
		dots:false,
        nav:true,
        autoplay:false,
		responsive: {
			0: {
                
            items: 1.2,
            nav:false,
			},
            
            568: {  
            items: 2.2,
            nav:false,
            },
            
			667: {  
            items: 2.2,
            nav:false,
            },
            
			1170: {
            
				items: 4
			}
		}
	});
    </script>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    
<script>
function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle()
    $('#logreg-forms .form-reset').toggle() 
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})    
</script>
<script>
var wow = new WOW();
  wow.init();
</script>

<script>    
    $(document).ready(function () {
        var picker = new Pikaday(
		{
			field: document.getElementById('datepicker'),
			firstDay: 1,
			format: 'DD-MM-YYYY',
			minDate: new Date(1930, 0, 1),
			maxDate: new Date(2016, 12, 31),
			yearRange: [1930, 2016]
		});
	});
</script>


<script>
$(document).ready(function(){
	$(".enter_btn").click(function(){
		var cardNumber = '';
		ref = this;
		/*if($("#validatecardnumber").val() != "" && $("#validatecardnumber1").val() == ""){
			cardNumber = $("#validatecardnumber").val();
		}
		if($("#validatecardnumber").val() == "" && $("#validatecardnumber1").val() != ""){
			cardNumber = $("#validatecardnumber1").val();
		}*/
		
		cardNumber = $("#validatecardnumber").val();
		
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
							console.log("inst");
							
							$(".dob_input select").css('display', 'none');
							//$(".dob_input input[type=text]").css('display', 'block');
							$(".dob_input").removeAttr('style');
							$(".card_input").css('display', 'none');
							$(".errorCardNumber").css('display', 'none');
							
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
