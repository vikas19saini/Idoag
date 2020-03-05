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
        <div class="container_info">
            <div class="brand_poast_info">

                <h3>INSTITUTION INFO <a href="{{URL::route('institution_profile',$institution->slug) }}"  class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

                <div class="brand_setting_txt">
                    <ul>
                        <li>
                            <div class="name_val">INSTITUTION NAME</div>
                            <div class="val_val"><strong>{{ ucfirst($institution->name) }}</strong></div>

                        </li>

                        <li>
                            <div class="val_val editdescription_txt">
                                {{ $institution->description }}

                            </div>

                        </li>
                        @if($institution->url !='')
                            <li>
                                <div class="name_val">Website</div>
                                <div class="val_val website_link"><a href="{{$institution->url}}"
                                                                     target="_blank">{{$institution->url}}</a>
                                </div>

                            </li>
                        @endif
                        @if($institution->facebook !='' || $institution->twitter !='')
                            <li>

                                <div class="name_val">Social Media</div>

                                <div class="val_val editsetting_scocial">
                                    @if($institution->facebook !='')
                                        <a href="{{$institution->facebook}}" target="_blank"><i
                                                    class="fa fa-facebook"></i></a>
                                    @endif
                                    @if($institution->twitter !='')
                                        <a href="{{$institution->twitter}}" target="_blank"><i
                                                    class="fa fa-twitter"></i></a>
                                    @endif
                                </div>

                            </li>

                        @endif

                    </ul>
                </div>

            </div>

            @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)

                <div class="brand_poast_info">

                    <h6>INSTITUTION PAGE SETTINGS</h6>

                    <div class="brand_setting_txt">

                        <ul>

                            <li>

                                <div class="name_val">NAME</div>

                                <div class="val_val"><strong>{{ ucfirst($institution->name) }}</strong></div>

                            </li>

                            <li>

                                <div class="name_val">COLORS</div>

                                <div class="val_val">

                                            <span class="color_box"
                                                  style="background:{{ $institution->color1 }};"></span> &nbsp; <span
                                            class="color_box"
                                            style="background:{{ $institution->color2 }};"></span>

                                </div>

                            </li>


                        </ul>

                        <div class="editsettings_btn" data-step="4" data-position='left'
                             data-intro="Edit your page settings.."><a
                                    href="{{ URL::route('institution_edit_profile', [$institution->slug]) }}">edit
                                settings</a></div>

                    </div>

                </div>
                @endif
        </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
