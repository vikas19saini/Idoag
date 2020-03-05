@extends('layouts.default')

@section('title','Press - View coverage of IDOAG in press and various leading journals, Press releases from IDOAG|idoag.com')
@section('metatags')
    <meta name="keywords" content="Press - View coverage of IDOAG in press and various leading journals, Press releases from IDOAG|idoag.com" />
    <meta name="description" content="Press - View coverage of IDOAG in press and various leading journals, Press releases from IDOAG|idoag.com" />
@stop

@section('content')

    <!-- Content Start Here -->
<div class="wrapper">

    <!-- Header Starts here -->
    @include('layouts.header')
    <!-- Header Ends here -->
    @include('partials.flash2')
    <div class="press_banner">

    </div>


    <div class="brandoffer_info">
    
        <div class="container_info press_info">

            <h1>Press List</h1>

            @foreach($press_all as $press)
            

                <div class="row">
                <div class="col-md-12 press_list">
                
                <div class="row">

                    <div class="col-md-2 col-xs-12">
                    
                    <div class="pressimg_wp">
                		{{ HTML::image("uploads/press/".$press->image_logo) }}
                     </div>
                
                    </div>

                    <div class="col-md-10 col-xs-12">
                    
                    <div class="row">

                        <div class="col-md-7 col-xs-12">

                            <h3>{{$press->name}}</h3>

                        </div>

                        <div class="col-md-5 col-xs-12 post_date">

                            Posted on {{date("F d, Y", strtotime($press->created_at)) }}

                        </div>

                        <hr class="press_seperator">

                        <div class="col-md-12 press_text">

                           <p>{{ str_limit(strip_tags($press->description), $limit = 600, $end = '...')}}</p>

                            <div class="pull-left read_more_btn"><a href="{{ URL::route('press_details',array('slug'=>$press->slug) )}}">Read More</a></div>
                            @if($press->link!='')
                                <div class="pull-right original_btn"><a href="{{$press->link}}" target="_blank">Original Article</a></div>
                            @endif
                        </div>
                        
                    </div>

                    </div>
                
                </div>

                </div>
		</div>

            @endforeach()

        </div>

    </div>
  
</div>


<!-- Footer Starts here -->
@include('layouts.footer')
<!-- Footer Ends here -->

@stop

@section('js')

@stop