@extends('layouts.default')
<?php error_reporting(0)?>
@section('title','Update Profile - View, update and manage your profile on IDOAG |idoag.com')

@section('metatags')
    <meta name="keywords" content="Update Profile - View, update and manage your profile on IDOAG |idoag.com" />
    <meta name="description" content="Update Profile - View, update and manage your profile on IDOAG |idoag.com" />
@stop

@section('css')
    {{ HTML::style('assets/css/custom_sonu.css') }}    
    {{ HTML::style('assets/plugins/colorpicker/bootstrap-colorpicker.min.css') }}
@stop

@section('content')
  
    <!-- Content Start Here -->
  	<div class="wrapper">
    
      <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('students.partials.student_profile')
        
        @include('partials.flash')
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
        
        <div class='row row_div_bf_i'>
         <div class='row'>
            <div class='col-lg-2 col-md-2 col-sm-12 col-xs-12'>
               <div class='right_container personal_right onefi'>
                  @include('students.partials.profile_menu')
               </div>
            </div>
            <div class='col-lg-10 col-md-10 col-sm-12 col-xs-12 '>
               <div class='bg_ried professional_detail_bg_ried page_weihgt'>
                  <h1>Addtional Details</h1>
                  {{Form::model($student, ['method' => 'POST','route' => ['student_additional_details_post', $student->user_id]])}}
                  
                  <?php                         
                            $data = json_decode($student->additional_details);
                  ?>
                  
                  <div class='row_do'>
                     <div class='inenr_child row'>
                        <p>Title</p>                        
                        <input type="text" name="title[]" class='width_div' value="{{$data->title[0]}}" required="true">
                     </div>
                     <div class='inenr_child row'>
                        <p>Details </p>
                        <textarea rows='10' name="detail[]" class="with_border" required="true">{{$data->detail[0]}}</textarea>
                     </div>
                      @for($i = 1; $i < count($data->title); $i++)
                      <div class="single_add_detail">
                        <div class='inenr_child row'>
                            <p>Title <i class="fa fa-minus-circle" style="color:red;cursor:pointer" aria-hidden="true" onclick="idoag.removeAdditionalDetails(this)"></i></p>                        
                            <input type="text" name="title[]" class='width_div' value="{{$data->title[$i]}}">
                        </div>
                        <div class='inenr_child row'>
                            <p>Details </p>
                            <textarea rows='10' name="detail[]" class="with_border">{{$data->detail[$i]}}</textarea>
                        </div>
                    </div>
                      @endfor
                      <div class="more_additional_details_add">
                          
                      </div>
                     <div class='inenr_child row'>
                        <button type="button" class='divb_aa' onclick="idoag.addMoreAdditionalDetail()">Add More</button>
                     </div>
                     <div class='row_gn row'></div>
                     <div class='button_div_co row'>
                        <div class='button_row'>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type="button"><a style='color:inherit' href='{{URL::to('/')}}/student/work_samples/{{$user->id}}'>Previous</a></button>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='rowd'>
                                 <button type="submit">SAVE</button>
                              </div>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                  </div>
                  {{Form::close()}}
               </div>
            </div>
      </div>       
    </div>
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->
@stop

@section('js')

    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}
    {{ HTML::script('assets/plugins/colorpicker/bootstrap-colorpicker.min.js') }}
    {{ HTML::script('assets/js/custom.js') }}   
    
@stop
