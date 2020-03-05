@extends('layouts.default')

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
                  <h1>Educational Details</h1>
                  <div class='row_do'>
                     <div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">High School(Xth)</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button1 '></button>
                           </div>
                        </div>
                        {{ Form::model($student, ['method' => 'POST','route' => ['student_educational_details_post', $student->user_id], 'files' => true]) }} 
                        <div class='top_cotent_di1'>
                           <div class="clearfix"></div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Year of Completion</p>
                                    <div class="form-group">
                                       {{ Form::number('highschool_year_comp',$student->highschool_year_comp,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p>Board</p>
                                    <div class="form-group">
                                       {{ Form::text('highschool_board',$student->highschool_board,['class' => 'form-control dfssf']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('highschool_marks',$student->highschool_marks,['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('highschool_marks_obtain',$student->highschool_marks_obtain,['class' => 'width_div dseas', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>School Name</p>
                              {{ Form::text('highschool_name',$student->highschool_name,['class' => 'width_div']) }}
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     <div class='margin_dig'>
                        <div class='row_gn row'></div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">Senior Secondary School(XIIth)</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button2'></button>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class='top_cotent_di2'>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Year of Completion</p>
                                    <div class="form-group">
                                       {{ Form::number('sss_comp',$student->sss_comp,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Board</p>
                                    <div class="form-group">
                                       {{ Form::text('sss_board',$student->sss_board,['class' => 'form-control dfssf']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('sss_marks',$student->sss_marks,['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('sss_marks_obtain',$student->sss_marks_obtain,['class' => 'width_div dseas', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>School Name</p>
                              {{ Form::text('sss_name',$student->sss_name,['class' => 'width_div']) }}
                           </div>
                           <div class='inenr_child row'>
                              <p>Stream</p>
                              {{ Form::text('sss_stream',$student->sss_stream,['class' => 'width_div']) }}
                           </div>
                           <div class='clearfix'></div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     <div class='margin_dig'>
                        <div class='row_gn row'></div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">Diploma Details</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button3'></button>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class='top_cotent_di3'>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Start Year</p>
                                    <div class="form-group">
                                       {{ Form::number('diploma_start',$student->diploma_start,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> End Year</p>
                                    <div class="form-group">
                                       {{ Form::number('diploma_end',$student->diploma_end,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('diploma_marks',$student->diploma_marks,['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('diploma_marks_obtain',$student->diploma_marks_obtain,['class' => 'width_div', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>College Name</p>
                              {{ Form::text('diploma_name',$student->diploma_name,['class' => 'width_div']) }}
                           </div>
                           <div class='inenr_child row'>
                              <p>Stream/Subject</p>
                              {{ Form::text('diploma_stream',$student->diploma_stream,['class' => 'width_div']) }}
                           </div>
                           <div class='clearfix'></div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     <div class='margin_dig'>
                        <div class='row_gn row'></div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">Bachelor Degree Details</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button4'></button>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class='top_cotent_di4'>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Start Year</p>
                                    <div class="form-group">
                                       {{ Form::number('bachelor_start',$student->bachelor_start,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> End Year</p>
                                    <div class="form-group">
                                       {{ Form::number('bachelor_end',$student->bachelor_end,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('bachelor_marks',$student->bachelor_marks,['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('bachelor_marks_obtain',$student->bachelor_marks_obtain,['class' => 'width_div dseas', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>College Name</p>
                              {{ Form::text('bachelor_college',$student->bachelor_college,['class' => 'width_div']) }}
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Degree</p>
                                    <div class="form-group">
                                       {{ Form::text('bachelor_degree',$student->bachelor_degree,['class' => 'width_div']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p>Stream/Subject</p>
                                    <div class="form-group">
                                        {{ Form::text('bachelor_stream',$student->bachelor_stream,['class' => 'form-control dfssf']) }}                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='clearfix'></div>
                        </div>
                        <div class='clearfix'></div>
                     </div>
                     <div class='margin_dig'>
                        <div class='row_gn row'></div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">Master Degree Details</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button5'></button>
                           </div>
                        </div>
                        <div class='top_cotent_di5'>
                           <div class="clearfix"></div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Start Year</p>
                                    <div class="form-group">
                                        {{ Form::number('master_start',$student->master_start,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p>End Year</p>
                                    <div class="form-group">
                                       {{ Form::number('master_end',$student->master_end,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('master_marks',$student->master_marks,['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('master_marks_obtain',$student->master_marks_obtain,['class' => 'width_div dseas', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>University/College Name</p>
                              {{ Form::text('master_college',$student->master_college,['class' => 'width_div']) }}
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Degree</p>
                                    <div class="form-group">
                                        {{ Form::text('master_degree',$student->master_degree,['class' => 'form-control dfssf']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p>Stream/Subject</p>
                                    <div class="form-group">
                                       {{ Form::text('master_stream',$student->master_stream,['class' => 'form-control dfssf']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class='clearfix'></div>
                     </div>
                     <div class='margin_dig'>
                        <div class='row_gn row'></div>
                        <div class="inenr_child_title_row">
                           <div class='inenr_child row '>
                              <p class="list-inline pull-left">Ph. D Details</p>
                              <button type='button' class='divb_aa_remove pull-right dfdf f_button6'></button>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class='top_cotent_di6'>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Start Year</p>
                                    <div class="form-group">
                                       {{ Form::number('phd_start',$student->phd_start,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p>End Year</p>
                                    <div class="form-group">
                                       {{ Form::number('phd_end',$student->phd_end,['class' => 'form-control dfssf', 'max' => date('Y')]) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='row'>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg fdfstret">
                                    <p>Performance/Marks Scale</p>
                                    <div class="form-group">
                                       {{ Form::number('phd_marks',$student->phd_marks, ['class' => 'form-control dfssf', 'max' => '99999']) }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                 <div class="row personal_detail_inenr_child fg">
                                    <p> Performance/Marks obtained</p>
                                    {{ Form::number('phd_marks_obtain',$student->phd_marks_obtain, ['class' => 'width_div dseas', 'max' => '99999']) }}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class='inenr_child row'>
                              <p>University Name</p>
                              {{ Form::text('phd_university',$student->phd_university, ['class' => 'width_div']) }}
                           </div>
                           <div class='inenr_child row'>
                              <p>Stream/Subject</p>
                              {{ Form::text('phd_stream',$student->phd_stream, ['class' => 'width_div']) }}
                           </div>
                        </div>
                     </div>                     
                     <div class='clearfix'></div>
                     <div class='button_div_co row riewsdf'>
                        <div class='button_row'>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <button type="button"><a style="color:inherit" href="{{URL::to('/')}}/student/{{$user->id}}">Previous</a></button>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='rowd'>
                                 <button type="submit">SAVE</button>
                              </div>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <button type="button" class='pull-right'><a style="color:inherit" href="{{URL::to('/')}}/student/professional_details/{{$user->id}}">NEXT</a></button>
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     {{form::close()}}
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

    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}
    {{ HTML::script('assets/plugins/colorpicker/bootstrap-colorpicker.min.js') }}
    {{ HTML::script('assets/js/custom.js') }}   
    
@stop
