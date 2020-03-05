@extends('layouts.default')

@section('title','Internship - '.$single->name.' from  |idoag.com')

@section('metatags')
    <meta name="keywords"
          content="Activity log -  view all the availed offers, applied internships, events |idoag.com"/>
    <meta name="description"
          content="Activity log -  view all the availed offers, applied internships, events |idoag.com"/>

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
                    <div class="brandoffer_listtop">
                        <div class="brandoffer_listtopimg">
                            {{ HTML::image(getImage('uploads/photos/',$single->image,'noimage.jpg'),'',['class'=>'brandsoffer_img'])}}

                            <div class="note_img2">{{ HTML::image('assets/images/note_img4.png')}} </div>

                            <!-- <div class="brandoffer_imgcont">
                              
                                <div class="share_like_txt">
                                    
                                    <p><i class="fa fa-eye"></i> {{getPostInfoCount($single->id, 'visits')}}</p>
                                    
                                    <p> <i class="fa likeicons @if(checkLikes($single->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$single->id}}" @endif></i>
                                    
                                        <b class="id_{{$single->id}}">{{getPostInfoCount($single->id, 'likes')}}</b> 

                                    </p>
                                    
                                    <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                                    
                                    <div class="addthis_sharing_toolbox"> 
                                        <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$single->image}}','{{$single->short_description}}','{{$single->name}}','{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($single->institution_id), 'slug2' => $single->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                        <span class="share_tw"><a href="https://twitter.com/home?status={{$single->name}} - {{ URL::route('get_inst_events',array('slug1' => getInstitutionSlug($single->institution_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                        <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_inst_events',array('slug1' => getInstitutionSlug($single->institution_id)))}}&media=http://idoag.com/uploads/photos/M_{{$single->image}}&description={{ $single->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                        <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_inst_events',array('slug1' => getInstitutionSlug($single->institution_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span> 
                                    </div>

                                </div>

                            </div> --> 
                            
                        </div>
                        <div class="brandoffer_listtopcont">
                            <h4>Regional Sales & Marketing Trainee</h4>

                            <div class="marketingtrainee_info">
                                <div class="marketingtrainee_left">
                                    <ul>
                                        <li>
                                            <p>Category</p>
                                            <h6>{{$single->category}}</h6>
                                        </li>
                                        <li>
                                            <p>Skills Required</p>
                                            <h6>{{$single->skills}}</h6>
                                        </li>
                                        <li>
                                            <p>Location</p>
                                            <h6>{{getCity($single->city)}}, {{getState($single->state)}}, India</h6>
                                        </li>
                                        <li>
                                            <p>Timeframe</p>
                                            <h6>{{$single->start_date}} to {{$single->end_date}}</h6>
                                        </li>
                                        <li>
                                            <p>Number of Positions</p>
                                            <h6>{{$single->positions}}</h6>
                                        </li>
                                        <li>
                                            <p>Stipend</p>
                                            <h6>@if($single->stipend==1)
                                                    Yes - Rs.{{$single->amount}} per month
                                                @else
                                                    No
                                                @endif</h6>
                                        </li>
                                        @if($single->contact_info!='')
                                            <li>
                                                <p>Contact Info</p>
                                                <h6>
                                                    {{$single->contact_info}}
                                                </h6>
                                            </li>@endif
                                    </ul>
                                    @if($user_group == 'Students')
                                        <a href="{{ URL::route('apply_internship',array('slug1' => $brand->slug, 'slug2' => $single->slug))}}"
                                           class="applynow_btn">Apply Now!</a>
                                    @endif
                                </div>
                                <div class="marketingtrainee_right">
                                    {{$single->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brandoffer_list newoffer_list">
                        <ul>

                            @foreach($internships as $internship)
                                @if($internship->id != $single->id)
                                    @include('brands.partial.internship')
                                @endif

                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @if($user_group=='Students')

                        <div class="notice_feed_list">
                            <h3> Notes / Feedback</h3>

                            <div class="notice_feed_listinner">
                                <ul>

                                    @foreach($notes as $note)

                                        @if($note->replymessage)

                                            <li>
                                                <div class="notice_feed_listinnerimg"> {{ HTML::image('uploads/profiles/'.getUserPicture($note->user_id)) }} </div>
                                                <div class="notice_feed_listinnercont">
                                                    <h6>{{$note->name}}</h6>

                                                    <p>{{$note->message}}</p>
                                                    <ul>
                                                        <li>
                                                            <div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div>
                                                            <div class="notice_feed_listinnercont">
                                                                <h6>{{getBrandName($brand->id)}}</h6>

                                                                <p>{{$note->replymessage}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        @endif

                                    @endforeach
                                </ul>
                                <div class="sendyourownnote_info">

                                    {{ Form::open(array('id' => 'notesform')) }}

                                    {{ Form::text('notes', null, ['id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}

                                    {{ Form::submit('Send Note') }}

                                    {{ Form::close() }}


                                </div>
                            </div>
                        </div>
                    @endif
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
