@extends('layouts.default')

@section('title','Offer - '.$single->name.' from '.$brand->name.' |idoag.com')

@section('metatags')
    <meta name="keywords" content="Offer - {{$single->name}} from {{$brand->name}} |idoag.com"/>
    <meta name="description" content="Offer - {{$single->name}} from {{$brand->name}} |idoag.com"/>
@stop

@section('css')
    {{HTML::style('assets/css/custom_sonu.css')}}
    @include('brands.partial.color')
    <style>
        .bg_sonu{
            background:transparent;
        }
    </style>
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

                            {{ HTML::image(getImage('uploads/photos/',$single->image,'noimage.jpg'),'',['class'=>'brandsoffer_img','itemprop'=>'image'])}}

                            <div class="note_img2">   {{ HTML::image("assets/images/note_img3.png") }} </div>

                            <div class="brandoffer_imgcont">
                              
                                <div class="share_like_txt">
                                    
                                    <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>
                                    
                                    <p> <i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$single->id}}" @endif></i>
                                    
                                        <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b> 

                                    </p>
                                    
                                    <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                                    
                                    <div class="addthis_sharing_toolbox"> 
                                        <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$single->image}}','{{$single->short_description}}','{{$single->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                        <span class="share_tw"><a href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('get_offers',array('slug1' => getBrandSlug($single->brand_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                        <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($single->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$single->image}}&description={{ $single->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                        <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($single->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="brandoffer_listtopcont">
                            {{ Form::hidden('_token', csrf_token()) }}

                            <h4 itemprop="name">{{ $single->name}}</h4>

                            <div class="available_txt">

                                <ul>

                                    @if($single->panindia == 'India')

                                        <li> Avail it Anytime Anywhere</li>

                                    @elseif($single->web_only == 1)

                                        <li> Online Offer Only</li>

                                    @elseif($single->panindia_inst_id)

                                        <li> Available in {{getInstitutionName($single->panindia_inst_id)}} </li>

                                    @else
                                        @if($single->city!='')
                                            <li><span class="stores_available"
                                                      id="{{ $single->id}}"> Available at {{getCity($single->city)}}
                                                    , {{getState($single->state)}} </span></li>
                                        @else
                                            <li><span class="stores_available" id="{{ $single->id}}"> Available at Selected Stores </span>
                                            </li>
                                        @endif
                                    @endif

                                    @if($single->start_date> date('Y-m-d'))

                                        <li> Starts at {{ date("F d, Y", strtotime($single->start_date))  }} </li>

                                    @else

                                        <li> Valid Till {{ date("F d, Y", strtotime($single->end_date))  }} </li>

                                    @endif

                                </ul>

                                @if($single->web_only == 0 && $single->available_stores)

                                    <div class="available_selectcntinfo">

                                        <div class="available_selectcnt">

                                            <div class="available_search">

                                                {{ Form::open(['class' => 'form-inline','id' => 'avail_stores', 'role' => 'form']) }}

                                                <div class="form-group">

                                                    <label>State</label>

                                                    {{ Form::select('state', array('' => 'Select State') + $states,  $single->state,  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)'])}}

                                                </div>

                                                <div class="form-group">

                                                    <label>City</label>

                                                    {{Form::select('city',array('' => 'Select City') + $cities, $single->city,['class'=>'form-control','id'=>'cityId','required'])}}

                                                </div>

                                                <div class="form-group">

                                                    <label>Location</label>

                                                    {{Form::text('location',null,['placeholder' => 'Location', 'id'=>'location' ,'class' => 'form-control'])}}

                                                </div>

                                                {{ Form::submit('Go', ['class' => 'btn go_btn']) }}

                                                {{ Form::close() }}

                                            </div>

                                            <div class="table-responsive available_tblinfo">

                                                <div class="whitebg">

                                                    <table class="table available_table">

                                                        <thead>

                                                        <tr>
                                                            <th>Sl. No.</th>
                                                            <th>city</th>
                                                            <th>Location</th>
                                                        </tr>

                                                        </thead>

                                                        <tbody>


                                                        </tbody>

                                                    </table>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endif

                                @if($single->end_date<date('Y-m-d H:i:s'))

                                    <br/><h4>Offer Expired</h4>

                                @else


                                    @if($single->voucher_type=='single' || $single->voucher_type=='multiple')

                                        <div class="couponcode_txt">
                                            <br/> <h5>Coupon Code</h5>

                                            @if($single->voucher_type=='single')


                                                @if($single->coupon_code)

                                                    <a class="singlecoupon"
                                                       id="{{$single->id}}">{{$single->coupon_code}}</a>

                                                @else

                                                    <a href="javascript:void(0);" class="singlecoupon"
                                                       id="{{$single->id}}"> Coupon Code</a>

                                                @endif

                                            @else


                                                @if($single->coupon_code)

                                                    <a href="javascript:void(0);"
                                                       id="{{$single->id}}">{{$single->coupon_code}}</a>
                                                    <p><strong>Note:</strong> Here is the coupon you just generated. You
                                                        could generate another coupon in
                                                        @if($coupon_interval->h==0 && $coupon_interval->i==0) 00:15 @else
                                                            00
                                                            :{{ 15-$coupon_interval->i}} @endif mins</p>

                                                @else

                                                    <a href="javascript:void(0);" class="multiplecoupon" id="{{$single->id}}">Generate Coupon Code & Send Via Email</a>

                                                    <div class="coupon_codetxt"> </div>
                                                    <p> <strong>Note:</strong> You could generate only one coupon every 15 minutes. </p>

                                                @endif

                                            @endif

                                        </div>

                                    @endif
                                @endif

                            </div>

                            <div class="show_stores"></div>

                            {{ nl2br($single->description)}}
                            <br/>

                            <div class="couponcode_txt"><a href="#having_trouble" class="" data-toggle="modal"
                                                           data-target="#having_trouble">Report Problem ?</a></div>

                        </div>

                    </div>
                @if(count($offers))
                    <div class="brandoffer_list newoffer_list">
                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $single->brand_id)
                        @else
                            <h3 class="other_offers"> Other Offers of Interest</h3>
                        @endif

                        <ul>
                         <div class='bg_sonu row_full'>
                            <div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit">
                            @foreach($offers as $offer)

                                @if($offer->id != $single->id)

                                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                                                    <div class="item_offer" style="position:relative">
                                                        <div class='inner_div_useonly'>
                                                            @if(Sentry::check())
                                                                <a  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">
                                                            @else
                                                                <a  href="#" data-toggle="modal" data-target="#login_required" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" class="login_btnpop">                                                            
                                                            @endif
                                                                <div class='moreinner'>
                                                                    {{ HTML::image(getImage('uploads/photos/M_',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}}
                                                                    <h1>{{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'')}}</h1>
                                                                </div>
                                                            </a>                                                            
                                                            @if(Sentry::check())
                                                                <a  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">
                                                            @else
                                                                <a  href="#" data-toggle="modal" data-target="#login_required" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" class="login_btnpop">                                                            
                                                            @endif
                                                                <div class="offers_min">
                                                                    <p>{{ShortenText($offer->short_description,70)}}</p>
                                                                    <!--<p class="text-center"><span>Click here to get your coupon code</span></p> -->
                                                                </div>
                                                            </a>
                                                            <div class='clearfix'></div>
                                                            <div class="uicon_latest">
                                                                <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$offer->id}}" @endif> {{getPostInfoCount($offer->id, 'likes')}}</i>
                                                                <i class="fa fa-share-alt share_social"></i>
                                                                <div style="top:76%;right:2em" class="addthis_sharing_toolbox">
                                                                    <span style="display:inline" class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                                                    <span style="display:inline" class="share_tw"><a href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                                                    <span style="display:inline" class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }}" target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                                                    <span style="display:inline" class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                                                </div>
                                                            </div>
                                                        </div>         
                                                    </div>
                                                </div>

                                @endif

                            @endforeach
                            </div>
                            </div>

                        </ul>

                    </div>
                    @endif

                </div>

                <div class="notice_feed_info">
                @if(count($brandoffers))
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
                    @endif

                    @include('brands.partial.note')  

                    @include('partials.ad')

                </div>

            </div>

        </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->


    <div id="having_trouble" class="modal fade" role="dialog">
        <div class="having_trouble-dialog modal-dialog">

            <!-- Modal content-->
            <div class="having_trouble-content modal-content">
                <div class="modal-header having_trouble-header">
                    <button type="button" class="close"
                            data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
                    <h4 class="modal-title">Report Problem</h4>
                </div>
                <div class="modal-body having_trouble-body">

                    {{ Form::open(['class' => 'form-horizontal','id' => 'offer_problem_issue', 'files' => 'true']) }}

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{ Form::select('reason', array('' => 'Select Reason') + $offer_problems,  null ,  ['class' => 'form-control', 'required' => 'required'])}}
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">
                            {{Form::textarea('message',null,['placeholder' => 'Details', 'class' => 'form-control', 'required' => 'required'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">

                            <input type="hidden" name="post_url" value="{{Request::fullUrl()}}">
                            <input type="hidden" name="post_id" value="{{$single->id}}">
                            <input type="submit" class="btn btn-default" value="Submit">
                        </div>
                    </div>

                    {{ Form::close() }}

                    <div class="load_info">
                        {{   HTML::image('assets/images/loading.gif')}}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- thankyou Registration -->
    <div id="thankyou_reg" class="modal fade" role="dialog">
        <div class="modal-dialog thankyou_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content institutions_modal-content">

                <button type="button" class="close"
                        data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>

                <div class="modal-body thankyou_body">
                    <h3>We regret the inconvenience.</h3>

                    <p>We will get back to you as soon as we can</br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- thankyou Registration end -->

@stop

@section('js')

    {{ HTML::script('assets/js/notescript.js') }}

    <script>

        $(document).ready(function (e) {

            $('.whitebg').hide();

            $('.coupon_codetxt').hide();

            $('#avail_stores').submit(function (e) {

                e.preventDefault();

                var state = $('#stateId').val();

                var city = $('#cityId').val();

                var location = $('#location').val();

                var post_id = $('.stores_available').attr('id');

                var data = "&state=" + state + "&city=" + city + "&location=" + location + "&post_id=" + post_id;

                $.ajax(
                        {
                            url: '/availableStores',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                $('.whitebg').show();

                                if (response) {
                                    var data = response.available_stores;

                                    $('.available_table > tbody').html('');

                                    $.each(data, function (index, value) {
                                        console.log(index);
                                        $('.available_table > tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.city + '</td><td>' + value.locality + '</td></tr>');

                                    });
                                }
                            }
                        });
            });

            $('.statistics_slider').bxSlider({

                pager: false
            });


            $('.singlecoupon').on('click', function () {

                var post_id = $(this).attr('id');

                var data = "post_id=" + post_id;

                $.ajax({
                    url: '/userSingleCoupon',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        console.log(response);
                        if (response) {
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
                            $('.multiplecoupon').hide();
                            $('.coupon_codetxt').show();
                            $('.coupon_codetxt').html(response.code);
                        }

                    }
                });
            });

            $('#offer_problem_issue').formValidation({

                framework: 'bootstrap',

                excluded: [':disabled'],

                icon: {

                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                trigger: 'change',

                fields: {

                    reason: {

                        validators: {

                            notEmpty: {

                                message: 'Reason is required and cannot be empty'

                            }

                        }
                    },
                    message: {

                        validators: {

                            notEmpty: {

                                message: 'Message is required and cannot be empty'

                            }

                        }
                    }

                }

            }).on('success.form.fv', function (e) {

                $(".having_trouble-body .load_info").show();

                e.preventDefault();

                var reg_form = $(e.target), fv = reg_form.data('formValidation');

                // Use Ajax to submit form data
                $.ajax({
                    url: '/reportProblemIssue',
                    type: 'POST',
                    data: reg_form.serialize(),
                    success: function (response) {

                        $(".having_trouble-body .load_info").hide();

                        $("#having_trouble").hide();

                        $('#having_trouble').trigger("reset");

                        $('#thankyou_reg').modal('show');

                        $("body").removeClass("modal-open");

                    }
                });
            });

        });


        $(document).keyup(function (e) {
            if (e.keyCode == 27) {
                if ($("#having_trouble").hasClass("in") || $("#thankyou_reg").hasClass("in")) {
                    $("#having_trouble").hide();
                    $('#thankyou_reg').hide();
                    $(".couponcode_txt a").trigger("click");
                }
            }
        });

    </script>

@stop
