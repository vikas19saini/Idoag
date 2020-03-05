    @if($post->type == 'photo')
        <div class="photowidget_{{$post->size}} grid-item">

          <div class="photowidget_img"><a @if(Sentry::check()) href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal"  data-id="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif> {{HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'),'',['class'=>'photowidget_img'])}}</a>
            <div class="photowidget_imgcont">
              <h5><a @if(Sentry::check()) href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal"  data-id="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif> {{$post->name}}</a></h5>
              <div class="share_like_txt">
                  <p><i class="fa fa-eye"></i> {{getPostInfoCount($post->id, 'visits')}}</p>

                  <p><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></p>

                  <p>    <a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                      @if(Sentry::check())
                  <div class="addthis_sharing_toolbox">

                       <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                      <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>

                      <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i class="fa fa-pinterest"></i></a></span>

                      <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"><i class="fa fa-google-plus"></i></a></span>

                  </div>
                  @endif  

              </div>
            </div>
            <div class="note_img2"> {{ HTML::image('assets/images/note_img5.png') }} </div>
          </div>
        </div>
    @endif

    @if($post->type == 'offer')

        @if((isset($user_group) &&  $user_group == 'Students' && $post->panindia_inst_id!=0 && $loggedin_user->institution == getInstitutionName($post->panindia_inst_id) ))

            @else
        <div class="photowidget_{{$post->size}} grid-item @if($post->end_date < date('Y-m-d')) disable @endif">

              <div class="photowidget_img"><a @if(Sentry::check()) href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"  @else  href="#" data-toggle="modal"  data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif> {{ HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'),'',['class'=>'photowidget_img']) }}
                      @if($post->end_date < date('Y-m-d'))
                          <div class="disablebgclr">
                              <h6>OFFER EXPIRED</h6>
                          </div>
                      @endif
                  </a>
                <div class="photowidget_imgcont">
                  <h5><a @if(Sentry::check()) href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"  @else  href="#" data-toggle="modal" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"  data-target="#login_required" class="login_btnpop"  @endif>{{$post->name}}</a></h5>
                  <div class="share_like_txt">
                      <p><i class="fa fa-eye"></i> {{getPostInfoCount($post->id, 'visits')}}</p>
					  <p><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></p>
						 
						<p>  <a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                            @if(Sentry::check())
                      <div class="addthis_sharing_toolbox">

                           <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                          <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>

                          <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i class="fa fa-pinterest"></i></a></span>

                          <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"><i class="fa fa-google-plus"></i></a></span>

                      </div>
                      @endif  

                  </div>
                </div>
                <div class="note_img2"> {{ HTML::image('assets/images/note_img3.png')}}</div>
              </div>
        </div>
            @endif
    @endif

    @if($post->type == 'event')
        <div class="photowidget_{{$post->size}} grid-item  @if($post->end_date < date('Y-m-d'))disable @endif">

            <div class="photowidget_img"> <a @if(Sentry::check())
                    href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal" data-id="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif> {{ HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'),'',['class'=>'photowidget_img']) }}
                    @if($post->end_date < date('Y-m-d'))
                        <div class="disablebgclr">
                            <h6>EVENT COMPLETED</h6>
                        </div>
                    @endif
                </a>
                <div class="photowidget_imgcont">
                    <h5>
                        <a @if(Sentry::check())
                            href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal" data-id="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>{{$post->name}}</a>
                    </h5>

                    <div class="share_like_txt">
                        <p><i class="fa fa-eye"></i> {{getPostInfoCount($post->id, 'visits')}}</p>

                        <p><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}"
                                                                      id="{{$post->id}}"></i><b
                                    class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b>
                        </p>

                        <p>  <a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
                        @if(Sentry::check())
                            <div class="addthis_sharing_toolbox">

                                 <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>

                                <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i class="fa fa-pinterest"></i></a></span>

                                <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"><i class="fa fa-google-plus"></i></a></span>

                            </div>
                        @endif

                    </div>
                </div>
                <div class="note_img2"> {{ HTML::image('assets/images/events_icon.png')}}</div>
            </div>
        </div>
    @endif

    @if($post->type == 'internship')
        <div class="photowidget_M whitebox_txt grid-item newinternship_list newinterndash_info">
            <a @if(Sentry::check()) href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"  @else  href="#" data-toggle="modal" data-id="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>
            <div class="newinternship_inner">

        @if($post->application_date < date('Y-m-d')) <div class="disablebgclr">
             <h6>INTERNSHIP EXPIRED</h6>
         </div> @endif
            <h4> <div class="note_img2">{{ HTML::image('assets/images/note_img4.png')}} </div>
                <span>  {{ShortenText($post->name,40)}}  </span></h4>
            <div class="internshipdash_inner">
          <div class="newinternship_txt">
             <span> {{ HTML::image(getImage('uploads/brands/',getBrandLogo($post->brand_id),'noimage.jpg'),'',['class'=>'brand_img'])}}</span>
             <p>{{ShortenText($post->short_description,100)}}</p>
         </div>
         <ul>
              <li><span>Cat: <i class="thinclr">{{getInternshipCatNameBySlug($post->category)}}</i></span><span>Resume: <i class="thinclr">{{getFirstWord($post->resume_preference)}}</i></span></li>
             <li><span>Start:  <i class="thinclr">{{dateformat($post->start_date)}}</i></span><span>End:  <i class="thinclr">{{dateformat($post->end_date)}}</i></span></li>
         </ul>
         <div class="stipend_row">
             <span>Stipend:  <i class="thinclr">@if($post->amount!=0)    <i class="redclr">Rs.{{$post->amount}} </i>
                     <small>Per Month</small>   @else  Nil
                     @endif</i></span>
             <span><i class="fa fa-map-marker"></i>@if($post->city){{getCity($post->city)}}, @endif @if($post->state){{getState($post->state)}}, @endif India</span>
         </div>
            </div>

     </div>
            </a>
            <div class="applyicons_row row share_like_txt dash_internship">
                <p><i class="fa fa-eye"></i> {{getPostInfoCount($post->id, 'visits')}}</p>

                <p><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></p>

                <p>    <a class="share_social"><i class="fa fa-share-alt"></i> Share </a> </p>
                @if(Sentry::check())
                    <div class="addthis_sharing_toolbox">

                        <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                        <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>

                        <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i class="fa fa-pinterest"></i></a></span>

                        <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"><i class="fa fa-google-plus"></i></a></span>

                    </div>
                @endif
            </div>
 </div>

@endif

@if($post->type == 'text')
 <div class="photowidget_M whitebox_txt grid-item">

         <div class="photowidget_imgcont">

         <div class="brandsign_listcont text_dashboard">
           <h3> <div class="note_img2">{{ HTML::image('assets/images/note_img.png')}} </div>
           <a @if(Sentry::check())  href="{{ URL::route('link_details',array('slug1' =>getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal" data-id="{{ URL::route('link_details',array('slug1' =>getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>{{$post->name}}</a></h3>
           <div class="brandsign_listinnercont">
             <div class="share_like_txt2">
               <ul>
                   <li><i class="fa fa-eye"></i><br><b>{{getPostInfoCount($post->id, 'visits')}}</b></li>
                   <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i> <br><b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                   <li><p> <a class="share_social2"><i class="fa fa-share-alt"></i> Share </a></p>
                     @if(Sentry::check())
                       <div class="addthis_sharing_toolbox">

                            <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                           <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>

                           <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i class="fa fa-pinterest"></i></a></span>

                           <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"><i class="fa fa-google-plus"></i></a></span>

                       </div>
                     @endif
                   </li>
               </ul>
             </div>
             <div class="share_like_txtcont">

                 <span>
                     <?php
                         // echo $post->description;
                         echo preg_replace('#<a.*?>.*?</a>#i', '', $post->description);
                         $m = preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~',$post->description, $matches);
                         if(!empty($matches[2])){
                             $tags = [];
                             $links = [];
                             foreach ($matches[2] as $value) {
                                 array_push($links, $value);
                                 $t = get_meta_tags($value);
                                 array_push($tags, $t);
                             }
                             //print_r($tags);
                             $i=0;
                             foreach ($tags as $value) {
                                 ?>
                                 <a href="<?php echo $links[$i]?>" target="_blank" style="text-decoration:none;color: initial;">
                                     <div class="link_fetch clearfix">
                                         <div class="leftdb">
                                             <?php
                                                 if(!isset($value['twitter:image'])){
                                                     $sites_html = file_get_contents($links[$i]);

                                                     $html = new DOMDocument();
                                                     @$html->loadHTML($sites_html);
                                                     $meta_og_img = null;
                                                     //Get all meta tags and loop through them.
                                                     foreach($html->getElementsByTagName('meta') as $meta) {
                                                         //If the property attribute of the meta tag is og:image
                                                         if($meta->getAttribute('property')=='og:image'){
                                                             //Assign the value from content attribute to $meta_og_img
                                                             $meta_og_img = $meta->getAttribute('content');
                                                         }
                                                     }
                                                     //echo $meta_og_img;
                                                     ?>
                                                     <img src="<?php echo $meta_og_img?>" />
                                                     <?php
                                                 }else{
                                                 ?>
                                                     <img src="<?php echo $value['twitter:image']?>" />
                                                     <?php
                                                 }
                                             ?>

                                         </div>
                                         <div class="rightdb">
                                             <?php if(isset($value['title'])) { ?>
                                                 <h6><?php echo $value['title']?></h6>
                                             <?php } else {?>
                                                 <h6><?php echo $value['twitter:title']?></h6>
                                             <?php } ?>
                                         </div>
                                     </div>
                                 </a>
                                 <?php
                                 $i++;
                             }
                         }
                     ?>
                 </span>

               <a @if(Sentry::check()) href="{{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"  @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>read more</a> </div>
           </div>
         </div>
     </div>
   </div>
@endif

@if($post->type == 'insphoto')
 <div class="photowidget_{{$post->size}} grid-item">

     <div class="photowidget_img">
         <a @if(Sentry::check())
             href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal" data-id="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>
             {{HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'),'',['class'=>'photowidget_img'])}}</a>
         <div class="photowidget_imgcont">
             <h5> {{$post->name}} </h5>

             <div class="share_like_txt">
                 <p>{{ HTML::image("assets/images/view_icon.png") }} {{getPostInfoCount($post->id, 'visits')}}</p>

                 <p>
                                                     <span class="likeicon @if(checkLikes($post->id)) active  @endif count_likes id_{{$post->id}}"
                                                           id="{{$post->id}}"></span><b
                             class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b>
                 </p>

                 <p><a class="share_social"><i class="fa fa-share-alt"></i> Share
                     </a></p>
                 @if(Sentry::check())
                     <div class="addthis_sharing_toolbox">

                         <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                                         <span class="share_tw"><a
                                                                     href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}} via idoagcard"><i
                                                                         class="fa fa-twitter"></i></a></span>

                                                         <span class="share_pin"><a
                                                                     href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i
                                                                         class="fa fa-pinterest"></i></a></span>

                                                         <span class="share_gplus"><a
                                                                     href="https://plus.google.com/share?url={{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}"><i
                                                                         class="fa fa-google-plus"></i></a></span>

                     </div>
                 @endif
             </div>
         </div>
         <div class="note_img2"> {{ HTML::image('assets/images/note_img5.png') }} </div>
     </div>
 </div>
@endif

@if($post->type == 'insevent')
 <div class="photowidget_{{$post->size}} grid-item @if($post->end_date < date('Y-m-d')) disable @endif">

     <div class="photowidget_img">


         <a  @if(Sentry::check()) href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal" data-id="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>

             {{ HTML::image(getImage('uploads/photos/'.$post->size.'_',$post->image,'noimage.jpg'),'',['class'=>'photowidget_img']) }}
             @if($post->end_date < date('Y-m-d'))
                 <div class="disablebgclr">
                     <h6>EVENT EXPIRED</h6>
                 </div>
             @endif</a>
         <div class="photowidget_imgcont">
             <h5>
                 <a href="{{ URL::route('inst_event_details',array('slug1' =>getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">{{$post->name}}</a>
             </h5>

             <div class="share_like_txt">
                 <p>{{ HTML::image("assets/images/view_icon.png") }} {{getPostInfoCount($post->id, 'visits')}}</p>

                 <p> <span class="likeicon @if(checkLikes($post->id)) active  @endif count_likes id_{{$post->id}}"
                           id="{{$post->id}}"></span><b
                             class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b>
                 </p>

                 <p><a class="share_social"><i class="fa fa-share-alt"></i> Share
                     </a></p>
                 @if(Sentry::check())
                     <div class="addthis_sharing_toolbox">

                         <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                                         <span class="share_tw"><a
                                                                     href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}} via idoagcard"><i
                                                                         class="fa fa-twitter"></i></a></span>

                                                         <span class="share_pin"><a
                                                                     href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i
                                                                         class="fa fa-pinterest"></i></a></span>

                                                         <span class="share_gplus"><a
                                                                     href="https://plus.google.com/share?url={{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}"><i
                                                                         class="fa fa-google-plus"></i></a></span>

                     </div>
                 @endif

             </div>
         </div>
         <div class="note_img2"> {{ HTML::image('assets/images/events_icon.png')}}</div>
     </div>

 </div>
@endif

@if($post->type == 'instext')
 <div class="photowidget_M whitebox_txt grid-item">

     <div class="photowidget_imgcont">

         <div class="brandsign_listcont text_dashboard">
             <h3>
                 <div class="note_img2">{{ HTML::image('assets/images/note_img.png')}}</div>
                   <a
                   @if(Sentry::check())
                       href="{{ URL::route('inst_text_details',array('slug1' =>getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}"
                       @else  href="#" data-toggle="modal" data-id="{{ URL::route('inst_text_details',array('slug1' =>getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" data-target="#login_required" class="login_btnpop"  @endif>{{$post->name}}</a>

             </h3>
             <div class="brandsign_listinnercont">
                 <div class="share_like_txt2">
                     <ul>
                         <li><i class="fa fa-eye"></i><br><b>{{getPostInfoCount($post->id, 'visits')}}</b></li>
                         <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i> <br><b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                         <li>

                             <p> <a class="share_social2"><i class="fa fa-share-alt"></i> Share </a></p>

                             @if(Sentry::check())

                               <div class="addthis_sharing_toolbox">

                                   <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                   <span class="share_tw"><a
                                               href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}} via idoagcard"><i
                                                   class="fa fa-twitter"></i></a></span>

                                   <span class="share_pin"><a
                                               href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_text_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} "><i
                                                   class="fa fa-pinterest"></i></a></span>

                                   <span class="share_gplus"><a
                                               href="https://plus.google.com/share?url={{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}"><i
                                                                                   class="fa fa-google-plus"></i></a></span>

                               </div>

                             @endif

                           </li>
                     </ul>
                 </div>
                 <div class="share_like_txtcont">
                     <span>{{ShortenText($post->description, 300)}}</span>
                     <a @if(Sentry::check()) href="{{ URL::route('inst_text_details',array('slug1' =>getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}" @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> <br><br>read more</a>
                 </div>
             </div>

         </div>

     </div>

 </div>
@endif