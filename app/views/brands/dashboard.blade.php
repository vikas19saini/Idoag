@extends('layouts.default')

@section('title', $brand->name.' Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com')

@section('metatags')
    <meta name="keywords"
          content="{{$brand->name}} Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
    <meta name="description"
          content="{{$brand->name}} Home Page - Maintain your Brand Page to promote, Post new offer, internship, event, text, photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
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
        
        @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)
            
            <div class="mobile_btmenu ">
                <ul>
                    <li>
                        <a href="{{ URL::route('brand_info',$brand->slug)}}">
                            <i class="fa fa-info"></i>
                            <span>Brand <br/>Info</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('brand_statistics',$brand->slug)}}">
                            <i class="fa fa-clipboard"></i>
                            <span>Brand<br/>Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('brand_followers',$brand->slug)}}">
                            <i class="fa fa-users"></i>
                            <span>Brand<br/>Followers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::route('get_feedback',$brand->slug)}}">
                            <i class="fa fa-file-text-o"></i>
                            <span>Notes /<br/> Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>
        
        @else
            <div class="mobile_btmenu othertopmenu">
                <ul>
                    <li>
                        <a href="{{ URL::route('brand_info',$brand->slug)}}">
                            <span>Brand Info</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('brand_feedback',$brand->slug)}}">
                            <span>Notes / Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>
        
        @endif
        
        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class='row_active row add_di offer_add_di'>
                <div class='container'>
                    <div class='col-lg-9 col-md-9 col-xs-12 col-sm-12'>                        
                        <div class='active_rowdd'>
                            <div class='inner_div_apply inner_div_apply_e row'>
                                <div class='clearfix'></div>
                                 @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                                    <div class="postsomething_statistics_info clearfix">

                                        <div class="postsomething_info" data-step="1" data-intro="Post Your Offers, Interships,Events, Text and photos" data-position='right'>

                                            <h6 class="fl">LET'S POST SOMETHING NEW </h6>

                                            <ul class="clear">

                                                <li>

                                                    <a href="{{ URL::route('create_offers',$brand->slug)}}">

                                                        {{ HTML::image('assets/images/postsomething_img1.png') }}

                                                        <p>OFFER</p>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="{{ URL::route('create_internships',$brand->slug)}}">

                                                        {{ HTML::image('assets/images/postsomething_img2.png') }}

                                                        <p>INTERNSHIP</p>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="{{ URL::route('create_events',$brand->slug)}}">

                                                        {{ HTML::image('assets/images/postsomething_img3.png') }}

                                                        <p>EVENT</p>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="{{ URL::route('create_text',$brand->slug)}}">

                                                        {{ HTML::image('assets/images/postsomething_img4.png') }}

                                                        <p>TEXT</p>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="{{ URL::route('create_photos',$brand->slug)}}">

                                                        {{ HTML::image('assets/images/postsomething_img5.png') }}

                                                        <p>PHOTOS</p>

                                                    </a>

                                                </li>

                                            </ul>

                                        </div>

                                        <div class="statistics_info" data-step="2" data-intro="Check your likes and views statistics" data-position='right'>

                                            <h6>STATISTICS</h6>

                                            <ul class="statistics_slider">


                                                <li>

                                                    <h4>+{{$month_followers}} </h4>

                                                    <p>followers from last one month</p>

                                                </li>
                                                <li>

                                                    <h4>+{{$posts_visits_count}} </h4>

                                                    <p>User visits for last one month</p>

                                                </li>
                                                <li>

                                                    <h4>+{{$posts_likes_count}} </h4>

                                                    <p>Likes for last one month</p>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                @endif 
                                <div class='clearfix'></div>
                                <div class='bg_sonu row_full' style="margin-top:0px">
                                    <div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit"> 
                                        
                                        @if(count($posts) > 0)                                        
                                            @foreach($posts as $offer)
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
                                                                    <!-- <p class="text-center"><span>Click here to get your coupon code</span></p> -->
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
                                                            @if(Sentry::check())
                                                                <div style="cursor:pointer" onclick="window.location.href='{{ URL::route('internship_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}'">
                                                            @else
                                                                <div style="cursor:pointer" class="login_btnpop" data-toggle="modal"  data-target="#login_required">
                                                            @endif
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
                                                                 
                                                             </div>
                                                            </div>
                                                        </div>         
                                                      </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else                                        
                                            <div class="allnotfund_msg">
                                                <div class="allnotfund_msgleft brands_errorleft">{{ HTML::image('assets/images/brands_errorimg.png')}} </div>
                                                <div class="allnotfund_msgright brands_errorright">
                                                    @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                                        <p>
                                                            <span class="bold_msg"> You have not posted anything.</span> <br/>
                                                            Start the journey with IDOAG to build your page and reach out to
                                                            Students across the country. Refer 

                                                            <a href="javascript:void(0);" onclick="introJs().start();">here</a>

                                                            if you need any assistance or contact us to help you with the same. </p>

                                                    @else
                                                        <p>
                                                            <span class="bold_msg">No posts Available Currently from {{$brand->name}}</span><br/>
                                                            Kindly bear with us for sometime.</p>
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
                        <div class='row_divdfs row_divdfs_offer' style='margin-top:2em'>
                            @if((isset($loggedin_user) && $loggedin_user->brand_id != $brand->id) || !isset($loggedin_user))
                    <div class="brand_poast_info">
                        <div class="notice_feed_info studentdashboard">
                                <h6>BRAND INFO</h6>

                                <div class="brand_setting_txt">
                                    <ul>
                                        <li>
                                            <div class="name_val">BRAND NAME</div>
                                            <div class="val_val"><strong>{{ ucfirst($brand->name) }}</strong></div>

                                        </li>

                                        <li>
                                            <div class="val_val editdescription_txt">
                                                {{ $brand->description }}

                                            </div>

                                        </li>

                                        @if($brand->url !='')

                                            <li>
                                                <div class="name_val">Website</div>

                                                <div class="val_val website_link"><a href="{{$brand->url}}" target="_blank">{{$brand->url}}</a> </div>

                                            </li>

                                        @endif

                                        @if($brand->facebook !='' || $brand->twitter !='')
                                            <li>

                                                <div class="name_val">Social Media</div>

                                                <div class="val_val editsetting_scocial">
                                                    @if($brand->facebook !='')
                                                        <a href="{{$brand->facebook}}" target="_blank"><i
                                                                    class="fa fa-facebook"></i></a>
                                                    @endif
                                                    @if($brand->twitter !='')
                                                        <a href="{{$brand->twitter}}" target="_blank"><i
                                                                    class="fa fa-twitter"></i></a>
                                                    @endif
                                                </div>

                                            </li>

                                        @endif

                                    </ul>

                                </div>

                            </div>
                            @endif

                            @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                                <div class="brand_poast_info">

                                    <h6>BRAND PAGE SETTINGS</h6>

                                    <div class="brand_setting_txt">

                                        <ul>

                                            <li>

                                                <div class="name_val">NAME</div>

                                                <div class="val_val"><strong>{{ ucfirst($brand->name) }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">COLORS</div>

                                                <div class="val_val">

                                                    <span class="color_box" style="background:{{ $brand->color1 }};"></span> &nbsp; <span class="color_box" style="background:{{ $brand->color2 }};"></span>

                                                </div>

                                            </li>

                                            <li>

                                                <div class="name_val">CATEGORIES</div>

                                                <div class="val_val">{{ implode(' | ', array_column(object_to_array($brand->categories), 'name')) }}</div>

                                            </li>

                                        </ul>

                                        <div class="editsettings_btn" data-step="4" data-position='left' data-intro="Edit your page settings..">

                                            <a href="{{ URL::route('brand_edit_profile', [$brand->slug]) }}">edit settings</a>

                                        </div>

                                    </div>

                                </div>

                                <div class="brand_poast_info" data-step="5" data-position='left' data-intro="Check your Statistics">

                                    <h6>POST STATISTICS (TOTAL/ACTIVE)</h6>

                                    <div class="brand_setting_txt">

                                        <ul class="stats">

                                            <li>

                                                <div class="name_val">OFFERS</div>

                                                <div class="val_val"><strong>{{ $offer_count }}/{{ $offer_active_count }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">INTERNSHIPS</div>

                                                <div class="val_val"><strong>{{ $internship_count }}/{{ $internship_active_count }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">PHOTOS</div>

                                                <div class="val_val"><strong>{{ $photo_count }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">EVENTS</div>

                                                <div class="val_val"><strong>{{ $event_count }}/{{ $event_active_count }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">TEXT</div>

                                                <div class="val_val"><strong>{{ $link_count }}</strong></div>

                                            </li>

                                        </ul>

                                    </div>

                                </div>

                                <div class="brand_poast_info" data-step="6" data-position='left' data-intro="Check Brand Statistics">

                                    <h6>OTHER STATISTICS</h6>

                                    <div class="brand_setting_txt">

                                        <ul class="stats">

                                            <li>

                                                <div class="name_val">OUTLETS</div>

                                                <div class="val_val"><strong>{{ $outlet_count }}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">FEEDBACK (Total/Not Replied)</div>

                                                <div class="val_val"><strong>{{ $total_feedback_count }}
                                                        /{{$total_not_replied}}</strong></div>

                                            </li>

                                            <li>

                                                <div class="name_val">INTERNSHIPS APPLICATIONS  RECEIVED</div>

                                                <div class="val_val"><strong>{{ $applied_internships_count }}</strong></div>

                                            </li>


                                        </ul>

                                    </div>

                                </div>

                                <div class="brand_poast_info">

                                    <h6>FOLLOWERS</h6>

                                    <div class="brand_follower_txt">

                                        <ul>
                                            @foreach($followers as $follower)

                                                <li>{{ HTML::image(getImage('uploads/profiles/',$follower->profile_image,'noimage.jpg'), $follower->first_name, ['class' => 'slider-img', 'width'=>'50']) }}</li>

                                            @endforeach

                                        </ul>

                                        <div class="editsettings_btn"><a
                                                    href="{{ URL::route('brand_followers', [$brand->slug]) }}">view
                                                all followers</a></div>

                                    </div>

                                </div>

                            @endif

                            @include('brands.partial.note')

                            @if(!isset($loggedin_user))

                                @include('partials.ad')

                            @endif
                        </div>
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


    <script>

        $(document).ready(function (e) {

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

        });

        $('.description').readmore({speed: 500});

    </script>

    {{ HTML::script('assets/js/notescript.js') }}


    {{ HTML::script('assets/js/isotope-docs.min.js') }}

    <script>

        $(window).load(function () {

            grid_list = $('.photowidget_list').isotope({
                itemSelector: '.grid-item',
                layoutMode: 'fitRows',
                isInitLayout: true,
                percentPosition: true,
                masonry: {
                    columnWidth: 100
                }
            });

            if (RegExp('demo', 'gi').test(window.location.search)) {
                introJs().start();
            }

            @if(Session::has('isfirstlogin'))
            introJs().start();
            <?php
            Session::forget('isfirstlogin');
            ?>
            @endif

        });


        var process = true;

        var path = window.location.pathname;

        $(document).ready(function () {

        //$(".intro_btn").trigger("click");


            var grid_list;

            var offset = 1;
            var limit = 10;
            var brand_id = $('#brandid').val();
            var total = {{getbrandposts($brand->id)}};
            //console.log(total);

            $(window).scroll(function () {

                if (process && $(window).scrollTop() + $(window).height() > $('.photowidget_list').height()) {

                    process = false;

                    offset++;

                    if (total > (offset - 1 ) * limit) {
                        var data = "&offset=" + offset + "&total=" + total + "&limit=" + limit + "&brand_id=" + brand_id;

                        $.ajax(
                                {
                                    url: '/getBrandPosts',
                                    type: 'POST',
                                    data: data,
                                    success: function (response) {
                                        if (response) {
                                            $('#load_more').fadeOut();
                                            $('.photowidget_list').append(response).isotope('reloadItems').isotope({sortBy: 'original-order'});
                                        }
                                    }
                                }).always(function () {
                                    process = true;
                                });
                    }
                    else {   //alert("done");
                        $('#load_more').fadeIn();
                        $('#load_more').html('');//message for end of offers
                    }
                }
            });

            $(document).on("click",".login_btnpop", function() {

                $('#login_required').modal('show');

                var url = $(this).data('id');
                // console.log(url);
                
                $('#get_url').val(url);
            });

        });

    </script>

@stop