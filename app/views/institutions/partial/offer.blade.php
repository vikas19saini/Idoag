<li>
    @if(Sentry::check())

        <div class="brandoffer_img"><a
                    href="{{ URL::route('inst_offer_details',array('slug1' => getInstitutionSlug($offer->institution_id), 'slug2' => $offer->slug ))}}">

                {{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}}

            </a>
            @if($offer->web_only == '1')
                <div class="newtxt_info">
                    <div class="new_txt"><a href="#">Online<br/>Only</a></div>
                </div>
            @endif

            <div class="brandoffer_cont share_like_cont">
                <div class="share_like_info">
                    <p>{{ HTML::image("assets/images/view_icon1.png") }} {{getPostInfoCount($offer->id, 'visits')}}</p>

                    <p><span class="likeicon @if(checkLikes($offer->id)) active  @endif" id="{{$offer->id}}"></span> <b
                                class="id_{{$offer->id}}">{{getPostInfoCount($offer->id, 'likes')}}</b></p>

                    <p>@include('partials.share') </p>


                </div>
                <h6>
                    <a href="{{ URL::route('inst_offer_details',array('slug1' => getInstitutionSlug($offer->institution_id), 'slug2' => $offer->slug ))}}">{{$offer->name}}</a>
                </h6>

                <div class="brandoffer_continner dashboardeventcnt_continner">

                    <div class="brandoffer_continner dashboardeventcnt_continner">
                        <p>{{ShortenText($offer->description,100)}}</p>

                    </div>
                    <div class="edit_remove_logo">
                        @if(isset($brand) && $loggedin_user->institution_id == $brand->id)
                            <span> <a href="" data-toggle="modal" data-target="#myModal{{$offer->id}}">
                                    <span data-toggle="tooltip" data-placement="bottom" title="Delete">
                                    {{ HTML::image('assets/images/remove_icon.png')}}</span></a>
        <div class="modal fade" id="myModal{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Are you sure to delete?</h4>
                    </div>
                    <div class="modal-footer">
                        {{ Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $offer->id]]) }}
                        {{ Form::submit('Yes', ['class' => 'btn btn-danger']) }}
                        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                        {{  Form::close() }}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  <a href="{{ URL::route('update_inst_offers',array('slug1' => getInstitutionSlug($offer->institution_id), 'slug2' => $offer->slug ))}}"
                   data-toggle="tooltip" data-placement="bottom"
                   title="Edit">{{ HTML::image("assets/images/edit_icon.png") }}</a></span>
                        @endif
                        <span class="brand_logo"> {{ HTML::image(getImage('uploads/institutions/',getInstitutionLogo($offer->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}} </span>
                    </div>
                </div>

            </div>

            @else

                <div class="brandoffer_img"><a href="#" data-toggle="modal"  data-target="#login_required" > {{ HTML::image(getImage('uploads/photos/',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}} </a>
                    @if($offer->offer_type == 'parttime')
                        <div class="newtxt_info">
                            <div class="new_txt"><a href="#">Online<br/>Only</a></div>
                        </div>
                    @endif
                    <div class="brandoffer_cont share_like_cont">
                        <div class="share_like_info">

                            <div class="share_like_txt">
                                <p>{{ HTML::image("assets/images/view_icon1.png") }} {{getPostInfoCount($offer->id, 'visits')}}</p>

                                <p><span class="likeicon"></span> <b
                                            class="id_{{$offer->id}}">{{getPostInfoCount($offer->id, 'likes')}}</b></p>

                                <p> @include('partials.share')</p>

                            </div>
                        </div>
                        <h6><a href="#" data-toggle="modal"  data-target="#login_required" >{{$offer->name}}</a></h6>

                        <div class="brandoffer_continner dashboardeventcnt_continner">

                            <div class="brandoffer_continner dashboardeventcnt_continner">
                                <p>{{ShortenText($offer->description,100)}}</p>

                            </div>
                            <div class="edit_remove_logo"><span
                                        class="brand_logo"> {{ HTML::image(getImage('uploads/','179_179_'.getInstitutionLogo($offer->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}} </span>
                            </div>

                        </div>


                    </div>

                </div>
    @endif
</li>
