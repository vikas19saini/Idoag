@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Internship Applications ')

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

                   Internship Applications Received

                    <a href="{{ URL::route('admin_applications_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Internships</a>

                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-lg-12">

                        @include('admin.layouts.flash')

                        <div class="box box-primary">

                            <div class="box-body">
                                {{ Form::open(['route' => 'searchApplications','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                <div class="form-group">

                                    {{ Form::label('institution', 'Institution', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                            {{ Form::select('institution', array('' => 'Select College')+$institutions,$filter['institution'] , ['class' => 'form-control']) }}

                                    </div>

                                    {{ Form::label('brand', 'Brand', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                        {{ Form::select('brand', array('' => 'Please select Brand') + $brands, $filter['brand'] , ['class' => 'form-control']) }}

                                    </div>

                                </div>

                                <div class="form-group">
                                    {{ Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                            {{ Form::select('status', array('' => 'All') + $internship_status, $filter['status'] , ['class' => 'form-control']) }}
                                    </div>


                                    {{ Form::label('daterange', 'Date Applied', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-2">

                                        {{ Form::text('startdate', $filter['startdate'], ['placeholder' => 'Date From', 'id'=>'startdate','class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::text('enddate', $filter['enddate'], ['placeholder' => 'Date To', 'id'=>'enddate','class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="form-group">

                                    {{ Form::label('internship', 'Internship', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">

                                        {{ Form::select('internship', array('' => 'Select Internship')+$posts,$filter['internship'] , ['class' => 'form-control']) }}

                                    </div>
                                    <div class="col-sm-6">                                {{ Form::submit('Filter', ['class' => 'btn btn-warning  ']) }}
                                        @if(isset($filter2))
                                            <a href="{{route('internship_applications')}}" class="btn btn-info filter_btn">View All</a>
                                        @endif
                                    </div>

                                </div>


                                {{ Form::close() }}

                                <table id="internshipslist" class="table table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Student</th>
                                        <th>Institution</th>
                                        <th>Brand</th>
                                        <th>Internship</th>
                                        <th>Status</th>
                                        <th width="70">Date Applied</th>
                                        <th width="70">Last Updated By Brand</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($internships as $key => $internship)

                                        @if($internship->deleted_at=='')
                                            <tr {{ ($internship->deleted_at!='') ? " class='deleted'" : "" }}>

                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $internship->name }}</td>
                                                <td>{{ $internship->institution }}</td>
                                                <td>{{ getBrandName($internship->brand_id) }}</td>
                                                <td>{{ getPostName($internship->post_id) }}</td>
                                                <td>{{$internship_status[$internship->status]}}</td>

                                                <td>{{ date('Y-m-d', strtotime($internship->created_at)) }}</td>
                                                <td> @if($internship->created_at!=$internship->updated_at){{ date('Y-m-d', strtotime($internship->updated_at)) }} @endif</td>

                                                <td> <a href="{{ URL::route('student_internship_view', [getBrandSlug($internship->brand_id), $internship->id, getPostSlug($internship->post_id)]) }}"
                                                        target="_blank"><i class="fa fa-eye-open"></i> View Info</a></td>



                                            </tr>@endif
                                    @endforeach
                                    </tbody>

                                </table>



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

            var table = $('#internshipslist').DataTable( {

                scrollY:        "700px",

                scrollX:        true,

                scrollCollapse: true,

                paging:         true,
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": [8]
                }],
                responsive: true

            } );

        });

    </script>

@stop