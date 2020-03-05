@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Reports')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

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

                <h1>Active/Inactive Students</h1>

                <ol class="breadcrumb">

                    <li class="active"><i class="fa fa-dashboard"></i>  Home</li>

                </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row"><div class="col-lg-12">

                        @include('admin.layouts.flash')

                        <div class="box box-primary">

                            <div class="box-body">
                                <div align="left">
                                    <a href="{{ URL::route('admin_report_not_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Not Registered Users List from Student Data</a> &nbsp;  
        							<a href="{{ URL::route('admin_report_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Registered Students List</a>&nbsp;  
        							<a href="{{ URL::route('admin_report_all_students_export') }}" class="btn btn-warning"><i class="fa fa-download"></i> Export All Students List</a>&nbsp;
        							<a href="{{ URL::route('admin_report_mismatch_students_export') }}" class="btn btn-warning"><i class="fa fa-download"></i> Export Unmatched Students Data</a>
                                </div>

                           

                                <table id="enquirieslist" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>College Name</th>
                                        <th>College Id</th>
                                        <th>Total Students</th> 
                                        <th>Register Students</th>
                                        <th>Active Students</th>
                                        <th>Inactive Students</th>
                                        <th>Non Registered Students</th>
										<th>Deleted Students</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $student_count=0;
                                        $active_count=0;
                                        $inactive_count=0;
                                        $registered_count=0;
                                        $not_registered_count=0;
										$total_delete = 0;
										$activeusers = 0;
                                    ?>
                                    @foreach($institutions as $key => $institute) 
                                        <tr {{ ($institute->deleted_at!='') ? " class='deleted'" : "" }}>

                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $institute->name}}</td>
                                            <td>{{ $institute->id}}</td>
                                            <td>
                                                <?php 
													$studentcount = $institute->getStudentsCount($institute->id);
													$activeData = $institute->getStudentsActiveCount($institute->id) ;
													$inactiveData = $institute->studentsNotConfirmedCount($institute->id);
													$deleteData = $institute->getDeleteStudentCountFromData($institute->id);
													$regusersData = $activeData + $inactiveData;
													//$nonregusersData = $institute->getStudentsNotRegisteredCountFromData($institute->id);
													//$nonregusersData  = $studentcount - ($activeData + $inactiveData + $deleteData);
													echo $studentcount;
												?>
                                            </td>
                                            <td>
                                              <?php 
                                                $regusers = $regusersData;
                                                echo $regusers;
                                              ?>  
                                            </td>
                                            <td>
                                                <?php 
													$activeusers = $activeData;
													echo $activeusers;
												
												?>
                                            </td>
                                            <td>
                                                <?php $inactiveusers = $inactiveData;
                                                echo $inactiveusers;?>
                                            </td>
                                            <td><?php $nonregusers=$studentcount - $regusers; 
														echo $nonregusers;
												?>
											</td>
											<td><?php $deletestudent = $deleteData;
													echo $deletestudent;?></td>
										</tr> 
                                        <?php 
                                           $student_count=$student_count+$studentcount;
										   $active_count=$active_count+$activeusers;
                                           $inactive_count=$inactive_count+$inactiveusers;
                                           $registered_count=$registered_count+$regusers;
										   $not_registered_count=$not_registered_count+$nonregusers;
										   $total_delete = $total_delete+$deletestudent;
                                        ?>
                                    @endforeach
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><strong>{{$student_count}}</strong></td>
                                            <td><strong>{{$registered_count}}</strong></td>
                                            <td><strong>{{$active_count}}</strong></td>
                                            <td><strong>{{$inactive_count}}</strong></td>
                                            <td><strong>{{$not_registered_count}}</strong></td>
                                            <td><strong>{{$total_delete}}</strong></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <p><strong>Deleted Student Count from User, Which are not in student details list: {{$delete_users - $total_delete}}</strong></p>
								<p><strong>Mismatch Student Count from User/Student Data: {{$data_mismatch}}</strong></p>

                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->

        </div>
        <!-- Content Block Ends Here  -->

        <!-- Footer Starts Here -->
        @include('admin.layouts.footer')
        <!-- Footer Starts Here -->

    </div><!-- ./wrapper -->

@stop

@section('js')

    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script>

        $(document).ready(function(e) {

        });

    </script>
@stop