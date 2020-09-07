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

        <!--start by dpk -->
	<div class="container">
		<div class="row">
			<div class="col-md-7 sec_1">
				{{ HTML::image(getImage('uploads/offer_mob.png','noimage.jpg',''),'',array('class' => "img-fluid"))}}
				<div class="img_tx"><a href="#"><p>View Details</p></a></div>
			</div>

			<div class="col-md-5 sel_2_left">
			<!-- TESTIMONIALS -->
				<section class="test_mob">
					<div class="letest_dis inner-sec les_dis wow fadeInUp">
						<h3>Best Deals </h3>  
						<p>Get us hands on our Best Offers from this month.</p>
					</div>
				<div id="testimonials_mob" class="img_custom owl-carousel">
					@foreach($offers_new as $offer)
						<div class="item wow fadeInUp">
							<div class="shadow-effect">
								{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'),'')}}
								<button><a href="other-letest.html">Claim Now</a></button>
							</div>
						</div>
					@endforeach
					
					<!--END OF TESTIMONIAL 5 -->
				</div>
			</section>
			<div class="right-bx-tx">
				<h2>Trending Discounts</h2>
				@if(count($trending_offers) > 0)
					@foreach($trending_offers as $offer)
						@if(isset($loggedin_user) && $loggedin_user->brand_id != $offer->brand_id &&  $offer->start_date> date('Y-m-d'))
							@else
							<div class="right_1 wow fadeInUp">
								<div class="right_in-tx">
								<!--<h5>80% off</h5> --> 
								<!--<p>Myntra Big Clearance Sale - <span>50% to 80% OFF</span></p>-->
								<!--<a href="#">View Details</a>-->
								<h5>80% off</h5>
								<p>{{ShortenText($offer->short_description,100)}}</p>
								<a @if(Sentry::check())  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" @else
                                            href="#" data-toggle="modal"  data-target="#login_required" @endif >View Details</a>
								</div>
								{{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'')}}
							</div>
						@endif
					@endforeach
                    @else
						<div class="right_1 wow fadeInUp">
							<div class="right_in-tx">
								<p>No Data Found</p>
							</div>
						</div>
				@endif
			</div>
		
		</div>
        </div>
    </div>
	
		<!----------------->
		
	<!-- TESTIMONIALS -->
	<section class="test_desk">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="letest_dis inner-sec les_dis wow fadeInUp">
						<h3>Best Deals </h3>  
						<p>Get us hands on our Best Offers from this month.</p>
					</div>
					<div id="customers-testimonials" class="img_custom owl-carousel wow fadeInRight">
					
						@foreach($offers_new as $offer)
						<div class="item wow fadeInUp">
							<div class="shadow-effect">
								{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'),'', array('width' => 271, 'height' => 309))}}
								<button>
								<a @if(Sentry::check())  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" @else
                                            href="#" data-toggle="modal"  data-target="#login_required" @endif >Claim Now</a>
								</button>
							</div>
						</div>
						@endforeach
						<!--<div class="item wow fadeInUp" data-wow-delay="0.3s">
						  <div class="shadow-effect">
							  <img src="images/offer-picture_1.png" alt="">
							  <button><a href="other-letest.html">Claim Now</a></button>
						  </div>
						</div>
						  
						  <div class="item wow fadeInUp" data-wow-delay="0.6s">
						  <div class="shadow-effect">
							<img src="images/offer-picture_2.png" alt="">
							<button><a href="other-letest.html">Claim Now</a></button>
						  </div>
						</div>

						<div class="item wow fadeInUp" data-wow-delay="0.9s">
						  <div class="shadow-effect">
							<img src="images/offer-picture_1.png" alt="">
							
							  <button><a href="other-letest.html">Claim Now</a></button>
						  </div>
						</div>
						-->
						
						
						
						
						<!--END OF TESTIMONIAL 5 -->
					</div>
				</div>
			</div>
		</div>
    </section>
	<section>
    <div class="container">
    <div class="letest_dis inner-sec inner_bttm_mg wow fadeInUp">
    <h3>Coming Soon offers</h3>  
    <p>Stay tuned for all the all new offers press the like button to notify when this is like ...</p>
    </div>
    <div class="coming_desk">
    <div class="row">
    <div class="col-lg-3 col-sm-6">
    <div class="coming_sec sec_3_main wow fadeInUp">
    <div class="sec_3"><img src="images/Image-118.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
    <small>Start from Till Feb 12, 2019</small>
    </div>
    </div>
    </div>  
        
    <div class="col-lg-3 col-sm-6">
    <div class="coming_sec sec_3_main wow fadeInUp" data-wow-delay="0.3s">
    <div class="sec_3"><img src="images/Image-118.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
    <small>Start from Till Feb 16, 2019</small>
    </div>
    </div>
    </div>
        
    <div class="col-lg-3 col-sm-6">
    <div class="coming_sec sec_3_main wow fadeInUp" data-wow-delay="0.6s">
    <div class="sec_3"><img src="images/img_1.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1 change_clr"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
     <small>Start from Till Feb 18, 2019</small>
    </div>
    </div>
    </div>
        
    <div class="col-lg-3 col-sm-6">
    <div class="coming_sec sec_3_main wow fadeInUp" data-wow-delay="0.9s">
    <div class="sec_3"><img src="images/img_1.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1 change_clr"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
     <small>Start from Till Feb 22, 2019</small>
    </div>
    </div>
    </div>
    </div> 
    </div>
        
    <div class="coming_mob">
    <div class="row">
        <div class="col-md-12">
    <div id="offer_letest" class="owl-carousel">
    <div class="item wow fadeInUp">
      <div class="coming_sec sec_3_main">
    <div class="sec_3"><img src="images/Image-118.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
    <small>Start from Till Feb 12, 2019</small>
    </div>
    </div>  
    </div>
        <div class="item wow fadeInUp" data-wow-delay="0.3s">
        <div class="coming_sec sec_3_main">
    <div class="sec_3"><img src="images/Image-118.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
    <small>Start from Till Feb 16, 2019</small>
    </div>
    </div>
        </div>
        <div class="item wow fadeInUp" data-wow-delay="0.6s">
        <div class="coming_sec sec_3_main">
    <div class="sec_3"><img src="images/img_1.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1 change_clr"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
     <small>Start from Till Feb 18, 2019</small>
    </div>
    </div>
        </div>
        <div class="item wow fadeInUp" data-wow-delay="0.9s">
        <div class="coming_sec sec_3_main">
    <div class="sec_3"><img src="images/img_1.png" alt=""></div>
     <div class="fa-icons">
    <i class="fa fa-heart" aria-hidden="true"></i>
    <i class="fa fa-upload" aria-hidden="true"></i>    
    </div>   
    <div class="inner-offer_1 change_clr"><h4>80% Off</h4>
    <p>Galaxy Tab A7 - On Exclusive Campus price</p> 
     <small>Start from Till Feb 22, 2019</small>
    </div>
    </div>
        </div>
    </div>
        </div>
        </div>
        </div>
        </div>
    </section>
	
	<section class="partner_brand">
	<div class="container">
    <div class="letest_dis inner-sec inner_bttm_mg wow fadeInUp" data-wow-delay="0.3s">
    <h3>OUR BRAND PARTNERS</h3>  
    <p>Get Your Refund 12 working hours Incase Of Transaction Failures.</p>
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

    @include('layouts.footerv2')


    <div id="stepbystep_regi" class="modal" role="dialog">
        <div class="modal-dialog institutions_modal-dialog stepbystep_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content institutions_modal-content">
                <div class="modal-header stepbystep_header">
                     <button type="button" class="close" data-dismiss="modal">{{HTML::image('assets/images/popup_close.png')}}</button>
                </div>
                <div class="modal-body">

                    <!-- steps page start -->
                    <div class="step_info">
                        <div class="stepbystep_details">
                            <h4>Welcome <span class="stepbystep_user">{{$student_details->name}}</span>,<br/>
                                Lets get some basic things right for you to get the best of IDOAG </h4>  

                            <div class="stepbystep_main">
                                <div id="msform">
										<ul id="progressbar">
										<li class="active">Profile </li>
										<li>Brands</li>
										<li>Institutions</li>
										</ul>
	                                <!-- fieldsets -->
	                                <div class="first_tab fs_tab">

	                                	{{Form::open(['class' => 'form-group profile_form', 'id' => 'profile_form','files' => 'true'])}}
	                                    	
	                                        <h5>Update your profile to help us serve you better</h5>
	                                        <div class="stepprofile_info">
	                                            <div class="stepprofile_left">
	                                                {{ HTML::image('uploads/stepprofileimg.png','',['class' => 'profile_img','id'=>'default_picture']) }}

	                                                 <div class="stepprofile_cnt">
	                                                    <p>
	                										{{ Form::file('upload', ['class' => 'upload', 'id' => 'upload']) }}
	                                                        <a href="" onClick="document.getElementById('upload').click(); return false">{{ HTML::image('assets/images/popupupload_icon.png','',['class' => 'default_img'])}}</a>
	                                                    </p>
	                                                </div>
	                                            </div>
	                                            <div class="stepprofile_right">
	                                                <ul>
                                                        @if($student_details->institution)
	                                                       <li><span> Institution :</span> <span class="inst_txt">{{$student_details->institution}}</span></li>
                                                        @else
                                                            <li><span> Institution :</span> <span class="inst_txt">IDOAG / DUMMY</span></li>
	                                                    @endif

                                                        <li><span> Card Number :</span> <span class="number_txt">{{$student_details->card_number}}</span></li>
	                                                    
                                                        <li><span> Expiry :</span> <span class=" ">{{$user->expiry_date}}</span></li>
	                                                
                                                    </ul>
	                                            </div>
	                                        </div>
    										<div class="form-group">

	                                        {{Form::text('name',$student_details->name,['placeholder' => 'Name', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('email',$student_details->email,['placeholder' => 'Email', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('course',$student_details->course,['placeholder' => 'Course', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('phone',$user->mobile,['placeholder' => 'Phone', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

	                                        {{Form::textarea('interests',$student_details->interests,['placeholder' => 'Interests', 'rows'=>2])}}

	                                        {{Form::textarea('aboutme',$student_details->aboutme,['placeholder' => 'About Me', 'rows'=>2])}}
	                                        
	                                        {{Form::submit('Update',['class' => 'update-button update1 action-button'])}}

										{{Form::close()}}

                                        <!--<input type="button" name="next" class="next action-button" value="Skip" />-->
	                                    <div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

	                                <div class="second_tab fs_tab">

	                                	{{Form::open(['class' => 'brand_form', 'files' => 'true'])}}

                                        <h5>Follow the Brands to get relevant offers and opportunities to reach you</h5>
            
                                        <div class="msg_brands" style="color: red; text-align: center;"> </div>   

                                        <div class="select_info">

                                                    <div class="checkbox selectall">
                                                        <span class="selectall_btn active">
                                                        	<em></em><span class="selectall_txt">Selected All</span>
										{{ Form::checkbox('checkall', '', null, ['class' => 'brand_input', 'id'=>'checkall', 'checked']) }}
                                                        </span>
                                                    </div>


                                                </div>
                                        <div class="content">
                                            <div id="content-9" class="brand_scrolling">
                                                
                                                <div class="popup_selectallinfo">

                                                    <div class="popup_selectall">

                                                        @foreach($brands as $brand)

	                                                        @if($brand->id != '69')

		                                                        <div class="checkbox">
		                                                            <div>
                                                                    <span class="brandactive_img active">{{ Form::checkbox('checkall', $brand->id, null, ['class' => 'brand_input brand_input_all', 'id'=>'check_all'.$brand->id, 'checked']) }}</span><span class="select_img"> {{   HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'))}}</span></div>
		                                                        </div>

	                                                        @endif

                                                        @endforeach
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    	{{ Form::submit('Update',['class' => 'update-button update2 action-button']) }}	    

										{{Form::close()}}

                                        <!--<input type="button" name="next" class="next action-button" value="Skip" />-->

                                        <input type="button" name="next" class="back_button" value="Back" />
	                                     <div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

	                                <div class="third_tab fs_tab">

	                                	{{Form::open(['class' => 'inst_form', 'files' => 'true'])}}

	                                        <h5>Follow the Institutions to know latest from the campus</h5>

                                            <div class="msg_insts" style="color: red; text-align: center;"> </div>   

                                            <div class="select_info">

                                                <div class="checkbox selectall">
                                                    <span class="selectall_btn active">
														<em></em> <span class="selectall_txt">Selected All</span>
														{{ Form::checkbox('checkall', '', null, ['class' => 'brand_input', 'id'=>'instcheckall', 'checked']) }}
                                                    </span>
                                                </div>


                                            </div>
	                                        <div class="content">
	                                            <div id="content-8" class="brand_scrolling">

	                                                <div class="popup_selectallinfo">

	                                                    <div class="popup_selectall">

	                                                        @foreach($institutions as $institute)
	                                                            <div class="checkbox">
	                                                                <div>
                                                                    <span class="brandactive_img active">{{ Form::checkbox('instcheckall', $institute->id, null, ['class' => 'inst_input inst_input_all', 'id'=>'check_all'.$institute->id, 'checked' ]) }}</span><span class="select_img"> {{   HTML::image(getImage('uploads/institutions/',$institute->image,'noimage.jpg'))}}</span></div>
	                                                            </div>
	                                                        @endforeach


	                                                    </div>


	                                                </div>


	                                            </div>
	                                        </div>
                                    	{{ Form::submit('Finish',['class' => 'submit action-button update-button update3']) }}	    

	                                    {{Form::close()}}

	                                    <input type="button" name="next" class="back_button" value="Back" />

										<div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- steps page end -->
                </div>
            </div>
        </div>
    </div>

<!-- dashstartup popup with idoag -->
@if(!empty($popup))    
    <div id="dashboadstart_popup" class="modal fade" role="dialog">
        
        <div class="modal-dialog dashboadstart_modal-dialog"> 
      
            <!-- Modal content-->
            <div class="modal-content dashboadstart_modal-content">
                
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
          
                </div>

                <div class="modal-body dashboadstart_modal_body">
                    
                    <div class="dashboadstart_modalpopupimg">
                    
                    @if($popup->url != "")

                        <a href="{{$popup->url}}" target="_blank"> {{ HTML::image('uploads/popup_images/'.$popup->image) }} </a>
                    
                    @else
                        
                        {{ HTML::image('uploads/popup_images/'.$popup->image) }}

                    @endif
                    </div>
                
                </div>
            
            </div>
        </div>
    </div>
@endif
<!-- dashstartup popup with idoag end --> 


@stop

@section('js')

  	{{ HTML::script('assets/js/isotope-docs.min.js') }}
	{{ HTML::script('assets/js/jquery.easing.min.js') }}        
    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
    	
<!-----start by dpk------>
<script>
var wow = new WOW();
  wow.init();
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
$('#offer_letest').owlCarousel( {
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
$('#brand-discount-sl').owlCarousel( {
		loop: true,
		items: 7,
		margin: 30,
		autoplay:true,
		dots:true,
        nav:false,
		autoplayTimeout: 8500,
		smartSpeed: 450,
  	     navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1170: {
				items: 7
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

<!-----End by dpk------->
		
<script>
    $(document).ready(function() {
        var process = true;

        var path = window.location.pathname;

    	var grid_list;

        $(window).load(function(){
      
	        grid_list = $('.photowidget_list').isotope({
					        itemSelector: '.grid-item',
					        layoutMode: 'fitRows',
					        isInitLayout: true, 
					        percentPosition: true,
					        masonry: {
					          columnWidth: 100
					        }
			      		});
    	
        })

        var offset = 1;
        var limit = 8;
        var total = {{gettotalposts()}};
        //console.log(total);

        $(window).scroll(function() {

            if( process && $(window).scrollTop() + $(window).height() > $('.photowidget_list').height()) {
            
                process = false;
                
                offset++;

                if(total > (offset - 1 ) * limit)
                {
                   // alert("ifdd");

                    var data = "&offset="+offset+"&total="+total+"&limit="+limit;
                        
                    $.ajax(
                    {
                        url : '/getRemainingPosts',
                        type: 'POST',
                        data : data,
                        success: function(response) 
                        {
                            if(response)
                            {

                                $('#load_more').fadeOut();
                                $('.photowidget_list').append(response).isotope( 'reloadItems' ).isotope( { sortBy: 'original-order' } );
                            }
                        }
                    }).always(function(){
                            process = true;
                        });
                }  
                else 
                {  // alert("else");
                    $('#load_more').fadeIn();
                    $('#load_more').html('');//message for end of offers
                }
            }
        
        });

		function readURL(input) {
		
			if (input.files && input.files[0]) {
				
				var reader = new FileReader();
		
				reader.onload = function (e) {
					
					$('#default_picture').attr('src', e.target.result).fadeIn('slow');
					
				};
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
		}
		
		$("#upload").change(function(){
			
			readURL(this);
			
		});

    });

</script>

<script>

	var brand = {{count($mybrands)}};

	// console.log(brand);
@if($settings->dashboard_popup==1)

    if(brand == 0)
    {
        $('#stepbystep_regi').modal('show');
    }
    else
    {
        @if(Session::has('popup_first'))
        $('#dashboadstart_popup').modal('show');
        <?php
        Session::forget('popup_first');
        ?>
        @endif
    }
    @endif
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches


    $('#profile_form').formValidation({
      
        framework: 'bootstrap',
                       
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
     
          course: {
            
            validators: {
              
              notEmpty: {
                
                message: 'Course is required and cannot be empty'
                
              }
            }
          },

          phone: {
            
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
                
              }
            }
          }
         }        
    
    }).on('err.validator.fv', function(e, data) {

        data.element
        .data('fv.messages')
        // Hide all the messages
        .find('.help-block[data-fv-for="' + data.field + '"]').hide()
        // Show only message associated with current validator
        .filter('[data-fv-validator="' + data.validator + '"]').show();

    }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
    
    }).on('success.form.fv', function(e) {

        // Prevent form submission
        e.preventDefault();
     	current_fs = $(this).parents(".fs_tab");
        
        next_fs = $(this).parents(".fs_tab").next();

		var fd          = new FormData($('.profile_form')[0]);

		var other_data  = $('.profile_form').serializeArray();

		$.each(other_data,function(key,input){
		fd.append(input.name,input.value);
		}); 

		$("#msform .load_info").show();

        $.ajax({
            url: '/profile_data',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
				
				$("#msform .load_info").hide();
		       	
		       	if(animating) return false;
		        animating = true;

		        //activate next step on progressbar using the index of next_fs
		        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

		        //show the next fieldset
		       
		        //hide the current fieldset with style
		        current_fs.animate({opacity: 0}, {
		            step: function(now, mx) {
		                //as the opacity of current_fs reduces to 0 - stored in "now"
		                //1. scale current_fs down to 80%
		                scale = 1 - (1 - now) * 0.2;
		                //2. bring next_fs from the right(50%)
		                left = (now * 50)+"%";
		                //3. increase opacity of next_fs to 1 as it moves in
		                opacity = 1 - now;
		                current_fs.css({'transform': 'scale('+scale+')'});
		                next_fs.css({'left': left, 'opacity': opacity});
		            },
		            duration: 800,
		            complete: function(){
		                current_fs.hide();
		                 next_fs.show();
		                animating = false;
		            },
		            //this comes from the custom easing plugin
		            easing: 'easeInOutBack'
		        });
		    }
        });
	
    });


    $(".next").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    
    });

	$(document).on("click","#msform .back_button",function(){

		current_fs = $(this).parents(".fs_tab");
        
        prev_fs = $(this).parents(".fs_tab").prev();

				if(animating) return false;
		        animating = true;

		        //activate next step on progressbar using the index of next_fs
		         $("#progressbar li").removeClass("active");
		         console.log($(this).parents(".fs_tab").index());
		        $("#progressbar li").eq($(this).parents(".fs_tab").index()-2).addClass("active");
		        $("#progressbar li").eq($(this).parents(".fs_tab").index()-2).prev("li").addClass("active");

		        //show the next fieldset
		       
		        //hide the current fieldset with style
		        current_fs.animate({opacity: 0}, {
		            step: function(now, mx) {
		                //as the opacity of current_fs reduces to 0 - stored in "now"
		                //1. scale current_fs down to 80%
		                scale = 1 - (1 - now) * 0.2;
		                //2. bring next_fs from the right(50%)
		                left = (now * 50)+"%";
		                //3. increase opacity of next_fs to 1 as it moves in
		                opacity = 1 - now;
		                current_fs.css({'transform': 'scale('+1+')'});
		                prev_fs.css({'left': left, 'opacity': opacity, 'transform': 'scale('+1+')'});
		            },
		            duration: 800,
		            complete: function(){
		                current_fs.hide();
		                 prev_fs.show();
		                animating = false;
		            },
		            //this comes from the custom easing plugin
		            easing: 'easeInOutBack'
		        });

	});


    $(".previous").click(function(){
        
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    
    });

	$('.brand_form').on('submit', function(e) {
	    
	    e.preventDefault();

  		current_fs = $(this).parents(".fs_tab");
        
        next_fs = $(this).parents(".fs_tab").next();

        var checkValues = $('.brand_input_all:checked').map(function()
        {
            return $(this).val();
        }).get();

        // $.each(checkValues, function(k, v) {
        	console.log(checkValues.length);//console.log (v);
        // });
        if(checkValues.length >= 5)	
        {	
            $('.msg_brands').html('');

    		$("#msform .load_info").show();
            
            $.ajax({
                url: '/brand_data',
                type: 'POST',
                data: { ids: checkValues },

                success: function(response) {

                	$("#msform .load_info").hide();
    				
    				if(animating) return false;
    		        animating = true;

    		        //activate next step on progressbar using the index of next_fs
    		        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

    		        //show the next fieldset
    		       
    		        //hide the current fieldset with style
    		        current_fs.animate({opacity: 0}, {
    		            step: function(now, mx) {
    		                //as the opacity of current_fs reduces to 0 - stored in "now"
    		                //1. scale current_fs down to 80%
    		                scale = 1 - (1 - now) * 0.2;
    		                //2. bring next_fs from the right(50%)
    		                left = (now * 50)+"%";
    		                //3. increase opacity of next_fs to 1 as it moves in
    		                opacity = 1 - now;
    		                current_fs.css({'transform': 'scale('+scale+')'});
    		                next_fs.css({'left': left, 'opacity': opacity});
    		            },
    		            duration: 800,
    		            complete: function(){
    		                current_fs.hide();
    		                 next_fs.show();
    		                animating = false;
    		            },
    		            //this comes from the custom easing plugin
    		            easing: 'easeInOutBack'
    		        });
    		    }
            });
        }
        else
        {
            $('.msg_brands').html('Please Select atleast 5 Brands to follow to view your personalized content.');
        }

   	});

	$('.update3').on('click', function(e) {
	    
	    e.preventDefault();
		
        
        var checkValues = $('.inst_input_all:checked').map(function()
        {
            return $(this).val();
        }).get();

        if(checkValues.length >= 5) 
        {   
            $('.msg_insts').html('');

            $("#msform .load_info").show();

            $.ajax({
                url: '/inst_data',
                type: 'POST',
                data: { ids: checkValues },

                success: function(response) {
                	
                	$("#msform .load_info").hide();
                    
                    $('#stepbystep_regi').hide(); 

                    $('#dashboadstart_popup').modal('show');

                    setTimeout(function(){location.href="/student/dashboard?demo=true"} , 4000);

    		    }
            });
        }
        else
        {
            $('.msg_insts').html('Please Select atleast 5 Institutions to follow to view your personalized content.');
        }
	});
    
    $(".submit").click(function(){
        return false;
    });

    $("#show").click(function(){
        $(".step_info").show();
    });

    $("#content-8").mCustomScrollbar({
        axis:"yx",
        scrollButtons:{enable:true},
        theme:"3d",
        scrollbarPosition:"outside"
    
    });

    $("#content-9").mCustomScrollbar({
        axis:"yx",
        scrollButtons:{enable:true},
        theme:"3d",
        scrollbarPosition:"outside"
    
    });

    $(document).keyup(function(e) {
        if(e.keyCode == 27) { 
            if($("#dashboadstart_popup").hasClass("in") ){

              $("#dashboadstart_popup").hide();
            }
        }
    
    });

    $(document).ready(function(e) {

	    $(document).on('click', '.selectall_btn #checkall', function(e) {				

			if($(this).is(":checked")){ 
				$('.popup_selectall span.brandactive_img').addClass("active");
				$('.popup_selectall span.brandactive_img input').prop("checked", true);
				$(this).parents(".selectall_btn").addClass("active"); 
				$(this).parents(".selectall_btn").find(".selectall_txt").html("Selected All");				 
			}
		
	    });
	    
	    $(document).on('click','.brand_input_all',function(){

	    	var getbrand_id = $(this).attr('id');

	    	//console.log(getbrand_id);

	    	if ($('#'+getbrand_id).prop('checked') == false)
	    	{
	    		//console.log(true);
	    		$('#checkall').prop('checked',false);
	    		$('.selectall .selectall_btn').removeClass("active");
	    		$('.selectall .selectall_btn .selectall_txt').html("Select All");
	    	}
	    	else 
	    	{ 
	    		if($('.brand_input_all:checked').length == $('.brand_input_all').length) 
	    		{
				    $('#checkall').prop('checked',true);
				    $('.selectall .selectall_btn').addClass("active");
				   $('.selectall .selectall_btn .selectall_txt').html("Selected All");
				}

	    	 }

	    });

	    $(document).on('click', '.selectall_btn #instcheckall', function(e) {				

			if($(this).is(":checked")){ 
				$('.popup_selectall span.brandactive_img').addClass("active");
				$('.popup_selectall span.brandactive_img input').prop("checked", true);
				$(this).parents(".selectall_btn").addClass("active"); 
				$(this).parents(".selectall_btn").find(".selectall_txt").html("Selected All");				 
			}
		
	    });

	    $(document).on('click','.inst_input_all',function(){

	    	var getbrand_id = $(this).attr('id');

	    	if ($('#'+getbrand_id).prop('checked') == false){
	    		
	    		$('#instcheckall').prop('checked',false);
	    		$('.selectall .selectall_btn').removeClass("active");
	    		$('.selectall .selectall_btn .selectall_txt').html("Select All");
	    	}
	    	else 
	    	{ 
	    		if($('.inst_input_all:checked').length == $('.inst_input_all').length) 
	    		{
				    $('#instcheckall').prop('checked',true);
				    $('.selectall .selectall_btn').addClass("active");
				    $('.selectall .selectall_btn .selectall_txt').html("Selected All");
				}

	    	 }

	    });
		
		document.getElementById('startButton').onclick = function() {
        introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
          window.location.href = '/student/{{$user->id}}?multipage=true';
        });
      };

    });
	
	$(window).load(function(){
		$('.photowidget_slider').bxSlider({
			auto: true,
			infiniteLoop: true,
			pager:false
		});

        if (RegExp('demo', 'gi').test(window.location.search)) {

            introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
                window.location.href = '/student/{{$user->id}}?multipage=true';
            });
        }
	
    });
</script>
<script>
         $(document).ready(function() {         
            $("#owl-demo").owlCarousel({
               navigation : true,
               autoPlay: 3000,
               pagination : false,
               items : 3,
               itemsDesktop : [1199,3],
               itemsDesktopSmall : [979,1.3],
               itemsTablet : [768,2],
               itemsMobile : [430,1],
               navigationText :["Prev","next"]	
            });
            $("#owl-demo_a").owlCarousel({
               navigation : true,
               autoPlay: 3000,
               pagination : false,
               items : 3,
               itemsDesktop : [1199,3],
               itemsDesktopSmall : [979,1.3],
               itemsTablet : [768,2],
               itemsMobile : [430,1],
               navigationText :["Prev","next"]	
            });
         });      
      </script>
@stop
