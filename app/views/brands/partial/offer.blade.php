@if(isset($loggedin_user) && $loggedin_user->brand_id != $offer->brand_id &&  $offer->start_date> date('Y-m-d'))

@else

    <li @if($offer->end_date < date('Y-m-d')) class="disable" @endif >

        <div class="brandoffer_img">

            <b class="hide">{{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}</b>

            @if(Sentry::check())

            <a  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">

            @else

            <a  href="#" data-toggle="modal" data-target="#login_required" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" class="login_btnpop">

            @endif

                {{ HTML::image(getImage('uploads/photos/M_',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}}

                @if($offer->web_only == '1')
                    <div class="newtxt_info">
                        <div class="new_txt"><span>Online<br/>Only</span></div>
                    </div>
                @endif

                @if($offer->end_date < date('Y-m-d'))
                    <div class="disablebgclr">
                        <h6>OFFER EXPIRED</h6>
                    </div>
                @endif

            </a>


            <div class="brandoffer_imgcont">

                <h5><a @if(Sentry::check())
                        href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}"
                        @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{--$offer->name--}}</a>
                </h5>

                <div class="share_like_txt">

                    <p><i class="fa fa-eye"></i> {{getPostInfoCount($offer->id, 'visits')}}</p>

                    <p>
                        <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$offer->id}}" @endif></i>

                        <b class="id_{{$offer->id}}">{{getPostInfoCount($offer->id, 'likes')}}</b>

                    </p>

                    <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>

                    @if(Sentry::check())

                        <div class="addthis_sharing_toolbox">

                            <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                            <span class="share_tw"><a
                                        href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}} via idoagcard"
                                        target="_blank"><i class="fa fa-twitter"></i></a></span>

                            <span class="share_pin"><a
                                        href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }} "
                                        target="_blank"><i class="fa fa-pinterest"></i></a></span>

                            <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        <div class="brandoffer_cont">
 
            <div class="brandoffer_continner">
            
            <div class="brandoffer_conttxt">
            
            @if($offer->offer_type == 'flat')

                <h6>{{ShortenText($offer->offer_value,25)}}</h6>

            @else

                <h6> {{$offer->offer_value .'% off'}}</h6>

            @endif  

                <p>{{ShortenText($offer->short_description,70)}}</p>
                </div>

                <div class="brandoffer_conticon">

                    {{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'',['class'=>'brand_img'])}}
                </div>



                    @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $offer->brand_id)
                    <div class="edit_remove_logo">
                        <span>

                        <span data-form="#frmDelete-{{$offer->id}}" data-title="Delete Offer"
                              data-message="Are you sure you want to delete this offer ?">
                                <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                   title="Delete"> <i class="fa fa-trash-o"></i></a>
                        </span>
                            {{ Form::open(array(
                                    'url' => route('posts.destroy', array($offer->id)),
                                    'method' => 'delete',
                                    'style' => 'display:none',
                                    'id' => 'frmDelete-' . $offer->id
                                ))
                            }}
                            {{ Form::submit('Submit') }}
                            {{ Form::close() }}

                            <a href="{{ URL::route('update_offers',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}"
                               data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                        class="fa fa-pencil"></i></a>
                    
                    </span>
                    </div>
                    @endif



            </div>

        </div>

    </li>
@endif

