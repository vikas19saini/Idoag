@extends('layouts.default')

@section('title', $institution->name.' Events |idoag.com')

@section('css')
    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Institution inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Institution inner Nav End here -->

        <div class="brandoffer_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="brandoffer_list newoffer_list">
                        <ul>
                            @if(count($photos)==0)
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft">{{ HTML::image('assets/images/photos_icon.png')}} </div>
                                    <div class="allnotfund_msgright">
                                        <p>
                                            <span class="bold_msg">No Photos Available Currently from {{$institution->name}}</span><br/>
                                            Kindly bear with us for sometime.</p>
                                    </div>
                                </div>
                            @endif
                            @foreach($photos as $photo)

                                @include('institutions.partial.photo')

                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('institutions.partial.note')
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


    <script>

        $(document).ready(function (e) {

            /* institution statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

        });

    </script>
    {{ HTML::script('assets/js/inst_notescript.js') }}
@stop
