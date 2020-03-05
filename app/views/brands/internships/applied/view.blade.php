@extends('layouts.default')

@section('title','Internship Application - '.$brand->name )

@section('css')

    {{HTML::style('packages/summernote/summernote.css')}}

    @include('brands.partial.color')

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

        <div class="brandoffer_info">
            <div class="container_info">
                <div class="intershipapp_details">
                    <div class="intershipapp_list ">
                        <?php $post_t = getPostType($internship->post_id)?>
                    <h3 class="note_img2">{{ HTML::image('assets/images/stdntrecentupdates_img2.png') }} <span>{{strtoupper($post_t)}} Application</span>
                    <a href="@if($user_group == 'Students'){{ URL::route('student_internships')}} @else {{route('internships_applied',$brand->slug)}} @endif" class="fr import_btn" >&laquo;Back </a> </h3>


                        <div class="row">
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <div class="intershipapp_listlft intershipapp_part">
                                    <div class="row">
                                        <div class="alert alert-success hide  avilablestatus">
                                            <span></span>
                                            <a class="close">&times;</a>
                                        </div>
                                        <div class="alert alert-danger hide avilablestatus2">
                                            <span></span>
                                            <a class="close">&times;</a>
                                        </div>
                                    </div>

                                    @if(isset($loggedin_user)  && $loggedin_user->brand_id == $internship->post->brand_id)
                                    <div class="m20">
                                   <div class="row">
                                       <div class="col-md-3 col-sm-3 col-xs-12">Change Status :</div>
                                       <div class="col-md-3 col-sm-3 col-xs-12">
                                    {{ Form::select('status', $internship_status, $internship->status, ['class' => 'form-control','id'=>'internship_status']) }}
                                           </div>
                                       <div class="col-md-3 col-sm-3 col-xs-12"> <a onclick="changeInternshipStatus()" class="btn btn-default filter_btn">Update</a></div>
                                    </div></div>
                                    @endif

                                    <div class="intershipapp_section">  {{$internship->post->deleted_at}}
                                        <h4>Student Info <span>Status : <i class="intn_status">@if($internship->post->status==0)Expired @else {{ $internship_status[$internship->status]}}@endif</i></span></h4>
                                        <ul>
                                            <li><span>Student Name:</span><span>{{ $student->name}}</span></li>
                                            <li><span>Institution Name:</span><span>{{ $student->institution }}</span></li>
                                            <li><span>Course:</span><span>{{$student->course}}</span></li>
                                            <li><span>Phone:</span><span>{{$student->phone_no}}</span></li>
                                            <li><span>Email:</span><span>{{$student->email}}</span></li>
                                            <li><span>Date of Birth:</span><span>{{$student->dob}}</span></li>
                                            <li><span>Gender:</span><span>{{$student->gender}}</span></li>
                                            <li><span>Address:</span><span>@if($student->city != '') {{getCity($student->city)}}, @endif {{getState($student->state)}}</span></li>
                                            <li><span>About:</span><span>{{$student->aboutme}}</span></li>
                                        </ul>
                                    </div>

                                    <div class="intershipapp_section">
                                        <h4>Educational Details:</h4>                                        
                                        <ul>
                                            <li>High school details</li>
                                            <li><span>School name:</span><span> @if($student->highschool_name != ''){{$student->highschool_name}} @else Not mention @endif</span></li>
                                            <li><span>Completion year:</span><span> @if($student->highschool_year_comp != ''){{$student->highschool_year_comp}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span> @if($student->highschool_marks_obtain != '' && $student->highschool_marks != ''){{($student->highschool_marks_obtain * 100)/$student->highschool_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                        <ul>
                                            <li>Senior secondary school details</li>
                                            <li><span>School name:</span><span> @if($student->sss_name != ''){{$student->sss_name}} @else Not mention @endif</span></li>
                                            <li><span>Completion year:</span><span> @if($student->sss_comp != ''){{$student->sss_comp}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span> @if($student->sss_marks_obtain != '' && $student->sss_marks != ''){{($student->sss_marks_obtain * 100)/$student->sss_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                        <ul>
                                            <li>Diploma details</li>
                                            <li><span>Name:</span><span> @if($student->diploma_name != ''){{$student->diploma_name}} @else Not mention @endif</span></li>
                                            <li><span>Stream:</span><span> @if($student->diploma_stream != ''){{$student->diploma_stream}} @else Not mention @endif</span></li>
                                            <li><span>Duration:</span><span> @if($student->diploma_start != ''){{$student->diploma_start}}@else Not mention @endif @if($student->diploma_end != '')- {{$student->diploma_end}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span> @if($student->diploma_marks_obtain != '' && $student->diploma_marks != ''){{($student->diploma_marks_obtain * 100)/$student->diploma_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                        <ul>
                                            <li>Bachelor degree details</li>
                                            <li><span>College name:</span><span>@if($student->bachelor_college != ''){{$student->bachelor_college}} @else Not mention @endif</span></li>
                                            <li><span>Degree name:</span><span>@if($student->bachelor_degree != ''){{$student->bachelor_degree}} @else Not mention @endif</span></li>
                                            <li><span>Stream:</span><span>@if($student->bachelor_stream != ''){{$student->bachelor_stream}} @else Not mention @endif</span></li>
                                            <li><span>Duration:</span><span>@if($student->bachelor_start != ''){{$student->bachelor_start}}@else Not mention @endif @if($student->bachelor_end != '')- {{$student->bachelor_end}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span>@if($student->bachelor_marks_obtain != '' && $student->bachelor_marks != ''){{($student->bachelor_marks_obtain * 100)/$student->bachelor_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                        <ul>
                                            <li>Master degree details</li>
                                            <li><span>College name:</span><span>@if($student->master_college != ''){{$student->master_college}} @else Not mention @endif</span></li>
                                            <li><span>Degree name:</span><span>@if($student->master_degree != ''){{$student->master_degree}} @else Not mention @endif</span></li>
                                            <li><span>Stream:</span><span>@if($student->master_stream != ''){{$student->master_stream}} @else Not mention @endif</span></li>
                                            <li><span>Duration:</span><span>@if($student->master_start != ''){{$student->master_start}}@else Not mention @endif @if($student->master_end != '')- {{$student->master_end}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span>@if($student->master_marks_obtain != '' && $student->master_marks != ''){{($student->master_marks_obtain * 100)/$student->master_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                        <ul>
                                            <li>Phd details</li>
                                            <li><span>University name:</span><span>@if($student->phd_university != ''){{$student->phd_university}} @else Not mention @endif</span></li>
                                            <li><span>Stream:</span><span>@if($student->phd_stream != ''){{$student->phd_stream}} @else Not mention @endif</span></li>
                                            <li><span>Duration:</span><span>@if($student->phd_start != ''){{$student->phd_start}}@else Not mention @endif @if($student->phd_end != '')- {{$student->phd_end}} @else Not mention @endif</span></li>
                                            <li><span>Obtain marks:</span><span>@if($student->phd_marks_obtain != '' && $student->phd_marks != ''){{($student->phd_marks_obtain * 100)/$student->phd_marks}}% @else Not mention @endif</span></li>
                                        </ul>
                                    </div>
                                    <?php $project_details = json_decode($student->project_details)?>
                                    <div class="intershipapp_section">
                                        <h4>Professional details:</h4>
                                        <ul>
                                            @if(count($project_details->project_name) != 0)
                                                @for($i = 0; $i < count($project_details->project_name); $i++)
                                                    <li>Project Details</li>
                                                    <li><span>Institute name:</span><span>@if($project_details->project_institute_name[$i] != ''){{$project_details->project_institute_name[$i]}}@else Not mention @endif</span></li>
                                                    <li><span>Project name:</span><span>@if($project_details->project_name[$i] != ''){{$project_details->project_name[$i]}}@else Not mention @endif</span></li>
                                                    <li><span>Duration:</span><span>@if($project_details->project_duration[$i] != ''){{$project_details->project_duration[$i]}}@else Not mention @endif</span></li>
                                                    <li><span>Guide:</span><span>@if($project_details->project_guide[$i] != ''){{$project_details->project_guide[$i]}}@else Not mention @endif</span></li>
                                                    <p>@if($project_details->project_details[$i] != ''){{$project_details->project_details[$i]}}@else Not details found @endif</p>
                                                @endfor
                                           @else
                                                <li><span>Project details: </span><span>No details found</span></li>
                                           @endif                                            
                                        </ul>
                                        <ul>
                                            @if(count($project_details->internship_title) != 0 && $project_details->internship_title[0] != '')
                                                @for($i = 0; $i < count($project_details->internship_title); $i++)
                                                  <li>Internship details</li>
                                                  <li><span>Title:</span><span>@if($project_details->internship_title[$i] != ''){{$project_details->internship_title[$i]}}@else Not mention @endif</span></li>
                                                  <li><span>Duration:</span><span>@if($project_details->internship_joining_date[$i] != ''){{$project_details->internship_joining_date[$i]}}@else Not mention @endif - @if($project_details->internship_currently_working[$i] == 'yes') Current @else @if($project_details->internship_leaving_date[$i] != ''){{$project_details->internship_leaving_date[$i]}}@else Not mention @endif @endif</span></li>
                                                  <li><span>Company name:</span><span>@if($project_details->internship_company_name[$i] != ''){{$project_details->internship_company_name[$i]}}@else Not mention @endif</span></li>
                                                  <li><span>Location:</span><span>@if($project_details->internship_location[$i] != ''){{$project_details->internship_location[$i]}}@else Not mention @endif</span></li>
                                                  <p>@if($project_details->internship_project_details[$i] != ''){{$project_details->internship_project_details[$i]}}@else Not detail found @endif</p>
                                                @endfor
                                             @else
                                                  <li><span>Internship details </span><span>No details found</span></li>
                                             @endif
                                        </ul>
                                        <ul>
                                            @if(count($project_details->job_title) != 0 && $project_details->job_title[0] != '')
                                                @for($i = 0; $i < count($project_details->job_title); $i++)
                                                  <li>Job details</li>
                                                  <li><span>Title:</span><span>@if($project_details->job_title[$i] != ''){{$project_details->job_title[$i]}}@else Not mention @endif</span></li>
                                                  <li><span>Title:</span><span>@if($project_details->job_joining_date[$i] != ''){{$project_details->job_joining_date[$i]}}@else Not mention @endif - @if($project_details->job_cureently_working[$i] == 'yes') Current @else @if($project_details->job_leaving_date[$i] != ''){{$project_details->job_leaving_date[$i]}}@else Not mention @endif @endif</span></li>
                                                  <li><span>Title:</span><span>@if($project_details->job_company_name[$i] != ''){{$project_details->job_company_name[$i]}}@else Not mention @endif</span></li>
                                                  <li><span>Title:</span><span>@if($project_details->job_location[$i] != ''){{$project_details->job_location[$i]}}@else Not mention @endif</span></li>
                                                  <p>@if($project_details->job_project_details[$i] != ''){{$project_details->job_project_details[$i]}}@else Not detail found @endif</p>
                                                @endfor
                                             @else
                                             <li><span>Job details </span><span>No details found</span></li>
                                             @endif
                                        </ul>                                            
                                    </div>
                                    <?php $add_d = json_decode($student->additional_details)?>
                                    <div class="intershipapp_section">
                                        <h4>Additional details:</h4>
                                        <ul>
                                            @if(count($add_d->title) != 0)
                                                @for($i = 0; $i < count($add_d->title); $i++)
                                                    <li><span>@if($add_d->title[$i] != ''){{$add_d->title[$i]}}@else Not mention @endif</span> <span>@if($add_d->detail[$i] != ''){{$add_d->detail[$i]}}@else Not mention @endif</span></li>                                                     
                                                @endfor
                                            @else
                                                <li>No additional details found</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <?php $work_samples = json_decode($student->work_samples)?>
                                    <div class="intershipapp_section">
                                        <h4>Work samples:</h4>
                                        <ul>
                                           @if(count($work_samples->sample_name) != 0)
                                                @for($i = 0; $i < count($work_samples->sample_name); $i++)
                                                    <li><span>@if($work_samples->sample_name[$i] != ''){{$work_samples->sample_name[$i]}}@else Not Mention @endif</span><span>@if($work_samples->sample_url[$i] != '')<a target='_blank' href='{{$work_samples->sample_url[$i]}}'>{{$work_samples->sample_url[$i]}}</a>@else Not Mention @endif</span></li>                                                    
                                                @endfor
                                            @else
                                                <li>No work sample found</li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if($post->question1!='')
                                    <div class="intershipapp_section">
                                        <h4>Brand Questions</h4>
                                        <ul>
                                            @if($post->question1!='')
                                            <li><span>{{$post->question1}}:</span><span>{{$internship->answer1}}</span></li>
                                            @endif
                                            @if($post->question2!='')
                                                <li><span>{{$post->question2}}:</span><span>{{$internship->answer2}}</span></li>
                                            @endif
                                            @if($post->question3!='')
                                                <li><span>{{$post->question3}}:</span><span>{{$internship->answer3}}</span></li>
                                            @endif
                                            @if($post->question4!='')
                                                <li><span>{{$post->question4}}:</span><span>{{$internship->answer4}}</span></li>
                                            @endif
                                            @if($post->question5!='')
                                                <li><span>{{$post->question5}}:</span><span>{{$internship->answer5}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                    @endif

                                    <div class="intershipapp_section">
                                        <h4>Resume</h4>
                                        <ul>
                                            @if($internship->video_resume!='')
                                                <li><span>Video Resume:</span><span><a class="uploadedvideo btnresume"><i class="fa fa-times"></i> Video</a></span>
                                                    {{--<span><a href="#play_video_file" class="videomodel2" data-toggle="modal" data-target="#play_video_file">Play Video</a></span>--}}

                                                </li>
                                                <div id="videofile" style="display: block"> <video  controls  autobuffer="autobuffer" width="100%" height="315">
                                                        <source src="/uploads/video_resumes/{{$internship->video_resume}}" type="video/{{ File::extension($internship->video_resume)}}" />
                                                    </video></div>
                                            @endif
                                                @if($internship->video_url!='')
                                                    <li><span>Video Resume:</span><span><a class="youtubevideo btnresume"><i class="fa fa-times"></i> Youtube Video</a> </span>
                                                        {{--<span><a href="#play_video_url" class="videomodel" data-toggle="modal" data-target="#play_video_url">Play Youtube Video</a></span>--}}
                                                    </li>
                                                    <div id="videourl" style="display: block"> <iframe width="100%" height="315" src="{{$internship->video_url}}" frameborder="0" allowfullscreen></iframe></div>
                                                @endif
                                            @if($internship->resume!='')
                                                <li><span>Document Resume:</span><span><a href="/uploads/resumes/{{$internship->resume}}" target="_blank" class="btnresume"><i class="fa fa-download"></i>  Resume</a></span>

                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                            </div></div>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="intershipapp_listrght intershipapp_part">
                                    <h4>{{$post->name}}   @  {{$brand->name}} </h4>
                                    <ul>
                                        <li>Category:<span>{{Str::title($post->category)}}</span></li>
                                        <li>Skills Required:<span>{{$post->skills}}</span></li>
                                        <li>Location:<span>{{$post->city}}</span></li>
                                        @if($post_t == 'internship')
                                            <li>Timeframe:<span>{{$post->start_date}} to {{$post->end_date}}</span></li>
                                        @endif
                                        <li>{{ucfirst($post_t)}} Type: <span>{{Str::title($post->offer_type)}}</span></li>
                                        <li>Number of Positions:<span>{{$post->positions}}</span></li>
                                        <li>@if($post_t == 'internship') Stipend @else Salary @endif
                                        <span>@if($post->amount!=0)
                                                Yes - Rs.{{$post->amount}} per month
                                            @else
                                                Nil
                                            @endif</span>
                                        </li>
                                        <li>Job Description:<br/>
                                         {{$post->description}}
                                        </li>
                                    </ul>

                                </div>
                            </div>
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

    <div id="play_video_file" class="modal fade" role="dialog">
        <div class="modal-dialog institutions_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content institutions_modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/popup_close.png"/></button>

                </div>
                <div class="modal-body institutions_modal_body">
                    <video  controls  autobuffer="autobuffer" width="100%" height="315">
                        <source src="/uploads/video_resumes/{{$internship->video_resume}}" type="video/{{ File::extension($internship->video_resume)}}" />
                    </video>
                    <div class="load_info">
                        <div class="load_img">

                            {{   HTML::image('assets/images/loading.gif')}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



            <div id="play_video_url" class="modal fade" role="dialog">
                <div class="modal-dialog institutions_modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content institutions_modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/popup_close.png"/></button>

                        </div>
                        <div class="modal-body institutions_modal_body">
                            <iframe width="100%" height="315" src="{{$internship->video_url}}" frameborder="0" allowfullscreen></iframe>
                            <br/>&nbsp;
                            <div class="load_info">
                                <div class="load_img">
                                    {{   HTML::image('assets/images/loading.gif')}}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <script>

                $(function(){

                    $(document).on("click", ".youtubevideo", function(){
                        if($(this).html()=='<i class="fa fa-play"></i> Youtube Video')
                        {
                            $(this).html('<i class="fa fa-times"></i> Youtube Video');
                            $('#videourl').show();
                        }
                        else
                        {
                        iframesrc=$('#videourl').find("iframe").attr("src");
                        $('#videourl').find("iframe").attr("src", "");
                        $('#videourl').find("iframe").attr("src", iframesrc);
                         $('#videourl').hide();
                         $(this).html('<i class="fa fa-play"></i> Youtube Video');
                        }
                    });

                    $(document).on("click", ".uploadedvideo", function(){
                        if($(this).html()=='<i class="fa fa-play"></i> Video')
                        {
                            $(this).html('<i class="fa fa-times"></i> Video');
                            $('#videofile').show();
                        }
                        else
                        {
                            $('#videofile').find("iframe").attr("src", iframesrc);
                            $('#videofile').hide();
                            $(this).html('<i class="fa fa-play"></i> Video');
                        }
                    });



                    var iframesrc=0;

                    $(document).on("click", ".modal .close", function(){
                        iframesrc=$(this).parents(".modal").find("iframe").attr("src");
                        $(this).parents(".modal").find("iframe").attr("src", "");
                        $(this).parents(".modal").find("iframe").attr("src", iframesrc);
                        $(this).parents(".modal").find("video").get(0).pause();
                    });

                    $(document).on("click", ".modal .close", function(){
                        iframesrc=$(this).parents(".modal").find("iframe").attr("src");
                        $(this).parents(".modal").find("iframe").attr("src", "");
                        $(this).parents(".modal").find("iframe").attr("src", iframesrc);
                        $(this).parents(".modal").find("video").get(0).pause();
                    });
                })


                function changeInternshipStatus()
                        {
                  var id={{$internship->id}};
                var status = $('#internship_status').val();
                if(id) {

                    $.ajax({

                        headers: {
                            'csrftoken' : '{{ csrf_token() }}'
                        },

                        type: 'POST',

                        url: '/changeInternshipStatus',

                        data: { 'id':id,'status':status },

                        success: function(data) {
                            if(data)
                            {
                                $('.avilablestatus2').addClass('hide');
                                $('.avilablestatus').removeClass('hide');
                                $('.avilablestatus span').html('Internship status has been changed!');
                                $('.intn_status').html(data);
                            }
                            else
                            {
                                $('.avilablestatus2').removeClass('hide');
                                $('.avilablestatus2').removeClass('hide');
                                $('.avilablestatus').addClass('hide');
                                $('.avilablestatus2 span').html('Error in updating Internship status!');
                            }
                        }

                    });
                }
                }

                $(document).keyup(function(e) {
                    if (e.keyCode == 27) {
                        if( $("#play_video_url").hasClass("in")  ){

                            $("#play_video_url").hide();
                            $(".videomodel").trigger("click");
                        }
                        if( $("#play_video_file").hasClass("in") ){
                            $('#play_video_file').hide();
                            $(".videomodel2").trigger("click");
                        }
                    }
                });

            </script>
@stop
