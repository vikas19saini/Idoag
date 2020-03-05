@extends('layouts.default')

@section('title','Student Brands - Idoag!')

@section('css')



@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('students.partials.profileheader')


        <div class="brandoffer_info stdntprofile_info">
            <div class="container_info">
                <div class="brandoffer_contleft">

                    <h3>  Following Brands</h3>
                    <div class="mybrandoffer_list">
                        <ul>
                            @foreach($brands as $brand)
                                @include('brands.partial.brand')
                            @endforeach

                        </ul>
                    </div>
                </div>
                @include('students.partials.rightbar')
            </div>
        </div>
    </div>
<!-- Footer Starts here -->
@include('layouts.footer')
<!-- Footer Ends here -->

@stop

@section('js')

    <script>
        $(function(){
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

            $('.suggestedbrands_list ul').bxSlider({
                pager: false
            });

        });
    </script>
@stop
