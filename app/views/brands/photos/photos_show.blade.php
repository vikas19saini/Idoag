@extends('layouts.default')

@section('title', $brand->name.' Photos |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Photos |idoag.com"/>
    <meta name="description" content="{{$brand->name}} Photos |idoag.com"/>
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
                    <div class="brandoffer_list newoffer_list">

                        <ul>
                            @if(count($photos)==0)
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft">{{ HTML::image('assets/images/photos_icon.png')}} </div>
                                    <div class="allnotfund_msgright">
                                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                            <p><span class="bold_msg"> You have not posted any Photos yet.  <a
                                                            href="{{ URL::route('create_photos',$brand->slug)}}">Upload</a> something today to capture the imagination of Students.
                                            </p>
                                        @else
                                            <p>
                                                <span class="bold_msg">No Photos Available Currently from {{$brand->name}}</span><br/>
                                                Kindly bear with us for sometime.</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @foreach($photos as $photo)

                                @include('brands.partial.photo')

                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('brands.partial.note')
                    @include('partials.ad')
                </div>
            </div>
        </div>

    </div></div>
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
