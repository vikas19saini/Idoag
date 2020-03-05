@extends('layouts.default')

@section('title', $brand->name.' Internships |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Internships |idoag.com"/>
    <meta name="description" content="{{$brand->name}} Internships |idoag.com"/>
@stop

@section('css')
    @include('brands.partial.color')
    <style>
        .row_active{
            background:transparent;
        }
        .active_rowdd{
            padding-top:1em;
        }
        .container_info{
            width:100%;
        }
    </style>
@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->
        
        <div class='row_active row add_di dfssfagf'>
      <div class='container width_son'>
        <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
            <div class="active_rowdd frhsfgfadf">
               <div class="inner_div_apply row dfsdfsdagf">
                  <div class="clearfix"></div>
                  @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                            <div class="export_btns">
                            <div class="fr">
                             <span class="addoutlet_btn"><a
                                         href="{{ URL::route('create_internships',$brand->slug)}}">{{ HTML::image("assets/images/addoutlet_icon.png") }}
                                     Create New Internship</a></span>
                             <span class="import_btn"><a href="{{route('internships_applied',$brand->slug)}}" >
                                     Received Applications</a></span>
                       </div>
                            </div>
                   @endif
                    
                  <div class="clearfix"></div>
                  
                  @if(count($internships) > 0)
                  
                    @foreach($internships as $internship)
                  
                        <div class="bg_sonu">
                            <div class="inner_div_useonly wor_new less_pad">
                                <div class="class_spamll">
                                    <p class="pull-left"><i class="fa fa-map-marker"></i> {{$internship->city}}</p>
                                    <?php $post_type = getPostType($internship->id)?>
                                    <h1 class="pull-right @if($post_type == 'internship') dser @elseif($post_type == 'ambassador') am_color @endif">{{strtoupper($post_type)}}</h1>
                                </div>
                                <div class="ordi divred">
                                    @if(Sentry::check())
                                        <div style="cursor:pointer" class="secd  over_div_e  flex-container_s" onclick="window.location.href='{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}'">
                                    @else
                                        <div style="cursor:pointer" class="secd login_btnpop over_div_e  flex-container_s" data-toggle="modal"  data-target="#login_required">
                                    @endif                                    
                                        <div class="div_container_my">                                            
                                                <div class='row div_circle'>
                                                {{ HTML::image(getImage('uploads/brands/',getBrandLogo($internship->brand_id),'noimage.jpg'),'', ['class' => 'pull-left_a dfsevgjg'])}}                                            
                                                <div class="clearfix"></div>
                                                <h2 class="cld_di">{{getBrandName($internship->brand_id)}}</h2>
                                            </div>                                           
                                        </div>
                                        <div class="div_container_my">
                                           <ul class="div_dsds">
                                               @if($internship->type != 'internship')<li><span>&nbsp;</span><span>&nbsp;</span></li>@endif
                                              <li>
                                                 <span>Starts</span>
                                                 <span>{{dateformat($internship->start_date)}}</span>   
                                              </li>
                                              <li>
                                                 <span>Category:</span>
                                                 <span>{{getInternshipCatNameBySlug($internship->category)}}</span>   
                                              </li>
                                              @if($post_type == 'internship')
                                                <li>
                                                   <span>Duration:</span>
                                                   <span>{{getMonths($internship->start_date, $internship->end_date)}}</span>   
                                                </li>
                                              @endif
                                           </ul>
                                        </div>
                                        <div class="div_container_my">
                                           <ul class="div_dsds">
                                               @if($internship->type != 'internship')<li><span>&nbsp;</span><span>&nbsp;</span></li>@endif
                                              <li>
                                                 <span>Salary:</span>
                                                 <span><i class="fa fa-inr" aria-hidden="true"></i> {{$internship->amount}}/Month</span>   
                                              </li>
                                              <li>
                                                 <span>Apply By:</span>
                                                 <span>{{$internship->application_date}}</span>
                                              </li>
                                           </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="bg_ground bg_red @if($post_type == 'internship') d fe @elseif($post_type == 'ambassador') dfd @endif" style="position: relative">
                                        <p class=""><a style="color: inherit" @if(Sentry::check())
                href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{$internship->name}}</a>
                </p>
                                       <div class="clearfix"></div>
                                       <div class="uicon_latest fled w-full w8dd9">
                                          <div class="clearfix"></div>
                                          <ul class="dodfu">
                                              <li>
                                                  <i class="fa likeicons @if(checkLikes($internship->id)) fa-heart @else fa-heart-o @endif" data-toggle="tooltip" data-placement="top" title="Likes"
                                                    id="{{$internship->id}}"></i> <b class="id_{{$internship->id}}">{{getPostInfoCount($internship->id, 'likes')}}</b>
                                              </li>
                                             <li class="text_align">
                                                <i class="fa fa-share-alt share_social"></i>
                                             </li>
                                             <li class="right_p">
                                                 @if(Sentry::check() && $user_group == 'Students')
                                                    @if(IsUserApplied($internship->id))
                                                        <p><i class="fa fa-check-circle "></i> APPLIED</p>
                                                    @else
                                                        @if($internship->application_date < date('Y-m-d'))
                                                            <p>EXPIRED</p>
                                                        @else
                                                            @if($internship->question1 != '' || $internship->question2 != '' || $internship->question3 != '' || $internship->question4 != '' || $internship->question5 != '')
                                                                <p style="cursor: pointer" onclick='window.location.href="{{ URL::route('apply_internship_question',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug))}}"'>APPLY</p>
                                                            @else
                                                                <p style="cursor: pointer" onclick='window.location.href="{{ URL::route('apply_internship',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug))}}"'>APPLY</p>
                                                            @endif
                                                        @endif
                                                    @endif
                                                 @endif
                                                 
                                                 @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $internship->brand_id)                                                    
                                                        <ul class="brand_internship_op">
                                                            <li>
                                                                <a href="{{ URL::route('internships_applied_post',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}" data-toggle="tooltip" data-placement="top" title="Received Applications"><i class="fa fa-user"></i>  {{getInternshipAppliedCount($internship->id)}}</a>                                                               
                                                            </li>
                                                            <li>
                                                                <i class="fa statuspost @if($internship->status==1) activestatus @else inactivestatus @endif"
                                                                             data_id="{{$internship->id}}" id="post_{{$internship->id}}"  data-toggle="tooltip" data-placement="top" title="@if($internship->status==1) Active @else Inactive @endif"></i>                                                               
                                                            </li>
                                                            <li>
                                                                <a href="{{ URL::route('update_internships',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                                                                       data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                                class="fa fa-pencil"></i>
                                                                </a>
                                                            </li>
                                                        </ul>                                                     
                                                @endif
                                             </li>
                                          </ul>
                                          <div class="clearfix"></div>                                          
                                          <div class="addthis_sharing_toolbox" style="top:2em;right: 40%;">
                                                    <span class="share_fb" style="display:inline">
                                                        <a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$internship->image}}','{{$internship->short_description}}','{{$internship->name}}','{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}')"><i class="fa fa-facebook"></i></a>
                                                    </span>
                                                    <span class="share_tw" style="display:inline">
                                                        <a href="https://twitter.com/home?status={{$internship->name}} - {{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}} via idoagcard"
                                                                        target="_blank"><i class="fa fa-twitter"></i></a>
                                                    </span>
                                                    <span class="share_pin" style="display:inline">
                                                        <a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$internship->image}}&description={{ $internship->name }} "
                                                                        target="_blank"><i class="fa fa-pinterest"></i></a>
                                                    </span>
                                                    <span class="share_gplus" style="display:inline">
                                                        <a href="https://plus.google.com/share?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($internship->brand_id)))}}"
                                                                        target="_blank"><i class="fa fa-google-plus"></i></a>
                                                    </span>
                                                </div>                                        
                                       </div>
                                    </div>
                                    </div>
                                 </div>
                             </div> 
                    
                    @endforeach
                    
                  @else
                  
                    <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft">{{ HTML::image('assets/images/internships_errorimg.png')}} </div>
                                    <div class="allnotfund_msgright">
                                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                            <p>
										@if($internships_count>0)
                                                    <span class="bold_msg">  Internships are not live yet and will NOT be shown to the users currently. You could however still post your internships which will be visible to users once we activate the same.</span>
											@else
                                                    <span class="bold_msg">  You have not posted any Internship yet. Post a  <a
                                                            href="{{ URL::route('create_internships',$brand->slug)}}">
                                                        New Internship</a>  today to get the best of talent as Interns.</span>
                                            @endif
                                            </p>
                                        @else
                                            <p>
                                                <span class="bold_msg">No Internships Available Currently from {{$brand->name}}</span><br/>
                                                Please <a href="{{ URL::route('internships') }}">click here</a> to view
                                                other Internships available on IDOAG</p>
                                        @endif
                                    </div>
                                </div>
                    
                  @endif
                  
                  <div class='clearfix'></div>
                  <button class='filter_div hidden-lg hidden-md'>FILTERS</button>                  
               </div>
            </div>
         </div>
         <div class='col-lg-4 col-md-4 hidden-xs hidden-sm'>
            <div class='row_divdfs frdrw'>
               @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)
                        <div class="brand_poast_info" >

                            <h6>INTERNSHIP STATISTICS</h6>
                            <div class="brand_setting_txt">
                                <ul class="stats">
                                    <li>
                                        <div class="name_val">INTERNSHIPS POSTED</div>
                                        <div class="val_val"><strong>{{ $stats['internships_count'] }}</strong></div>
                                    </li>

                                    <li>
                                        <div class="name_val">APPLICATIONS RECEIVED</div>
                                        <div class="val_val"><strong>{{ $stats['received_app_count'] }}</strong></div>
                                    </li>

                                    <li>
                                        <div class="name_val">APPLICATIONS PENDING REVIEW</div>
                                        <div class="val_val"><strong>{{ $stats['app_pending_count'] }}</strong></div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    @endif

                    @include('brands.partial.note')
                    @include('partials.ad')
               <div class='clearfix'></div>
            </div>
         </div>         
      </div>
      </div>
</div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')


    {{ HTML::script('assets/js/notescript.js') }}


@stop
