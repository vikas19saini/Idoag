@extends('layouts.default')

@section('title', 'Idoag!  Photo Details - '.$single->name)

@section('css')


    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('institutions.partial.inner_nav')
        <div class="brandoffer_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="brandoffer_listtop">
                        <div class="brandoffer_listtopimg">
                            {{ HTML::image(getImage('uploads/photos/',$single->image,'noimage.jpg'),'',['class'=>'brand_img'])}}

                            <div class="note_img2">   {{ HTML::image("assets/images/note_img5.png") }} </div>

                            <div class="brandoffer_imgcont">
                              
                                <div class="share_like_txt">
                                    
                                    <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>
                                    
                                    <p> <i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$single->id}}" @endif></i>
                                    
                                        <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b> 

                                    </p>
                                    
                                    <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                                    
                                    <div class="addthis_sharing_toolbox"> 
                                        <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$single->image}}','{{$single->short_description}}','{{$single->name}}','{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($single->institution_id), 'slug2' => $single->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                        <span class="share_tw"><a href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('get_inst_photos',array('slug1' => getInstitutionSlug($single->institution_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                        <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_inst_photos',array('slug1' => getInstitutionSlug($single->institution_id)))}}&media=http://idoag.com/uploads/photos/M_{{$single->image}}&description={{ $single->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                        <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_inst_photos',array('slug1' => getInstitutionSlug($single->institution_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="brandoffer_listtopcont">
                            <h4>{{ $single->name}}</h4>
                            {{ $single->description }}
                        </div>
                    </div>
                    <div class="brandoffer_list newoffer_list">
                        <ul>
                            @foreach($photos as $photo)
                                @if($photo->id != $single->id)
                                    @include('institutions.partial.photo')
                                @endif

                            @endforeach
                        </ul>

                    </div>

                </div>
                <div class="notice_feed_info">
                    @include('institutions.partial.note')
                    @include('partials.ad')
                </div>
            </div>
        </div>


        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

        @stop

        @section('js')

            {{ HTML::script('assets/js/inst_notescript.js') }}

@stop
