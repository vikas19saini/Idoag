@extends('layouts.default')

@section('title','Student Recent Offers - Idoag!')


@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('students.partials.profileheader')


        <div class="brandoffer_info stdntprofile_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="notice_feed_list">
                        <h3>{{ HTML::image("assets/images/note_img3.png") }} <span>Recently Viewed Offers</span> <a href="{{ URL::route('student_dashboard')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>

                        <div class="notice_feed_listinner2">

                            @if(count($recently_viewed_post)>0)
                                <ul>

                                    @foreach($recently_viewed_post as $post)

                                        @if($post->type == 'offer')

                                            <li>

                                                <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">

                                                    <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'))}}</div>

                                                    <div class="notice_feed_listinnercont">

                                                        <h5>{{$post->name}}</h5>

                                                        <p>{{ShortenText($post->short_description,200)}} <br>

                                                            <i>by {{getBrandName($post->brand_id)}}</i>
                                                        </p>

                                                    </div>
                                                </a>
                                            </li>

                                        @endif

                                    @endforeach

                                </ul>

                            @else
                                <p>No Recent Offers have.</p>
                            @endif
                        </div>
                    </div>
                </div>
                @include('students.partials.rightbar')
            </div>
        </div>
    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    <script>
        $(function(){
            var ww=$(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww);

            $( window ).resize(function() {
                var ww2=$(window).innerWidth();
                $(".navbar-default .navbar-nav > li .submenu").width(ww2);
            });

            $('.navbar-default .navbar-nav > li .submenu .mybrandslider_info').bxSlider({
                minSlides: 1,
                maxSlides: 5,
                slideWidth: 154,
                infiniteLoop: false,
                pager: false,
                moveSlides: 1,
                slideMargin: 10
            });

            $('.suggestedbrands_list ul').bxSlider({
                pager: false
            });

        });
    </script>
@stop
