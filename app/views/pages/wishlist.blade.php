@extends('layouts.default')

@section('title','Offers & Discounts for Students |idoag.com')
@section('metatags')
    <meta name="keywords" content="Offers & Discounts for Students |idoag.com" />
    <meta name="description" content="Offers & Discounts for Students |idoag.com" />

    <!-- <meta property="og:url" content="http://idoag.com" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="YOffers & Discounts for Students |idoag.com" />
    <meta property="og:description" content="Offers & Discounts for Students |idoag.com" />
    <meta property="og:image" content="http://idoag.com/uploads/th_logo.png" />

    <meta property="og:description" content="Offers & Discounts for Students |idoag.com">
    <meta property="og:image" content="http://idoag.com/assets/images/connectstudents_bg.jpg">
    <meta property="og:title" content="Offers & Discounts for Students |idoag.com">
    <meta property="og:url" content="{{ Request::fullUrl(); }}">
    <meta property="fb:app_id" content="1664606373750912">
    <meta property="og:type" content="idoagconnect:website">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:creator" content="idoag">
    <meta property="twitter:domain" content="idoag.com">
    <meta property="twitter:site" content="idoag.com"> -->
@stop

@section('css')

    {{HTML::style('assets/css/custom_sonu.css')}}    

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students')
        <div class="mobile_btmenu othertopmenu">
            <ul>
                <li>
                    <a href="{{ URL::route('trending_offers')}}" >
                        {{ HTML::image('assets/images/mobilebt_recently.png')}}
                        <span>Trending Offers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('mybrands_offers')}}">
                        {{ HTML::image('assets/images/mobilebt_recently.png')}}
                        <span>Offers from My Brands</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        
        <div class='clearfix'></div>
        
        <div class='row_active row add_di offer_add_di'>
                <div class='container'>
                    <div class='col-lg-9 col-md-9 col-xs-12 col-sm-12'>
                        <div class='active_rowdd'>
                            <div class='inner_div_apply inner_div_apply_e row'>
                                <div class='clearfix'></div>
                                 <div class="serech_box_main">                                    
                                </div> 
                                <div class='clearfix'></div>
                                <div class='bg_sonu row_full'>
                                    <div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit"> 
                                        
                                        @if(count($offers) > 0)
                                        
                                            @foreach($offers as $offer)
                                                @if($offer->type == 'offer')
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
                                                                    <!--<p class="text-center"><span>Click here to get your coupon code</span></p>-->
                                                                </div>
                                                                </a>
                                                                <div class='clearfix'></div>
                                                                <div class="uicon_latest">                                                                    
                                                                    <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$offer->id}}" @endif></i> <b class="id_{{$offer->id}}">{{getPostInfoCount($offer->id, 'likes')}}</b>
                                                                    <i class="fa fa-share-alt share_social"></i>
                                                                    <div style="top:77%;right:1em" class="addthis_sharing_toolbox">
                                                                        <span style="display:inline" class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                                                        <span style="display:inline" class="share_tw"><a href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                                                        <span style="display:inline" class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }}" target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                                                        <span style="display:inline" class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                                                    </div>
                                                                </div>
                                                            </div>         
                                                        </div>
                                                    </div>                                                
                                                @elseif($offer->type == 'internship' || $offer->type == 'job' || $offer->type == 'ambassador')
                                                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                                                        <div class="item_offer" style='position:relative'>
                                                            <div class="inner_div_useonly">
                                                               <h1 class="pull-right th_a @if($offer->type == 'job') job_color @endif @if($offer->type == 'ambassador') amm_color @endif">{{strtoupper(getPostType($offer->id))}}&nbsp;</h1>
                                                               <div class="class_spamll">
                                                                    <p class="pull-left th"><i class="fas fa-map-marker-alt"></i> {{$offer->city}}</p>
                                                               </div>                                                            
                                                            <div class="ordi img_size_ch">
                                                                {{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'))}}
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="secd de">
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <ul>
                                                                      @if($offer->type != 'internship')<li>&nbsp;</i>@endif
                                                                      <li><a href="#">Cat: {{getInternshipCatNameBySlug($offer->category)}}</a></li>  
                                                                      <li><a href="#">Start: {{dateformat($offer->start_date)}}</a></li>
                                                                      @if($offer->type == 'internship')
                                                                        <li><a href="#">Duration: {{getMonths($offer->start_date, $offer->end_date)}}</a></li>
                                                                      @endif
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <ul class="pull-right">
                                                                      @if($offer->type != 'internship')<li>&nbsp;</i>@endif
                                                                      <li><a href="#">Apply By: {{$offer->application_date}}</a></li>  
                                                                      <li><a href="#">Stipend: <i class="fa fa-inr" aria-hidden="true"></i> {{$offer->amount}}/Month</a></li>
                                                                    </ul>
                                                                </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <div class="bg_ground fgt w_offers_min @if($offer->type == 'job') job_bg_color @endif @if($offer->type == 'ambassador') amm_bg_color @endif">
                                                              <p class="th_b whshlist_intern">
                                                                  <a style="color: inherit" @if(Sentry::check())
                href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{ShortenText($offer->name,70)}}</a>
                                                              </p>
                                                            <div class="uicon_latest lates_updates">
                                                                <div class="clearfix"></div>
                                                                <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o @endif" data-toggle="tooltip" data-placement="top" title="Likes"
                                                                             id="{{$offer->id}}"></i> <b class="id_{{$offer->id}}">{{getPostInfoCount($offer->id, 'likes')}}</b>
                                                                <i class="fa fa-share-alt share_social"></i>
                                                                @if(Sentry::check())
                                                                   <div class="addthis_sharing_toolbox" style="top:-70%;">
                                                                             <span class="share_fb" style="display:inline">
                                                                                 <a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('internship_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a>
                                                                             </span>
                                                                             <span class="share_tw" style="display:inline">
                                                                                 <a href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('get_internships',array('slug1' => getBrandSlug($offer->brand_id)))}} via idoagcard"
                                                                                                 target="_blank"><i class="fa fa-twitter"></i></a>
                                                                             </span>
                                                                             <span class="share_pin" style="display:inline">
                                                                                 <a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($offer->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }} "
                                                                                                 target="_blank"><i class="fa fa-pinterest"></i></a>
                                                                             </span>
                                                                             <span class="share_gplus" style="display:inline">
                                                                                 <a href="https://plus.google.com/share?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($offer->brand_id)))}}"
                                                                                                 target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                             </span>
                                                                         </div>
                                                                 @endif
                                                             </div>
                                                            </div>
                                                        </div>         
                                                      </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else                                        
                                            <p><span class="bold_msg"> Oops</span><br/>
                                            You don't have any item in your wishlist.</p>                                            
                                       @endif
                                        
                                    </div>
                                    <div class='clearfix'></div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                            {{$offers->links()}}
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-3 hidden-xs hidden-sm'>
                        <div class='row_divdfs row_divdfs_offer text-center' style='margin-top:3em'>
                            <div class='dirow'>
                                <h1>TRENDING DISCOUNTS</h1>
                            </div>
                            @if(count($trending_offers) > 0)
                                @foreach($trending_offers as $offer)
                                    @if(isset($loggedin_user) && $loggedin_user->brand_id != $offer->brand_id &&  $offer->start_date> date('Y-m-d'))
                                    @else
                                        <div class='row_xa_offer'>
                                            <a @if(Sentry::check())  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" @else
                                            href="#" data-toggle="modal"  data-target="#login_required" @endif >
                                                {{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'')}}                                        
                                                <p>{{ShortenText($offer->short_description,100)}}</p>
                                            </a>    
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class='row_xa_offer'>                                        
                                    <p>No record found..</p>
                                </div>
                            @endif
                            <div class='clearfix'></div>
                            <div class='clearfix'></div>
                        </div>
                    </div>  
                </div>
                <!-- fotter start -->
            </div>
    </div>

        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

        @stop

@section('js')

@stop