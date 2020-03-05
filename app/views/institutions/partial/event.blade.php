<li  @if($event->end_date <= date('Y-m-d')) class="disable" @endif>
    <div class="brandoffer_img"><a
                @if(Sentry::check())href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>  {{ HTML::image(getImage('uploads/photos/M_',$event->image,'noimage.jpg'),'',['class'=>'brand_img'])}}
            @if($event->end_date <= date('Y-m-d'))
                <div class="disablebgclr">
                    <h6>EVENT EXPIRED</h6>
                </div>
            @endif
        </a>

        <div class="brandoffer_imgcont">
            <h5><a @if(Sentry::check())
                    href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}"
                    @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{$event->name}}</a>
            </h5>

            <div class="share_like_txt">
                <p>{{ HTML::image("assets/images/view_icon.png") }} {{getPostInfoCount($event->id, 'visits')}}</p>

                <p><span class="likeicon @if(checkLikes($event->id)) active  @endif" id="{{$event->id}}"></span> <b
                            class="id_{{$event->id}}">{{getPostInfoCount($event->id, 'likes')}}</b></p>

                <p><a class="share_social"> {{ HTML::image("assets/images/share_icon.png") }} Share </a></p>
                @if(Sentry::check())
                    <div class="addthis_sharing_toolbox">

                        <span class="share_fb"><a
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}"><i
                                        class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a
                                    href="https://twitter.com/home?status={{$event->name}} - {{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}} via idoagcard"><i
                                        class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a
                                    href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$event->image}}&description={{ $event->name }} "><i
                                        class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a
                                    href="https://plus.google.com/share?url={{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}"><i
                                        class="fa fa-google-plus"></i></a></span>

                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="brandoffer_cont">
        <div class="brandoffer_continner">
            <div class="event_timelocation">
                <p> {{ HTML::image('assets/images/clock_icon.png')}} {{ date("d M, Y", strtotime($event->start_date))  }}  </p>

                <p> {{ HTML::image('assets/images/location_icon.png')}}  {{getCity($event->city)}}</p>
            </div>
            <div class="brandoffer_continner dashboardeventcnt_continner">
                <p> {{ShortenText($event->short_description,120)}}</p>

                <div class="brandoffer_conticon">
                    {{ HTML::image(getImage('uploads/institutions/',getInstitutionLogo($event->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</div>
            </div>

            @if(isset($institution) && isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)
                <div class="edit_remove_logo">
                        <span>
                              <span data-form="#frmDelete-{{$event->id}}" data-title="Delete Event"
                                    data-message="Are you sure you want to delete this event ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"> {{ HTML::image('assets/images/remove_icon.png')}}</a>
                                </span>
                            {{ Form::open(array(
                                    'url' => route('inst_posts.destroy', array($event->id)),
                                    'method' => 'delete',
                                    'style' => 'display:none',
                                    'id' => 'frmDelete-' . $event->id
                                ))
                            }}
                            {{ Form::submit('Submit') }}
                            {{ Form::close() }}

                            <a href="{{ URL::route('update_inst_events',array('slug1' => getInstitutionSlug($event->institution_id), 'slug2' => $event->slug ))}}">{{ HTML::image("assets/images/edit_icon.png") }}</a></span>
                </div>         @endif
        </div>

    </div>

</li>