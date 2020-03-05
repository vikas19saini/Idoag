@extends('layouts.default')

@section('title', $brand->name.' Offers and Discounts |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Offers and Discounts |idoag.com"/>
    <meta name="description" content="{{$brand->name}} Offers and Discounts |idoag.com"/>

    <meta property="og:description" content="{{$brand->name}} Offers and Discounts |idoag.com">
    <meta property="og:image" content="http://idoag.com/uploads/brands/{{$brand->image}}">
    <meta property="og:title" content="{{$brand->name}} Offers and Discounts |idoag.com">
    <meta property="og:url" content="{{ Request::fullUrl(); }}">
    <meta property="fb:app_id" content="1664606373750912">
    <meta property="og:type" content="idoagconnect:website">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:creator" content="idoag">
    <meta property="twitter:domain" content="idoag.com">
    <meta property="twitter:site" content="idoag.com">

@stop
@section('css')
    {{HTML::style('assets/css/custom_sonu.css')}}
    @include('brands.partial.color')
    <style>
        .container_info{
            width:100%;
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
        
        <div class='row_active row add_di offer_add_di'>
                <div class='container'>
                    <div class='col-lg-9 col-md-9 col-xs-12 col-sm-12'>
                        <div class='active_rowdd' style="padding-top:0px">
                            <div class='inner_div_apply inner_div_apply_e row'>                                
                                <div class='clearfix'></div>
                                <div class='bg_sonu row_full'>
                                    <div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit"> 
                                        
                                        @if(count($offers) > 0)
                                        
                                            @foreach($offers as $offer)
                                                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                                                    <div class="item_offer" style="position:relative">
                                                        
                                                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $offer->brand_id)
                                                            <ul class="offer_brand_control">
                                                                <li>
                                                                    <span data-form="#frmDelete-{{$offer->id}}" data-title="Delete Offer"
                                                                          data-message="Are you sure you want to delete this offer ?">
                                                                            <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                                                               title="Delete"> <i class="fa fa-trash-o"></i></a>
                                                                    </span>
                                                                </li>                                                                   
                                                                <li>
                                                                    <a href="{{ URL::route('update_offers',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}"
                                                                       data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                </li>
                                                                {{ Form::open(array(
                                                                            'url' => route('posts.destroy', array($offer->id)),
                                                                            'method' => 'delete',
                                                                            'style' => 'display:none',
                                                                            'id' => 'frmDelete-' . $offer->id
                                                                        ))
                                                                    }}
                                                                    {{ Form::submit('Submit') }}
                                                                    {{ Form::close() }}
                                                            </ul>
                                                            @endif
                                                        
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
                                                                    <!--<p class="text-center"><span>Click here to get your coupon code</span></p>-->
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
                                            @endforeach
                                        @else
                                        
                                            <div class="allnotfund_msg">
                                                <div class="allnotfund_msgleft institutions_errorleft">{{ HTML::image('assets/images/nooffer_img.png')}} </div>
                                                <div class="allnotfund_msgright institutions_erroright">
                                                    @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                                        <p><span class="bold_msg"> You have not posted any offer yet. Post a <a href="{{ URL::route('create_offers',$brand->slug)}}">New
                                                                    Offer</a> now.</span></p>
                                                    @else
                                                        <p>
                                                            <span class="bold_msg">No Offers Available Currently from {{$brand->name}}</span><br/>
                                                            Please <a href="{{ URL::route('offers') }}">click here</a> to view other
                                                            offers available on IDOAG</p>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                       @endif
                                        
                                    </div>
                                    <div class='clearfix'></div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-3 hidden-xs hidden-sm'>
                        <div class='row_divdfs row_divdfs_offer text-center' style="margin-top:0em">                            
                            <div class='row_xa_offer'>
                                @include('brands.partial.note')
                                @include('partials.ad')
                            </div>
                            <div class='clearfix'></div>
                            <div class='clearfix'></div>
                        </div>
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

    {{ HTML::script('assets/js/notescript.js') }}


@stop
