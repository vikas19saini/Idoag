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
        <div class="container_info">
        <div class="notice_feed_info internship_list">

                <h3>Offers from my brands<a href="{{ URL::route('offers')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
            <div class="notice_feed_list">
                <div class="notice_feed_listinner2">

                    <ul>
                        @if(count($top_offers)>0)

                            @foreach($top_offers as $offer)

                                <li>

                                    <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">

                                        <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'))}}</div>

                                        <div class="notice_feed_listinnercont">

                                            <h5>{{$offer->name}}</h5>

                                            <p>{{ShortenText($offer->short_description,200)}} <br>

                                                <i>by {{getBrandName($offer->brand_id)}}</i>
                                            </p>

                                        </div>
                                    </a>
                                </li>

                            @endforeach

                        @else

                            <p class="norecords">No offers available.</p>

                        @endif

                    </ul>

                </div>

            </div>
        </div>
            </div>

    </div></div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
