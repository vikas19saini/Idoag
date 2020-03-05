@extends('layouts.default')

@section('title','About Us |idoag.com')

@section('metatags')
    <meta name="keywords" content="About Us |idoag.com" />
    <meta name="description" content="About Us |idoag.com" />

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

        <div class="about_banner">
            <ul class="bxslider about_bxslider">
                <li class="frist_banner">
    <div class="aboutbanner_bgclr"></div> 
    <div class="aboutbanner_cnt">
         <p>IDOAG is trusted by leading Brands & Institutions and our services could be used
             in over <span>500 cities, 2000+ Stores</span> across India. We have built a complete
             umbrella of brands to serve the needs of Students in India through
             <span>India’s First Student Benefit Card</span> <span>called IDOAG Card</span>.</p>
    </div>
 </li>
 <li class="second_banner">
    <div class="aboutbanner_bgclr"></div> 
     <div class="aboutbanner_cnt">
         <p>IDOAG goes well beyond providing just the discounts – it acts as an interface to cater to various other needs of the Students such as internships, fresher jobs and campus ambassador programs. In Short, IDOAG creates Connect amongst Students, Brands and Institutions.</p>
     </div>
 </li>
 <li class="third_banner">
    <div class="aboutbanner_bgclr"></div> 

     <div class="aboutbanner_cnt">
         <p>We provide a platform to Brands and Institutions where they could reach out directly to Students to market themselves as well as generate leads for various offerings.</p>
     </div>
 </li>
</ul>
<span class="aboutdown_arrow scrolldown_txt"><a href="javascript:void(0)">{{ HTML::image('assets/images/aboutdown_arrow.png')}}</a></span></div>


<div id="about_info">
<div class="brandoffer_info aboutwrapper_info">
<div class="container_info aboutus_info">

 <h1>Our Services</h1>
 <div class="row about_locationinfo">
     <div class="col-md-4 col-sm-4 col-xs-12 about_list firstabout_list">
         <figure class="figure">
             {{ HTML::image('assets/images/about_listimg3.png','',['class'=>'img-rounded'])}}
             <figcaption class="figure-caption text-center">
                 <h4>Students</h4>
                 IDOAG helps this generation of ‘millennials’ who are still in college to get access to unique offers and opportunities and proficiently throngs the lacuna amongst Students, Brands and Institutes.</figcaption>
            <a href="{{ URL::route('student-register') }}" class="readmore_btn">Read more..</a>    </figure>
     </div>
     <div class="col-md-4 col-sm-4 col-xs-12 about_list">
         <figure class="figure">
             {{ HTML::image('assets/images/about_listimg2.png','',['class'=>'img-rounded'])}}
             <figcaption class="figure-caption text-center">
                 <h4>Institutions</h4>
                 IDOAG Provides you the ideal platform for institutions to connect with their students at the touch of button. Your personalized page give you the
                 ability connect and communicate with all
                 Students and Brands at the same time    </figcaption>
             <a href="{{ URL::route('inst-register') }}" class="readmore_btn">Read more..</a>    </figure>
     </div>
     <div class="col-md-4 col-sm-4 col-xs-12 about_list">
         <figure class="figure">
             {{ HTML::image('assets/images/about_listimg1.png')}}
             <figcaption class="figure-caption text-center">
                 <h4>Brands</h4>
                 Top Notch Brands from all around the globe are looking for a way to capture imagination. IDOAG provides you the perfect platform for Brands to connect with these young adults in a personalized manner.</figcaption>
             <a href="{{ URL::route('brand-register') }}" class="readmore_btn">Read more..</a>    </figure>
     </div>
 </div>
</div>

<div class="about_contactstip">
 <p><span class="contact_link"><a href="{{ URL::route('contactus') }}">Contact us</a></span> now to find out how together, we can propel your Brand or Institution through IDOAG.</p>
</div>
</div>
</div>
</div>        <!-- Footer Starts here -->
@include('layouts.footer')
<!-- Footer Ends here -->

@stop

@section('js')
<script>
$(function(){
    $('.about_bxslider').bxSlider({
        controls: false,
        infiniteLoop: true,
        pager: true,
        auto:true,
        pause: 10000
    });
    $(".scrolldown_txt a").click(function(){
        var abouttop=$("#about_info").offset().top;
        $("body, html").animate({"scrollTop":abouttop}, 500);
    });
});
</script>
@stop