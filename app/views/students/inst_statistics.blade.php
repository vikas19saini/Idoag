@extends('layouts.default')

@section('title',$institution->name.' Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com')
@section('metatags')
    <meta name="keywords"
          content="{{$institution->name}} Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
    <meta name="description"
          content="{{$institution->name}} Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
@stop

@section('css')

    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        <div class="container_info">
            <div class="brand_poast_info">

                <h3>INSTITUTION STATISTICS <a href="{{URL::route('institution_profile',$institution->slug) }}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

                @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)
                <div class="brand_poast_info" >

                    <h6>POST STATISTICS</h6>

                    <div class="brand_setting_txt">

                        <ul>



                            <li>

                                <div class="name_val">PHOTOS</div>

                                <div class="val_val"><strong>{{ $photo_count }}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">EVENTS</div>

                                <div class="val_val"><strong>{{ $event_count }}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">TEXT</div>

                                <div class="val_val"><strong>{{ $text_count }}</strong></div>

                            </li>
                            <li>

                                <div class="name_val">FEEDBACK (Total/Not Replied)</div>

                                <div class="val_val"><strong>{{ $total_feedback_count }}/{{$total_not_replied}}</strong></div>

                            </li>

                        </ul>

                    </div>

                </div>


                @endif

            </div>
        </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
