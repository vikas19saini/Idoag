<div class="col-md-4 col-sm-6 col-xs-12 newinternship_list">
    @if($internship->end_date < date('Y-m-d'))
    <a @if(Sentry::check())
        href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
        @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>
        @endif
    <div class="newinternship_inner">
        @if($internship->end_date < date('Y-m-d'))
            <div class="disablebgclr">
                <h6>INTERNSHIP EXPIRED</h6>
            </div>
        @endif
            @if($internship->offer_type == 'parttime')
                <div class="newtxt_info">
                    <div class="new_txt2"><span>Part<br/>time</span></div>
                </div>
            @endif
            @if($internship->offer_type == 'virtual')
                <div class="newtxt_info">
                    <div class="new_txt3"><span>Virtual</span></div>
                </div>
            @endif
        <h4> @if($internship->end_date < date('Y-m-d'))
                {{ShortenText($internship->name,30)}}
                 @else
            <a @if(Sentry::check())
                href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{ShortenText($internship->name,30)}}</a>
        @endif</h4>
        <div class="newinternship_txt">
            <span> {{ HTML::image(getImage('uploads/brands/',getBrandLogo($internship->brand_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</span>
            <p>{{ShortenText($internship->short_description,60)}}</p>
        </div>
        <ul>
            <li><span>Cat:  <i class="thinclr">{{getInternshipCatNameBySlug($internship->category)}}</i></span><span>Resume:  <i class="thinclr">@if($internship->resume_preference){{getFirstWord($internship->resume_preference)}}@endif</i></span></li>

            <li><span>Start:  <i class="thinclr">{{dateformat($internship->start_date)}}</i></span><span>End:  <i class="thinclr">{{dateformat($internship->end_date)}}</i></span></li>
         </ul>
        <div class="stipend_row"><span>Stipend:  @if($internship->amount!=0)
                        <i class="redclr">Rs.{{$internship->amount}} </i><br/>
                        <small>Per Month</small>
                                                     @else Nil
                    @endif</span><span><i class="fa fa-map-marker"></i>{{$internship->city}}</span>        </div>
            @if(Sentry::check() && $user_group == 'Students')
                @if(IsUserApplied($internship->id))
                   <p class="alreadyppl_txt">Already Applied this Internship.</p>
                @else
                    <div class="intership_aplybtn">
                        @if($internship->application_date < date('Y-m-d'))
                            <p class="alreadyppl_txt">Internship Expired.</p>
                            @else
                    <a href="{{ URL::route('apply_internship',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug))}}"
                       >Apply Now!</a>
                    @endif
                    </div>
                @endif
            @endif





</div>
 @if($internship->end_date < date('Y-m-d'))
        </a>
        @endif

<div class="internship_sharenew @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $internship->brand_id) internship_sharefull @endif">

    <div class="applyicons_row row share_like_txt">
        <p><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Visits"></i> {{getPostInfoCount($internship->id, 'visits')}}</p>

        <p><i class="fa likeicons @if(checkLikes($internship->id)) fa-heart @else fa-heart-o @endif" data-toggle="tooltip" data-placement="top" title="Likes"
              id="{{$internship->id}}"></i> <b
                    class="id_{{$internship->id}}">{{getPostInfoCount($internship->id, 'likes')}}</b></p>
        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $internship->brand_id)

            <p><a href="{{ URL::route('internships_applied_post',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}" data-toggle="tooltip" data-placement="top" title="Received Applications"><i class="fa fa-user"></i>  {{getInternshipAppliedCount($internship->id)}}</a></p>
        @else
            <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
        @endif
        @if(Sentry::check())
            <div class="addthis_sharing_toolbox">

                <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$internship->image}}','{{$internship->short_description}}','{{$internship->name}}','{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a
                                    href="https://twitter.com/home?status={{$internship->name}} - {{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}} via idoagcard"
                                    target="_blank"><i class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a
                                    href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$internship->image}}&description={{ $internship->name }} "
                                    target="_blank"><i class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a
                                    href="https://plus.google.com/share?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}}"
                                    target="_blank"><i class="fa fa-google-plus"></i></a></span>

            </div>
        @endif
    </div>

    @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $internship->brand_id)
        <div class="edit_remove_logo newedit_remove_logo">


                   <span><i class="fa statuspost @if($internship->status==1) activestatus @else inactivestatus @endif"
                                 data_id="{{$internship->id}}" id="post_{{$internship->id}}"  data-toggle="tooltip" data-placement="top" title="@if($internship->status==1) Active @else Inactive @endif"></i>
                   </span>


                        <a href="{{ URL::route('update_internships',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                           data-toggle="tooltip" data-placement="top" title="Edit"><i
                                    class="fa fa-pencil"></i></a>

         </div>
    @endif
</div>
</div> 