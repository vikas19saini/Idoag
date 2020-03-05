
<div class="container_info">

    <div class="brandicon_info" style="background-image:url(/{{getImage('uploads/instcover/',$institution->coverimage,'noimage.jpg')}})">


        <div class="brandicon_list instuctionbrandlogo_list">

            @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)

                <div class="profile_img brandicon_img instuctionbrandlogo_img">

                    <div class="brand_logo_thmb">

                        {{ HTML::image(getImage('uploads/institutions/',$institution->image,'noimage.jpg'), '', ['class' => 'slider-img']) }}

                    </div>

                </div>

                <div class="follow_txt"> {{(IsUserFollowInstitution($institution->id)?'Following':'Follow')}}</div>

                <div class="follow_txtlist"> + {{getInstitutionFollowCount($institution->id)}}  </div>

            @else

                <div class="profile_img brandicon_img instuctionbrandlogo_img">

                    <div class="brand_logo_thmb">

                        {{ HTML::image(getImage('uploads/institutions/',$institution->image,'noimage.jpg'), '', ['class' => 'slider-img']) }}

                    </div>

                </div>

                <div class="follow_txt">

                    <a href="javascript:void(0);" @if(isset($loggedin_user)) class="follow_institution id_{{$institution->id}}" id="{{$institution->id}}" @else data-toggle="modal" data-target="#login_required" class="login_btnpop"  @endif>{{(IsUserFollowInstitution($institution->id)?'Following':'Follow')}} </a>

                </div>

                <div class="follow_txtlist"> + {{getInstitutionFollowCount($institution->id)}}  </div>

            @endif

        </div>

    </div>

{{--<div class="brandicon_info"--}}
     {{--style="background:url(/{{getImage('uploads/instcover/',$institution->coverimage,'noimage.jpg')}})">--}}

    {{--<div class="container_info">--}}

        {{--<div class="brandicon_list instuctionbrandlogo_list">--}}

            {{--<div class="profile_img brandicon_img instuctionbrandlogo_img">--}}

                {{--{{ Form::open(array('class' => 'profile_picture', "files" => true)) }}--}}
                {{--{{ Form::file('image', array('class' => 'hidden', 'id'=>'profile-image-upload', 'name' => 'profile_image')) }}--}}
                {{--{{ Form::close() }}--}}

                {{--<div class="brand_logo_thmb  @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id) ins_img @endif">--}}
                    {{--{{ HTML::image(getImage('uploads/institutions/',$institution->image,'noimage.jpg'), '', ['class' => 'slider-img']) }} </div>--}}

            {{--</div>--}}

            {{--<div class="follow_txt"><a href="javascript:void(0);" @if(isset($loggedin_user))--}}
                                       {{--class="follow_institution id_{{$institution->id}}"--}}
                                       {{--id="{{$institution->id}}" @endif>{{(IsUserFollowInstitution($institution->id)?'Following':'Follow')}} </a>--}}
            {{--</div>--}}

            {{--<div class="follow_txtlist"> + {{getInstitutionFollowCount($institution->id)}}  </div>--}}

        {{--</div>--}}

    {{--</div>--}}

{{--</div>--}}

<div class="nav_info2">

    <div class="container_info">

        <h4>{{ Str::upper($institution->name) }}</h4>

        <ul>

            <li class="{{ setActive('institution_profile') }}">

                <a href="{{URL::route('institution_profile',$institution->slug)}}">UPDATES</a>

            </li>

            <li class="{{ setActive('get_inst_events') }}">

                <a href="{{URL::route('get_inst_events',$institution->slug)}}">EVENTS</a>

            </li>

            {{--<li class="{{ setActive('get_inst_offers') }}">--}}

            {{--<a href="{{URL::route('get_inst_offers',$institution->slug)}}">OFFERS</a>--}}

            {{--</li>--}}

            {{--<li class="{{ setActive('get_inst_internships') }}">--}}

            {{--<a href="{{URL::route('get_inst_internships',$institution->slug)}}">INTERNSHIPS</a>--}}

            {{--</li>--}}

            <li class="{{ setActive('get_inst_photos')}}">


                <a href="{{URL::route('get_inst_photos',$institution->slug)}}">PHOTOS</a>

            </li>

            <li class="{{ setActive('get_inst_links') }}">

            <a href="{{URL::route('get_inst_links',$institution->slug)}}">TEXT</a>

            </li>
            <li class="{{ setActive('get_members')}}">

                <a href="{{URL::route('get_members',$institution->slug)}}">MEMBERS</a>

            </li>
            @if(isset($loggedin_user) && $loggedin_user->institution_id == $institution->id)
                <li class="{{ setActive('get_inst_feedback')}}">

                    <a href="{{URL::route('get_inst_feedback',$institution->slug)}}">FEEDBACKS</a>

                </li>
                <li class="{{ setActive('institution_followers')}}">

                    <a href="{{URL::route('institution_followers',$institution->slug)}}">FOLLOWERS</a>

                </li>
                @if(Route::currentRouteName()=='institution_profile')
                    <li><a href="javascript:void(0);" onclick="javascript:introJs().start();">Help</a></li>
                @endif
            @endif
        </ul>


    </div>

</div>
    </div>
{{Form::hidden('institutionid',$institution->id,['id' => 'institutionid'])}}
@if(isset($loggedin_user))
    {{Form::hidden('userid',$loggedin_user->id,['id' => 'userid'])}}
@endif
@include('partials.flash')