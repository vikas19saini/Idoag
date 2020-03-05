@extends('layouts.default')

@section('title','Privacy Policy|idoag.com')

@section('metatags')
    <meta name="keywords" content="Privacy Policy|idoag.com" />
    <meta name="description" content="Privacy Policy|idoag.com" />

@stop

@section('css')
<style>
    .contactus_fullform select{
            background: #fff;
    border: 1px solid #dbdbdb;
    margin: 0 15px 0 0;
    display: inline-block;
    vertical-align: middle;
    width: 360px;
    height: 50px;
    line-height: 50px;
    color: #555;
    font-size: 18px;
    font-family: 'proxima_novalight';
    padding: 0 15px;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    margin-bottom: 15px;
    border-radius: 0px;
    }
</style>
 @stop


@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        <div class="brandoffer_info">
            <div class="container_info">

                <div class="brandsatidoag_info">
                </div>
                <div class="privacy_policy">
                    <div class="contactus_from">
            <div class="container_info">
                <h1>Submit Your Details</h1>

                <div class="form-area contactus_fullform">
                    {{ Form::open(['class' => 'form-group form-inline']) }}
                    <div class="form-group">
                        {{Form::text('name',null,['placeholder' => 'Full Name', 'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('email',null,['placeholder' => 'Email address', 'type' => 'email', 'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('college',null,['placeholder' => 'College Name',  'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('contact',null,['placeholder' => 'Contact Number','required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::select('social',['facebook' => 'Facebook', 'twitter' => 'Twitter', 'insta' => 'Instagram', 'tiktok' => 'TikTok', 'snapchat' => 'Snapchat', 'Youtube' => 'Youtube'],['placeholder' => 'Contact Number','required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::text('link',null,['placeholder' => 'Social Media Url','required' => 'required'])}}
                    </div>
                    <div class="form-inline"> 
                        <div class="input-group">
                            {{ Form::submit('Submit', array('class' => 'btn btn-primary text-center')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>


            </div>
        </div>
                </div>

            </div>    </div>
    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop