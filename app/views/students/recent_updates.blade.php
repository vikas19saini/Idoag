@extends('layouts.default')

@section('title','Student Recent Updates - Idoag!')


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
                        <h3>{{ HTML::image("assets/images/noteheart_img17.png") }} <span>Recent Updates</span><a href="{{ URL::route('student_dashboard')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
                        <div class="studentrecentupdates_list">
                            <ul>

                                @foreach($brands_posts as $post)

                                    @if($post->type == 'offer')

                                        <li> <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/stdntrecentupdates_img1.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted an offer: <strong>{{$post->name}}</strong></div>
                                            </a> </li>

                                    @endif


                                    @if($post->type == 'photo')

                                        <li> <a href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_photo studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img3.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new photo gallery.</div>
                                            </a> </li>

                                    @endif

                                    @if($post->type == 'insphoto')

                                        <li> <a href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_photo studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img3.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getInstitutionName($post->institution_id)}}</strong> posted a new photo gallery.</div>
                                            </a> </li>

                                    @endif


                                    @if($post->type == 'link')

                                        <li> <a href="{{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_text studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img5.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new link.</div>
                                            </a> </li>

                                    @endif

                                    @if($post->type == 'internship')

                                        <li> <a href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_internship studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted an internship : <strong>{{$post->category, $post->city}}</strong></div>
                                            </a> </li>

                                    @endif

                                    @if($post->type == 'event')

                                        <li> <a href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_event studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img4.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new event :  <strong>{{ $post->name}}</strong></div>
                                            </a> </li>

                                    @endif

                                    @if($post->type == 'insevent')

                                        <li> <a href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_event studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img4.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getInstitutionName($post->institution_id)}}</strong> posted a new event :  <strong>{{ $post->name}}</strong></div>
                                            </a> </li>

                                    @endif

                                @endforeach

                            </ul>
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
