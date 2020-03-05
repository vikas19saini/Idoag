@if(isset($loggedin_user) && $loggedin_user->brand_id != $event->brand_id &&  $event->start_date> date('Y-m-d'))

@else

<li  @if($event->end_date <= date('Y-m-d')) class="disable" @endif>

    <div class="brandoffer_img"><a @if(Sentry::check())
            href="{{ URL::route('event_details',array('slug1' => getBrandSlug($event->brand_id), 'slug2' => $event->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>  {{ HTML::image(getImage('uploads/photos/M_',$event->image,'noimage.jpg'),'',['class'=>'brand_img'])}}
            @if($event->end_date <= date('Y-m-d'))
                <div class="disablebgclr">
                    <h6>EVENT EXPIRED</h6>
                </div>
            @endif
        </a>

        <div class="brandoffer_imgcont">


            <div class="share_like_txt">
                <p><i class="fa fa-eye"></i> {{getPostInfoCount($event->id, 'visits')}}</p>

                <p><i class="fa likeicons @if(checkLikes($event->id)) fa-heart @else fa-heart-o @endif"
                      id="{{$event->id}}"></i> <b
                            class="id_{{$event->id}}">{{getPostInfoCount($event->id, 'likes')}}</b></p>

                <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                @if(Sentry::check())
                    <div class="addthis_sharing_toolbox">

                         <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$event->image}}','{{$event->short_description}}','{{$event->name}}','{{ URL::route('event_details',array('event' => getBrandSlug($event->brand_id), 'slug2' => $event->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a
                                    href="https://twitter.com/home?status={{$event->name}} - {{ URL::route('get_events',array('slug1' => getBrandSlug($event->brand_id)))}} via idoagcard"
                                    target="_blank"><i class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a
                                    href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_events',array('slug1' => getBrandSlug($event->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$event->image}}&description={{ $event->name }} "
                                    target="_blank"><i class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a
                                    href="https://plus.google.com/share?url={{ URL::route('get_events',array('slug1' => getBrandSlug($event->brand_id)))}}"
                                    target="_blank"><i class="fa fa-google-plus"></i></a></span>

                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="brandoffer_cont">
        <div>

            <div class="event_timelocation">
                <p> {{ HTML::image('assets/images/clock_icon.png')}} {{ dateformat2($event->start_date)  }} @if($event->end_date!='' && $event->start_date!=$event->end_date) to {{ dateformat2($event->end_date)  }} @endif</p>

                <p> {{ HTML::image('assets/images/location_icon.png')}}  {{getState($event->city).', '.getCity($event->state)}}</p>
            </div>
            <div class="brandoffer_continner dashboardeventcnt_continner">
<div class="brandoffer_conttxt">
    <h5><a @if(Sentry::check())
            href="{{ URL::route('event_details',array('slug1' => getBrandSlug($event->brand_id), 'slug2' => $event->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{$event->name}}</a>
    </h5>
                <p> {{ShortenText($event->short_description,120)}}</p>
</div>

                <div class="brandoffer_conticon">
                    {{ HTML::image(getImage('uploads/brands/',getBrandLogo($event->brand_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</div>
            </div>

            @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $event->brand_id)
                <div class="edit_remove_logo">
                    <span>

                                <span data-form="#frmDelete-{{$event->id}}"
                                      data-url="{{route('posts.destroy', array($event->id))}}" data-title="Delete Event"
                                      data-message="Are you sure you want to delete this event ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"> <i class="fa fa-trash-o"></i></a>
                                </span>
                        {{ Form::open(array(
                                'url' => route('posts.destroy', array($event->id)),
                                'method' => 'delete',
                                'style' => 'display:none',
                                'id' => 'frmDelete-' . $event->id
                            ))
                        }}
                        {{ Form::submit('Submit') }}
                        {{ Form::close() }}

                        <a href="{{ URL::route('update_events',array('slug1' => getBrandSlug($event->brand_id), 'slug2' => $event->slug ))}}"
                           data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                    class="fa fa-pencil"></i></a>


                </span></div> @endif

        </div>
    </div>
</li>

@endif