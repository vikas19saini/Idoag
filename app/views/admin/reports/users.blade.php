@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Reports')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}
    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}
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

                <h1>Reports  </h1>

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

                                {{ Form::open(['route' => 'filterUserReport','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                <div class="form-group">

                                    {{ Form::label('institution', 'Institution', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                        {{ Form::select('institution', array('' => 'Select College')+$institutions,$filter['institution'] , ['class' => 'form-control']) }}

                                    </div>

                                    {{ Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                        {{ Form::select('status', array('' => 'All','1'=>'Activated','0'=>'Activated but email not verified','2'=>'Not Activated(Registered)'), $filter['status'] , ['class' => 'form-control']) }}
                                    </div>

                                </div>

                                <div class="form-group">


                                    {{ Form::label('daterange', 'Date Inserted', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-2">

                                        {{ Form::text('startdate', $filter['startdate'], ['placeholder' => 'Date From', 'id'=>'startdate','class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::text('enddate', $filter['enddate'], ['placeholder' => 'Date To', 'id'=>'enddate','class' => 'form-control']) }}
                                    </div>

                                    <div class="col-sm-3"> {{ Form::submit('Filter', ['name' => 'Filter','class' => 'btn btn-warning  ']) }}
                                    </div>
									<div class="col-sm-3"> @if(isset($users)){{ Form::submit('Export Users', ['name' => 'Export','class' => 'btn btn-success  ']) }} @endif  </div>

                                </div>


                                {{ Form::close() }}

                                <div class="user_status_msg"> </div>
                                @if(isset($users))

                                <table id="userslist" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Card Number</th>
                                        <th>College</th>
                                         <th>Inserted</th>
                                        <th>Confirm</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $user->first_name}}</td>
                                                <td>{{ $user->last_name}}</td>
                                                <td>{{ $user->email_id}}</td>
                                                <td>{{ $user->card_number}}</td>
                                                <td>{{ getInstitutionName($user->college_id)}}</td>
                                                 <td>{{ $user->created_at}}</td>
                                                <td>@if($user->activated==0 && $user->created_at!='')<a data_id="{{$user->id}}" id="user_{{$user->id}}"   class="statususer">Confirm</a> @endif</td>

                                            </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                    @endif

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
    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}


    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}
    {{ HTML::script('assets/js/app.js') }}

    <script>

        $(document).ready(function(e) {
            $('#startdate').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#enddate').datepicker({
                format: 'yyyy-mm-dd'
            });

            var table = $('#userslist').DataTable( {

                scrollY:        "700px",

                scrollX:        true,

                scrollCollapse: true,

                paging:         true,

                responsive: true

            } );

        });

        $(document).on('click', '.statususer', function() {

            var user_id        = $(this).attr('data_id');

            var data           = "user_id="+user_id;

            $.ajax({
                url: '/admin/activate_user',
                type: 'POST',
                data: data,

                success: function(response) {
                        $('#user_'+user_id).html('');
                    $('.user_status_msg').html("<div class='alert alert-success'>Activated User status <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>");
                }
            });

        });


    </script>
@stop