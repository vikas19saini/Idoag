@extends('layouts.default')

@section('title',$press_single->name.' - Press Release|idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$press_single->name}} - Press Release|idoag.com" />
    <meta name="description" content="{{$press_single->name}} - Press Release|idoag.com" />
@stop

@section('content')

    <!-- Content Start Here -->
<div class="wrapper">

    <!-- Header Starts here -->
    @include('layouts.header')
    <!-- Header Ends here -->
    @include('partials.flash')
    <div class="brandoffer_info">

        <div class="container_info press_info">
          
          <div class="col-md-12 press_list press_details">
            
            <div class="col-md-2 col-xs-12">
            <div class="press_logo">
                {{ HTML::image("uploads/press/".$press_single->image_logo) }}
            </div>
            </div>
            
            <div class="col-md-10 col-xs-12">
                
              <div class="col-md-7 col-xs-12">
                    <h3>{{$press_single->name}}</h3>
                </div>
                
              <div class="col-md-5 col-xs-12 post_date">
                    Posted on {{date("F d, Y", strtotime($press_single->created_at)) }}
                </div>
                
                <hr class="press_seperator">

                <div class="col-md-12 press_text">
                    <p> {{ $press_single->description}} </p>
                  
                  @if($press_single->image_news)

                    <img src="images/press_view_img.jpg" alt="" class="margin-btm">

                  @endif

                </div>

            </div>
            
            <hr class="press_seperator seperator_dark">
            
            <div class="pull-left read_more_btn"><a href="{{ URL::route('press_list')}}">View More Lists</a></div>
            @if($press_single->link!='')
            <div class="pull-right original_btn"><a href="{{$press_single->link}}" target="_blank">Original Article</a></div>
            @endif
          </div>

        </div>

    </div>

</div>



<!-- Footer Starts here -->
@include('layouts.footer')
<!-- Footer Ends here -->

@stop

@section('js')

@stop