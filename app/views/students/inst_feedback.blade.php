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
                {{Form::hidden('institutionid',$institution->id,['id' => 'institutionid'])}}
                @if(isset($loggedin_user))
                    {{Form::hidden('userid',$loggedin_user->id,['id' => 'userid'])}}
                @endif

                <h3>FEEDBACK <a href="{{URL::route('institution_profile',$institution->slug) }}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
<br/>
                @include('institutions.partial.note')

            </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
 @section('js')

            {{ HTML::script('assets/js/inst_notescript.js') }}

@stop