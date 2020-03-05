@extends('layouts.default')

@section('title','Text - '.$single->name.' from '.$institution->name.' |idoag.com')

@section('metatags')
    <meta name="keywords" content="Text - {{$single->name}} from {{$institution->name}} |idoag.com"/>
    <meta name="description" content="Text - {{$single->name}} from {{$institution->name}} |idoag.com"/>
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

        <!-- Brand inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class="brandoffer_info">
            <div class="container_info">
                <div class="brandoffer_contleft">

                    <div class="postanewoffer_info inst_postanewoffer_info">
                        <h3>  {{ HTML::image('assets/images/note_img.png') }} {{$single->name}}</h3>

                        <div class="brandoffer_listtopcont inst_brandoffer_listtopcont">

                            {{ nl2br($single->description)}}

                              
                            <div class="share_like_txt dashlinks_sharelike share_like_info inst_share share_like_txt3">
                                <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>

                                <p><i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif" id="{{$single->id}}"></i>
                                    <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b></p>

                                <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                                @if(Sentry::check())
                                    <div class="addthis_sharing_toolbox">

                                        <span class="share_fb"><a
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ URL::route('get_inst_links',array('slug1' => getInstitutionSlug($single->institution_id)))}}"><i
                                                        class="fa fa-facebook"></i></a></span>

                                        <span class="share_tw"><a
                                                    href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($single->institution_id), 'slug2' => $single->slug ))}} via idoagcard"><i
                                                        class="fa fa-twitter"></i></a></span>

                                        <span class="share_pin"><a
                                                    href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_text_details',array('slug1' => getInstitutionSlug($single->institution_id), 'slug2' => $single->slug ))}}&description={{ $single->name }} "><i
                                                        class="fa fa-pinterest"></i></a></span>

                                        <span class="share_gplus"><a
                                                    href="https://plus.google.com/share?url={{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($single->institution_id), 'slug2' => $single->slug ))}}"><i
                                                        class="fa fa-google-plus"></i></a></span>

                                    </div>
                                @endif
                            </div>


                        </div>

                    </div>

                    <br/>

                    <div class="brandoffer_list dashboard_events">
                        <div class="dashboard_linksinfo">

                            @foreach($links as $link)
                                @if($link->id != $single->id)
                                @include('institutions.partial.link')
                                @endif

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('institutions.partial.note')
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

    {{ HTML::script('assets/js/inst_notescript.js') }}
    <script>
        $(function () {
            var ww = $(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww);

            $(window).resize(function () {
                var ww2 = $(window).innerWidth();
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

        });
    </script>

@stop
