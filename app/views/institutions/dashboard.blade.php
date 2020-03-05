@extends('layouts.default')

@section('title',$institution->name.' Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com')
@section('metatags')
    <meta name="keywords"
          content="{{$institution->name}} Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
    <meta name="description"
          content="{{$institution->name}} Home Page - Maintain your Institution Page to promote, Post new  event,photo for Students, View statistics, Evaluate Performance, Respond to Students |idoag.com"/>
@stop

@section('css')
    @include('institutions.partial.color')
@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)

            <div class="mobile_btmenu ">
                <ul>
                    <li>
                        <a href="{{ URL::route('institution_info',$institution->slug)}}">
                            <i class="fa fa-info"></i>
                            <span>{{ $institution->type }} <br/>Info</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('inst_statistics',$institution->slug)}}">
                            <i class="fa fa-clipboard"></i>
                            <span>{{ $institution->type }}<br/>Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('institution_followers',$institution->slug)}}">
                            <i class="fa fa-users"></i>
                            <span>{{ $institution->type }}<br/>Followers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::route('get_inst_feedback',$institution->slug)}}">
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
                        <a href="{{ URL::route('institution_info',$institution->slug)}}">
                            <span>{{ $institution->type }} Info</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('instfeedback',$institution->slug)}}">
                            <span>Notes / Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>

            @endif
        <!-- Institution inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Institution inner Nav End here -->

        <div class="brandoffer_info">

            <div class="success"></div>

            <div class="container_info">

                <div class="brandoffer_contleft">

                    @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id )

                        <div class="postsomething_statistics_info clearfix">

                            <div class="postsomething_info" data-step="1" data-intro="Post Your Events and photos"
                                 data-position='right'>

                                <h6 class="fl">LET’S POST SOMETHING NEW</h6>

                                <ul class="clear">

                                    <li>

                                        <a href="{{ URL::route('create_inst_events',$institution->slug)}}">

                                            {{ HTML::image('assets/images/postsomething_img3.png') }}

                                            <p>EVENT</p>

                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ URL::route('create_inst_text',$institution->slug)}}">

                                            {{ HTML::image('assets/images/postsomething_img4.png') }}

                                            <p>TEXT</p>

                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{ URL::route('create_inst_photos',$institution->slug)}}">

                                            {{ HTML::image('assets/images/postsomething_img5.png') }}

                                            <p>PHOTOS</p>

                                        </a>

                                    </li>

                                </ul>

                            </div>

                            <div class="statistics_info" data-step="2"
                                 data-intro="Check your likes and views statistics" data-position='right'>

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

                    <div class="photowidget_list">

                        @if(count($posts)==0)
                            <div class="allnotfund_msg">
                                <div class="allnotfund_msgleft brands_errorleft">{{ HTML::image('assets/images/institutions_errorimg.png')}} </div>
                                <div class="allnotfund_msgright brands_errorright">
                                    @if(isset($loggedin_user) && isset($institution) && $loggedin_user->institution_id == $institution->id)
                                        <p><span class="bold_msg"> You have not posted anything !!</span><br/>
                                            Start the journey with IDOAG to build your page and reach out to Students/employees
                                            across the country. Refer <a href="javascript:void(0);"
                                                                         onclick="introJs().start();">here</a>
                                            if you need any assistance or contact us to help you with the same. </p>
                                    @else
                                        <p>
                                            <span class="bold_msg">No posts Available Currently from {{$institution->name}}</span><br/>
                                            Kindly bear with us for sometime.</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @foreach($posts as $post)

                                @include('students.partials.dashboard_post')

                        @endforeach

                    </div>

                </div>

                <div class="notice_feed_info studentdashboard">
                    <div class="brand_poast_info">

                        <h6>{{ $institution->type }} INFO</h6>

                        <div class="brand_setting_txt">
                            <ul>
                                <li>
                                    <div class="name_val">{{ $institution->type }} NAME</div>
                                    <div class="val_val"><strong>{{ ucfirst($institution->name) }}</strong></div>

                                </li>

                                <li>
                                    <div class="val_val editdescription_txt">
                                        {{ $institution->description }}

                                    </div>

                                </li>
                                @if($institution->url !='')
                                    <li>
                                        <div class="name_val">Website</div>
                                        <div class="val_val website_link"><a href="{{$institution->url}}"
                                                                             target="_blank">{{$institution->url}}</a>
                                        </div>

                                    </li>
                                @endif
                                @if($institution->facebook !='' || $institution->twitter !='')
                                    <li>

                                        <div class="name_val">Social Media</div>

                                        <div class="val_val editsetting_scocial">
                                            @if($institution->facebook !='')
                                                <a href="{{$institution->facebook}}" target="_blank"><i
                                                            class="fa fa-facebook"></i></a>
                                            @endif
                                            @if($institution->twitter !='')
                                                <a href="{{$institution->twitter}}" target="_blank"><i
                                                            class="fa fa-twitter"></i></a>
                                            @endif
                                        </div>

                                    </li>

                                @endif

                            </ul>
                        </div>

                    </div>


                    @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)

                        <div class="brand_poast_info">

                            <h6>{{ $institution->type }} PAGE SETTINGS</h6>

                            <div class="brand_setting_txt">

                                <ul>

                                    <li>

                                        <div class="name_val">NAME</div>

                                        <div class="val_val"><strong>{{ ucfirst($institution->name) }}</strong></div>

                                    </li>

                                    <li>

                                        <div class="name_val">COLORS</div>

                                        <div class="val_val">

                                            <span class="color_box"
                                                  style="background:{{ $institution->color1 }};"></span> &nbsp; <span
                                                    class="color_box"
                                                    style="background:{{ $institution->color2 }};"></span>

                                        </div>

                                    </li>


                                </ul>

                                <div class="editsettings_btn" data-step="4" data-position='left'
                                     data-intro="Edit your page settings.."><a
                                            href="{{ URL::route('institution_edit_profile', [$institution->slug]) }}">edit
                                        settings</a></div>

                            </div>

                        </div>

                        <div class="brand_poast_info" data-step="5" data-position='left'
                             data-intro="Check your Statistics">

                            <h6>POST STATISTICS</h6>

                            <div class="brand_setting_txt">

                                <ul>


                                    <li>

                                        <div class="name_val">PHOTOS</div>

                                        <div class="val_val"><strong>{{ $photo_count }}</strong></div>

                                    </li>

                                    <li>

                                        <div class="name_val">EVENTS</div>

                                        <div class="val_val"><strong>{{ $event_count }}</strong></div>

                                    </li>

                                    <li>

                                        <div class="name_val">TEXT</div>

                                        <div class="val_val"><strong>{{ $text_count }}</strong></div>

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
                                            href="{{ URL::route('institution_followers', [$institution->slug]) }}">view
                                        all followers</a></div>

                            </div>

                        </div>
                    @endif

                    @include('institutions.partial.note')
                    @if(!isset($loggedin_user))
                        @include('partials.ad')
                    @endif

                </div>

            </div>
            <div class="clear"></div>

        </div>

        <div class="clear"></div>

        <!-- Content Ends Here -->
</div>
        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

        @stop

        @section('js')


            <script>

                $(document).ready(function (e) {

                    /* institution statistics slider */
                    $('.statistics_slider').bxSlider({

                        pager: false

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


                $('.description').readmore({speed: 500});

            </script>

            {{ HTML::script('assets/js/inst_notescript.js') }}


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
                })

            </script>


            <script>

                var process = true;

                var path = window.location.pathname;

                $(document).ready(function () {

                    //$(".intro_btn").trigger("click");


                    var grid_list;
                    var offset = 1;
                    var limit = 10;
                    var institution_id = {{$institution->id}};
                    var total = {{getinstitutionposts($institution->id)}};
                    //console.log(total);

                    $(window).scroll(function () {

                        if (process && $(window).scrollTop() + $(window).height() > $('.photowidget_list').height()) {

                            process = false;

                            offset++;

                            if (total > (offset - 1 ) * limit) {
                                var data = "&offset=" + offset + "&total=" + total + "&limit=" + limit + "&institution_id=" + institution_id;

                                $.ajax(
                                        {
                                            url: '/getInstitutionPosts',
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

                });

            </script>



@stop