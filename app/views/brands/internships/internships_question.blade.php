@extends('layouts.default')
@section('title','Idoag! '.$post->name.' - Internship Application')
<?php error_reporting(0)?>

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}

    @include('brands.partial.color')
    <style>
        .container_info{
            width:100%;
        }
    </style>
@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">

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
                  <div class="inner_div_apply row">
                     <h1>Apply for Internship</h1>
                     <p>Please make sure that you absolutely meet the criteria set by {{$brand->name}} mentioned on the right. An Application once confirmed cannot be taken back.
                        <span class="dfdd row"></span>
                        Please do note that you will be contacting the HR at {{$brand->name}}. Please be courteous, truthful and open. This might affect your career.
                     </p>
                  </div>                   
                  {{Form::open(array('route' => array('post_apply_internship_question', 'slug1' => getBrandSlug($post->brand_id), 'slug2' => getPostSlug($post->id))))}}
                     <div class="parent">
                        <div class="row_brainds">
                           <h1>Brand  Questions</h1>
                           <p>* ALll Questions are manadatory</p>
                        </div>
                        @if($post->question1 != '') 
                            <div class="form_frup">
                               <p>1. {{$post->question1}}</p>
                               <textarea name='answer1' required="true">@if(isset($answers)){{$answers[0]->answer1}}@endif</textarea>
                            </div>
                        @endif
                        @if($post->question2 != '') 
                            <div class="form_frup">
                               <p>2. {{$post->question2}}</p>
                               <textarea name='answer2' required="true">@if(isset($answers)){{$answers[0]->answer2}}@endif</textarea>
                            </div>
                        @endif
                        @if($post->question3 != '') 
                            <div class="form_frup">
                               <p>3. {{$post->question3}}</p>
                               <textarea name='answer3' required="true">@if(isset($answers)){{$answers[0]->answer3}}@endif</textarea>
                            </div>
                        @endif
                        @if($post->question4 != '') 
                            <div class="form_frup">
                               <p>4. {{$post->question4}}</p>
                               <textarea name='answer4' required="true">@if(isset($answers)){{$answers[0]->answer4}}@endif</textarea>
                            </div>
                        @endif
                        @if($post->question5 != '') 
                            <div class="form_frup">
                               <p>5. {{$post->question5}}</p>
                               <textarea name='answer5' required="true">@if(isset($answers)){{$answers[0]->answer5}}@endif</textarea>
                            </div>
                        @endif
                        <button class="bvgp" type="submit">NEXT</button>
                        <div class="clearfix"></div>
                     </div>
                  {{Form::close()}}
               </div>
            </div>
            <div class="col-lg-4 col-md-4 hidden-xs hidden-sm">
               <div class="row_fullsize">
                  <h1>{{$post->name }}  @  {{$brand->name}}</h1>
                  <div class="pade_row">
                     <p>Category:</p>
                     <p>{{$post->category}}</p>
                  </div>
                  <div class="pade_row">
                     <p>Skills Required:</p>
                     <p>{{$post->skills}}</p>
                  </div>
                  <div class="pade_row">
                     <p>Location:</p>
                     <p>{{$post->city}}</p>
                  </div>
                  <div class="pade_row">
                     <p>Application End Date:</p>
                     <p>{{$post->application_date}}</p>
                  </div>
                  <?php $p_type = getPostType($post->id)?>
                  @if($p_type != 'job')
                    <div class="pade_row">
                       <p>Duration:</p>
                       <p>{{getMonths($post->start_date, $post->end_date)}}</p>
                    </div>
                  @endif
                  <div class="pade_row">
                     <p>Number of Positions:</p>
                     <p>{{$post->positions}}</p>
                  </div>
                  <div class="pade_row">                     
                      @if($p_type == 'internship')
                        <p>Stipend:</p>
                      @else
                        <p>Salary:</p>
                      @endif
                     <p><i class="fa fa-inr" aria-hidden="true"></i> {{$post->amount}}/Month</p>
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
{{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}           
@stop
