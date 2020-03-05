@extends('layouts.default')

@section('title','Offers & Discounts for Students |idoag.com')
@section('metatags')
    <meta name="keywords" content="Offers & Discounts for Students |idoag.com" />
    <meta name="description" content="Offers & Discounts for Students |idoag.com" />

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

        <div class="notice_feed_info internship_list">
            <div class="container_info">
  <h3>Trending Offers<a href="{{ URL::route('offers')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
            <div class="notice_feed_list">
                <div class="notice_feed_listinner2">
                    <ul>
                        @foreach($trending_offers as $offer)

                            <li>
                                @if(Sentry::check())

                                    <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">

                                        @else

                                            <a href="#" data-toggle="modal"  data-target="#login_required" >

                                                @endif

                                                <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'))}}</div>

                                                <div class="notice_feed_listinnercont">

                                                    <h5>{{$offer->name}}</h5>

                                                    <p>{{ShortenText($offer->short_description,100)}} <br>

                                                        <i>by {{getBrandName($offer->brand_id)}}</i>
                                                    </p>

                                                </div>
                                            </a>
                            </li>


                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
        </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
