@extends('layouts.defaultv2')

@section('title','Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com')

@section('metatags')

    <meta name="keywords" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

    <meta name="description" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

@stop

@section('css')

@stop

@section('content')
    @include('layouts.headerv2')
    <div class="container-fluid inner_bg_ht header-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-top-aria wow fadeInUp">
                        <h1>Why Idoag for your brand ?</h1>
                        <p>Idoag is a unique platform designed on a simple principle of community building ,
                        <span>we work with closed loop networks like Colleges  , Universities and Corporates</span> 
                        <span>( most recently ) giving our brand partners both reach and visibilty to there</span> 
                        <span>products and services. At Idoag we curate 10 maximum offers at any time in order</span>
                            to make simpler decision making and maximum buying for each of our brand partners.</p>
                        <button>Register with us</button>
                        <small>Brands on idoag :</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="brand_main">
            <div class="itemsBg offer_trade">
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
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.2s">
                        {{ HTML::image('assets/imagesv2/icon-5.jpg','',['class'=>'img-fluid'])}} 
                        <h5>Fully Verified Users</h5>
                        <p>Our database is provided by the campus /corporate directly , hence every idoag user is a verified Student or An Employee </p>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.4s">
                        {{ HTML::image('assets/imagesv2/icon-6.jpg','',['class'=>'img-fluid'])}}
                        <h5>Connect with <span>Students/Employees</span></h5>
                        <p>Aiming to design just the right offers for each of our users to bring out the right impulse targeting just the right mindspace.</p>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.6s">
                        {{ HTML::image('assets/imagesv2/icon-7.jpg','',['class'=>'img-fluid'])}}
                        <h5>Make Brand Loyal and <span>Aspirational Customers</span></h5>
                        <p>At Idoag our users come from a set of age group that is most likely to be identified as a new users and making them experience our products and services .</p>
                    </div>    
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.2s">
                        {{ HTML::image('assets/imagesv2/icon-8.jpg','',['class'=>'img-fluid'])}}
                        <h5>Mesuring Results <span>and ROI</span></h5>
                        <p>We generate reports on month and month basis with our partners understanding code redemptions and future targets.</p>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.4s">
                        {{ HTML::image('assets/imagesv2/icon-9.jpg','',['class'=>'img-fluid'])}}
                        <h5>User Segmentation</h5>
                        <p>With detailed Analytics report we shall be able define several factors segmenting every user.</p>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="services_bx image-zm wow fadeInUp" data-wow-delay="0.6s">
                        <img src="images/icon-10.jpg" class="img-fluid" alt="">
                        <h5>Scale of Idoag</h5>
                        <p>With over 400 million people fitting into our universe we have the potential to scale to infinity.</p>
                    </div>    
                </div>
            </div>
        </div>
    </div>

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