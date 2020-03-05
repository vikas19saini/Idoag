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

                <h1>Students by College <a href="{{ URL::route('admin_report_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Students Report</a></h1>

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

                                <table id="enquirieslist" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>College</th>
                                        <th>College Id</th>
                                        <th>Total Users</th>
                                        <th>Total Users Active</th>
                                        <th>Active but email not confirmed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($institutions as $key => $institute)

                                        @if($institute->deleted_at=='')
											<?php 
												$active = $institute->getStudentsActiveCount($institute->id);
												$inActive = $institute->studentsNotConfirmedCount($institute->id);
											?>
                                            <tr {{ ($institute->deleted_at!='') ? " class='deleted'" : "" }}>

                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $institute->name}}</td>
                                                <td>{{ $institute->id}}</td>
                                                <td> <a href="{{ URL::route('admin_inst_students_users',$institute->id) }}">{{ $active + $inActive}}</a></td>
                                                <td>{{ $active }}</td>
                                                <td>{{ $inActive }}</td>
                                            </tr>@endif
                                    @endforeach
                                    </tbody>

                                </table>

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