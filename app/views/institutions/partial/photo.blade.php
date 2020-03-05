<li>

    <div class="brandoffer_img">

        <a   @if(Sentry::check())
            href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>  {{ HTML::image(getImage('uploads/photos/M_',$photo->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</a>

        <div class="brandoffer_imgcont">

            <h5><a @if(Sentry::check())
                    href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}"
                    @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{$photo->name}}</a>
            </h5>

            <div class="share_like_txt">

                <p>{{ HTML::image("assets/images/view_icon.png") }} {{getPostInfoCount($photo->id, 'visits')}}</p>

                <p><span class="likeicon @if(checkLikes($photo->id)) active  @endif" id="{{$photo->id}}"></span> <b
                            class="id_{{$photo->id}}">{{getPostInfoCount($photo->id, 'likes')}}</b></p>

                <p><a class="share_social"> {{ HTML::image("assets/images/share_icon.png") }} Share </a></p>
                @if(Sentry::check())
                    <div class="addthis_sharing_toolbox">

                        <span class="share_fb"><a
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}"><i
                                        class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a
                                    href="https://twitter.com/home?status={{$photo->name}} - {{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}} via idoagcard"><i
                                        class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a
                                    href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$photo->image}}&description={{ $photo->name }} "><i
                                        class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a
                                    href="https://plus.google.com/share?url={{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}"><i
                                        class="fa fa-google-plus"></i></a></span>

                    </div>
                @endif

            </div>
        </div>

    </div>

    <div class="brandoffer_cont">

        <div class="brandoffer_continner">

            <p> {{ShortenText($photo->description,100)}}</p>

            <div class="brandoffer_conticon">   {{ HTML::image(getImage('uploads/institutions/',getInstitutionLogo($photo->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</div>

        </div>



        @if(isset($loggedin_user) && isset($institution) && $loggedin_user->institution_id == $institution->id)
            <div class="edit_remove_logo">
                <span>
                       <span data-form="#frmDelete-{{$photo->id}}" data-title="Delete Photo"
                             data-message="Are you sure you want to delete this photo ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"> {{ HTML::image('assets/images/remove_icon.png')}}</a>
                                </span>
                    {{ Form::open(array(
                            'url' => route('inst_posts.destroy', array($photo->id)),
                            'method' => 'delete',
                            'style' => 'display:none',
                            'id' => 'frmDelete-' . $photo->id
                        ))
                    }}
                    {{ Form::submit('Submit') }}
                    {{ Form::close() }}

                    <a href="{{ URL::route('update_inst_photos',array('slug1' => getInstitutionSlug($photo->institution_id), 'slug2' => $photo->slug ))}}"
                       data-toggle="tooltip" data-placement="bottom"
                       title="Edit">{{ HTML::image("assets/images/edit_icon.png") }}</a>

                </span></div>
        @endif
    </div>
</li>
