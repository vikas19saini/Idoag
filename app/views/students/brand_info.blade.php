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
        <div class="container_info">
            <div class="brand_poast_info">

                <h3>BRAND INFO <a href="{{ URL::route('brand_profile', [$brand->slug]) }}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

                <div class="brand_setting_txt">
                    <ul>
                        <li>
                            <div class="name_val">BRAND NAME</div>
                            <div class="val_val"><strong>{{ ucfirst($brand->name) }}</strong></div>

                        </li>

                        <li>
                            <div class="val_val editdescription_txt">
                                {{ $brand->description }}

                            </div>

                        </li>
                        @if($brand->url !='')
                            <li>
                                <div class="name_val">Website</div>
                                <div class="val_val website_link"><a href="{{$brand->url}}" target="_blank">{{$brand->url}}</a></div>

                            </li>
                        @endif
                        @if($brand->facebook !='' || $brand->twitter !='')
                            <li>

                                <div class="name_val">Social Media</div>

                                <div class="val_val editsetting_scocial">
                                    @if($brand->facebook !='')
                                        <a href="{{$brand->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    @endif
                                    @if($brand->twitter !='')
                                        <a href="{{$brand->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    @endif
                                </div>

                            </li>

                        @endif

                    </ul>
                </div>

            </div>

            @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                <div class="brand_poast_info">

                    <h6>BRAND PAGE SETTINGS</h6>

                    <div class="brand_setting_txt">

                        <ul>

                            <li>

                                <div class="name_val">COLORS</div>

                                <div class="val_val">

                                    <span class="color_box" style="background:{{ $brand->color1 }};"></span>
                                    &nbsp; <span class="color_box"
                                                 style="background:{{ $brand->color2 }};"></span>

                                </div>

                            </li>

                            <li>

                                <div class="name_val">CATEGORIES</div>

                                <div class="val_val">{{ implode(' | ', array_column(object_to_array($brand->categories), 'name')) }}</div>

                            </li>

                        </ul>

                        <div class="editsettings_btn" data-step="4" data-position='left' data-intro="Edit your page settings.." >
                            <a href="{{ URL::route('brand_edit_profile', [$brand->slug]) }}">edit settings</a>
                        </div>

                    </div>

                </div>

                 @endif
        </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
