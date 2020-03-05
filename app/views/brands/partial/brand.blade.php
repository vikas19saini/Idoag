<li>

    <div class="brandoffer_img">
        <a href="{{URL::route('brand_profile',array($brand->slug))}}">
            <div class="brand_logo">
                {{   HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'brand_img'])}} </div>
            <div class="mybrandslider_listcont clearfix">
                <div class="brandname">{{$brand->name}}</div>
                <div class="brandlike">{{ HTML::image('assets/images/like4_icon.png')}} <span class="id_{{$brand->id}}">+{{getBrandFollowsCount($brand->id)}}</span>
                </div>
            </div>
            <div class="brandoffer_imgcont">
                <h5>{{$brand->name}}</h5>

                <p>{{ ShortenText($brand->description,60)}}</p>

                <div class="share_like_txt">
                    <p>{{ HTML::image('assets/images/like3_icon.png')}} <span
                                class="id_{{$brand->id}}">{{getBrandFollowsCount($brand->id)}} </span> followers</p>

                    <p>{{ HTML::image('assets/images/offer_icon.png')}} {{getBrandInfoCount($brand->id,'offer')}}
                        Offers</p>

                    <p>{{ HTML::image('assets/images/internships_icon.png')}} {{getBrandInfoCount($brand->id,'internship')}}
                        Internships</p>
                </div>
            </div>
        </a>
    </div>


    <div class="brandoffer_follow brandoffer_follow2 id_{{$brand->id}}" id="{{$brand->id}}"><a
                href="javascript:void(0);" @if(!Sentry::check()) data-toggle="modal" data-target="#login_required" class="login_btnpop"  @endif>@if(IsUserFollowBrand($brand->id))FOLLOWING @else FOLLOW @endif</a>
    </div>
</li>
                                