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
                                    <div class='serech_box col-lg-9 col-md-9 col-sm-12 col-xs-12'>
                                        <input type='text' value="" id="search_input" placeholder='What are you looking for ?'/>
                                        <button class='btn_show_s'><i class="fa fa-search"></i></button>
                                    </div>
                                    <div class='sort_by_main col-lg-3 col-md-3 hidden-xs hidden-sm'>
                                        <div class="sort_by">
                                            
                                            @if(count($offers)>0)
                                                {{ Form::select('sort', [
                                                    '0' => 'Most Viewed',
                                                    '1' => 'Latest',
                                                    '2' => 'Popular'],1,['id' => 'sort_offers', 'class' => 'type_div']
                                                ) }}
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class='clearfix'></div>
                                <div class='bg_sonu row_full'>
                                    <div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit"> 
                                        
                                        @if(count($offers) > 0)
                                        
                                            @foreach($offers as $offer)
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
                                        
                                            <p><span class="bold_msg"> We are in the process of adding offers on IDOAG.</span><br/>
                                            Kindly bear with us for sometime and we will notify you once this is active.</p>
                                            
                                       @endif
                                        
                                    </div>
                                    <div class='clearfix'></div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-3 hidden-xs hidden-sm'>
                        <div class='row_divdfs row_divdfs_offer text-center'>
                            <div class='dirow'>
                                <h1>TRENDING DISCOUNTS</h1>
                            </div>
                            @if(count($trending_offers) > 0)
                                @foreach($trending_offers as $offer)
                                    @if(isset($loggedin_user) && $loggedin_user->brand_id != $offer->brand_id &&  $offer->start_date> date('Y-m-d'))
                                    @else
                                        <div class='row_xa_offer'>
                                            <a   @if(Sentry::check())  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" @else
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

    <script>
        $(document).ready(function() {            
            var timer;            
            var process = true;     
            var path = window.location.pathname; 
            $('#sort_offers').change(function() {
                var select = $('#sort_offers :selected').text();
                var category = $('#category').val();
                var data = "&category=" + category + "&keywords=" + select;
                
                $.ajax({
                    url: '/getPopular',
                    type: 'POST',
                    data: {'keywords': select, 'category': category},
                    success: function (response) {                        
                        if (response) {                                    
                            $('#display_offers').replaceWith(response);
                        }
                    }
                }).always(function () {
                    process = true;
                });
            });

            $("#search_input, .btn_show_s").keyup(function(){
                var keywords = $('#search_input').val();
                timer = setTimeout(function(){
                    if(keywords.length > 0)
                    {
                        $.post('/searchOffer',{keywords: keywords},function(response){
                            if(response) {
                                $("#display_offers").replaceWith(response);
                            }
                        });
                    }
                }, 500);
            });


            $("#search_input").keydown(function(){

               clearTimeout(timer);

            });


            var offset = 1;
            var limit = 12;
            var total = {{$post_total}};

            $(window).scroll(function() {                
                var keywords = $('#search_input').val();
                var select = $('#sort_offers :selected').text();
                var category = $('#category').val();
                if( process && $(window).scrollTop() + $(window).height() > $('.brandoffer_list').height() && path == '/offers' && keywords.length == 0 && select == 'Latest') {

                    process = false;
                    
                    offset++;

                    if(total > (offset - 1 ) * limit)
                    {
                        var data = "&offset="+offset+"&total="+total+"&limit="+limit+"&select="+select;
                            
                        $.ajax(
                        {
                            url : '/getmoreOffers',
                            type: 'POST',
                            data : data,
                            success: function(response) 
                            {
                                if(response)
                                {   
                                    $('#load_more').fadeOut();
                                    $('.brandoffer_list ul').append(response);
                                }
                            }
                        }).always(function(){
                                process = true;
                            });
                    }  
                    else 
                    {   //alert("done");
                        $('#load_more').fadeIn();
                        $('#load_more').html('');//message for end of offers
                    }
                }
            });

            $(document).on("click",".login_btnpop", function() {

                $('#login_required').modal('show');

                var url = $(this).data('id');
                console.log(url);
                
                $('#get_url').val(url);
            });

        });

    </script>

@stop