<div class="profile_info">
    <div class="profile_bg"></div>
    <div class="profile_cont clearfix">
        <div class="container_info">
          <div class="profile_click">
            {{ Form::open(array('class' => 'profile_picture', "files" => true)) }}
            {{ Form::file('image', array('class' => 'hidden', 'id'=>'profile-image-upload', 'name' => 'profile_image', 'accept'=>"image/*")) }}
            {{ Form::close() }}

            @if($user->profile_image)
                
                <div class="profile_img"  data-step="1" data-intro="Profile Picture" data-position='right'>{{ HTML::image('uploads/profiles/'.$user->profile_image, '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}

                    <div class="stepprofile_cnt"   >
                        <p>
                            <a href="javascript:void(0);" class="profile_pic">
                                {{ HTML::image('http://idoag.com/assets/images/profile_update.png', '', ['class' => 'default_img' ]) }}  upload Picture
                            </a>
                        </p>
                    </div>
                </div>

           
            @elseif($user->faebook_id)
               
                <div class="profile_img">{{ HTML::image('http://graph.facebook.com/'. $user->faebook_id .'/picture?type=square&width=150&height=140', '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }} 

                    <div class="stepprofile_cnt">
                        <p>                            
                            <a href="javascript:void(0);" class="profile_pic">
                                {{ HTML::image('http://idoag.com/assets/images/profile_update.png', '', ['class' => 'default_img' ]) }}  upload Picture
                            </a>
                        </p>
                    </div>
                </div>
            
            @else
                
                <div class="profile_img">{{ HTML::image('uploads/profiles/noimage.jpg') }} 

                    <div class="stepprofile_cnt">
                        <p>                            
                            <a href="javascript:void(0);" class="profile_pic">
                                {{ HTML::image('http://idoag.com/assets/images/profile_update.png', '', ['class' => 'default_img' ]) }}  upload Picture
                            </a>
                        </p>
                    </div>
                </div>
            
            @endif
            
            <div class="profile_continner" data-step="2" data-intro="Institution Name" data-position='right'>
            
                <h4>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</h4>
                <p>{{$user->institution}}</p>
            
            </div>

        </div>
    </div>
</div>
</div>
@include('partials.flash')