@extends('layouts.default')

@section('title','Text - '.$single->name.' from '.$brand->name.' |idoag.com')

@section('metatags')
    <meta name="keywords" content="Text - {{$single->name}} from {{$brand->name}} |idoag.com"/>
    <meta name="description" content="Text - {{$single->name}} from {{$brand->name}} |idoag.com"/>
@stop
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

                    <div class="postanewoffer_info">
                        <h3>  {{ HTML::image('assets/images/note_img.png') }} {{$single->name}}</h3>

                        <div class="brandoffer_listtopcont">

                            {{-- nl2br($single->description)--}}
                        
                        <p class="text-justify">
                            <?php 
                                echo preg_replace('#<a.*?>.*?</a>#i', '', $single->description);
                                preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~',$single->description, $matches);
                                if(!empty($matches[2])){
                                    $tags = [];
                                    $links_new = [];
                                    foreach ($matches[2] as $value) {
                                        array_push($links_new, $value);
                                        $t = get_meta_tags($value);
                                        array_push($tags, $t);
                                    }
                                    //print_r($tags);
                                    $i=0;
                                    foreach ($tags as $value) {
                                        ?>
                                        <a href="<?php echo $links_new[$i]?>" target="_blank" style="text-decoration:none;color: initial;">
                                            <div class="link_fetch clearfix">
                                                <div class="left">
                                                    <?php
                                                        if(!isset($value['twitter:image'])){
                                                            $sites_html = file_get_contents($links_new[$i]);

                                                            $html = new DOMDocument();
                                                            @$html->loadHTML($sites_html);
                                                            $meta_og_img = null;
                                                            //Get all meta tags and loop through them.
                                                            foreach($html->getElementsByTagName('meta') as $meta) {
                                                                //If the property attribute of the meta tag is og:image
                                                                if($meta->getAttribute('property')=='og:image'){ 
                                                                    //Assign the value from content attribute to $meta_og_img
                                                                    $meta_og_img = $meta->getAttribute('content');
                                                                }
                                                            }
                                                            //echo $meta_og_img;
                                                            ?>
                                                            <img src="<?php echo $meta_og_img?>" />
                                                            <?php
                                                        }else{
                                                        ?>
                                                            <img src="<?php echo $value['twitter:image']?>" />
                                                            <?php 
                                                        } 
                                                    ?>
                                                    
                                                </div>
                                                <div class="right">
                                                    <?php if(isset($value['title'])) { ?>
                                                        <h6><?php echo $value['title']?></h6>
                                                    <?php } else {?>
                                                        <h6><?php echo $value['twitter:title']?></h6>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                        $i++;
                                    }
                                }
                            ?>
                        </p>                            

                        </div>

                        <div class="share_like_txt dashlinks_sharelike share_like_info share_like_txt3 single_link_share">
                            
                            <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>

                            <p><i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif"  id="{{$single->id}}"></i>
                                <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b>
                            </p>

                            <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>

                            @if(Sentry::check())

                                <div class="addthis_sharing_toolbox">

                                    <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$single->image}}','{{$single->short_description}}','{{$single->name}}','{{ URL::route('link_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                    <span class="share_tw"><a  target="_blank"
                                                href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('link_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}} via idoagcard"><i
                                                    class="fa fa-twitter"></i></a></span>

                                    <span class="share_pin"><a  target="_blank"
                                                href="https://pinterest.com/pin/create/button/?url={{URL::route('link_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}}&description={{ $single->name }} "><i
                                                    class="fa fa-pinterest"></i></a></span>

                                    <span class="share_gplus"><a  target="_blank"
                                                href="https://plus.google.com/share?url={{ URL::route('link_details',array('slug1' => getBrandSlug($single->brand_id), 'slug2' => $single->slug ))}}"><i
                                                    class="fa fa-google-plus"></i></a></span>

                                </div>

                            @endif

                        </div>

                    </div>

                    <br/>

                    <div class="brandoffer_list dashboard_events">
                        <div class="dashboard_linksinfo">

                            @foreach($links as $link)

                                @include('brands.partial.link')

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="notice_feed_info">
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

@stop

@section('js')

    {{ HTML::script('assets/js/notescript.js') }}
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
