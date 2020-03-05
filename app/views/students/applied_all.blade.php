@extends('layouts.default')

@section('title','Student Internships - Idoag!')


@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->      
    
    <div class='row_content row'></div>
      <h1 class="div_in dfes">APPLICATION HISTORY</h1>
      <div class='row_div'>
         <p class='divddf'>You have applied for {{$appliejobs}} jobs in last 30 days</p>
         <div class='clearfix'></div> 
    <div class="maing_div  desktop_on">
            <div class="bg_row_div">
               <ul>
                  <li><a href="#">Type</a></li>
                  <li><a href="#">Brands</a></li>
                  <li><a href="#">Job Details</a></li>
                  <li><a href="#">Applied Date</a></li>
                  <li><a href="#">Status</a></li>
               </ul>
            </div>
            @if(count($myinternships) > 0)
                @foreach($myinternships as $internship)
                    <div class='div_rowd'>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                          <p>{{getPostType($internship->post_id)}}</p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-1 col-xs-3'>
                          <p>{{getBrandName($internship->brand_id)}}</p>
                       </div>
                       <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                          <p>{{getPostName($internship->post_id)}}</p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                          <p>{{Carbon::parse($internship->created_at)->format('d M, Y')}}</p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                          <p>{{$internship_status[$internship->status]}}</p>
                       </div>
                    </div>
                @endforeach
            @else
                <h1>No records found..
            @endif        
         </div>
        <div class="row bg_rowedfa dfsddf">
         @if(count($myinternships) > 0)
                @foreach($myinternships as $internship)                        
                        <div class='bg_ground_use_d'>
                            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8'>
                                <h3>{{getPostName($internship->post_id)}}</h3>                                
                                <span>{{getBrandName($internship->brand_id)}}</span>
                                <p>Applied on: {{Carbon::parse($internship->created_at)->format('d M, Y')}}</p>
                            </div>
                            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                                <div class="make_relative_div">
                                    <h3>{{getPostType($internship->post_id)}}</h3>
                                    <p>{{$internship_status[$internship->status]}}</p>
                                </div>
                            </div>
                        </div>                 
                @endforeach
            @else
            <div class="bg_ground_use_d">
                <h1>No records found..</h1>
            </div>
            @endif
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
