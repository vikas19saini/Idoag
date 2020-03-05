
@extends('layouts.default')

@section('title','Student Home Page |idoag.com')
@section('metatags')
    <meta name="keywords" content="Student Home Page |idoag.com" />
    <meta name="description" content="Student Home Page |idoag.com" />
    
@stop

@section('css')

    {{ HTML::style('assets/css/jquery-ui.css') }}    
    {{ HTML::style('assets/css/owl.carousel.css') }}    
    {{ HTML::style('assets/css/owl.theme.css') }}

@stop

@section('content')
  
    <!-- Content Start Here -->
  	<div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')                  
        <!-- Header Ends here -->
        
        <!--<div class="mobile_btmenu ">
            <ul>
                <li>
                    <a href="{{ URL::route('studentupdates')}}" >
                        {{ HTML::image('assets/images/mobilebt_recent.png')}}
                        <span>Recent<br/> Updates</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('studentoffers')}}">
                        {{ HTML::image('assets/images/mobilebt_recently.png')}}
                        <span>Recently<br/> Viewed Offers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('student_internships')}}">
                        {{ HTML::image('assets/images/mobilebt_internship.png')}}
                        <span>My<br/> Internships</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::route('institution_profile',getInstitutionSlug($student_details->institution_id))}}">
                        {{ HTML::image('assets/images/mobilebt_institutions.png')}}
                        <span>My<br/> Institute</span>
                    </a>
                </li>
            </ul>        
        </div> -->
        
        <div class='row'>
        
        <!-- Desktop slider -->
        
         <div class="carousel fade-carousel slide carousel-fade hidden-sm hidden-xs" data-ride="carousel" data-interval="4000" id="bs-carousel">
            <div class="carousel-inner piislider">			   
		<?php
                $counter = 0;
                $indictors = '';
                ?>
                @foreach($sliders as $slider)
                <div class="item slides @if($counter == 0) active bg_div_use @endif" style="background-size: cover;background-repeat: no-repeat;background-image: url('{{URL::to('/')}}/uploads/{{ $slider->image_name }}');">
                    <div class="hero">
                        <div class="bg_slider_content bounceInLeft">
                           <h3>{{ $slider->name }}</h3>
                           <p>{{ $slider->title }}</p>
                        </div>
                    </div>
                </div>
                <?php 
                
                if($counter == 0)
                    $indictors .= '<li data-target="#bs-carousel" data-slide-to="' . $counter . '" class="active"></li>';
                else
                    $indictors .= '<li data-target="#bs-carousel" data-slide-to="' . $counter . '"></li>';
                        
                ?>
                <?php $counter++ ?>
                @endforeach               
            </div>
            <ol class="carousel-indicators">
               {{ $indictors }}
            </ol>
         </div>
        
        <!-- Desktop slider end -->
        
        
        <!-- Mobile Slider -->
        
        <div id="myCarousel" class="carousel slide   hidden-lg hidden-md" data-ride="carousel">                   
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        
                        
                        <?php
                $counter = 0;
                $indictors = '';
                ?>
                @foreach($sliders as $slider)
                <div class="item @if($counter == 0) active bg_div_use @endif div_wso">
                            <img src="{{URL::to('/')}}/uploads/{{ $slider->image_name }}" class="img-responsive" style="width:100%; height:100vh">
                            <div class='bg_slider_content bounceInLeft'>
                                <h3>{{ $slider->name }}</h3>
                                <p>{{ $slider->title }}</p>
                            </div>
                        </div>
                <?php 
                
                if($counter == 0)
                    $indictors .= '<li data-target="#myCarousel" data-slide-to="' . $counter . '" class="active"></li>';
                else
                    $indictors .= '<li data-target="#myCarousel" data-slide-to="' . $counter . '"></li>';
                        
                ?>
                <?php $counter++ ?>
                @endforeach               
            </div>            
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    
                     <!-- Indicators -->
                    <ol class="carousel-indicators">
                        {{ $indictors }}
                    </ol>                    
                </div>
            </div>
        
        
      <div class='container'>
         <h1 class='div_in iwq'>DISCOUNTS</h1>
      </div>
      
        <div class='row'>
         <div class='btn_latest'>
            <button class='clearfix'>Latest</button>
         </div>
         <div class='inner_navagation row'>
            <div id="owl-demo" class="owl-carousel owl-theme">
                @foreach($offers_new as $offer) 
                    <div class="item">
                       <div class='inner_div_useonly' style="position:relative">
                          <div class='moreinner'>
                             <img src='{{URL::to('/')}}/uploads/photos/{{$offer->image}}' alt='src_use'/>
                             <h1>{{$offer->bname}}</h1>
                          </div>
                          <p>{{$offer->name}}</p>                          
                          <span><a href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">Click here to get your coupon code</a></span>
                          <div class='clearfix'></div>
                          <div class='uicon_latest'>
                             <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$offer->id}}" id="{{$offer->id}}"></i>
                             <i class="fa fa-share-alt share_social"></i>
                             <div style="top:65%;" class="addthis_sharing_toolbox">
                                <span style="display:inline" class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('photo_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                <span style="display:inline" class="share_tw"><a href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('photo_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}} via idoagcard"><i class="fa fa-twitter"></i></a></span>
                                <span style="display:inline" class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('photo_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }} "><i class="fa fa-pinterest"></i></a></span>
                                <span style="display:inline" class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('photo_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}"><i class="fa fa-google-plus"></i></a></span>
                            </div>
                          </div>                          
                       </div>                       
                    </div>
                @endforeach
            </div>
         </div>
         <div class='clearfix'></div>
         <div class='fgs'>
            <button class='clearfix o pull-right'>View All</button>
         </div>
      </div>
      
      <div class="clearfix"></div>
        
      <div class="container">
         <h1 class="div_in iwq frd">FRESHER 
            JOBS
         </h1>
      </div>
      <div class='row'>
         <div class='banner_div_row'></div>
      </div>
      <div class='row bg_use_div_nav'>
         <div class='maing_container'>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
               <div class='inner_div_row_bg row'>
                  <h1 class='fresher_-d'>FRESHER<br/>
                     JOBS
                  </h1>
               </div>
            </div>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
               <div class='inner_div_row_bg row'>
                  <h1>INTERNSHIPS</h1>
               </div>
            </div>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
               <div class='inner_div_row_bg row'>
                  <h1 class='dicrise'>CAMPUS
                     AMBASSADORS
                  </h1>
               </div>
            </div>
         </div>
      </div>
      
      
      <div class='row margin_div_e'>
         <div class='btn_latest'>
            <button class='clearfix'>Latest</button>
         </div>
         <div class='inner_navagation row'>
            <div id="owl-demo_a" class="owl-carousel owl-theme">
               @foreach($internships_new as $internship)
                <div class="item">
                  <div class='inner_div_useonly'>
                     <div class='class_spamll'>
                        <p class='pull-left'><i class="fas fa-map-marker-alt"></i> Thiruvananthapuram</p>
                        <h1 class='pull-right dfdes'>INTERNSHIP</h1>
                     </div>
                     <div class='ordi eadfdf'>
                        <img src='{{URL::to('/')}}/uploads/photos/{{$internship->image}}' alt='co_logo'/>
                     </div>
                     <div class='clearfix'></div>
                     <div class='secd cesagrer'>
                        <div class='col-lg-6 col-sm-6 col-md-6 col-xs-6'>
                           <ul>
                              <li>
                                 <a href='#'>Cat: {{$internship->category}}</a>   
                              </li>
                              <li>
                                 <a href='#'>Start : {{$internship->start_date}}</a>   
                              </li>
                              <li>
                                 <a href='#'>Duration : 5 Months</a>   
                              </li>
                           </ul>
                        </div>
                        <div class='col-lg-6 col-sm-6 col-md-6 col-xs-6'>
                           <ul class='pull-right'>
                              <li>
                                 <a href='#'>Apply By : 1-2-2000</a>   
                              </li>
                              <li>
                                 <a href='#'>Stipened:  <i class="fas fa-rupee-sign"></i> 20000/month</a>   
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     <div class='bg_ground'>
                        <p class=''>{{$internship->name}}</p>
                        <div class='uicon_latest'>
                           <div class='clearfix'></div>
                           <i class="fa likeicons @if(checkLikes($internship->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$internship->id}}" id="{{$internship->id}}"></i>
                           <i class="fa fa-share-alt"></i>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div class='clearfix'></div>
         <div class='fgs'>
            <button class='clearfix o pull-right'>View All</button>
         </div>
      </div>
      
      
		
        <div class="brandoffer_info stdntdashboard_info">
			
			<div class="container_info">
			  
				<div class="brandoffer_contleft">
                    
                    @if(count($featured_posts))

                        <div class="photowidgetslide_wp">
                            
                            <ul class="photowidget_slider">

                                @foreach($featured_posts as $post)

                                    @if($post->featured==1)
                                    
                                        @if($post->type == 'photo')
                                            <li>

                                                <div class="photowidget_FSW featured_widgetfsw">

                                                    <div class="brandsign_info studentdb">
                                                        
                                                        <div class="brandsign_left">
                                                            
                                                            <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>
                                                            
                                                            <div class="brandsign_leftcont">

                                                                <h3><a href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}"> {{ShortenText($post->name,80)}}</a></h3>
                                                                
                                                                <p>{{ShortenText($post->short_description,120)}}</p>

                                                            </div>

                                                        </div>

                                                        <div class="brandsign_right">

                                                            <div class="share_like_strip share_like_txt">
                                                                
                                                                <ul>
                                                                    
                                                                    <li><i class="fa fa-eye"></i><br>
                                                                        {{getPostInfoCount($post->id, 'visits')}} </li>
                                                                    
                                                                    <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                        <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                                                                    
                                                                    <li> <a class="share_social"><i class="fa fa-share-alt"></i><br> Share </a>
                                                                        @if(Sentry::check())

                                                                            <div class="addthis_sharing_toolbox share_fp">

                                                                                 <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                                                                <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                                <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                                <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_photos',array('slug1' => getBrandSlug($post->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                            </div>
                                                                        @endif  </li>
                                                                </ul>
                                                            </div>
                                                            <div class="brandsign_img">
                                                                {{HTML::image(getImage('uploads/photos/',$post->image,'noimage.jpg'),'',['class'=>'cocacola_img'])}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>

                                            </li>
                                        @endif

                                            @if($post->type == 'insphoto')
                                                <li>

                                                    <div class="photowidget_FSW featured_widgetfsw">

                                                        <div class="brandsign_info studentdb">

                                                            <div class="brandsign_left">

                                                                <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>

                                                                <div class="brandsign_leftcont">

                                                                    <h3><a href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">{{ShortenText($post->name,80)}}</a></h3>

                                                                    <p> {{ShortenText($post->short_description,120)}}</p>

                                                                </div>

                                                            </div>

                                                            <div class="brandsign_right">

                                                                <div class="share_like_strip share_like_txt">

                                                                    <ul>

                                                                        <li><i class="fa fa-eye"></i><br>
                                                                            {{getPostInfoCount($post->id, 'visits')}} </li>

                                                                        <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                            <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>

                                                                        <li> <a class="share_social"><i class="fa fa-share-alt"></i><br> Share </a>
                                                                            @if(Sentry::check())

                                                                                <div class="addthis_sharing_toolbox share_fp">

                                                                                    <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                                                                    <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                                    <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                                    <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_inst_photos',array('slug1' => getInstitutionSlug($post->institution_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                                </div>
                                                                            @endif  </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="brandsign_img">
                                                                    {{HTML::image(getImage('uploads/photos/',$post->image,'noimage.jpg'),'',['class'=>'cocacola_img'])}}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </li>
                                            @endif
                                       
                                        @if($post->type == 'offer')
                                            <li>
                                                <div class="photowidget_FSW featured_widgetfsw">

                                                    <div class="brandsign_info studentdb">
                                                        <div class="brandsign_left">
                                                            <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>
                                                            <div class="brandsign_leftcont">
                                                                <h3><a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" >{{ShortenText($post->name,80)}}</a></h3>
                                                                <p> {{ShortenText($post->short_description,120)}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="brandsign_right">
                                                            <div class="share_like_strip share_like_txt">
                                                                <ul>
                                                                    <li><i class="fa fa-eye"></i><br>
                                                                        {{getPostInfoCount($post->id, 'visits')}} </li>
                                                                    <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                        <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                                                                    <li> <a class="share_social"><i class="fa fa-share-alt"></i><br> Share </a>
                                                                        
                                                                        @if(Sentry::check())
                                                                            
                                                                            <div class="addthis_sharing_toolbox share_fp">

                                                                                 <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
     
                                                                                <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                                <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                                <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($post->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                            </div>

                                                                        @endif  

                                                                    </li>

                                                                </ul>

                                                            </div>
                                                            <div class="brandsign_img">
                                                                <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}" >{{HTML::image(getImage('uploads/photos/',$post->image,'noimage.jpg'),'',['class'=>'cocacola_img'])}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                        @if($post->type == 'internship')
                                            <li>
                                                <div class="photowidget_FSW featured_widgetfsw">
                                                    <div class="brandsign_info studentdb">
                                                        <div class="brandsign_left">
                                                            <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>
                                                            <div class="brandsign_leftcont">
                                                                <h3><a href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">{{ShortenText($post->name,80)}}</a></h3>
                                                                <p> {{ShortenText($post->short_description,120)}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="brandsign_right">
                                                            <div class="share_like_strip">
                                                                <ul>
                                                                    <li><i class="fa fa-eye"></i><br>
                                                                        {{getPostInfoCount($post->id, 'visits')}} </li>
                                                                    <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                        <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                                                                    <li>  <a class="share_social"><i class="fa fa-share-alt"></i><br> Share </a>
                                                                        @if(Sentry::check())
                                                                            <div class="addthis_sharing_toolbox share_fp">

                                                                                <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span> 

                                                                                <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                                <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                                <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_internships',array('slug1' => getBrandSlug($post->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                            </div>
                                                                        @endif </li>
                                                                </ul>
                                                            </div>
                                                            <div class="brandsign_img">
                                                                {{HTML::image(getImage('uploads/photos/',$post->image,'internship_featured.jpg'),'',['class'=>'cocacola_img'])}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>  
                                        @endif
                                        
                                        @if($post->type == 'event')
                                        <li>
                                            <div class="photowidget_FSW featured_widgetfsw">
                                                <div class="brandsign_info studentdb">
                                                    <div class="brandsign_left">
                                                        <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>
                                                        <div class="brandsign_leftcont">
                                                            <h3><a href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">{{ShortenText($post->name,80)}}</a></h3>
                                                            <p> {{ShortenText($post->short_description,120)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="brandsign_right">
                                                        <div class="share_like_strip">
                                                            <ul>
                                                                <li><i class="fa fa-eye"></i><br>
                                                                    {{getPostInfoCount($post->id, 'visits')}} </li>
                                                                <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                    <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                                                                <li>  <a class="share_social"><i class="fa fa-heart"></i> Share </a>
                                                                    @if(Sentry::check())
                                                                        <div class="addthis_sharing_toolbox share_fp">

                                                                             <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span> 

                                                                            <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                            <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                            <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_events',array('slug1' => getBrandSlug($post->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                        </div>
                                                                    @endif </li>
                                                            </ul>
                                                        </div>
                                                        <div class="brandsign_img">
                                                            {{HTML::image(getImage('uploads/photos/',$post->image,'noimage.jpg'),'',['class'=>'cocacola_img'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif

                                            @if($post->type == 'insevent')
                                                <li>
                                                    <div class="photowidget_FSW featured_widgetfsw">
                                                        <div class="brandsign_info studentdb">
                                                            <div class="brandsign_left">
                                                                <div class="featured_txt"> {{ HTML::image('assets/images/idoage_logo.png')}} <span>featured</span> </div>
                                                                <div class="brandsign_leftcont">
                                                                    <h3><a href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">{{ShortenText($post->name,80)}}</a></h3>
                                                                    <p> {{ShortenText($post->short_description,120)}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="brandsign_right">
                                                                <div class="share_like_strip">
                                                                    <ul>
                                                                        <li><i class="fa fa-eye"></i><br>
                                                                            {{getPostInfoCount($post->id, 'visits')}} </li>
                                                                        <li><i class="fa likeicons @if(checkLikes($post->id)) fa-heart @else fa-heart-o  @endif count_likes id_{{$post->id}}" id="{{$post->id}}"></i><br>
                                                                            <b class="id_{{$post->id}}">{{getPostInfoCount($post->id, 'likes')}}</b></li>
                                                                        <li>  <a class="share_social"><i class="fa fa-heart"></i> Share </a>
                                                                            @if(Sentry::check())
                                                                                <div class="addthis_sharing_toolbox share_fp">

                                                                                    <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$post->image}}','{{$post->short_description}}','{{$post->name}}','{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                                                                                    <span class="share_tw"><a href="https://twitter.com/home?status={{$post->name}} - {{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>

                                                                                    <span class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}&media=http://idoag.com/uploads/photos/M_{{$post->image}}&description={{ $post->name }} " target="_blank"><i class="fa fa-pinterest"></i></a></span>

                                                                                    <span class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_inst_events',array('slug1' => getInstitutionSlug($post->institution_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>

                                                                                </div>
                                                                            @endif </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="brandsign_img">
                                                                    {{HTML::image(getImage('uploads/photos/',$post->image,'noimage.jpg'),'',['class'=>'cocacola_img'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                    @endif

                                @endforeach

                            </ul>

                        </div>  
                
                    @endif
                    
                    <div class="photowidget_list">

                        @foreach($brands_posts as $post)

                            @if($post->status == 1)

                                @include('students.partials.dashboard_post')

                            @endif

                        @endforeach

	                </div>

    		    </div>

    			<div class="notice_feed_info internship_list studentdashboard">
    				    <div class="notice_feed_list"  data-step="1" data-intro="Recent Viewed Offers" data-position='left'>
    			      <h3>{{ HTML::image('assets/images/noteheart_img17.png')}} <span>Recent Updates</span></h3>
    			      <div class="studentrecentupdates_list">
    			        <ul>
                            @foreach($activities as $activity)

                                <li> <a href="{{ URL::route('student_internship_view2', [getBrandSlugByInternshipId($activity->internship_id), getPostSlugByInternshipId($activity->internship_id)]) }}" >
                                        <div class="studentrecentupdates_img_internship studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
                                        <div class="studentrecentupdates_cont">{{$activity->message}}</div>
                                    </a> </li>

                            @endforeach

    			        	@foreach($brands_posts as $post)

    				       		@if($post->type == 'offer')
    					        
    					          <li> <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
    					            <div class="studentrecentupdates_img_offer studentrecentupdates_img" >{{ HTML::image('assets/images/stdntrecentupdates_img1.png')}}</div>
    					            <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted an offer: <strong>{{$post->name}}</strong></div>
    					            </a> </li>

    					        @endif


    				       		@if($post->type == 'photo')

    					          <li> <a href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
    					            <div class="studentrecentupdates_img_photo studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img3.png')}}</div>
    					            <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new photo gallery.</div>
    					            </a> </li>

    					        @endif

                                    @if($post->type == 'insphoto')

                                        <li> <a href="{{ URL::route('inst_photo_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_photo studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img3.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getInstitutionName($post->institution_id)}}</strong> posted a new photo gallery.</div>
                                            </a> </li>

                                    @endif


    				       		@if($post->type == 'link')

    					          <li> <a href="{{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
    					            <div class="studentrecentupdates_img_text studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img5.png')}}</div>
    					            <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new link.</div>
    					            </a> </li>

    					        @endif
    					        
    				       		@if($post->type == 'internship')

    					          <li> <a href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
    					            <div class="studentrecentupdates_img_internship studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
    					            <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted an internship : <strong>{{$post->name}}</strong></div>
    					            </a> </li>

    					        @endif

    				       		@if($post->type == 'event')

    					          <li> <a href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
    					            <div class="studentrecentupdates_img_event studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img4.png')}}</div>
    					            <div class="studentrecentupdates_cont"><strong>{{getBrandName($post->brand_id)}}</strong> posted a new event :  <strong>{{ $post->name}}</strong></div>
    					            </a> </li>

    					        @endif

                                    @if($post->type == 'insevent')

                                        <li> <a href="{{ URL::route('inst_event_details',array('slug1' => getInstitutionSlug($post->institution_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img_event studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img4.png')}}</div>
                                                <div class="studentrecentupdates_cont"><strong>{{getInstitutionName($post->institution_id)}}</strong> posted a new event :  <strong>{{ $post->name}}</strong></div>
                                            </a> </li>

                                    @endif

    					    @endforeach

    			        </ul>
    			      </div>
    			    </div>
                    @if(count($recently_viewed_post)>0)
    			    <div class="notice_feed_list">
    			      <h3>{{ HTML::image('assets/images/note_img3.png')}} <span>Recently Viewed Offers</span></h3>
    			      <div class="notice_feed_listinner2">
    			        <ul>

    			        	@foreach($recently_viewed_post as $post) 
    				       		 
                                @if(isset($post->type) && $post->type=='offer')				        	

    					            <li> 
    					             
    					             	<a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">

                                            <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/S_',$post->image,'noimage.jpg'))}}</div>
    					              
    							            <div class="notice_feed_listinnercont">
    							              
    											<h5>{{$post->name}}</h5>

    											<p>{{ShortenText($post->short_description,200)}} <br>
    											
    												<i>by {{getBrandName($post->brand_id)}}</i>
    											</p>
    							            
    							            </div>
    					            	</a> 
    					        	</li>
    					        	
    					        @endif

    				        @endforeach

    			        </ul>
    			      </div>
    			    </div>
                    @endif


    			    <div class="notice_feed_list"  data-step="2" data-intro="Your Internships" data-position='left'>
    			      <h3>{{ HTML::image('assets/images/note_img4.png')}} <span>My Internships</span></h3>
                        @if(count($internships)>0)

    			      <div class="myinternships_list">

        			        <ul>
                                @foreach($internships as $internship)
            			          <li>
            			            @if($internship->post->status==0)
                                      <div class="myinternships_btn {{$internship_status_class[3]}}">  <a href="{{ URL::route('student_internship_view2', [getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)]) }}">Expired</a></div>
                                     @else
                                      <div class="myinternships_btn {{$internship_status_class[$internship->status]}}">  <a href="{{ URL::route('student_internship_view2', [getPostBrandSlug($internship->post_id), getPostSlug($internship->post_id)]) }}">{{$internship_status[$internship->status]}} </a></div>
                                      @endif
            			            <div class="myinternships_cont"> {{getPostName($internship->post_id)}}</div>
            			          </li>
                                @endforeach

        			        </ul>
                            <a href="{{ URL::route('student_internships')}}" class="seeallapplications_btn">See all applications</a> </div>
                        @else
                            <p class="norecords_sml">You have not applied for any internship yet.</p>
                        @endif
    			    </div>

    			    <div class="notice_feed_list"  data-step="3" data-intro="My Institute" data-position='left'>
    			      <h3>{{ HTML::image('assets/images/newstdnt_img18.png')}} <span>My Institute </span></h3>
    			      <div class="myinstitute_list"><a href="{{URL::route('institution_profile',getInstitutionSlug($student_details->institution_id))}}"> 
    						{{ HTML::image(getImage('uploads/institutions/',getInstitutionLogo($student_details->institution_id),'noimage.jpg'),'',['class'=>'brand_img'])}}  </a>
    			        <div class="updates_txt">{{count($my_institute)}} updates</a> </div>
    			      </div>
    			    </div>


                  <div class="googlead">
                      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

                      <!-- First -->
                      <ins class="adsbygoogle"
                           style="display:block"
                           data-ad-client="ca-pub-3097887502072180"
                           data-ad-slot="3580918951"
                           data-ad-format="auto"></ins>
                      <script>
                          (adsbygoogle = window.adsbygoogle || []).push({});
                      </script>
                  </div>

    			</div>

			</div>

		
        </div>

    </div>

    <!-- Footer Starts here-->
    @include('layouts.footer')
    <!-- Footer Ends here -->

    <div id="stepbystep_regi" class="modal" role="dialog">
        <div class="modal-dialog institutions_modal-dialog stepbystep_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content institutions_modal-content">
                <div class="modal-header stepbystep_header">
                    <!-- <button type="button" class="close" data-dismiss="modal">{{-- HTML::image('assets/images/popup_close.png')--}}</button> -->
                </div>
                <div class="modal-body">

                    <!-- steps page start -->
                    <div class="step_info">
                        <div class="stepbystep_details">
                            <h4>Welcome <span class="stepbystep_user">{{$student_details->name}}</span>,<br/>
                                Lets get some basic things right for you to get the best of IDOAG </h4>  

                            <div class="stepbystep_main">
                                <div id="msform">
										<ul id="progressbar">
										<li class="active">Profile </li>
										<li>Brands</li>
										<li>Institutions</li>
										</ul>
	                                <!-- fieldsets -->
	                                <div class="first_tab fs_tab">

	                                	{{Form::open(['class' => 'form-group profile_form', 'id' => 'profile_form','files' => 'true'])}}
	                                    	
	                                        <h5>Update your profile to help us serve you better</h5>
	                                        <div class="stepprofile_info">
	                                            <div class="stepprofile_left">
	                                                {{ HTML::image('uploads/stepprofileimg.png','',['class' => 'profile_img','id'=>'default_picture']) }}

	                                                 <div class="stepprofile_cnt">
	                                                    <p>
	                										{{ Form::file('upload', ['class' => 'upload', 'id' => 'upload']) }}
	                                                        <a href="" onClick="document.getElementById('upload').click(); return false">{{ HTML::image('assets/images/popupupload_icon.png','',['class' => 'default_img'])}}</a>
	                                                    </p>
	                                                </div>
	                                            </div>
	                                            <div class="stepprofile_right">
	                                                <ul>
                                                        @if($student_details->institution)
	                                                       <li><span> Institution :</span> <span class="inst_txt">{{$student_details->institution}}</span></li>
                                                        @else
                                                            <li><span> Institution :</span> <span class="inst_txt">IDOAG / DUMMY</span></li>
	                                                    @endif

                                                        <li><span> Card Number :</span> <span class="number_txt">{{$student_details->card_number}}</span></li>
	                                                    
                                                        <li><span> Expiry :</span> <span class=" ">{{$user->expiry_date}}</span></li>
	                                                
                                                    </ul>
	                                            </div>
	                                        </div>
    										<div class="form-group">

	                                        {{Form::text('name',$student_details->name,['placeholder' => 'Name', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('email',$student_details->email,['placeholder' => 'Email', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('course',$student_details->course,['placeholder' => 'Course', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

    										<div class="form-group">
	                                        {{Form::text('phone',$user->mobile,['placeholder' => 'Phone', 'class'=>'form-control','required' => 'required'])}}
	                                        </div>

	                                        {{Form::textarea('interests',$student_details->interests,['placeholder' => 'Interests', 'rows'=>2])}}

	                                        {{Form::textarea('aboutme',$student_details->aboutme,['placeholder' => 'About Me', 'rows'=>2])}}
	                                        
	                                        {{Form::submit('Update',['class' => 'update-button update1 action-button'])}}

										{{Form::close()}}

                                        <!--<input type="button" name="next" class="next action-button" value="Skip" />-->
	                                    <div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

	                                <div class="second_tab fs_tab">

	                                	{{Form::open(['class' => 'brand_form', 'files' => 'true'])}}

                                        <h5>Follow the Brands to get relevant offers and opportunities to reach you</h5>
            
                                        <div class="msg_brands" style="color: red; text-align: center;"> </div>   

                                        <div class="select_info">

                                                    <div class="checkbox selectall">
                                                        <span class="selectall_btn active">
                                                        	<em></em><span class="selectall_txt">Selected All</span>
										{{ Form::checkbox('checkall', '', null, ['class' => 'brand_input', 'id'=>'checkall', 'checked']) }}
                                                        </span>
                                                    </div>


                                                </div>
                                        <div class="content">
                                            <div id="content-9" class="brand_scrolling">
                                                
                                                <div class="popup_selectallinfo">

                                                    <div class="popup_selectall">

                                                        @foreach($brands as $brand)

	                                                        @if($brand->id != '69')

		                                                        <div class="checkbox">
		                                                            <div>
                                                                    <span class="brandactive_img active">{{ Form::checkbox('checkall', $brand->id, null, ['class' => 'brand_input brand_input_all', 'id'=>'check_all'.$brand->id, 'checked']) }}</span><span class="select_img"> {{   HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'))}}</span></div>
		                                                        </div>

	                                                        @endif

                                                        @endforeach
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    	{{ Form::submit('Update',['class' => 'update-button update2 action-button']) }}	    

										{{Form::close()}}

                                        <!--<input type="button" name="next" class="next action-button" value="Skip" />-->

                                        <input type="button" name="next" class="back_button" value="Back" />
	                                     <div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

	                                <div class="third_tab fs_tab">

	                                	{{Form::open(['class' => 'inst_form', 'files' => 'true'])}}

	                                        <h5>Follow the Institutions to know latest from the campus</h5>

                                            <div class="msg_insts" style="color: red; text-align: center;"> </div>   

                                            <div class="select_info">

                                                <div class="checkbox selectall">
                                                    <span class="selectall_btn active">
														<em></em> <span class="selectall_txt">Selected All</span>
														{{ Form::checkbox('checkall', '', null, ['class' => 'brand_input', 'id'=>'instcheckall', 'checked']) }}
                                                    </span>
                                                </div>


                                            </div>
	                                        <div class="content">
	                                            <div id="content-8" class="brand_scrolling">

	                                                <div class="popup_selectallinfo">

	                                                    <div class="popup_selectall">

	                                                        @foreach($institutions as $institute)
	                                                            <div class="checkbox">
	                                                                <div>
                                                                    <span class="brandactive_img active">{{ Form::checkbox('instcheckall', $institute->id, null, ['class' => 'inst_input inst_input_all', 'id'=>'check_all'.$institute->id, 'checked' ]) }}</span><span class="select_img"> {{   HTML::image(getImage('uploads/institutions/',$institute->image,'noimage.jpg'))}}</span></div>
	                                                            </div>
	                                                        @endforeach


	                                                    </div>


	                                                </div>


	                                            </div>
	                                        </div>
                                    	{{ Form::submit('Finish',['class' => 'submit action-button update-button update3']) }}	    

	                                    {{Form::close()}}

	                                    <input type="button" name="next" class="back_button" value="Back" />

										<div class="load_info">
											{{   HTML::image('assets/images/loading.gif')}}
	                                    </div>
	                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- steps page end -->
                </div>
            </div>
        </div>
    </div>

<!-- dashstartup popup with idoag -->
@if(!empty($popup))    
    <div id="dashboadstart_popup" class="modal fade" role="dialog">
        
        <div class="modal-dialog dashboadstart_modal-dialog"> 
      
            <!-- Modal content-->
            <div class="modal-content dashboadstart_modal-content">
                
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>
          
                </div>

                <div class="modal-body dashboadstart_modal_body">
                    
                    <div class="dashboadstart_modalpopupimg">
                    
                    @if($popup->url != "")

                        <a href="{{$popup->url}}" target="_blank"> {{ HTML::image('uploads/popup_images/'.$popup->image) }} </a>
                    
                    @else
                        
                        {{ HTML::image('uploads/popup_images/'.$popup->image) }}

                    @endif
                    </div>
                
                </div>
            
            </div>
        </div>
    </div>
@endif
<!-- dashstartup popup with idoag end --> 


@stop

@section('js')

  	{{ HTML::script('assets/js/isotope-docs.min.js') }}
	{{ HTML::script('assets/js/jquery.easing.min.js') }}        
        {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
        {{ HTML::script('assets/js/custom.js') }}
        {{ HTML::script('assets/js/owl.carousel.js') }}
<script>
    $(document).ready(function() {
        var process = true;

        var path = window.location.pathname;

    	var grid_list;

        $(window).load(function(){
      
	        grid_list = $('.photowidget_list').isotope({
					        itemSelector: '.grid-item',
					        layoutMode: 'fitRows',
					        isInitLayout: true, 
					        percentPosition: true,
					        masonry: {
					          columnWidth: 100
					        }
			      		});
    	
        })

        var offset = 1;
        var limit = 8;
        var total = {{gettotalposts()}};
        //console.log(total);

        $(window).scroll(function() {

            if( process && $(window).scrollTop() + $(window).height() > $('.photowidget_list').height()) {
            
                process = false;
                
                offset++;

                if(total > (offset - 1 ) * limit)
                {
                   // alert("ifdd");

                    var data = "&offset="+offset+"&total="+total+"&limit="+limit;
                        
                    $.ajax(
                    {
                        url : '/getRemainingPosts',
                        type: 'POST',
                        data : data,
                        success: function(response) 
                        {
                            if(response)
                            {

                                $('#load_more').fadeOut();
                                $('.photowidget_list').append(response).isotope( 'reloadItems' ).isotope( { sortBy: 'original-order' } );
                            }
                        }
                    }).always(function(){
                            process = true;
                        });
                }  
                else 
                {  // alert("else");
                    $('#load_more').fadeIn();
                    $('#load_more').html('');//message for end of offers
                }
            }
        
        });

		function readURL(input) {
		
			if (input.files && input.files[0]) {
				
				var reader = new FileReader();
		
				reader.onload = function (e) {
					
					$('#default_picture').attr('src', e.target.result).fadeIn('slow');
					
				};
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
		}
		
		$("#upload").change(function(){
			
			readURL(this);
			
		});

    });

</script>

<script>

	var brand = {{count($mybrands)}};

	// console.log(brand);
@if($settings->dashboard_popup==1)

    if(brand == 0)
    {
        $('#stepbystep_regi').modal('show');
    }
    else
    {
        @if(Session::has('popup_first'))
        $('#dashboadstart_popup').modal('show');
        <?php
        Session::forget('popup_first');
        ?>
        @endif
    }
    @endif
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches


    $('#profile_form').formValidation({
      
        framework: 'bootstrap',
                       
        icon: {
          valid: 'glyphicon glyphicon-ok',          
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        
        trigger: 'change',
                  
        fields: {
          
          name: {
            
            validators: {
              
              notEmpty: {
                
                message: 'The Name is required and cannot be empty'
                
              },
              regexp: {
                
                regexp: /^[a-z\s]+$/i,
                
                message: 'The name can consist of alphabetical characters and spaces only'
              }
              
            }
          },
		  
		  email: {
        
            validators: {
              
              notEmpty: {
                
                message: 'The email input is required and cannot be empty'
                
              },
              
              regexp: {
                
                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                
                message: 'The email input is not a valid email address'
                
              }
        
            }
          },          
     
          course: {
            
            validators: {
              
              notEmpty: {
                
                message: 'Course is required and cannot be empty'
                
              }
            }
          },

          phone: {
            
            validators: {
              
              notEmpty: {
                
                message: 'The Mobile Number is required and cannot be empty'
                
              },
              phone: {
                
                country: 'IN',
                
                message: 'The value is not valid India Mobile number'
              },
              
              stringLength: {
              
                min: 8,

                max: 10,
                
                message: 'The Mobile number must be at max 10 digits'
                
              }
            }
          }
         }        
    
    }).on('err.validator.fv', function(e, data) {

        data.element
        .data('fv.messages')
        // Hide all the messages
        .find('.help-block[data-fv-for="' + data.field + '"]').hide()
        // Show only message associated with current validator
        .filter('[data-fv-validator="' + data.validator + '"]').show();

    }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
    
    }).on('success.form.fv', function(e) {

        // Prevent form submission
        e.preventDefault();
     	current_fs = $(this).parents(".fs_tab");
        
        next_fs = $(this).parents(".fs_tab").next();

		var fd          = new FormData($('.profile_form')[0]);

		var other_data  = $('.profile_form').serializeArray();

		$.each(other_data,function(key,input){
		fd.append(input.name,input.value);
		}); 

		$("#msform .load_info").show();

        $.ajax({
            url: '/profile_data',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
				
				$("#msform .load_info").hide();
		       	
		       	if(animating) return false;
		        animating = true;

		        //activate next step on progressbar using the index of next_fs
		        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

		        //show the next fieldset
		       
		        //hide the current fieldset with style
		        current_fs.animate({opacity: 0}, {
		            step: function(now, mx) {
		                //as the opacity of current_fs reduces to 0 - stored in "now"
		                //1. scale current_fs down to 80%
		                scale = 1 - (1 - now) * 0.2;
		                //2. bring next_fs from the right(50%)
		                left = (now * 50)+"%";
		                //3. increase opacity of next_fs to 1 as it moves in
		                opacity = 1 - now;
		                current_fs.css({'transform': 'scale('+scale+')'});
		                next_fs.css({'left': left, 'opacity': opacity});
		            },
		            duration: 800,
		            complete: function(){
		                current_fs.hide();
		                 next_fs.show();
		                animating = false;
		            },
		            //this comes from the custom easing plugin
		            easing: 'easeInOutBack'
		        });
		    }
        });
	
    });


    $(".next").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    
    });

	$(document).on("click","#msform .back_button",function(){

		current_fs = $(this).parents(".fs_tab");
        
        prev_fs = $(this).parents(".fs_tab").prev();

				if(animating) return false;
		        animating = true;

		        //activate next step on progressbar using the index of next_fs
		         $("#progressbar li").removeClass("active");
		         console.log($(this).parents(".fs_tab").index());
		        $("#progressbar li").eq($(this).parents(".fs_tab").index()-2).addClass("active");
		        $("#progressbar li").eq($(this).parents(".fs_tab").index()-2).prev("li").addClass("active");

		        //show the next fieldset
		       
		        //hide the current fieldset with style
		        current_fs.animate({opacity: 0}, {
		            step: function(now, mx) {
		                //as the opacity of current_fs reduces to 0 - stored in "now"
		                //1. scale current_fs down to 80%
		                scale = 1 - (1 - now) * 0.2;
		                //2. bring next_fs from the right(50%)
		                left = (now * 50)+"%";
		                //3. increase opacity of next_fs to 1 as it moves in
		                opacity = 1 - now;
		                current_fs.css({'transform': 'scale('+1+')'});
		                prev_fs.css({'left': left, 'opacity': opacity, 'transform': 'scale('+1+')'});
		            },
		            duration: 800,
		            complete: function(){
		                current_fs.hide();
		                 prev_fs.show();
		                animating = false;
		            },
		            //this comes from the custom easing plugin
		            easing: 'easeInOutBack'
		        });

	});


    $(".previous").click(function(){
        
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    
    });

	$('.brand_form').on('submit', function(e) {
	    
	    e.preventDefault();

  		current_fs = $(this).parents(".fs_tab");
        
        next_fs = $(this).parents(".fs_tab").next();

        var checkValues = $('.brand_input_all:checked').map(function()
        {
            return $(this).val();
        }).get();

        // $.each(checkValues, function(k, v) {
        	console.log(checkValues.length);//console.log (v);
        // });
        if(checkValues.length >= 5)	
        {	
            $('.msg_brands').html('');

    		$("#msform .load_info").show();
            
            $.ajax({
                url: '/brand_data',
                type: 'POST',
                data: { ids: checkValues },

                success: function(response) {

                	$("#msform .load_info").hide();
    				
    				if(animating) return false;
    		        animating = true;

    		        //activate next step on progressbar using the index of next_fs
    		        $("#progressbar li").eq($(".fs_tab").index(next_fs)).addClass("active");

    		        //show the next fieldset
    		       
    		        //hide the current fieldset with style
    		        current_fs.animate({opacity: 0}, {
    		            step: function(now, mx) {
    		                //as the opacity of current_fs reduces to 0 - stored in "now"
    		                //1. scale current_fs down to 80%
    		                scale = 1 - (1 - now) * 0.2;
    		                //2. bring next_fs from the right(50%)
    		                left = (now * 50)+"%";
    		                //3. increase opacity of next_fs to 1 as it moves in
    		                opacity = 1 - now;
    		                current_fs.css({'transform': 'scale('+scale+')'});
    		                next_fs.css({'left': left, 'opacity': opacity});
    		            },
    		            duration: 800,
    		            complete: function(){
    		                current_fs.hide();
    		                 next_fs.show();
    		                animating = false;
    		            },
    		            //this comes from the custom easing plugin
    		            easing: 'easeInOutBack'
    		        });
    		    }
            });
        }
        else
        {
            $('.msg_brands').html('Please Select atleast 5 Brands to follow to view your personalized content.');
        }

   	});

	$('.update3').on('click', function(e) {
	    
	    e.preventDefault();
		
        
        var checkValues = $('.inst_input_all:checked').map(function()
        {
            return $(this).val();
        }).get();

        if(checkValues.length >= 5) 
        {   
            $('.msg_insts').html('');

            $("#msform .load_info").show();

            $.ajax({
                url: '/inst_data',
                type: 'POST',
                data: { ids: checkValues },

                success: function(response) {
                	
                	$("#msform .load_info").hide();
                    
                    $('#stepbystep_regi').hide(); 

                    $('#dashboadstart_popup').modal('show');

                    setTimeout(function(){location.href="/student/dashboard?demo=true"} , 4000);

    		    }
            });
        }
        else
        {
            $('.msg_insts').html('Please Select atleast 5 Institutions to follow to view your personalized content.');
        }
	});
    
    $(".submit").click(function(){
        return false;
    });

    $("#show").click(function(){
        $(".step_info").show();
    });

    $("#content-8").mCustomScrollbar({
        axis:"yx",
        scrollButtons:{enable:true},
        theme:"3d",
        scrollbarPosition:"outside"
    
    });

    $("#content-9").mCustomScrollbar({
        axis:"yx",
        scrollButtons:{enable:true},
        theme:"3d",
        scrollbarPosition:"outside"
    
    });

    $(document).keyup(function(e) {
        if(e.keyCode == 27) { 
            if($("#dashboadstart_popup").hasClass("in") ){

              $("#dashboadstart_popup").hide();
            }
        }
    
    });

    $(document).ready(function(e) {

	    $(document).on('click', '.selectall_btn #checkall', function(e) {				

			if($(this).is(":checked")){ 
				$('.popup_selectall span.brandactive_img').addClass("active");
				$('.popup_selectall span.brandactive_img input').prop("checked", true);
				$(this).parents(".selectall_btn").addClass("active"); 
				$(this).parents(".selectall_btn").find(".selectall_txt").html("Selected All");				 
			}
		
	    });
	    
	    $(document).on('click','.brand_input_all',function(){

	    	var getbrand_id = $(this).attr('id');

	    	//console.log(getbrand_id);

	    	if ($('#'+getbrand_id).prop('checked') == false)
	    	{
	    		//console.log(true);
	    		$('#checkall').prop('checked',false);
	    		$('.selectall .selectall_btn').removeClass("active");
	    		$('.selectall .selectall_btn .selectall_txt').html("Select All");
	    	}
	    	else 
	    	{ 
	    		if($('.brand_input_all:checked').length == $('.brand_input_all').length) 
	    		{
				    $('#checkall').prop('checked',true);
				    $('.selectall .selectall_btn').addClass("active");
				   $('.selectall .selectall_btn .selectall_txt').html("Selected All");
				}

	    	 }

	    });

	    $(document).on('click', '.selectall_btn #instcheckall', function(e) {				

			if($(this).is(":checked")){ 
				$('.popup_selectall span.brandactive_img').addClass("active");
				$('.popup_selectall span.brandactive_img input').prop("checked", true);
				$(this).parents(".selectall_btn").addClass("active"); 
				$(this).parents(".selectall_btn").find(".selectall_txt").html("Selected All");				 
			}
		
	    });

	    $(document).on('click','.inst_input_all',function(){

	    	var getbrand_id = $(this).attr('id');

	    	if ($('#'+getbrand_id).prop('checked') == false){
	    		
	    		$('#instcheckall').prop('checked',false);
	    		$('.selectall .selectall_btn').removeClass("active");
	    		$('.selectall .selectall_btn .selectall_txt').html("Select All");
	    	}
	    	else 
	    	{ 
	    		if($('.inst_input_all:checked').length == $('.inst_input_all').length) 
	    		{
				    $('#instcheckall').prop('checked',true);
				    $('.selectall .selectall_btn').addClass("active");
				    $('.selectall .selectall_btn .selectall_txt').html("Selected All");
				}

	    	 }

	    });
		
		document.getElementById('startButton').onclick = function() {
        introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
          window.location.href = '/student/{{$user->id}}?multipage=true';
        });
      };

    });
	
	$(window).load(function(){
		$('.photowidget_slider').bxSlider({
			auto: true,
			infiniteLoop: true,
			pager:false
		});

        if (RegExp('demo', 'gi').test(window.location.search)) {

            introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
                window.location.href = '/student/{{$user->id}}?multipage=true';
            });
        }
	
    });
</script>
<script>
         $(document).ready(function() {         
            $("#owl-demo").owlCarousel({
               navigation : true,
               autoPlay: 3000,
               pagination : false,
               items : 3,
               itemsDesktop : [1199,3],
               itemsDesktopSmall : [979,1.3],
               itemsTablet : [768,2],
               itemsMobile : [430,1],
               navigationText :["Prev","next"]	
            });
            $("#owl-demo_a").owlCarousel({
               navigation : true,
               autoPlay: 3000,
               pagination : false,
               items : 3,
               itemsDesktop : [1199,3],
               itemsDesktopSmall : [979,1.3],
               itemsTablet : [768,2],
               itemsMobile : [430,1],
               navigationText :["Prev","next"]	
            });
         });      
      </script>
@stop
