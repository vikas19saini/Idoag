@extends('layouts.default')

@section('title','Offer Details - '.$single->name.' - '.$brand->name)

@section('css')

    @include('brands.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class="brandoffer_info">

            <div class="container_info">

                <div class="brandoffer_contleft">

                    <div class="brandoffer_listtop">

                        <div class="brandoffer_listtopimg">
                            {{ HTML::image(getImage('uploads/photos/',$single->image,'noimage.jpg'),'',['class'=>'brandsoffer_img'])}}


                            <div class="note_img2">   {{ HTML::image("assets/images/note_img3.png") }} </div>

                        </div>

                        <div class="brandoffer_listtopcont">

                            <h4>{{ $single->name}}</h4>

                            <div class="available_txt">

                                <ul>

                                    <li>
                                        @if($single->web_only==1)
                                            <a href="#">Online Offer Only</a>
                                        @else
                                            <a href="javascript:void(0);" class="stores_available"
                                               id="{{ $single->id}}">Available at Select Stores </a> @endif</li>

                                    <li> Valid Till {{ date("F d, Y", strtotime($single->end_date))  }} </li>

                                </ul>

                                @if($single->end_date<date('Y-m-d H:i:s'))

                                    <br/><h4>Offer Expired</h4>

                                @else

                                    @if($single->voucher_type=='single' || $single->voucher_type=='multiple')

                                        <div class="couponcode_txt">
                                            <br/> <h5>Coupon Code</h5>

                                            @if($single->voucher_type=='single')

                                                @if($single->coupon_code)

                                                    <a href="javascript:void(0);" class="singlecoupon"
                                                       id="{{$single->id}}">{{$single->coupon_code}}</a>

                                                @else

                                                    <a href="javascript:void(0);" class="singlecoupon"
                                                       id="{{$single->id}}"> Coupon Code</a>

                                                @endif

                                            @else

                                                @if($single->coupon_code)

                                                    <a href="javascript:void(0);" class="multiplecoupon"
                                                       id="{{$single->id}}">{{$single->coupon_code}}</a>

                                                @else

                                                    <a href="javascript:void(0);" class="multiplecoupon"
                                                       id="{{$single->id}}">Generate Coupon Code & Send Via Email</a>

                                                    <p>Please note: This can only be generated once every two hours</p>

                                                @endif

                                            @endif

                                        </div>

                                    @endif
                                @endif


                            </div>

                            <div class="show_stores"></div>

                            {{ $single->description}}

                        </div>

                    </div>

                    <div class="brandoffer_list newoffer_list">

                        <ul>

                            @foreach($offers as $offer)

                                @if($offer->id != $single->id)

                                    @include('brands.partial.offer')

                                @endif

                            @endforeach

                        </ul>

                    </div>

                </div>

                <div class="notice_feed_info">

                    <div class="notice_feed_list">
                        <h3> {{ HTML::image("assets/images/note_img3.png") }} Offers
                            by {{ Str::upper($brand->name) }} </h3>

                        <div class="notice_feed_listinner2">

                            <ul>


                                @foreach($brandoffers as $offer)

                                    <li>
                                        <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">

                                            <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'))}}</div>

                                            <div class="notice_feed_listinnercont">

                                                <h5>{{$offer->name}}</h5>

                                                <p>{{ShortenText($offer->short_description,120)}}</p>

                                            </div>
                                        </a>
                                    </li>

                                @endforeach

                            </ul>

                            <a href="{{URL::route('get_offers',$brand->slug)}}" class="seealloffers_btn">See all
                                offers</a></div>
                    </div>

                    @if($loggedin_user->brand_id != $brand->id)

                        <div class="notice_feed_list">

                            <h3> Notes / Feedback</h3>

                            <div class="notice_feed_listinner">
                                <ul>

                                    @foreach($notes as $note)

                                        @if($note->replymessage)

                                            <li>
                                                <div class="notice_feed_listinnerimg"> {{ HTML::image('uploads/profiles/'.getUserPicture($note->user_id)) }} </div>
                                                <div class="notice_feed_listinnercont">
                                                    <h6>{{$note->name}}</h6>

                                                    <p>{{$note->message}}</p>
                                                    <ul>
                                                        <li>
                                                            <div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div>
                                                            <div class="notice_feed_listinnercont">
                                                                <h6>{{getBrandName($brand->id)}}</h6>

                                                                <p>{{$note->replymessage}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        @endif

                                    @endforeach
                                </ul>
                                <div class="sendyourownnote_info">

                                    {{ Form::open(array('id' => 'notesform')) }}

                                    {{ Form::text('notes', null, ['id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}

                                    {{ Form::submit('Send Note') }}

                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    @endif

                    @include('partials.ad')

                </div>

            </div>

        </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')


    <script>

        $(document).ready(function (e) {

            $('.statistics_slider').bxSlider({

                pager: false
            });

            $('#notesform').submit(function () {

                event.preventDefault();

                var message = $('#notes').val();

                var user_id = {{$loggedin_user->id}};

                var brand_id = {{$brand->id}};

                var data = "&user_id=" + user_id + "&message=" + message + "&brand_id=" + brand_id;

                $.ajax(
                        {
                            url: '/postNotes',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                if (response) {
                                    if ($('#notes').val()) {
                                        $('#notes').val('');
                                    }
                                    swal(response);//alert(response);
                                }
                            }
                        });
            });

            $('.singlecoupon').on('click', function () {

                var post_id = $(this).attr('id');

                var data = "post_id=" + post_id;

                $.ajax({
                    url: '/userSingleCoupon',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        if (response) {
//alert(response);
                            $('.singlecoupon').html(response.code).removeAttr("href");
                        }

                    }
                });
            });

            $('.multiplecoupon').on('click', function () {

                var post_id = $(this).attr('id');

                var data = "post_id=" + post_id;

                $.ajax({
                    url: '/userMultipleCoupon',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        if (response) {
                            $('.multiplecoupon').html(response.code).removeAttr("href");
                        }

                    }
                });
            });

            $('.stores_available').on('click', function () {

                var post_id = $('.stores_available').attr('id');

                var data = "&post_id=" + post_id;//+"&message="+message+"&brand_id="+brand_id;

                $.ajax(
                        {
                            url: '/availableStores',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                if (response) {
                                    $.each(response.available_stores, function (index, value) {
                                        $('.show_stores').append(value);
                                        $('.show_stores').append('<br>');
                                    });
                                    $('.show_stores').append('<br>');
                                }
                            }
                        });

            });

        });

    </script>

@stop
