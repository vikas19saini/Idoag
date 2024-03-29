@extends('admin.layouts.default')

@section('title','Idoag.com | Report Problems')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

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

            <!-- Content Header (problem header) -->
            <section class="content-header">

                <h1>

                    Report Problems

                    <a href="{{ URL::route('admin_problems_export') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Export to Excel</a>



                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">problems</li> -->

                </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-lg-12">

                            @include('admin.layouts.flash')

                            <div class="box box-primary">

                                <div class="box-body">

                                    {{ Form::open(['route' => 'admin_problems_actions', 'class' => 'form-horizontal','id' => 'problems-actions-form']) }}

                                    <table id="problemslist" class="table table-bordered table-hover">

                                        <thead>

                                        <tr>

                                            <th>S No</th> 
                                            <th>Section</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Date Sent</th>
                                            <th>Action</th>
                                            <th><input type="checkbox" name="selectall" value="all" id="checkall" /></th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                        @foreach($problems as $key => $problem)

                                              @if($problem->deleted_at=='')
                                                 <tr {{ ($problem->deleted_at!='') ? " class='deleted'" : "" }}>

                                                <td>{{ $key+1 }}</td>

                                                <td>{{ $problem->section}}</td>
                                                <td>{{ $problem->reason }}</td>
                                                <td>{{ $problem->status}}</td> 
                                                <td>{{ date('Y-M-d H:i:s', strtotime($problem->created_at)) }}</td>

                                                <td><a href="{{ URL::route('admin.problems.edit', [$problem->id]) }}" class="btn btn-warning"><i class="fa fa-eye-open"></i> View</a></td>

                                                <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $problem->id }}"></td>

                                            </tr>@endif
 @endforeach                                    
                                </tbody> 
                                <tfoot>

                                        <tr>

                                            <th>S No</th>
                                             <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                            <th></th>

                                        </tr>

                                        </tfoot>

                                    </table>
                                    {{ Form::submit('Activate', ['name' => 'Activate',  'class' => 'btn btn-lg btn-info']) }}

                                    {{ Form::submit('Deactivate', ['name' => 'Deactivate',  'class' => 'btn btn-lg btn-warning']) }}

                                    {{ Form::submit('Trash', ['name' => 'Trash',  'class' => 'btn btn-lg btn-danger']) }}

                                    {{ Form::submit('Untrash', ['name' => 'Untrash',  'class' => 'btn btn-lg btn-warning hide']) }}

                                    {{ Form::close() }}

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

    {{ HTML::script('assets/js/app.js') }}

    <script type="text/javascript">

        $(document).ready(function(e) {

            var table = $('#problemslist').DataTable( {

                scrollY:        "300px",

                scrollX:        true,

                scrollCollapse: true,

                paging:         true,

                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 3,4 ] }
                ]

            } );

            $(document).on('click', '#checkall', function(e) {

                var cells = table.cells( ).nodes();

                $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));

            });

        });

    </script>

@stop