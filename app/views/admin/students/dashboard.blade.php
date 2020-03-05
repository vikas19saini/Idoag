@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Student Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}
	
	 {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}


@stop

@section('content')

    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Top Header Starts Here -->
        @include('admin.layouts.navbar')
        <!-- Top Header Starts Here -->

        <!-- Sidebar Starts Here -->
        @include('admin.layouts.sidebar')
        <!-- Sidebar Starts Here -->

        <!-- Content Block Starts Here -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">

                <h1>
                    Student Dashboard -  {{ucfirst($student->name)}}

                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_institutions') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back to Institutions</a>
        </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-lg-12">

                            @include('admin.layouts.flash')

                            <div class="box box-primary">

                                <div class="box-body">

                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                                            <li><a href="#internships" data-toggle="tab">Internships</a></li>
                                            <li><a href="#brands" data-toggle="tab">Brands Following</a></li>
                                            <li><a href="#institutions" data-toggle="tab">Institutions Following</a></li>
                                            <li><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li><a href="#activity" data-toggle="tab">Activity Log</a></li>
                                            <li><a href="#coupons" data-toggle="tab">Taken Coupons</a></li>
                                            <li><a href="#statistics" data-toggle="tab">Statistics</a></li>
                                            <li><a href="#search" data-toggle="tab">Activity Search Report</a></li>
                                        </ul>

                                    </div>

                                    <div class="tab-content" style="min-height:400px">
                                        <div class="active tab-pane" id="profile">

                                            <p>
                                                <strong> Name :</strong> {{ $student->name}}</p>
                                            <p><strong>Email :</strong>  {{ $student->email}}</p>
                                            <p><strong>Mobile :</strong>  {{ $user->mobile}}</p>
                                            <p><strong>Card Number :</strong>  {{ $student->card_number}}</p>
                                            <p><strong>Institution :</strong>  {{ $student->institution}}</p>
                                            <p><strong>Course :</strong>  {{ $student->course}}</p>
                                            <p><strong>DOB :</strong>  {{ $student->dob}}</p>
                                            <p><strong>Roll No :</strong>  {{ $user->roll_no}}</p>
                                            <p><strong>Gender :</strong>  {{ $user->gender}}</p>
                                            <p><strong>State :</strong>  {{ getState($student->state)}}</p>
                                            <p><strong>City :</strong>  {{ getCity($student->city)}}</p>
                                            <p><strong>About me :</strong>  {{ $student->aboutme}}</p>
                                            <p><strong>Interests :</strong>  {{ $student->interests}}</p>
                                            <p><strong>Color :</strong>  {{ $student->color}}</p>
                                            <p> <strong>Created on:</strong> {{ $student->created_at}}</p>
                                            <p><strong>Last Updated :</strong>  {{ $student->updated_at}}</p>
                                            <p><strong>Profile Picture :</strong><br/>
                                                @if($user->image!='')
                                                    {{ HTML::image('/uploads/profile/'.$user->image, '', ['height'=>'200']) }}
                                                @endif  </p>
                                        </div>

                                        <div class="tab-pane" id="internships">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="internships_list">
                                                    <thead>
                                                    <tr>
                                                        <th>SNo</th>
                                                        <th>Post Name</th>
                                                        <th>Category</th>
                                                        <th>Location</th>
                                                         <th>Status</th>
                                                        <th>Applied on</th>
                                                        <th>View</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($internships as $key => $internship)
                                                        @if($internship->deleted_at=='')
                                                            <tr {{ ($internship->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                <td>{{ $key+1 }}</td>

                                                                <td>{{ $internship->post->name }}</td>

                                                                <td>{{ $internship->post->category }}</td>

                                                                <td>{{ $internship->post->location }}</td>

                                                                <td>{{$internship_status[$internship->status]}}</td>

                                                                <td>{{ date('Y-M-d H:i:s', strtotime($internship->created_at)) }}</td>
                                                                <td><a href="#"> View</a></td>
                                                            </tr>@endif
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="brands">
                                            <table id="brands_list" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>

                                                    <th>SNo</th>
                                                    <th width="150">Brand Name</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                </tr>

                                                </thead>

                                                <tbody>

                                                @foreach($brands as $key => $brand)

                                                    @if($brand->deleted_at=='')
                                                        <tr {{ ($brand->deleted_at!='') ? " class='deleted'" : "" }}>

                                                            <td>{{ $key+1 }}</td>

                                                            <td><a href="{{ URL::route('admin_brand_dashboard', [$brand->slug]) }}" target="_blank"> {{ ucfirst($brand->name) }}</a></td>

                                                            <td>{{ HTML::image('/uploads/brands/'.$brand->image, '', ['class' => 'admin_thumbnail']) }}</td>

                                                            <td>{{ $brand->category }}</td>

                                                        </tr>@endif
                                                @endforeach
                                                </tbody>
                                                <tfoot>

                                                <tr>

                                                    <th>S No</th>
                                                    <th>Brand Name</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                </tr>

                                                </tfoot>

                                            </table>
                                        </div>

                                        <div class="tab-pane" id="institutions">
                                            <div class="dataTable_wrapper">
                                                <table id="institutions_list" class="table table-bordered table-hover">

                                                    <thead>

                                                    <tr>

                                                        <th>S No</th>
                                                        <th width="200">Institution Name</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                    </tr>

                                                    </thead>

                                                    <tbody>

                                                    @foreach($institutions as $key => $data)

                                                        @if($data->deleted_at=='')
                                                            <tr {{ ($data->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                <td>{{ $key+1 }}</td>

                                                                <td><a href="{{ URL::route('admin_institution_dashboard', [$data->slug]) }}" target="_blank"> {{ ucfirst($data->name) }}</a></td>

                                                                <td>{{ ucfirst($data->description) }}</td>

                                                                <td>{{ HTML::image('uploads/institutions/'.$data->image, '', ['class' => 'admin_thumbnail']) }}</td>

                                                            </tr>@endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>

                                                    <tr>
                                                        <th>S No</th>
                                                        <th>Institution Name</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                    </tr>

                                                    </tfoot>

                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="feedback">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="feedback_list">
                                                    <thead>
                                                    <tr>
                                                        <th>SNo</th>
                                                        <th>Brand/Institution</th>
                                                        <th>Message</th>
                                                        <th>Reply Message</th>
                                                        <th>Posted At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($feedbacks as $key => $note)
                                                        <tr {{ ($note->deleted_at!='') ? " class='deleted'" : "" }}>

                                                            <td>{{ $key+1 }}</td>

                                                            <td>@if($note->brand_id!=0){{ getBrandName($note->brand_id) }}
                                                            @else {{ getInstitutionName($note->institution_id) }}@endif</td>

                                                            <td>{{$note->message}}</td>

                                                            <td>{{$note->replymessage}}</td>

                                                            <td>  {{$note->created_at}} </td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="activity">

                                            <div class="activity_info">
                                                <ul>
                                                    @foreach($output as $key => $value)

                                                        <li>

                                                            <div class="activity_left">

                                                                <div class="date_box"> <span class="date">{{date('j', strtotime($key))}}<sup>{{date('S', strtotime($key))}}</sup></span> <span class="year">{{date('M', strtotime($key))}}, {{date('Y', strtotime($key))}}</span> </div>
                                                            </div>
                                                            <div class="activity_right">
                                                                <ul class="list-group activity_group">
                                                                    @for($i=0; $i < sizeof($value); $i++)

                                                                        @if($value[$i]['type'] == 'brand_follows')
                                                                            <li class="list-group-item activity_item">{{ HTML::image('assets/images/follow.jpg', '') }}Following  {{ getBrandName($value[$i]['brand_id'])}}</li>
                                                                        @endif

                                                                        @if($value[$i]['type'] == 'inst_follows')
                                                                            <li class="list-group-item activity_item">{{ HTML::image('assets/images/follow.jpg', '') }}Following  {{ getInstitutionName($value[$i]['inst_id'])}}</li>
                                                                        @endif

                                                                        @if($value[$i]['type'] == 'coupon')
                                                                            <li class="list-group-item activity_item">{{ HTML::image('assets/images/activyimg.png', '') }} {{ getBrandName($value[$i]['brand_id'])}} Offer {{ $value[$i]['offer_name']}} was accessed with Coupon {{ $value[$i]['coupon_code']}} at {{ $value[$i]['created_at']}}</li>
                                                                        @endif

                                                                        @if($value[$i]['type'] == 'feedback')
                                                                            <li class="list-group-item activity_item">{{ HTML::image('assets/images/feedback.jpg', '') }} {{ getBrandName($value[$i]['brand_id'])}} responded to your feedback</li>
                                                                        @endif

                                                                        @if($value[$i]['type'] == 'intern')
                                                                            <li class="list-group-item activity_item">{{ HTML::image('assets/images/activyimg1.png', '') }} {{ getBrandName($value[$i]['brand_id'])}} Applied for Internship {{ $value[$i]['internship_name']}} </li>
                                                                        @endif

                                                                        @if($value[$i]['message'] != '')
                                                                                <li class="list-group-item activity_item"> <a href="{{ URL::route('student_internship_view', [getBrandSlugByInternshipId($value[$i]['internship_id']),$value[$i]['internship_id'], getPostSlugByInternshipId($value[$i]['internship_id'])]) }}"  target="_blank">
                                                                                      {{ HTML::image('assets/images/activyimg1.png')}}
                                                                                      {{$value[$i]['message']}}
                                                                                    </a> </li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                        </li>

                                                    @endforeach

                                                </ul>
                                                <div style="clear:both"></div>
                                            </div>

                                        </div>

                                        <div class="tab-pane" id="coupons">
                                            <div class="dataTable_wrapper">
                                                <table id="couponslist" class="table table-bordered table-hover">

                                                    <thead>
                                                    <tr>
                                                        <th>S No</th>
                                                        <th>Coupon Code</th>
                                                        <th>Type</th>
                                                        <th>Post</th>
                                                        <th>Brand</th>
                                                        <th>Used On</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody> 
                                                    @foreach($coupons_used as $key => $coupon)
                                                        <tr>

                                                            <td>{{ $key+1 }}</td>

                                                            <td>{{$coupon->code}}</td>
                                                            <td>{{$coupon->post->voucher_type}}</td>
                                                            <td>{{ $coupon->post->name }}</td>
                                                            <td>{{ getBrandName($coupon->post->brand_id) }}</td>
                                                            <td>{{ $coupon->created_at }}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="statistics">

                                            <p><strong>Total Posts Visits :</strong> {{ $statistics['posts_visits_count'] }}</p>

                                            <p><strong>Total Posts Likes :</strong> {{ $statistics['posts_likes_count'] }}</p>

                                            <p><strong>Submitted Feedback :</strong> {{ $statistics['total_feedback_count'] }}</p>

                                            <p> <strong>Institutions Follows : </strong> {{$statistics['institutions_count']}}</p>

                                            <p> <strong>Brands Follows : </strong> {{$statistics['brands_count']}}</p>

                                            <p> <strong>Applied Internships : </strong> {{$statistics['internships_count']}}</p>

                                    </div>

                                        <div class="tab-pane" id="search">

                                             <div class="form-group">
                                                {{ Form::label('daterange', 'Activity Date', ['class' => 'col-sm-2 control-label']) }}

                                                <div class="col-sm-2">

                                                    {{ Form::text('startdate', null, ['placeholder' => 'Date From', 'id'=>'startdate','class' => 'form-control']) }}
                                                </div>
                                                <div class="col-sm-2">
                                                    {{ Form::text('enddate', null, ['placeholder' => 'Date To', 'id'=>'enddate','class' => 'form-control']) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="btn btn-warning" id="filter">Filter</span>
                                                </div>
                                            </div>
                                            <br/>
                                             <div id="result"></div>
                                        </div>
										<div  style="clear:both"></div>

                                </div>

                                  <!-- /.box-body -->

                            </div>
                            <!-- /.box -->

                        </div><!-- /.col -->

                    </div>
                    <!-- /.row -->

            </section>
            <!-- /.content -->



        </div>
        <!-- Content Block Ends Here  -->

        <!-- Footer Starts Here -->
        @include('admin.layouts.footer')
        <!-- Footer Starts Here -->

    </div>
    <!-- ./wrapper -->


@stop

@section('js')

    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}

    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}
	
	   {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}


    {{ HTML::script('assets/js/app.js') }}

    <script type="text/javascript">

        $(document).ready(function(e) {

 $('#startdate').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#enddate').datepicker({
                format: 'yyyy-mm-dd'
            });

            var table = $('#brands_list').DataTable( {
                paging:         true
            } );

            var table = $('#institutions_list').DataTable( {
                paging:         true
            } );

            var table = $('#internships_list').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 6 ] }
                ]
            } );

            var table = $('#feedback_list').DataTable( {
                paging:         true
            } );
			
			 var table = $('#couponslist').DataTable( {
                paging:         true
            } );
			
			

            $('#filter').on('click', function () {

                var user_id = {{$student->user_id}};
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();

                var data = "user_id=" + user_id+"&startdate=" + startdate + "&enddate=" + enddate;

                $.ajax({
                    url: '/admin/userDateActivity',
                    type: 'POST',
                    data: data,

                    success: function (response) {

                        if (response) {
                            $('#result').html(response);
                        }
                    }
                });
            });


        });

    </script>

@stop