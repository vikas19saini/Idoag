<div class="notice_feed_info internship_list">
    
    <div class="notice_feed_list">

        <h3>{{ HTML::image('assets/images/newstdnt_img18.png')}}<span>My Institute</span></h3>

        <div class="myinstitute_list"><a href="{{URL::route('institution_profile',getInstitutionSlug($student->institution_id))}}">  {{   HTML::image(getImage('uploads/institutions/',getInstitutionLogo($student->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</a>

            <!--   <div class="updates_txt"> 21 updates </div>-->

        </div>

    </div>

    @if(Route::currentRouteName()=='studentprofile')

        <div class="notice_feed_list"  data-step="3" data-intro="Profile Color" data-position='left'>

            <div class="profilescolor_info">

                <p>Your Profile’s Color is:<br>

                    <span>{{$student->color}}</span>

                </p>

                <ul>

                    <li>{{ HTML::image(getImage('uploads/profiles/',$user->profile_image,'noimage.jpg'), '', ['class' => 'slider-img', 'id' => 'show_image_preview'])}}</li>

                    <li> <a href="#"  data-toggle="modal" data-target="#users-color">{{ HTML::image('assets/images/color_img2.png')}}</a></li>

                </ul>

                <p>We found it out using the dominant color in your picture.</p>

            </div>

        </div>

    @endif

    @if(Route::currentRouteName()=='student_internships')

        <div class="notice_feed_list">
            <h3>{{ HTML::image('assets/images/noteheart_img17.png')}} <span>Recent Updates</span></h3>
            <div class="studentrecentupdates_list">
                <ul>
                    @foreach($activities as $value)

                        @if($value->type == 'brand_follows')


                            <li>   <div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/follow.jpg', '') }}</div>
                                <div class="studentrecentupdates_cont">You are now following  {{ getBrandName($value->brand_id)}}</div></li>

                        @endif

                        @if($value->type == 'inst_follows')


                            <li ><div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/follow.jpg', '') }}</div><div class="studentrecentupdates_cont">You are now following  {{ getInstitutionName($value->inst_id)}}</div></li>

                        @endif

                        @if($value->type == 'coupon')

                            <li><div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/activyimg.png', '') }}</div>
                                <div class="studentrecentupdates_cont"> {{ getBrandName($value->brand_id)}} Offer {{ $value->offer_name}} was accessed with Coupon {{ $value->coupon_code}} at {{ $value->created_at}}</div></li>

                        @endif

                        @if($value->type == 'feedback')


                            <li><div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/feedback.jpg', '') }}</div>
                                <div class="studentrecentupdates_cont"> {{ getBrandName($value->brand_id)}} responded to your feedback</div></li>


                        @endif
                        @if($value->message != '')
                            <li> <a href="{{ URL::route('student_internship_view2', [getBrandSlugByInternshipId($value->internship_id), getPostSlugByInternshipId($value->internship_id)]) }}" >
                                    <div class="studentrecentupdates_img_internship studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
                                    <div class="studentrecentupdates_cont">{{$value->message}}</div>
                                </a> </li>
                        @endif
                        @if($value->type == 'intern')
                            <li ><div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/activyimg1.png', '') }} </div>
                                <div class="studentrecentupdates_cont">{{ getBrandName($value->brand_id)}} You have applied for Internship {{ $value->internship_name}} </div></li>

                        @endif

                    @endforeach

                </ul>
            </div>
        </div>

    @endif

    <div class="brandsnearyou_info"  data-step="4" data-intro="Suggested Brands to Follow" data-position='left'>

        @if(count($suggested_brands)>0)

            <h4>Suggested Brands</h4>

            <div class="suggestedbrands_list">

                <ul>

                    @foreach($suggested_brands as $brand)

                        @if($brand->slug != 'idoag')

                            <li class="suggest_brand_{{$brand->id}}">

                                <div class="suggestedbrands_cont">

                                    <a href="{{URL::route('brand_profile',array($brand->slug))}}">{{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'))}}</a>

                                    <h4><a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}}</a></h4>

                                    <p><span class="likeicon count_likes"></span>  <span>+ {{getBrandFollowsCount($brand->id)}} followers</span></p>

                                    <div class="random_follow_brand id_{{$brand->id}}" id="{{$brand->id}}"> <a href="javascript:void(0);" class="follow_btn">Follow</a> </div>

                                </div>

                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>

        @elseif(isset($suggested_institutions) && count($suggested_institutions) >0 )

            <h4>Suggested Institutions</h4>

            <div class="suggestedbrands_list">

                <ul>

                    @foreach($suggested_institutions as $institution)


                            <li class="suggest_inst_{{$institution->id}}">

                                <div class="suggestedbrands_cont">

                                    <a href="{{URL::route('institution_profile',array($institution->slug))}}">{{   HTML::image(getImage('uploads/institutions/',$institution->image,'noimage.jpg'))}}</a>

                                    <h4><a href="{{URL::route('institution_profile',array($institution->slug))}}">{{$institution->name}}</a></h4>

                                    <p><span class="likeicon count_likes"></span>  <span>+ {{getInstitutionFollowsCount($institution->id)}} followers</span></p>

                                    <div class="random_follow_inst id_{{$institution->id}}" id="{{$institution->id}}">  <a href="javascript:void(0);" class="follow_btn">Follow</a></div>

                                </div>

                            </li>

                    @endforeach

                </ul>

            </div>

        @else

            <h4>Suggested Brands/Institutions</h4>

            <p>You are currently following all Brands and Institutes</p>

        @endif

    </div>

    @if(isset($ads) && !is_null($ads))

        <div class="advertisement_img"> {{ HTML::image('assets/images/advertisement_img.jpg')}}</div>

    @endif

</div>