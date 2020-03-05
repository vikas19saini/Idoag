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
                {{Form::hidden('brandid',$brand->id,['id' => 'brandid'])}}
                @if(isset($loggedin_user))
                    {{Form::hidden('userid',$loggedin_user->id,['id' => 'userid'])}}
                @endif

                <h3>FEEDBACK <a href="{{ URL::route('brand_profile', [$brand->slug]) }}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
<br/>
                @include('brands.partial.note')

            </div>

    </div> </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
 @section('js')

            {{ HTML::script('assets/js/notescript.js') }}

@stop