@extends('layouts.default')

@section('title','Sitemap |idoag.com')

@section('metatags')
    <meta name="keywords" content="Sitemap |idoag.com" />
    <meta name="description" content="Sitemap |idoag.com" />
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

                <div class="brandsatidoag_info">
                    <h5>Sitemap</h5>
                </div>
                <div class="pagecontent">
                    <div class="col-sm-4">

                    <ul class="sitemap">

                        <li >

                                 <a href="{{ URL::route('student_dashboard')}}"> Home </a>


                        </li>


                        <li  >

                            <a href="{{ URL::route('offers') }}"> Offers </a>

                        </li>

                        <li >

                            <a href="{{ URL::route('internships') }}"> Internships </a>



                        </li>

                        <li>

                            <a href="{{ URL::route('brands') }}"> Brands </a>



                        </li>

                        <li>

                            <a href="{{ URL::route('institutions') }}"> Institutions </a>

                        </li>


                                    <li ><a href="#">Associate<i class="submenu_arrow"></i></a>
                                        <ul  >
                                            <li><a href="{{ URL::route('student-register') }}">Students</a></li><li><a href="{{ URL::route('inst-register') }}">Brands</a></li><li><a href="{{ URL::route('brand-register') }}">Institutions</a></li>
                                        </ul>

                                    </li>
                                    <li><a href="{{ URL::route('press_list') }}">Press</a></li>

                                    <li><a href="{{ URL::route('about') }}">About us</a></li>
                                    <li><a href="{{ URL::route('contactus') }}">Contact us</a></li>

                        <li><a href="{{ URL::route('faq') }}">FAQ </a></li>

                        <li><a href="{{ URL::route('tos') }}"> Terms </a></li>

                        <li><a href="{{ URL::route('privacy-policy') }}"> Privacy Policy</a></li>

                        <li><a href="{{ URL::route('login') }}"> Login </a></li>
                        <li><a href="{{ URL::route('login') }}"> Register </a></li>
                        <li><a href="{{ URL::route('forgot_password') }}"> Forgot Password </a></li>


                    </ul></div>
                    <div class="col-sm-4">
                        <h4>Brands</h4>
                        <ul class="brands">
                            @foreach($brands as $brand)
                                <li><a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h4>Institutions</h4>
                        <ul class="institutions"> @foreach($institutions as $institution)
                                <li><a href="{{URL::route('institution_profile',array($institution->slug))}}">{{$institution->name}} </a></li>
                            @endforeach</ul>
                    </div>
                </div>

            </div>    </div>
    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop