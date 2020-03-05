@extends('layouts.default')

@section('title','Student Internships - Idoag!')

@section('css')
    {{ HTML::style('assets/css/custom_sonu.css') }}
@stop
@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        
        <div class="row_content row">
        <!-- right side  start -->
   <div class="row row_df">
      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
      </div>
      <!--  right sideend -->
      <div class="col-lg-10 col-md-10 col-sm-11 col-xs-11">
         <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
            <div class="row inner_div_back profile_picture_style" style="background:url('{{ Url::to('/') . '/uploads/profiles/'.$user->profile_image}}')">
               
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
   <div class="clearfix"></div>
   <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 thank_you_bg_white">
      <div class="row_div thank_you_row_div">         
          @include('partials.flash')
         <br/>
         <div class="clearfix"></div>
         <div class="maing_div gdrtbnj row dere">
            <div class="bg_row_div">
               <ul>
                  <li>
                     <a href="#">Type</a>
                  </li>
                  <li>
                     <a href="#">Brands</a>
                  </li>
                  <li>
                     <a href="#">Job Details</a>
                  </li>
                  <li>
                     <a href="#">Applied Date</a>
                  </li>
                  <li>
                     <a href="#">Status</a>
                  </li>
               </ul>
            </div>
            
            @if(count($myinternships) > 0)
                @foreach($myinternships as $internship)
                    <div class='div_rowd'>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                          <p>{{getPostType($internship->post_id)}}</p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-1 col-xs-3'>
                          <p>{{getBrandName($internship->brand_id)}}</p>
                       </div>
                       <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                           <p><a href="{{ URL::route('internship_details',array('slug1' => getPostBrandSlug($internship->post_id), 'slug2' => getPostSlug($internship->post_id) ))}}">{{getPostName($internship->post_id)}}</a></p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>                           
                          <p>{{date('d M, Y', strtotime($internship->created_at))}}</p>
                       </div>
                       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                          <p>{{$internship_status[$internship->status]}}</p>
                       </div>
                    </div>
                @endforeach
            @else
                <h1>No records found..
            @endif 
            
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
      <div class="row_div thank_you_row_div">
         <div class="row row_df">
            <div class="  col-lg-9 col-md-9 col-xs-12 col-sm-12">
               <p class="thank_you_row_div_heading">SIMILAR INTERNSHIPS YOU MAY BE INTERESTED IN</p>
            </div>
            <div class="  col-lg-3 col-md-3 col-xs-12 col-sm-12">
            </div>
            <div class="clearfix"></div>
            <div class="bg_sonu_thank_you row_full">
                @if(count($internships) > 0)
                    @foreach($internships as $internship)
                    
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                           <div class="item_offer" style="position:relative">
                              <div class="inner_div_useonly">
                                 <div class="class_spamll">
                                    <p class="pull-left th"><i class="fa fa-map-marker"></i> {{$internship->city}}</p>
                                    <h1 class="pull-right th_a @if($internship->type == 'job') job_color @endif @if($internship->type == 'ambassador') amm_color @endif">{{strtoupper(getPostType($internship->id))}}</h1>
                                 </div>
                                  <a style="color: inherit" @if(Sentry::check())
                href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>
                                 <div class="ordi eadfdf">
                                    {{ HTML::image(getImage('uploads/brands/',getBrandLogo($internship->brand_id),'noimage.jpg'),'')}}
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="secd de">
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                       <ul>
                                           @if($internship->type != 'internship')<li>&nbsp;</li>@endif
                                          <li>
                                             <a>Cat: {{getInternshipCatNameBySlug($internship->category)}}</a>   
                                          </li>
                                          <li>
                                             <a>Start : {{dateformat($internship->start_date)}}</a>   
                                          </li>
                                          @if($internship->type == 'internship')
                                            <li>
                                               <a>Duration : {{getMonths($internship->start_date, $internship->end_date)}}</a>   
                                            </li>
                                          @endif
                                       </ul>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                       <ul class="pull-right">
                                           @if($internship->type != 'internship')<li>&nbsp;</li>@endif
                                          <li>
                                             <a>Apply By : {{$internship->application_date}}</a>   
                                          </li>
                                          <li>
                                             <a>Stipened: <i class="fa fa-inr" aria-hidden="true"></i> {{$internship->amount}}/Month</a>   
                                          </li>
                                       </ul>
                                    </div>
                                 </a>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="bg_ground div_height_bg_use @if($internship->type == 'job') job_bg_color @endif @if($internship->type == 'ambassador') amm_bg_color @endif">
                                    <p class="th_b"><a style="color: inherit" @if(Sentry::check())
                href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"
                @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>{{ShortenText($internship->name, 70)}}</a>
                                    </p>
                                    <div class="uicon_latest lates_updates">
                                       <div class="clearfix"></div>
                                       <i class="fa likeicons @if(checkLikes($internship->id)) fa-heart @else fa-heart-o @endif" data-toggle="tooltip" data-placement="top" title="Likes"
                                                    id="{{$internship->id}}"></i> <b class="id_{{$internship->id}}">{{getPostInfoCount($internship->id, 'likes')}}</b>
                                       <i class="fa fa-share-alt share_social"></i>
                                       @if(Sentry::check())
                                          <div class="addthis_sharing_toolbox" style="top: 78%">
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
                                        @endif
                                    </div>                                    
                                 </div>
                              </div>                               
                           </div>
                        </div>                        
                    @endforeach
                @else
                    <h1>No records found..</h1>
                @endif
            </div>
            <div class="inenr_child row">
               <button class="divb_aa divb_aa_bg pull-right" onclick="window.location.href='{{route('internships')}}'">View All</button>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  </div>
   <div class="clearfix"></div>
</div>
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    <script>
        $(function(){
            var ww=$(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww);

            $( window ).resize(function() {
                var ww2=$(window).innerWidth();
                $(".navbar-default .navbar-nav > li .submenu").width(ww2);
            });

            $('.navbar-default .navbar-nav > li .submenu .mybrandslider_info').bxSlider({
                minSlides: 1,
                maxSlides: 5,
                slideWidth: 154,
                infiniteLoop: false,
                pager: false,
                moveSlides: 1,
                slideMargin: 10
            });

            $('.suggestedbrands_list ul').bxSlider({
                pager: false
            });

        });
    </script>
@stop
