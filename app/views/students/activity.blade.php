
@extends('layouts.default')

@section('title','Activity log -  view all the availed offers, applied internships, events |idoag.com')

@section('metatags')
    <meta name="keywords" content="Activity log -  view all the availed offers, applied internships, events |idoag.com" />
    <meta name="description" content="Activity log -  view all the availed offers, applied internships, events |idoag.com" />

@stop

@section('css')

@stop

@section('content')
  
    <!-- Content Start Here -->
  	<div class="wrapper">

	    <!-- Header Starts here -->
	    @include('layouts.header')
	    <!-- Header Ends here -->
        @include('partials.flash')

		<div class="brandoffer_info">
			
			<div class="container_info">
			 	
			 	<div class="brandoffer_contleft">
				 	<div class="content">
				    	<div class="activity_info">
			      			<ul>
                                 <?php $previous_date="";$ss=0;?>
						        @foreach($output as $key => $value)

						        @if(date("d-m-Y", strtotime($value->created_at))!=$previous_date)
                                @if($ss==1)
                            </ul>
                        </div>
                        </li>
                        @endif

                        <?php $ss=1;?>
                                            <li>
                                            <div class="activity_left">
						            	<div class="date_box"> <span class="date">{{date('j', strtotime($value->created_at))}}<sup>{{date('S', strtotime($value->created_at))}}</sup></span> <span class="year">{{date('M', strtotime($value->created_at))}}, {{date('Y', strtotime($value->created_at))}}</span> </div>
						          	</div>
									<div class="activity_right">
								  <ul class="list-group activity_group">
							         @endif

								 		@if($value->type == 'brand_follows')

									            <li class="list-group-item activity_item">{{ HTML::image('assets/images/follow.jpg', '') }}You are now following  {{ getBrandName($value->brand_id)}}</li>

								        @endif

										@if($value->type == 'inst_follows')


									            <li class="list-group-item activity_item">{{ HTML::image('assets/images/follow.jpg', '') }}You are now following  {{ getInstitutionName($value->inst_id)}}</li>

								        @endif

								        @if($value->type == 'coupon')

								          	       <li class="list-group-item activity_item">{{ HTML::image('assets/images/activyimg.png', '') }} {{ getBrandName($value->brand_id)}} Offer {{ $value->offer_name}} was accessed with Coupon {{ $value->coupon_code}} at {{ $value->created_at}}</li>

								        @endif

								        @if($value->type == 'feedback')


									            <li class="list-group-item activity_item">{{ HTML::image('assets/images/feedback.jpg', '') }} {{ getBrandName($value->brand_id)}} responded to your feedback</li>


								        @endif
										 @if($value->message != '')
										  <li @if($value->visit_status == 0 && $value->type=='internship_status') class="redbg" @endif> <a href="{{ URL::route('student_internship_view2', [getBrandSlugByInternshipId($value->internship_id), getPostSlugByInternshipId($value->internship_id)]) }}" >
                                        <div class="studentrecentupdates_img_internship studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
                                        <div class="studentrecentupdates_cont">{{$value->message}}</div>
                                    </a> </li>
 @endif
								        @if($value->type == 'intern')
									            <li class="list-group-item activity_item">{{ HTML::image('assets/images/activyimg1.png', '') }} {{ getBrandName($value->brand_id)}} You have applied for Internship {{ $value->internship_name}} </li>

								        @endif
                                   <?php $previous_date= date("d-m-Y", strtotime($value->created_at));?>


					    		@endforeach
                                  </ul>
                                    </div>
                                            </li>
			      			
			      			</ul>
			    		</div>
			    	</div>
			  	</div>

			  @include('students.partials.rightbar')

		 	</div>

		</div>

	</div>

	    <!-- Footer Starts here-->
	    @include('layouts.footer')
	    <!-- Footer Ends here -->

@stop

@section('js')

  	{{ HTML::script('assets/js/isotope-docs.min.js') }}

	{{ HTML::script('assets/js/jquery.easing.min.js') }}

	{{ HTML::script('assets/js/jquery.easing.min.js') }}

<script>

$(function(){

	$("#content-8").mCustomScrollbar({
					axis:"yx",
					scrollButtons:{enable:true},
					theme:"3d",
					scrollbarPosition:"outside"
	});

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
	
	
});

$(window).load(function(){

	$('.suggestedbrands_list ul').bxSlider({
		pager: false,
        auto:  true
	});
})

</script>

@stop