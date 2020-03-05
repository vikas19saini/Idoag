@extends('layouts.default')

@section('title',$page->pagetitle)

@section('metatags')
    <meta name="keywords" content="{{$page->metakeywords}}" />
    <meta name="description" content="{{$page->metadesc}}" />

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
                    <h5>{{$page->heading}}</h5>
                </div>
                <div class="pagecontent">{{$page->description}}
                </div>

            </div>    </div>
    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop