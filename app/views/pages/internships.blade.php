@extends('layouts.default')

@section('title','Internships for Students |idoag.com')
@section('metatags')
    <meta name="keywords" content="Internships for Students |idoag.com" />
    <meta name="description" content="Internships for Students |idoag.com" />

    <meta property="og:title" content="Internships for Students |idoag.com" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="http://idoag.com" />
    <meta property="og:image" content="http://idoag.com/assets/images/logo.png" />
    <meta property="og:description" content="Internships for Students |idoag.com" />
    <meta property="og:site_name" content="idoag.com" />
@stop
@section('css')
@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students')
            <div class="mobile_btmenu othertopmenu" >
                <ul>
                    <li>
                        <a href="{{ URL::route('trending_internships')}}" >
                            {{ HTML::image('assets/images/mobilebt_internship.png')}}
                            <span>Trending <br/>Internships</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('mybrands_internships')}}">
                            {{ HTML::image('assets/images/mobilebt_internship.png')}}
                            <span>Internships<br>from My Brands</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        @include('partials.flash')
        
        
      <div class='banner_divda'></div>
      <div class='clearfix'></div>
      <div class='row_active row add_di dfssfagf'>
      <div class='container width_son'>
         <div class='col-lg-4 col-md-4 hidden-xs hidden-sm'>
            <div class='row_divdfs frdrw'>
               <div class='dirow'>
                  <h1>APPLIED JOBS</h1>
               </div>
               @if(Sentry::check())
                    @if(count($student_internships) > 0)
                         @foreach($student_internships as $internship)                    
                             <div class='row_xa'>
                                <div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>
                                   <p class='opd'><a href="{{ URL::route('internship_details',array('slug1' => getPostBrandSlug($internship->post_id), 'slug2' => getPostSlug($internship->post_id) ))}}">{{getPostName($internship->post_id)}}</a></p>
                                </div>
                                <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                   {{ HTML::image(getImage('uploads/brands/',getBrandLogo($internship->brand_id),'noimage.jpg'),'')}}
                                   @if($internship->post->status==0)
                                     <button onclick="window.location.href='{{ URL::route('student_internship_view2', [getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)]) }}'">EXPIRED</button>
                                   @else
                                     <button onclick='window.location.href="{{ URL::route('student_internship_view2', [getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)]) }}"' target="_blank">{{$internship_status[$internship->status]}}</button>
                                   @endif                              
                                </div>
                             </div>
                         @endforeach
                     @else
                         <br>
                         <h1 style='text-align:center'>No records found..</h1>
                     @endif               
               @else
                    <br>
                    <h1 style='text-align:center'><a href="#login" data-toggle="modal" data-target="#login_required">Login to view this section.</a></h1>
               @endif
               <div class='clearfix'></div>
               <button onclick='window.location.href="{{route('student_applied_jobs')}}"' class='btn_row_d'>VIEW ALL APPLICATIONS</button>
               <div class='clearfix'></div>
            </div>
         </div>
         <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
            <div class="active_rowdd frhsfgfadf">
               <div class="inner_div_apply row dfsdfsdagf">
                  <div class="clearfix"></div>
                  <div class="serech_box row">
                     <input type="text" placeholder="What are you looking for ?">
                     <button class="btn_show_s"><i class="fa fa-search"></i></button>
                  </div>
                  <!--<h5 class="congrats">Congrats! You have been selected by Burger King.</h5> -->
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
                  
                    <p><span class="bold_msg"> We are in the process of adding internships on IDOAG.</span><br/> Kindly bear with us for sometime and we will notify you once this is active.</p>
                    
                  @endif
                  {{ $internships->links() }}
                  <div class='clearfix'></div>
                  <button class='filter_div hidden-lg hidden-md'>FILTERS</button>                  
               </div>
            </div>
         </div>
      </div>
      </div>        
    </div>

        <!-- Footer Starts here -->
        @include('layouts.footer')
        <!-- Footer Ends here -->

        @stop

        @section('js')



    <script>

        $('.count_likes').on('click', function() {
            var post_id = $(this).attr('id');
            var data = "post_id="+post_id;
            $.ajax({
                url: '/getIntLikes',
                type: 'POST',
                data: data,
                success: function(response) {
                    if(response){
                        $('a.id_'+post_id).html('<a href="javascript:void(0);"><img src="assets/images/like_icon.png"> '+response.count+'</a>');
                    }
                }
            });
        });
    </script>

@stop
