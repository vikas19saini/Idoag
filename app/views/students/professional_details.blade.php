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
            <div class='col-lg-10 col-md-10 col-sm-12 col-xs-12'>
               {{Form::model($student, ['method' => 'POST','route' => ['student_professional_details_post', $student->user_id]])}} 
               <div class='bg_ried professional_detail_bg_ried page_weihgt'>
                   <?php $project_details = json_decode($student->project_details)?>
                  <h1>Professional Details</h1>
                  <div class='row_do'>
                     <div class='single_project_detail'>
                     <div class="inenr_child_title_row">
                        <div class='inenr_child row '>
                           <p class="list-inline pull-left">Projects Details</p>
                           <button type="button" class='divb_aa_remove pull-right' onclick='idoag.removeProject(this)'>Remove Projects</button>
                        </div>
                     </div>
                     <div class='inenr_child row '>
                        <p>Project Name</p>
                        <input type="text" name="project_name[]" class='width_div' value='{{$project_details->project_name[0]}}'>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_left'>
                           <p>Duration</p>
                           <input type="text" name="project_duration[]" class='width_div' value='{{$project_details->project_duration[0]}}'>
                        </div>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_right'>
                           <p>Guide/Indtructor Name</p>
                           <input type="text" name="project_guide[]" class='width_div' value='{{$project_details->project_guide[0]}}'>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='inenr_child row'>
                        <p>Institute Name</p>
                        <input type="text" name="project_institute_name[]" class='width_div' value='{{$project_details->project_institute_name[0]}}'>
                     </div>
                     <div class='inenr_child row'>
                        <p>Project Details </p>
                        <textarea rows='10' name="project_details[]" class="with_border">{{$project_details->project_details[0]}}</textarea>
                     </div>
                     </div>
                     @for($i = 1; $i < count($project_details->project_name); $i++)
                     
                     <div class='single_project_detail'>
                         <div class="inenr_child_title_row">
                           <div class='inenr_child row '>                              
                              <button type="button" class='divb_aa_remove pull-right' onclick='idoag.removeProject(this)'>Remove Projects</button>
                           </div>
                        </div>
                        <div class='inenr_child row '>
                           <p>Project Name</p>
                           <input type="text" name="project_name[]" class='width_div' value='{{$project_details->project_name[$i]}}'>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child_left'>
                              <p>Duration</p>
                              <input type="text" name="project_duration[]" class='width_div' value='{{$project_details->project_duration[$i]}}'>
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child_right'>
                              <p>Guide/Indtructor Name</p>
                              <input type="text" name="project_guide[]" class='width_div' value='{{$project_details->project_guide[$i]}}'>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class='inenr_child row'>
                           <p>Institute Name</p>
                           <input type="text" name="project_institute_name[]" class='width_div' value='{{$project_details->project_institute_name[$i]}}'>
                        </div>
                        <div class='inenr_child row'>
                           <p>Project Details </p>
                           <textarea rows='10' name="project_details[]" class="with_border">{{$project_details->project_details[$i]}}</textarea>
                        </div>
                     </div>
                     
                     @endfor
                     
                     <div class="add_more_projects"></div>
                     
                     <div class='inenr_child row'>
                        <button type="button" class='divb_aa' onclick="idoag.addproject()">Add Project</button>
                     </div>
                     
                        
                        
                     <div class="row_gn row"></div>
                     <div class='single_internship'>
                     <div class="inenr_child_title_row">
                        <div class='inenr_child row '>
                           <p class="list-inline pull-left">Internship Details</p>
                           <button class='divb_aa_remove pull-right' onclick='idoag.removeInternship(this)'>Remove Internship</button>
                        </div>
                     </div>
                     <div class='inenr_child row '>
                        <p>Profile/Job Title</p>
                        <input type="text" name='internship_title[]' class='width_div' value='{{$project_details->internship_title[0]}}'>
                     </div>
                     <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>
                        <div class="personal_detail_inenr_child_left">
                           <div class='row  personal_detail_inenr_child'>
                              <p>Joining Date</p>
                              <div class="form-group">
                                  <input type='date' name='internship_joining_date[]' class="form-control" value='{{$project_details->internship_joining_date[0]}}' />
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class="personal_detail_inenr_child_right">
                           <div class='row  personal_detail_inenr_child'>
                              <p>Leaving Date</p>
                              <div class="form-group">
                                 <input type='date' name='internship_leaving_date[]' class="form-control" value='{{$project_details->internship_leaving_date[0]}}' />
                              </div>
                              <input type="hidden" name="internship_currently_working[]" value="@if($project_details->internship_currently_working[0] != ''){{$project_details->internship_currently_working[0]}}@else{{no}}@endif">
                              <div class="xcxc"><input onclick='idoag.jobCurrentWorking(this)' type="checkbox" class="list-inline" @if($project_details->internship_currently_working[0] == 'yes') checked @endif><span class="list-inline"><b>Currently working here</b></span></label></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_left'>
                           <p>Company Name</p>
                           <input type="text" name='internship_company_name[]' class='width_div' value='{{$project_details->internship_company_name[0]}}'>
                        </div>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_right'>
                           <p>Location</p>
                           <input type="text" name='internship_location[]' class='width_div' value='{{$project_details->internship_location[0]}}'>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='inenr_child row'>
                        <p>Project Details </p>
                        <textarea rows='10' name='internship_project_details[]' class="with_border">{{$project_details->internship_project_details[0]}}</textarea>
                     </div>
                  </div>
                     
                     @for($i = 1; $i < count($project_details->internship_title); $i++)                     
                            <div class='single_internship'>
                            <div class="inenr_child_title_row">
                               <div class='inenr_child row '>                                  
                                  <button class='divb_aa_remove pull-right' onclick='idoag.removeInternship(this)'>Remove Internship</button>
                               </div>
                            </div>
                            <div class='inenr_child row '>
                               <p>Profile/Job Title</p>
                               <input type="text" name='internship_title[]' class='width_div' value='{{$project_details->internship_title[$i]}}'>
                            </div>
                            <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>
                               <div class="personal_detail_inenr_child_left">
                                  <div class='row  personal_detail_inenr_child'>
                                     <p>Joining Date</p>
                                     <div class="form-group">
                                         <input type='date' name='internship_joining_date[]' class="form-control" value='{{$project_details->internship_joining_date[$i]}}' />
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class="personal_detail_inenr_child_right">
                                  <div class='row  personal_detail_inenr_child'>
                                     <p>Leaving Date</p>
                                     <div class="form-group">
                                        <input type='date' name='internship_leaving_date[]' class="form-control" value='{{$project_details->internship_leaving_date[$i]}}' />
                                     </div>
                                     <input type="hidden" name="internship_currently_working[]" value="@if($project_details->internship_currently_working[$i] != ''){{$project_details->internship_currently_working[$i]}}@else{{no}}@endif">
                                     <div class="xcxc"><input onclick='idoag.jobCurrentWorking(this)' type="checkbox" class="list-inline" @if($project_details->internship_currently_working[$i] == 'yes') checked @endif><span class="list-inline"><b>Currently working here</b></span></label></div>                                     
                                  </div>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class='row personal_detail_inenr_child_left'>
                                  <p>Company Name</p>
                                  <input type="text" name='internship_company_name[]' class='width_div' value='{{$project_details->internship_company_name[$i]}}'>
                               </div>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class='row personal_detail_inenr_child_right'>
                                  <p>Location</p>
                                  <input type="text" name='internship_location[]' class='width_div' value='{{$project_details->internship_location[$i]}}'>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class='inenr_child row'>
                               <p>Project Details </p>
                               <textarea rows='10' name='internship_project_details[]' class="with_border">{{$project_details->internship_project_details[$i]}}</textarea>
                            </div>
                         </div>						 
                     @endfor
                     
                     <div class='add_more_internships'></div>
                     
                     <div class='inenr_child row'>
                        <button class='divb_aa' type='button' onclick='idoag.addInternships()'>Add Internships</button>
                     </div>
                     
                     <div class="row_gn row"></div>
                     <div class='single_job_display'>
                     <div class="inenr_child_title_row">
                        <div class='inenr_child row '>
                           <p class="list-inline pull-left">Jobs Details</p>
                           <button type='button' class='divb_aa_remove pull-right' onclick='idoag.removeJob(this)'>Remove Jobs</button>
                        </div>
                     </div>
                     <div class='inenr_child row '>
                        <p>Profile/Job Title</p>
                        <input type="text" name='job_title[]' class='width_div' value='{{$project_details->job_title[0]}}'>
                     </div>
                     <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>
                        <div class="personal_detail_inenr_child_left">
                           <div class='row  personal_detail_inenr_child'>
                              <p>Joining Date</p>
                              <div class="form-group">
                                 <input type='date' name='job_joining_date[]' class="form-control" value='{{$project_details->job_joining_date[0]}}' />
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class="personal_detail_inenr_child_right">
                           <div class='row  personal_detail_inenr_child'>
                              <p>Leaving Date</p>
                              <div class="form-group">
                                 <input type='date' name='job_leaving_date[]' class="form-control" value='{{$project_details->job_leaving_date[0]}}' />
                              </div>
                              <input type="hidden" name="job_cureently_working[]" value="@if($project_details->job_cureently_working[0] != ''){{$project_details->job_cureently_working[0]}}@else{{no}}@endif">
                              <div class="xcxc"><input onclick='idoag.jobCurrentWorking(this)' type="checkbox" class="list-inline" @if($project_details->job_cureently_working[0] == 'yes') checked @endif><span class="list-inline"><b>Currently working here</b></span></label></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_left'>
                           <p>Company Name</p>
                           <input type="text" name='job_company_name[]' class='width_div' value='{{$project_details->job_company_name[0]}}'>
                        </div>
                     </div>
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child_right'>
                           <p>Location</p>
                           <input type="text" name='job_location[]' class='width_div' value='{{$project_details->job_location[0]}}'>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='inenr_child row'>
                        <p>Project Details </p>
                        <textarea rows='10' name='job_project_details[]' class="with_border">{{$project_details->job_project_details[0]}}</textarea>
                     </div>
                     </div>
                       
                     @for($i = 1; $i < count($project_details->job_title); $i++)
                     
                        <div class='single_job_display'>
                            <div class="inenr_child_title_row">
                               <div class='inenr_child row'>                                  
                                  <button type='button' class='divb_aa_remove pull-right' onclick='idoag.removeJob(this)'>Remove Jobs</button>
                               </div>
                            </div>
                            <div class='inenr_child row '>
                               <p>Profile/Job Title</p>
                               <input type="text" name='job_title[]' class='width_div' value='{{$project_details->job_title[$i]}}'>
                            </div>
                            <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>
                               <div class="personal_detail_inenr_child_left">
                                  <div class='row  personal_detail_inenr_child'>
                                     <p>Joining Date</p>
                                     <div class="form-group">
                                        <input type='date' name='job_joining_date[]' class="form-control" value='{{$project_details->job_joining_date[$i]}}' />
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class="personal_detail_inenr_child_right">
                                  <div class='row  personal_detail_inenr_child'>
                                     <p>Leaving Date</p>
                                     <div class="form-group">
                                        <input type='date' name='job_leaving_date[]' class="form-control" value='{{$project_details->job_leaving_date[$i]}}' />
                                     </div>
                                     <input type="hidden" name="job_cureently_working[]" value="@if($project_details->job_cureently_working[0] != ''){{$project_details->job_cureently_working[$i]}}@else{{no}}@endif">
                                     <div class="xcxc"><input onclick='idoag.jobCurrentWorking(this)' type="checkbox" class="list-inline" @if($project_details->job_cureently_working[$i] == 'yes') checked @endif><span class="list-inline"><b>Currently working here</b></span></label></div>
                                  </div>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class='row personal_detail_inenr_child_left'>
                                  <p>Company Name</p>
                                  <input type="text" name='job_company_name[]' class='width_div' value='{{$project_details->job_company_name[$i]}}'>
                               </div>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                               <div class='row personal_detail_inenr_child_right'>
                                  <p>Location</p>
                                  <input type="text" name='job_location[]' class='width_div' value='{{$project_details->job_location[$i]}}'>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class='inenr_child row'>
                               <p>Project Details </p>
                               <textarea rows='10' name='job_project_details[]' class="with_border">{{$project_details->job_project_details[$i]}}</textarea>
                            </div>
                        </div>
                        
                     @endfor
                       
                     <div class='add_more_jobs'></div>
                     
                     <div class='inenr_child row'>
                        <button type='button' onclick='idoag.addMoreJobs()' class='divb_aa'>Add Jobs</button>
                     </div>
                     <div class='row_gn row'></div>
                     <div class='button_div_co row'>
                        <div class='button_row'>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type='button'><a style='color:inherit' href='{{URL::to('/')}}/student/education_details/{{$user->id}}'>Previous</a></button>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='rowd'>
                                 <button type='submit'>SAVE</button>
                              </div>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type='button' class='pull-right'><a style='color:inherit' href='{{URL::to('/')}}/student/work_samples/{{$user->id}}'>NEXT</a></button>
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>                  
		</div>
                     
                  {{Form::close()}}
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
