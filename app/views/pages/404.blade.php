@extends('layouts.default')

@section('title','404|idoag.com')

@section('css')

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

              <!--   <div class="brandsatidoag_info">
                    <h5></h5>
                </div> -->
                
<div class="errorpage">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="error404_img">
{{ HTML::image('assets/images/error_img.jpg')}}
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="error404_cnt">
 <h4>We can't seem to find the page you're looking for.</h4>
    {{$error}}
    <h4>Please <a href="{{ URL::route('contactus') }}">contact us</a> if you need any help</h4>
</div>
</div>
</div>
</div>

            </div>    </div>
    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop