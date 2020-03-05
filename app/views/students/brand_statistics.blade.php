@extends('layouts.default')
@section('title', $brand->name.' Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com" />
    <meta name="description" content="{{$brand->name}} Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com" />
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
        @include('partials.flash')
        <div class="container_info">
            <div class="brand_poast_info">

                <h3>BRANDS NEAR YOU<a href="{{ URL::route('brands')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

                @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)
                <div class="brand_poast_info" >

                    <h6>POST STATISTICS</h6>

                    <div class="brand_setting_txt">

                        <ul class="stats">

                            <li>

                                <div class="name_val">OFFERS</div>

                                <div class="val_val"><strong>{{ $offer_count }}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">INTERNSHIPS</div>

                                <div class="val_val"><strong>{{ $internship_count }}</strong></div>

                            </li>

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

                                <div class="val_val"><strong>{{ $link_count }}</strong></div>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="brand_poast_info"   >

                    <h6>OTHER STATISTICS</h6>

                    <div class="brand_setting_txt">

                        <ul class="stats">

                            <li>

                                <div class="name_val">OUTLETS</div>

                                <div class="val_val"><strong>{{ $outlet_count }}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">FEEDBACK (Total/Not Replied)</div>

                                <div class="val_val"><strong>{{ $total_feedback_count }}/{{$total_not_replied}}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">INTERNSHIPS APPLICATIONS RECEIVED</div>

                                <div class="val_val"><strong>{{ $applied_internships_count }}</strong></div>

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
