@extends('layouts.defaultv2')

@section('title','Offer - '.$single->name.' from '.$brand->name.' |idoag.com')

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

<style>
.top_right_hdTx h4 p{
	color:black !important;
	background:#fff !important;
}
</style>
@stop

@section('content')
@include('layouts.headerv2')
    <!-- Content Start Here -->
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 sec_1 sec_1Tx">
			<!--<img src="images/offer_mob.png" class="img-fluid" alt="">-->
				{{ HTML::image(getImage('uploads/photos/',$single->image,'noimage.jpg'),'',['class'=>'img-fluid'])}}

				<div class="img_tx"><a href="#"><p>View Details</p></a></div>
			</div>
			<div class="col-md-6 sel_2_left">
				<div class="top_right_hdTx">
					<!--<h2>Galaxy Note 8 - On Exclusive Campus price</h2>-->
					<h2>{{ $single->name}}</h2>
					<p>Valid Till {{ date("F d, Y", strtotime($single->end_date))  }}</p>
					@if(!empty($single->description))
					<h3>How to Avail this Offer</h3>
					<h4>{{ ($single->description)}}</h4>
					 @endif
					<!--<ol>
					<li> Click on following link :
						<a href="#">https://shop.samsung.com/in/byod/idoag</a>
						</li>
						<li>Mark the 'checkbox' : "I have an agent code"</li>
						<li>Enter your 16 digit idoag card number in the agent code column.</li>
						<li>Enter your email id that you have registered with your college.</li>
						<li>Enter your mobile number that you have registered with your college.</li>
						<li>You will receive an OTP and eStore Password on your email.</li>
						<li>Enter OTP and Submit.. .</li>
					</ol>-->
					<br/>
					<button type="botton" class="calim_bttn">Calim Now</button>
					<small>My coupon code isn’t working. <a href="{{ URL::route('contactus') }}">Need Help</a></small>
				</div>
			</div>
		</div>
    </div>
	
	
	<!-- TESTIMONIALS -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="letest_dis inner-sec les_dis wow fadeInUp">
						<h3>Other Offers </h3>  
						<p>Get us hands on our Best Offers from this month.</p>
					</div>
					<div id="customers-testimonials" class="img_custom owl-carousel wow fadeInRight">
						@foreach($offers as $offer)
							@if($offer->id != $single->id)
								<div class="item wow fadeInUp">
									  <div class="shadow-effect">
										<!--<img src="images/offer_pictur.png" alt="">-->
											{{ HTML::image(getImage('uploads/photos/M_',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}}
                                            
                                                                
										<button><a @if(Sentry::check())  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" @else
                                            href="#" data-toggle="modal"  data-target="#login_required" @endif >Claim Now</a></button>
									</div>
								</div>
							@endif
						@endforeach
					
					<!--END OF TESTIMONIAL 5 -->
					</div>
				</div>
			</div>
		</div>
    </section>
	
	<section class="partner_brand">
		<div class="container">
			<div class="inner-sec inner_bttm_mg wow fadeInUp">
				<h3>Brand Discounts</h3>  
				<p>Get Your Refund 12 working hours Incase Of Transaction Failures.</p>
			</div>
			<div id="brand_icon" class="owl-carousel">
				@if($brandoffers)
					@foreach($brandoffers as $offer)
				
						<div class="item">
							<!--<div class="image-zm"><a href="#"><img src="images/brand/Ajio.png" alt=""></a></div>-->
							
							<div class="image-zm">
								<a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">
							<!--{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'),'',['class'=>'img-fluid'])}}-->
							
							{{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'')}}
							</a>
							</div>
						</div>
					@endforeach
				@endif
			   
			</div>
		</div>
    </section>
	
    
	
	
	
	<!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footerv2')
    <!-- Footer Ends here -->


    <div id="having_trouble" class="modal fade" role="dialog">
        <div class="having_trouble-dialog modal-dialog">

            <!-- Modal content-->
            <div class="having_trouble-content modal-content">
                <div class="modal-header having_trouble-header">
                    <button type="button" class="close"
                            data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
                    <h4 class="modal-title">Report Problem</h4>
                </div>
                <div class="modal-body having_trouble-body">

                    {{ Form::open(['class' => 'form-horizontal','id' => 'offer_problem_issue', 'files' => 'true']) }}

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{ Form::select('reason', array('' => 'Select Reason') + $offer_problems,  null ,  ['class' => 'form-control', 'required' => 'required'])}}
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">
                            {{Form::textarea('message',null,['placeholder' => 'Details', 'class' => 'form-control', 'required' => 'required'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">

                            <input type="hidden" name="post_url" value="{{Request::fullUrl()}}">
                            <input type="hidden" name="post_id" value="{{$single->id}}">
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

    <!-- thankyou Registration -->
    <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content institutions_modal-content">

                <button type="button" class="close"
                        data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>

                <div class="modal-body thankyou_body">
                    <h3>We regret the inconvenience.</h3>

                    <p>We will get back to you as soon as we can</br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- thankyou Registration end -->

@stop

@section('js')

    {{ HTML::script('assets/js/notescript.js') }}
	{{ HTML::script('assets/js/isotope-docs.min.js') }}
	{{ HTML::script('assets/js/jquery.easing.min.js') }}        
    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
	
	
<script>
var wow = new WOW();
  wow.init();
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
$('#customers-testimonials').owlCarousel( {
		loop: true,
		items: 4,
		margin: 10,
		dots:true,
        nav:false,
  	     navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive: {
			0: {
				items: 1.2
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
			768: {
				items: 2.2
			},
            1024: {
				items: 3.2
			},
			1170: {
				items: 4.2
			}
		}
});
    </script>
    
<script>
$('#testimonials_mob').owlCarousel( {
		loop: true,
		items: 4,
		margin: 10,
		dots:false,
        nav:false,
  	     navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive: {
			0: {
				items: 1.2
			},
			768: {
				items: 2.2
			},
            1024: {
				items: 3.2
			},
			1170: {
				items: 4.2
			}
		}
});
    </script>









    <script>

        $(document).ready(function (e) {

            $('.whitebg').hide();

            $('.coupon_codetxt').hide();

            $('#avail_stores').submit(function (e) {

                e.preventDefault();

                var state = $('#stateId').val();

                var city = $('#cityId').val();

                var location = $('#location').val();

                var post_id = $('.stores_available').attr('id');

                var data = "&state=" + state + "&city=" + city + "&location=" + location + "&post_id=" + post_id;

                $.ajax(
                        {
                            url: '/availableStores',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                $('.whitebg').show();

                                if (response) {
                                    var data = response.available_stores;

                                    $('.available_table > tbody').html('');

                                    $.each(data, function (index, value) {
                                        console.log(index);
                                        $('.available_table > tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.city + '</td><td>' + value.locality + '</td></tr>');

                                    });
                                }
                            }
                        });
            });

            $('.statistics_slider').bxSlider({

                pager: false
            });


            $('.singlecoupon').on('click', function () {

                var post_id = $(this).attr('id');

                var data = "post_id=" + post_id;

                $.ajax({
                    url: '/userSingleCoupon',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        console.log(response);
                        if (response) {
                            $('.singlecoupon').html(response.code).removeAttr("href");
                        }

                    }
                });
            });

            $('.multiplecoupon').on('click', function () {

                var post_id = $(this).attr('id');

                var data = "post_id=" + post_id;

                $.ajax({
                    url: '/userMultipleCoupon',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        if (response) {
                            $('.multiplecoupon').hide();
                            $('.coupon_codetxt').show();
                            $('.coupon_codetxt').html(response.code);
                        }

                    }
                });
            });

            $('#offer_problem_issue').formValidation({

                framework: 'bootstrap',

                excluded: [':disabled'],

                icon: {

                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                trigger: 'change',

                fields: {

                    reason: {

                        validators: {

                            notEmpty: {

                                message: 'Reason is required and cannot be empty'

                            }

                        }
                    },
                    message: {

                        validators: {

                            notEmpty: {

                                message: 'Message is required and cannot be empty'

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
                    url: '/reportProblemIssue',
                    type: 'POST',
                    data: reg_form.serialize(),
                    success: function (response) {

                        $(".having_trouble-body .load_info").hide();

                        $("#having_trouble").hide();

                        $('#having_trouble').trigger("reset");

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
                    $(".couponcode_txt a").trigger("click");
                }
            }
        });

    </script>

@stop
