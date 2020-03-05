@extends('layouts.default')
<?php error_reporting(0)?>
@section('title','Internship - '.$single->name.' from '.$brand->name.' |idoag.com')

@section('metatags')
    <meta name="keywords" content="Internship - {{$single->name}} from {{$brand->name}} |idoag.com"/>
    <meta name="description" content="Internship - {{$single->name}} from {{$brand->name}} |idoag.com"/>
@stop

@section('css')
    @include('brands.partial.color')
    <style>
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

        <div class="row_active row">
         <div class="container">
            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
               <div class="active_rowdd">
                  <div class="inner_div_apply row row_difa">
                     <div class="child_1">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                           <h1 class="jp_classi">{{$single->name}}</h1>
                        </div>
                         <?php $p_type = getPostType($single->id)?>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">                            
                           @if($single->status == 0 || $single->application_date < date('Y-m-d'))
                                    <button class="hidden-xs hidden-sm">EXPIRED</button>
                           @elseif($user_group == 'Students')
                                    @if(IsUserApplied($single->id))
                                        <button class="hidden-xs hidden-sm"><i class="fa fa-check-circle-o" aria-hidden="true"></i> APPLIED</button>
                                    @else                                    
                                        @if(($single->question1 != '') || ($single->question2 != '') || ($single->question3 != '') || ($single->question4 != '') || ($single->question5 != ''))
                                            <a href='{{ URL::route('apply_internship_question',array('slug1' => $brand->slug, 'slug2' => $single->slug))}}'>
                                        @else
                                            <a href='{{ URL::route('apply_internship',array('slug1' => $brand->slug, 'slug2' => $single->slug))}}'>
                                        @endif
                                            <button class="hidden-xs hidden-sm">APPLY</button>
                                        </a>
                                    @endif
                                @endif
                        </div>
                     </div>                      
                     <div class="clearfix"></div>
                     <div class="div_ress">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                           <div class="row_pp">
                              <p>Location:</p>
                              <p>{{$single->city}}</p>
                           </div>
                           <div class="row_pp">
                              <p>Category/Industry:</p>
                              <p>{{Str::title($single->category)}}</p>
                           </div>
                           <div class="row_pp">
                               @if($p_type == 'internship')
                                    <p>Stipend:</p>
                               @else
                                    <p>Salary:</p>
                               @endif
                              <p><i class="fa fa-inr" aria-hidden="true"></i> @if($single->amount!=0){{$single->amount}}/Month @else No @endif</p>
                           </div>
                           <div class="row_pp  hidden-xs hidden-sm">
                              <p>No. of Positions:</p>
                              <p>{{$single->positions}}</p>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                           <div class="pull-right">
                              <div class="row_pp">
                                 <p>Starts</p>
                                 <p>{{$single->start_date}}</p>
                              </div>
                              @if($p_type == 'internship') 
                                <div class="row_pp">
                                   <p>Duration :</p>
                                   <p>{{getMonths($single->start_date, $single->end_date)}}</p>
                                </div>
                              @endif
                              <div class="row_pp">
                                 <p>Apply By:</p>
                                 <p>{{$single->application_date}}</p>
                              </div>
                              <div class="row_pp hidden-xs hidden-sm">
                                 <p>Resume Type:</p>
                                 <p>{{$single->resume_preference}}</p>
                              </div>
                              <div class="row_pp  hidden-lg hidden-md">
                                 <p>No. of Positions:</p>
                                 <p>2</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     @if($single->description != '')
                        <div class="dig_rg">
                           <h1 class="diwu">ROLE DESCRIPTION:</h1>
                           <div class="row_kg">
                               {{$single->description}}
                           </div>
                        </div>
                     @endif
                     
                     @if($single->skills != '')
                        <div class="dig_rg">
                           <h1 class="diwu">SKILLS REQUIRED:</h1>
                           <div class="row_kg">
                              <ul>
                                  <?php $skills = explode(',', $single->skills)?>
                                  @for($i = 0; $i < count($skills); $i++)
                                    <li>{{$skills[$i]}}</li>
                                  @endfor
                              </ul>
                           </div>
                        </div>
                     @endif
                     <div class="dig_rg">
                        @if(getBrandDescription($single->brand_id) != '')
                            <h1 class="diwu">ABOUT COMPANY:</h1>
                            <div class="row_kg">
                                <p>{{getBrandDescription($single->brand_id)}}</p>
                            </div>
                        @endif
                        <div class="clearfix"></div>                        
                        <div class="button_dic">
                            <?php $np = gerNextPrevPost($single->id)?>                            
                           <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
                               @if(count($np['prev']) != 0)
                                  <a href='{{ URL::route('internship_details',array('slug1' => getBrandSlug($np['prev'][0]->brand_id), 'slug2' => $np['prev'][0]->slug ))}}'><button class="pull-left"><i class="fa fa-arrow-left"></i> PREVIOUS</button></a>
                               @endif
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                               @if($single->status==0 || $single->application_date < date('Y-m-d'))
                                    <button class="dds">EXPIRED</button>
                                @elseif($user_group == 'Students')
                                    @if(IsUserApplied($single->id))
                                        <button class="dds"><i class="fa fa-check-circle-o" aria-hidden="true"></i> APPLIED</button>
                                    @else
                                        @if(($single->question1 != '') || ($single->question2 != '') || ($single->question3 != '') || ($single->question4 != '') || ($single->question5 != ''))
                                            <a href='{{ URL::route('apply_internship_question',array('slug1' => $brand->slug, 'slug2' => $single->slug))}}'>
                                        @else
                                            <a href='{{ URL::route('apply_internship',array('slug1' => $brand->slug, 'slug2' => $single->slug))}}'>
                                        @endif
                                            <button class="dds">APPLY</button>
                                        </a>
                                    @endif
                                @endif                               
                           </div>
                           <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
                               @if(count($np['next']) != 0)
                                    <a href='{{ URL::route('internship_details',array('slug1' => getBrandSlug($np['next'][0]->brand_id), 'slug2' => $np['next'][0]->slug ))}}'><button class="pull-right">NEXT <i class="fa fa-arrow-right"></i> </button></a>
                               @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-4 hidden-xs hidden-sm">
               <div class="row_fullsize border_dia">
                  <div class="bg_ddsl">
                     <h1>FEEDBACK/NOTE</h1>
                     {{ Form::open(array('id' => 'notesform')) }}
                     {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}
                     {{ Form::button('SUBMIT',['class'=>'submit_feed_button', 'type' => 'submit']) }}
                     {{ Form::close() }}                     
                  </div>
                   <br>
                   @include('partials.ad')
               </div>
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
    <script>
        $(function () {
            var ww = $(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww);

            $(window).resize(function () {
                var ww2 = $(window).innerWidth();
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

        });
    </script>

@stop
