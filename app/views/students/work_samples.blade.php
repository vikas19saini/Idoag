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
               <div class='bg_ried page_weihgt'>
                  <h1>Work Samples</h1>
                  <!-- Form start -->
                  
                  {{ Form::model($student, ['method' => 'POST','route' => ['student_work_samples_post', $student->user_id]]) }}
                  
                  <div class='row_do'>
                      
                     <?php                         
                            $data = json_decode($student->work_samples);
                     ?>
                      
                     <div class='inenr_child row'>
                        <p>Blog:</p>
                        {{ Form::hidden('sample_name[]', 'Blog') }}                        
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[0]}}"/>
                     </div>
                     <div class='inenr_child row'>
                        <p>GitHub Link:</p>
                        {{ Form::hidden('sample_name[]', 'GitHub Link') }}
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[1]}}"/>
                     </div>
                     <div class='inenr_child row'>
                        <p>Play Store Developer A/c public Link:</p>
                        {{ Form::hidden('sample_name[]', 'Play Store Developer A/c public Link') }}
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[3]}}"/>
                     </div>
                     <div class='inenr_child row'>
                        <p>Behance Portfolio Link: </p>
                        {{ Form::hidden('sample_name[]', 'Behance Portfolio Link') }}
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[4]}}"/>
                     </div>
                     <div class='inenr_child row'>
                        <p>Dribble Link: </p>
                        {{ Form::hidden('sample_name[]', 'Dribble Link') }}
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[5]}}"/>
                     </div>
                     <div class='inenr_child row'>
                        <p>LinkedIn Link: </p>
                        {{ Form::hidden('sample_name[]', 'LinkedIn Link') }}
                        <input type='text' name='sample_url[]' value="{{$data->sample_url[6]}}"/>
                     </div>
                     
                      @for($i = 7; $i < count($data->sample_name); $i++)
                          <div class='inenr_child row'>
                               <p>{{$data->sample_name[$i]}}: <i class="fa fa-minus-circle" style="color:red;cursor:pointer" aria-hidden="true" onclick="idoag.removeCustomSamples(this)"></i></p>
                                {{ Form::hidden('sample_name[]', $data->sample_name[$i]) }}
                               <input type='text' name='sample_url[]' value="{{$data->sample_url[$i]}}"/>
                          </div>
                      @endfor
                      <div class="add_more_sample_works">                          
                      </div>
                      
                     <div class='clearfix'></div>
                     <div class='inenr_child row dfsddf'>
                        <button type="button" class='divb_aa' onclick="idoag.addMoreWorkSamples()">Add More Links</button>
                     </div>
                     <div class='row_gn row'></div>
                     <div class='button_div_co row'>
                        <div class='button_row'>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type="button"><a style='color:inherit' href='{{URL::to('/')}}/student/professional_details/{{$user->id}}'>Previous</a></button>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='rowd'>
                                 <button type="submit">SAVE</button>
                              </div>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type="button" class='pull-right'><a style='color:inherit' href='{{URL::to('/')}}/student/additional_details/{{$user->id}}'>NEXT</a></button>
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                  </div>
                  {{Form::close()}}
                  <!-- Form close -->
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

    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}
    {{ HTML::script('assets/plugins/colorpicker/bootstrap-colorpicker.min.js') }}
    {{ HTML::script('assets/js/custom.js') }}   
    
@stop
