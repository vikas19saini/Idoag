
<div class="container_info">

    <div class="brandicon_info" style="background-image:url(/{{getImage('uploads/brandcover/',$brand->coverimage,'noimage.jpg')}})">


        <div class="brandicon_list instuctionbrandlogo_list">

            @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                <div class="profile_img brandicon_img instuctionbrandlogo_img">

                        <div class="brand_logo_thmb">

                            {{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'), '', ['class' => 'slider-img']) }}

                        </div>

                </div>

                <div class="follow_txt"> {{(IsUserFollowBrand($brand->id)?'Following':'Follow')}}</div>

                <div class="follow_txtlist"> + {{getBrandFollowCount($brand->id)}}  </div>

            @else

                <div class="profile_img brandicon_img instuctionbrandlogo_img">

                    <div class="brand_logo_thmb">

                        {{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'), '', ['class' => 'slider-img']) }} 

                    </div>

                </div>

                <div class="follow_txt">

                    <a href="javascript:void(0);" @if(isset($loggedin_user)) class="follow_brand id_{{$brand->id}}" id="{{$brand->id}}" @else data-toggle="modal" data-target="#login_required" class="login_btnpop"  @endif>{{(IsUserFollowBrand($brand->id)?'Following':'Follow')}} </a>
                
                </div>

                <div class="follow_txtlist"> + {{getBrandFollowCount($brand->id)}}  </div>

            @endif

        </div>

    </div>
    <div class="nav_info2">

        <div class="container_info">

            <h4><a href="{{URL::route('brand_profile',$brand->slug)}}">{{ Str::upper($brand->name) }}</a></h4>

            <ul data-step="3"
                data-intro="Check updates, offers, Intersnships, Events, Text, Photos, Outlets, Feedbacks and Followers"
                data-position='left'>
                <li class="{{ setActive('brand_profile') }}">
                    <a href="{{URL::route('brand_profile',$brand->slug)}}">UPDATES</a>
                </li>

                <li class="{{ setActive2(['get_offers','offer_details','create_offers','update_offers']) }}">
                    <a href="{{URL::route('get_offers',$brand->slug)}}">OFFERS</a>
                </li>

                <!--<li class="{{ setActive2(['get_internships','internship_details','create_internships','update_internships']) }}">
                    <a href="{{URL::route('get_internships',$brand->slug)}}">INTERNSHIPS  @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id && $brand_received_internships>0)<span class="red"><sup> {{$brand_received_internships}}</sup></span>@endif</a>

                </li>-->

                <!--<li class="{{ setActive2(['get_events','event_details','create_events','update_events']) }}">
                    <a href="{{URL::route('get_events',$brand->slug)}}">EVENTS</a>
                </li>-->

                <!--<li class="{{ setActive2(['get_text','link_details','create_text','update_text']) }}">
                    <a href="{{URL::route('get_text',$brand->slug)}}">TEXT</a>
                </li>-->

                <!--<li class="{{ setActive2(['get_photos','photo_details','create_photos','update_photos'])}}">
                    <a href="{{URL::route('get_photos',$brand->slug)}}">PHOTOS</a>
                </li>-->
                @if(OutletsCount($brand->id) || (isset($loggedin_user) && $loggedin_user->brand_id == $brand->id))
                    <li class="{{ setActive2(['get_outlets','create_outlet','update_outlet'])}}">
                        <a href="{{URL::route('get_outlets',$brand->slug)}}">OUTLETS</a>
                    </li>
                @endif

                @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)
                    <li class="{{ setActive('get_feedback')}}">
                        <a href="{{URL::route('get_feedback',$brand->slug)}}">FEEDBACK</a>
                    </li>

                    <li class="{{ setActive('brand_followers')}}">
                        <a href="{{URL::route('brand_followers',$brand->slug)}}">FOLLOWERS</a>
                    </li>
                    @if(Route::currentRouteName()=='brand_profile')
                        <li><a href="javascript:void(0);" onclick="introJs().start();" class="help_intro">Help</a></li>
                    @endif
                @endif
            </ul>
        </div>

    </div>
</div>



{{Form::hidden('brandid',$brand->id,['id' => 'brandid'])}}
@if(isset($loggedin_user))
    {{Form::hidden('userid',$loggedin_user->id,['id' => 'userid'])}}
@endif

@include('partials.flash')