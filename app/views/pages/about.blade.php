@extends('layouts.defaultv2')

@section('title','About Us |idoag.com')

@section('metatags')
    <meta name="keywords" content="About Us |idoag.com" />
    <meta name="description" content="About Us |idoag.com" />

@stop

@section('css')

 @stop


@section('content')
@include('layouts.headerv2')
<div class="container-fluid about-bg-ht header-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-top-aria about_band wow fadeInUp">
                    <h1>About us</h1>
                    <p>At Idoag we curate custom designed discounts and offers with indias largest ecomm Brands - Products & <span>Services for users in order to help them save on almost everything they order in there daily life, </span><span>starting from food-travel-fashion-healthcare- Gadgets and more. Every month 10 best offers are </span>shortlisted and displayed for each one you keeping in mind maximum benefits and seamless services.</p>
                    <small>Our Brand Partners :</small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="brand_main">
        <div class="itemsBg about_brand">
            <div id="brand_icon" class="owl-carousel">  
                @foreach($brands as $brand)
                    <div class="item">
                        <div class="image-zm"><a href="{{URL::route('brand_profile',array($brand->slug))}}">{{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'img-fluid'])}}</a></a></div>
                    </div>
                @endforeach                
               
            </div>
            
        </div>
    </div>
</div>


<div class="container">
    <div class="inner_contant_sec">
        <div class="row">
            <div class="col-md-6">
                <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.3s">
                    {{ HTML::image('assets/imagesv2/icon-5.jpg','',['class'=>'img-fluid'])}}
                    <h5>In Campus</h5>
                    <p>Idoag works with the largest Universities / Colleges of India building complete campus automation solutions starting from Smart Cards - Attendance Marking - Cafetaria - Parking Management - Hostel Management Systems integrated with a plethora of Valuable Discounts and Offers from the largest ECommerce Services available nationwide.
                        You can simply click on “Register with us “ Button and we shall be happy to reach out to you within the next 24 hours.
                        Button : Register with us.</p>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.6s">
                    {{ HTML::image('assets/imagesv2/icon-6.jpg','',['class'=>'img-fluid'])}}
                    <h5>With Corporates</h5>
                    <p>At Idoag over the last few months, our team has been working hard to design an overlap between the needs of a campus student and a corporate employee in order to
                    integrate our end to end solutions for corporates helping them to have happy employee in there respective organisations by adding value through our offers embedded in there ID’s.
                    Simply Click on Register with us button and we would be happy to reach out to you within the next 24 hours.
                    Button : Register with us.</p>
                </div>    
            </div>
        </div>
    </div>
</div>   
@include('layouts.footerv2')


@stop

@section('js')
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

@stop