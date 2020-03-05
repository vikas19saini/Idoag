@extends('layouts.default')

@section('title','Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com')

@section('metatags')

    <meta name="keywords" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

    <meta name="description" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

@stop

@section('css')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
    @include('partials.flash')
        <div class="container_info">
        <div class="brandsnearyou_info">

            <h3>BRANDS NEAR YOU<a href="{{ URL::route('brands')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

            @if(!($local_brands))

                <div class="brandsnearyou_list">

                    <ul>

                        @foreach($local_brands as $brand)

                            <li>
                                <div class="brandsnearyou_listimg"> <a href="{{URL::route('brand_profile',array($brand->slug))}}"> {{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</a> </div>

                                <div class="brandsnearyou_listcont"> <a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}}</a> </div>

                                <div class="brandsnearyou_listcont2"> {{ HTML::image('assets/images/like4_icon.png')}} <span>+{{getBrandFollowsCount($brand->id)}}</span>  </div>
                            </li>

                        @endforeach

                    </ul>

                </div>

            @else

                <p class="norecords">No Local Brands</p>

            @endif

        </div>
    </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
