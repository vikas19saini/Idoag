@extends('layouts.default')

@section('title','Event - '.$single->name.' from '.$brand->name.' |idoag.com')

@section('metatags')
    <meta name="keywords" content="Event - {{$single->name}} from {{$brand->name}} |idoag.com"/>
    <meta name="description" content="Event - {{$single->name}} from {{$brand->name}} |idoag.com"/>
@stop

@section('css')



    @include('brands.partial.color')


@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class="brandoffer_info">
            
            <div class="container_info">
                
                <div class="brandoffer_contleft">
                    
                    <div class="brandoffer_list dashboard_events">
                        
                        <div class="dashboard_linksinfo">
                            
                            <div class="dashboard_list">
    
                                <div class="brandoffer_listtop">

                                    <div class="brandoffer_listtopimg">
                                        {{ HTML::image(getImage('uploads/photos/FSW_',$single->image,'noimage.jpg'),'',['class'=>'brandsoffer_img'])}}

                                        <div class="note_img2">{{ HTML::image('assets/images/events_icon.png')}} </div>

                                        <div class="brandoffer_imgcont">
                                          
                                            <div class="share_like_txt">
                                                
                                                <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>
                                                
                                                <p> <i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$single->id}}" @endif></i>
                                                
                                                    <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b> 

                                                </p>
                                                
                                                <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                                                
                                                <div class="addthis_sharing_toolbox"> 
                                                    <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$single->image}}','{{$single->short_description}}','{{$single->name}}','{{ URL::route('event_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                                    <span class="share_tw"><a href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('get_events',array('slug1' => getBrandSlug($single->brand_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                                    <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_events',array('slug1' => getBrandSlug($single->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$single->image}}&description={{ $single->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                                    <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_events',array('slug1' => getBrandSlug($single->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <h4>{{$single->name}}</h4>

                                <div class="dashlinks_datetime">
                                    
                                    @if($single->time_to!='')
                                        <span>{{ HTML::image('assets/images/clock_icon.png')}}{{$single->time_from}}
                                            to {{$single->time_to}}</span>@endif
                                    <span>{{ HTML::image('assets/images/dateblock_icon.png')}}{{$single->start_date}}
                                        to {{$single->end_date}}</span> <span>{{ HTML::image('assets/images/location_icon.png')}}
                                        India</span>

                                </div>

                                {{ nl2br($single->description)}}
                                @if($single->registration_url!='')
                                    <div class="evtndetail_btn">
                                        <a href="{{$single->registration_url}}" target="_blank">
                                            <span>{{ HTML::image('assets/images/register_icon.png')}}</span>Register
                                            Here</a></div>
                                @endif

                            </div>

                        </div>

                        <div class="brandoffer_list newoffer_list">
                            
                            <ul>

                                @foreach($events as $event)

                                    @if($event->id != $single->id)

                                        @include('brands.partial.event')
                                    @endif

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="notice_feed_info">

                    @include('brands.partial.note')

                    @include('partials.ad')

                </div>

            </div>
            
        </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')


    {{ HTML::script('assets/js/notescript.js') }}
    <script>
        $(function () {
            var ww = $(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww);

            $(window).resize(function () {
                var ww2 = $(window).innerWidth();
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
    </script>

@stop
