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
                  <div class="parent">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Personal Info:</h1>                           
                           <a href='{{URL::to('/')}}/student/{{$student->user_id}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="fomr_group">
                           <div class="jesea">
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>NAME:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                 <input type="type" value="{{$student->name}}" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>E-mail:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                 <input type="type" value="{{$student->email}}" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Contact No:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                 <input type="type" value="{{$student->phone_no}}" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>                              
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Date of Birth:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                 <input type="type" value="{{$student->dob}}" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Gender:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                 <input type="type" value="{{$student->gender}}" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Address:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                     <input type="type" value="@if($student->city != '') {{getCity($student->city)}}, @endif {{getState($student->state)}}" disabled="true">
                                 </label>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <p class="dop">About Your Self</p>
                           <p>{{$student->aboutme}}</p>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="parent div_markl">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Education details:</h1>
                           <a href='{{URL::to('/')}}/student/education_details/{{$student->user_id}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="jesea">
                           <div class="fomr_group">
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>High School (Xth):</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">
                                    <div class="">
                                       <input type="type" value="@if($student->highschool_name != ''){{$student->highschool_name}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                       <input type="type" value="@if($student->highschool_year_comp != ''){{$student->highschool_year_comp}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                       <input type="type" value="@if($student->highschool_marks_obtain != '' && $student->highschool_marks != ''){{($student->highschool_marks_obtain * 100)/$student->highschool_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">                                 
                                 </div>
                              </label></div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Senior Secondary (XIIth):</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">
                                    <input type="type" value="@if($student->sss_name != ''){{$student->sss_name}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->sss_comp != ''){{$student->sss_comp}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->sss_marks_obtain != '' && $student->sss_marks != ''){{($student->sss_marks_obtain * 100)/$student->sss_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">                                 
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Diploma:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">                                     
                                    <input type="type" value="@if($student->diploma_name != ''){{$student->diploma_name}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->diploma_stream != ''){{$student->diploma_stream}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->diploma_start != ''){{$student->diploma_start}}@else Not mention @endif @if($student->diploma_end != '')- {{$student->diploma_end}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->diploma_marks_obtain != '' && $student->diploma_marks != ''){{($student->diploma_marks_obtain * 100)/$student->diploma_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">
                                 </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Bachelor Degree:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">
                                    <input type="type" value="@if($student->bachelor_college != ''){{$student->bachelor_college}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->bachelor_degree != ''){{$student->bachelor_degree}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->bachelor_stream != ''){{$student->bachelor_stream}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->bachelor_start != ''){{$student->bachelor_start}}@else Not mention @endif @if($student->bachelor_end != '')- {{$student->bachelor_end}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->bachelor_marks_obtain != '' && $student->bachelor_marks != ''){{($student->bachelor_marks_obtain * 100)/$student->bachelor_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">
                                 </label>
                              </div>                              
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Master Degree:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">
                                    <input type="type" value="@if($student->master_college != ''){{$student->master_college}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->master_degree != ''){{$student->master_degree}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->master_stream != ''){{$student->master_stream}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->master_start != ''){{$student->master_start}}@else Not mention @endif @if($student->master_end != '')- {{$student->master_end}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->master_marks_obtain != '' && $student->master_marks != ''){{($student->master_marks_obtain * 100)/$student->master_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">
                                 </label>
                              </div>                              
                              <div class="clearfix"></div>
                              <div class="form_inner_group">
                                 <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <p>Phd Details:</p>
                                 </label>
                                 <label class="col-lg-8 col-md-8 col-sm-10 col-xs-9 ">
                                    <input type="type" value="@if($student->phd_university != ''){{$student->phd_university}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->phd_stream != ''){{$student->phd_stream}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->phd_start != ''){{$student->phd_start}}@else Not mention @endif @if($student->phd_end != '')- {{$student->phd_end}} @else Not mention @endif" class="pull-right_wd" disabled="true">
                                    <input type="type" value="@if($student->phd_marks_obtain != '' && $student->phd_marks != ''){{($student->phd_marks_obtain * 100)/$student->phd_marks}}% @else Not mention @endif" class="pull-right_wd" disabled="true">
                                 </label>
                              </div>                              
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="parent div_markl">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Professional details:</h1>
                           <a href='{{URL::to('/')}}/student/professional_details/{{$student->user_id}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                         <?php $project_details = json_decode($student->project_details)?>
                        <div class="fomr_group">
                           <div class="form_inner_group">
                              <label class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                 <p>Project Details:</p>
                              </label>
                               <label class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                               @if(count($project_details->project_name) != 0)
                                    @for($i = 0; $i < count($project_details->project_name); $i++)                                        
                                           <input type="type" value="@if($project_details->project_institute_name[$i] != ''){{$project_details->project_institute_name[$i]}}@else Not mention @endif" disabled="true">
                                           <input type="type" value="@if($project_details->project_name[$i] != ''){{$project_details->project_name[$i]}}@else Not mention @endif" disabled="true">
                                           <input type="type" value="@if($project_details->project_duration[$i] != ''){{$project_details->project_duration[$i]}}@else Not mention @endif" disabled="true">
                                           <input type="type" value="@if($project_details->project_guide[$i] != ''){{$project_details->project_guide[$i]}}@else Not mention @endif" disabled="true">                                           
                                           <p>@if($project_details->project_details[$i] != ''){{$project_details->project_details[$i]}}@else Not details found @endif</p>
                                    @endfor
                               @else
                                        <input type="type" value="No details found" disabled="true">
                               @endif
                               </label>
                           </div>
                           <div class="clearfix"></div>
                           <div class="form_inner_group">
                              <label class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                 <p>Internship Details:</p>
                              </label>
                              <label class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  @if(count($project_details->internship_title) != 0)
                                      @for($i = 0; $i < count($project_details->internship_title); $i++)
                                        <input type="type" value="@if($project_details->internship_title[$i] != ''){{$project_details->internship_title[$i]}}@else Not mention @endif" disabled="true">
                                        <input type="type" value="@if($project_details->internship_joining_date[$i] != ''){{$project_details->internship_joining_date[$i]}}@else Not mention @endif - @if($project_details->internship_currently_working[$i] == 'yes') Current @else @if($project_details->internship_leaving_date[$i] != ''){{$project_details->internship_leaving_date[$i]}}@else Not mention @endif @endif" disabled="true">
                                        <input type="type" value="@if($project_details->internship_company_name[$i] != ''){{$project_details->internship_company_name[$i]}}@else Not mention @endif" disabled="true">
                                        <input type="type" value="@if($project_details->internship_location[$i] != ''){{$project_details->internship_location[$i]}}@else Not mention @endif" disabled="true">
                                        <p>@if($project_details->internship_project_details[$i] != ''){{$project_details->internship_project_details[$i]}}@else Not detail found @endif</p>
                                      @endfor
                                   @else
                                        <input type="type" value="No details found" disabled="true">
                                   @endif
                              </label>
                           </div>
                           <div class="clearfix"></div>
                           <div class="form_inner_group">
                              <label class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                 <p>Job Details:</p>
                              </label>
                              <label class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  @if(count($project_details->job_title) != 0)
                                      @for($i = 0; $i < count($project_details->job_title); $i++)
                                        <input type="type" value="@if($project_details->job_title[$i] != ''){{$project_details->job_title[$i]}}@else Not mention @endif" disabled="true">
                                        <input type="type" value="@if($project_details->job_joining_date[$i] != ''){{$project_details->job_joining_date[$i]}}@else Not mention @endif - @if($project_details->job_cureently_working[$i] == 'yes') Current @else @if($project_details->job_leaving_date[$i] != ''){{$project_details->job_leaving_date[$i]}}@else Not mention @endif @endif" disabled="true">
                                        <input type="type" value="@if($project_details->job_company_name[$i] != ''){{$project_details->job_company_name[$i]}}@else Not mention @endif" disabled="true">
                                        <input type="type" value="@if($project_details->job_location[$i] != ''){{$project_details->job_location[$i]}}@else Not mention @endif" disabled="true">
                                        <p>@if($project_details->job_project_details[$i] != ''){{$project_details->job_project_details[$i]}}@else Not detail found @endif</p>
                                      @endfor
                                   @else
                                        <input type="type" value="No details found" disabled="true">
                                   @endif
                              </label>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="parent div_markl">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Additional details:</h1>
                           <a href='{{URL::to('/')}}/student/additional_details/{{$student->user_id}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="fomr_group">
                           <div class="clearfix"></div>
                           <?php $add_d = json_decode($student->additional_details)?>
                           @if(count($add_d->title) != 0)
                               @for($i = 0; $i < count($add_d->title); $i++)
                                    <p class="dop">@if($add_d->title[$i] != ''){{$add_d->title[$i]}}@else Not mention @endif</p>
                                    <p>@if($add_d->detail[$i] != ''){{$add_d->detail[$i]}}@else Not mention @endif</p>
                               @endfor
                           @else
                                <p>No additional details found</p>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="parent div_markl">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Work Samples Links:</h1>
                           <a href='{{URL::to('/')}}/student/work_samples/{{$student->user_id}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="fomr_group">
                           <?php $work_samples = json_decode($student->work_samples)?>
                            @if(count($work_samples->sample_name) != 0)
                                @for($i = 0; $i < count($work_samples->sample_name); $i++)
                                    <div class="form_inner_group">
                                       <label class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                          <p>@if($work_samples->sample_name[$i] != ''){{$work_samples->sample_name[$i]}}@else Not Mention @endif</p>
                                       </label>
                                       <label class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                           @if($work_samples->sample_url[$i] != '')<a target='_blank' href='{{$work_samples->sample_url[$i]}}'>{{$work_samples->sample_url[$i]}}</a>@else Not Mention @endif
                                       </label>
                                    </div>
                                    <div class="clearfix"></div>
                                @endfor
                            @else
                                <p>No data found</p>
                            @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  
                {{ Form::open(['route' => 'internships.store', 'id' => 'internship-form', 'class'=>'form-horizontal', 'files' => 'true']) }}
                {{ Form::hidden('post_id', $post->id) }}
                {{ Form::hidden('name', $loggedin_user->first_name.' '.$loggedin_user->last_name) }}        
                {{ Form::hidden('institution', getInstitutionName($student->institution_id)) }}        
                {{ Form::hidden('course', $student->course) }}
                {{ Form::hidden('phone', $student->phone_no) }}        
                {{ Form::hidden('email', $student->email) }}                  
                {{ Form::hidden('city', $student->city) }}
                {{ Form::hidden('state', $student->state) }}                
                  <div class="clearfix"></div>
                  <div class="parent div_markl">
                     <div class="row_brainds div_gs">
                        <div class="personla_info">
                           <h1 class="">Brand Questions:</h1>
                        </div>
                        <div class="fomr_group">
                           <div class="form_inner_group">
                              <div class="div_weosls">                                 
                                 <ol>
                                    @if($post->question1 != '') 
                                        <li>{{$post->question1}}</li>
                                        <textarea style='width:100%;background: #ebebeb;border:none' required='true' name='answer1'>@if(isset($answers)){{$answers[0]->answer1}}@endif</textarea>
                                    @endif
                                    @if($post->question2 != '') 
                                        <li>{{$post->question2}}</li>
                                        <textarea style='width:100%;background: #ebebeb;border:none' required='true' name='answer2'>@if(isset($answers)){{$answers[0]->answer2}}@endif</textarea>
                                    @endif
                                    @if($post->question3 != '') 
                                        <li>{{$post->question3}}</li>
                                        <textarea style='width:100%;background: #ebebeb;border:none' required='true' name='answer3'>@if(isset($answers)){{$answers[0]->answer3}}@endif</textarea>
                                    @endif
                                    @if($post->question4 != '') 
                                        <li>{{$post->question4}}</li>
                                        <textarea style='width:100%;background: #ebebeb;border:none' required='true' name='answer4'>@if(isset($answers)){{$answers[0]->answer4}}@endif</textarea>
                                    @endif
                                    @if($post->question5 != '') 
                                        <li>{{$post->question5}}</li>
                                        <textarea style='width:100%;background: #ebebeb;border:none' required='true' name='answer5'>@if(isset($answers)){{$answers[0]->answer5}}@endif</textarea>
                                    @endif
                                    @if($post->resume_preference=='Video Resume' ||$post->resume_preference=='Any')
                                        @if($post->resume_preference=='Any')
                                            <li style='list-style:none'>Video Resume or Document Resume is Required</li>
                                            {{Form::file('video_resume',['accept'=>'.mp4,.wmv','class'=>'form-control file_choose', 'paceholder' => 'resume'])}}<br/>
                                            {{Form::text('video_url', null, ['placeholder' => 'Video URL','class' => 'form-control userresume text_choose']) }}<br/>
                                            {{Form::file('resume',['accept'=>'.pdf,.doc, .docx, .rtf','class'=>'userresume file_choose'])}}                                            
                                        @endif
                                        @if($post->resume_preference=='Video Resume')
                                            <li style='list-style:none'>Video Resume is Required</li>
                                            {{Form::file('video_resume',['accept'=>'.mp4,.wmv','class'=>'form-control file_choose', 'paceholder' => 'resume'])}}<br/>
                                            {{Form::text('video_url', null, ['placeholder' => 'Video URL','class' => 'form-control userresume text_choose']) }}
                                        @endif
                                    @else
                                         <li style='list-style:none'>Document resume is required</li>
                                         {{Form::file('resume',['accept'=>'.pdf,.doc, .docx, .rtf','required', 'class'=>'userresume text_choose'])}}
                                    @endif
                                 </ol>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfox"></div>
                  <div class=" div_markl">
                     <div class="clearfix"></div>
                     <div class="par_tee">
                        <div class="clearfix"></div>
                        <p class="">Please tick the box to apply</p>
                        <div class="clearfix"></div>
                        <span class=""> <input type="checkbox" required='true'> 
                        I hereby agree to the T&amp;Cs and authorise IDOAG and/or respective Brand to contact me through email or phone as per the information provided above.
                        </span>
                        <div class="clearfix"></div>
                        <button type='submit' class="bth_o">APPLY</button>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  
                  {{Form::close()}}
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
