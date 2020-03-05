<div class="row_container_work row"></div>
        <div class="row row_df">
           <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
           <div class="col-lg-10 col-md-10 col-sm-11 col-xs-11">
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                 <div class="row inner_div_back profile_picture_style" style="position:relative;background:url('{{ Url::to('/') . '/uploads/profiles/'.$user->profile_image}}')">
                     {{ Form::open(array('class' => 'profile_picture', "files" => true)) }}
                     {{ Form::file('image', array('class' => 'hidden', 'id'=>'profile-image-upload', 'name' => 'profile_image', 'accept'=>"image/*")) }}
                     {{ Form::close() }}
                     @if($user->profile_image)                        
                        <div class="inner_div_pro">
                            <a href="javascript:void(0);" class="profile_pic">
                                <img style="height:18px; width:26px;" src="https://idoag.com/assets/images/profile_update.png" />
                            </a>
                        </div>
                     @elseif($user->faebook_id)
                        {{ HTML::image('http://graph.facebook.com/'. $user->faebook_id .'/picture?type=square&width=150&height=140', '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}
                        <div class="inner_div_pro">
                            <a href="javascript:void(0);" class="profile_pic">
                                <img style="height:18px; width:26px;" src="https://idoag.com/assets/images/profile_update.png" />
                            </a>
                        </div>
                     @else
                        {{ HTML::image('uploads/profiles/noimage.jpg') }}
                        <div class="inner_div_pro">
                            <a href="javascript:void(0);" class="profile_pic">
                                <img style="height:18px; width:26px;" src="https://idoag.com/assets/images/profile_update.png" />
                            </a>
                        </div>
                     @endif
                 </div>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                 <div class="work_edi row">
                    <h1>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</h1>
                    <p>{{$user->institution}}</p>
                    <p>{{$user->card_number}}</p>
                 </div>
              </div>
           </div>
         </div>
        <div class='clearfix'></div>