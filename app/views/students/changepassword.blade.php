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
                  <h1>Change Password</h1>
                  {{Form::model($user, ['method' => 'POST','route' => ['student_changepassword_post', $user->id]])}}
                  
                  <div class='row_do'>
                     <div class='inenr_child row'>
                        <p>Email Address</p>                        
                        <input type="email" name="email" class='width_div' value="{{$user->email}}" required="true" readonly="true">
                     </div>
                     <div class='inenr_child row'>
                        <p>Old Password</p>                        
                        <input type="password" name="old_password" class='width_div' required="true">
                     </div>
                     <div class='inenr_child row'>
                        <p>New Password</p>                        
                        <input type="password" name="new_password" class='width_div' required="true">
                     </div>
                     <div class='button_div_co row'>
                        <div class='button_row'>
                           <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                              <div class='rowd'>
                                 <button type="submit">SAVE</button>
                              </div>
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
