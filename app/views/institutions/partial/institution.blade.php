<li>

    <div class="brandoffer_img">
        <a href="{{URL::route('institution_profile',$institution->slug)}}">
            <div class="brand_logo">
                {{   HTML::image(getImage('uploads/institutions/',$institution->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</div>
            <div class="mybrandslider_listcont clearfix">
                <div class="brandname">{{$institution->name}}</div>
                <div class="brandlike">{{ HTML::image('assets/images/like4_icon.png')}} <span
                            class="id_{{$institution->id}}">+{{getInstitutionFollowsCount($institution->id)}}</span>
                </div>
            </div>
            <div class="brandoffer_imgcont">
                <h5>{{$institution->name}}</h5>

                <p>{{ ShortenText($institution->description,60)}}</p>

                <div class="share_like_txt">
                    <p>{{ HTML::image('assets/images/like3_icon.png')}} {{getInstitutionFollowsCount($institution->id)}}
                        followers</p>

                    <p>{{ HTML::image('assets/images/offer_icon.png')}} {{getInstitutionInfoCount($institution->id,'insevent')}}
                        Events</p>

                    <p>{{ HTML::image('assets/images/internships_icon.png')}} {{getInstitutionInfoCount($institution->id,'insphoto')}}
                        Photos</p>
                </div>
            </div>
        </a>
    </div>

    <div class="brandoffer_follow institution_follow2 id_{{$institution->id}}" id="{{$institution->id}}">
    
        <a href="javascript:void(0);" @if(!Sentry::check()) data-toggle="modal" data-target="#login_required" class="login_btnpop"  @endif>@if(IsUserFollowInstitution($institution->id))FOLLOWING @else FOLLOW @endif</a>
    
    </div>

</li>
