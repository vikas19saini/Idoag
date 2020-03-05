<li>

    <div class="brandoffer_img">
        <b class="hide">{{ URL::route('get_photos',array('slug1' => getBrandSlug($photo->brand_id)))}}</b>


        <a  @if(Sentry::check())
            href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($photo->brand_id), 'slug2' => $photo->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{ HTML::image(getImage('uploads/photos/M_',$photo->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</a>

        <div class="brandoffer_imgcont">

            <h5>
                <a @if(Sentry::check())href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($photo->brand_id), 'slug2' => $photo->slug ))}}"
                   @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{$photo->name}}</a></h5>

            <div class="share_like_txt">

                <p><i class="fa fa-eye"></i> {{getPostInfoCount($photo->id, 'visits')}}</p>

                <p><i class="fa likeicons @if(checkLikes($photo->id)) fa-heart @else fa-heart-o @endif"
                      id="{{$photo->id}}"></i> <b
                            class="id_{{$photo->id}}">{{getPostInfoCount($photo->id, 'likes')}}</b></p>

                <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                @if(Sentry::check())
                    <div class="addthis_sharing_toolbox">

                         <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$photo->image}}','{{$photo->short_description}}','{{$photo->name}}','{{ URL::route('photo_details',array('slug1' => getBrandSlug($photo->brand_id), 'slug2' => $photo->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a
                                    href="https://twitter.com/home?status={{$photo->name}} - {{ URL::route('get_photos',array('slug1' => getBrandSlug($photo->brand_id)))}} via idoagcard"
                                    target="_blank"><i class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a
                                    href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_photos',array('slug1' => getBrandSlug($photo->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$photo->image}}&description={{ $photo->name }} "
                                    target="_blank"><i class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a
                                    href="https://plus.google.com/share?url={{ URL::route('get_photos',array('slug1' => getBrandSlug($photo->brand_id)))}}"
                                    target="_blank"><i class="fa fa-google-plus"></i></a></span>

                    </div>

                @endif

            </div>
        </div>

    </div>

    <div class="brandoffer_cont">

        <div class="brandoffer_continner">
<div class="brandoffer_conttxt">
            <p> {{ShortenText($photo->description,100)}}</p>
</div>

            <div class="brandoffer_conticon">  {{ HTML::image(getImage('uploads/brands/',getBrandLogo($photo->brand_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</div>

        </div>


            @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $photo->brand_id)
            <div class="edit_remove_logo">

                <span> 
                     <span data-form="#frmDelete-{{$photo->id}}" data-title="Delete Photo"
                           data-message="Are you sure you want to delete this Photo ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"><i class="fa fa-trash-o"></i></a>
                                </span>
                    {{ Form::open(array(
                            'url' => route('posts.destroy', array($photo->id)),
                            'method' => 'delete',
                            'style' => 'display:none',
                            'id' => 'frmDelete-' . $photo->id
                        ))
                    }}
                    {{ Form::submit('Submit') }}
                    {{ Form::close() }}

                    <a href="{{ URL::route('update_photos',array('slug1' => getBrandSlug($photo->brand_id), 'slug2' => $photo->slug ))}}"
                       data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                
                </span>
            </div>

            @endif


    </div>


</li>
