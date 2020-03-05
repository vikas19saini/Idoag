@extends('layouts.default')

@section('title','Idoag! '.$institution->name.' Followers')

@section('css')

    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('institutions.partial.inner_nav')

        <div class="brandoffer_info followers_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="mybrandoffer_list">
                        <h2>Followers</h2>
                        @if(count($followers)==0)
                            <div class="norecords"> No Followers.</div>
                        @endif
                        <div class="row">
                            @foreach($followers as $follower)

                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 follower_thumbinfo">
                                    <div class="follower_thumb">
                                        {{ HTML::image(getImage('uploads/profiles/',$follower->profile_image,'noimage.jpg'), $follower->first_name, ['class' => 'slider-img']) }}
                                        <br/>
                                        <h4>{{$follower->first_name}}</h4></div>
                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('institutions.partial.note')
                    @include('partials.ad')
                </div>
            </div>
        </div>


        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

        @stop

        @section('js')

            {{ HTML::script('assets/js/inst_notescript.js') }}

@stop
