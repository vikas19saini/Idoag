@extends('layouts.default')

@section('title','IDOAG Blog |idoag.com')

@section('metatags')
    <meta name="keywords" content="IDOAG Blog |idoag.com" />
    <meta name="description" content="IDOAG Blog |idoag.com" />
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
                    <h5>Blog</h5>
                </div>
                <div class="pagecontent"><div class="underprocess">Update Soon</div>
                </div>

            </div>    </div>
    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop