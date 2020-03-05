@extends('layouts.default')

@section('title', $brand->name.' Text |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Text |idoag.com"/>
    <meta name="description" content="{{$brand->name}} Text |idoag.com"/>
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
                    <div class="postanewoffer_info">
                          <div class="brandoffer_list">
                        <div class="dashboard_linksinfo">


                            @if(count($links)==0)
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft">{{ HTML::image('assets/images/text_icon.png')}} </div>
                                    <div class="allnotfund_msgright">
                                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                            <p><span class="bold_msg">  You do not have any posts here. Post something   <a
                                                            href="{{ URL::route('create_text',$brand->slug)}}">New</a> to communicate with Students.</span>
                                            </p>
                                        @else
                                            <p>
                                                <span class="bold_msg">No Text Available Currently from {{$brand->name}}</span><br/>
                                                Kindly bear with us for sometime.</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @foreach($links as $link)
                                @include('brands.partial.link')
                            @endforeach

                        </div>
                        <div class="clear"></div>
                    </div>
                      </div>
                </div>
            <div class="notice_feed_info">
                @include('brands.partial.note')
                @include('partials.ad')
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


        $(document).ready(function (e) {

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

        });

    </script>

@stop
