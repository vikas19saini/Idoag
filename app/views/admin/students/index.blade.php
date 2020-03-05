@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Students Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}

    <style>
        tfoot input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }
    </style>

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

                	List of Students

                    <!-- <a href="{{ URL::route('admin.students.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Student</a>

                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#students-import"><i class="fa fa-upload"></i> Import Students</a>

                    <a href="{{ URL::route('admin_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a> -->

               	</h1>

          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_students') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Students</li> -->

                </ol>

          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">

            		<div class="col-lg-12">

                      	@include('admin.layouts.flash')

                        <div class="box box-primary">

                			<div class="box-body">

                                {{ Form::open(['method' => 'get','route' => 'searchStudents','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                    <div class="form-group">

                                        {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-4">

                                          {{ Form::select('institution_id', array('' => 'Please select College') + $institutions, '' , ['class' => 'form-control']) }}

                                        </div>


                                        {{ Form::label('card_number', 'Card Number', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-4">

                                          {{ Form::text('card_number', null, ['placeholder' => 'Card Number', 'id'=>'cardnumber','class' => 'form-control']) }}

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('phone', 'Phone', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-4">

                                          {{ Form::text('phone', null, ['placeholder' => 'Phone', 'id'=>'phone','class' => 'form-control']) }}
                                        </div>


                                        {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-4">

                                          {{ Form::text('email', null, ['placeholder' => 'Email', 'id'=>'email','class' => 'form-control']) }}

                                        </div>

                                    </div>

                                    <div class="form-group">

                                      {{ Form::label('Roll NUmber', 'rollno', ['class' => 'col-sm-2 control-label']) }}

                                      <div class="col-sm-4">

                                        {{ Form::text('rollno', null, ['placeholder' => 'Roll NUmber', 'id'=>'rollno','class' => 'form-control']) }}

                                      </div>

                                    </div>

                                    {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-info center-block']) }}

                                {{ Form::close() }}

                                {{ Form::open(['route' => 'admin_students_actions', 'class' => 'form-horizontal','id' => 'students-actions-form']) }}

                                    <table id="studentslist" class="table table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> status </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college name </th>
                                                <th> streamorcourse </th>
                                                <th> validity_for_how_many_years </th>
                                                <th> cluborgrouporsociety </th>
                                                <th> residentordayscholar </th>
                                                <th> date_of_issue </th>
                                                <th> expiry_date </th>
                                                <th> section </th>
                                                <th> father_name </th>
                                                <th> batch_year </th>
                                                <th> program_duration </th>
                                                <th> email_id </th>
                                                <th> gender </th>
                                                <th> Created At</th>
                                                <th> Edit</th>
                                                <th><input type="checkbox" name="selectall" value="all" id="checkall" /></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($students as $key => $student)

                                                  @if($student->deleted_at=='')
                                                 <tr {{ ($student->deleted_at!='') ? " class='deleted'" : "" }}>

                                                    <td>{{ $key+1 }}</td>

                                                    <td>{{ $student->card_number }} </td>

                                                    <td>{{ $student->rol_no }} </td>

                                                    <td>{{ $student->status }} </td>

                                                    <td>{{ $student->contact_number }} </td>

                                                    <td>{{ $student->first_name }} </td>

                                                    <td>{{ $student->last_name }} </td>

                                                    <td>{{ $student->dob }} </td>

                                                    <td>{{ $student->name }} </td>

                                                    <td>{{ $student->streamorcourse }} </td>

                                                    <td>{{ $student->validity_for_how_many_years }} </td>

                                                    <td>{{ $student->cluborgrouporsociety }} </td>

                                                    <td>{{ $student->residentordayscholar }} </td>

                                                    <td>{{ $student->date_of_issue }} </td>

                                                    <td>{{ $student->expiry_date }} </td>

                                                    <td>{{ $student->section }} </td>

                                                    <td>{{ $student->father_name }} </td>

                                                    <td>{{ $student->batch_year }} </td>

                                                    <td>{{ $student->program_duration }} </td>

                                                    <td>{{ $student->email_id }} </td>

                                                    <td>{{ $student->gender }} </td>

                                                    <td>{{ date('Y-M-d H:i:s', strtotime($student->created_at)) }}</td>

                                                    <td><a href="{{ URL::route('admin.students.edit', [$student->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                    <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $student->id }}"></td>

                                                </tr>@endif
                                            @endforeach
                                </tbody>
                                <tfoot>

                                            <tr>

                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> status </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college_id </th>
                                                <th> streamorcourse </th>
                                                <th> validity_for_how_many_years </th>
                                                <th> cluborgrouporsociety </th>
                                                <th> residentordayscholar </th>
                                                <th> date_of_issue </th>
                                                <th> expiry_date </th>
                                                <th> section </th>
                                                <th> father_name </th>
                                                <th> batch_year </th>
                                                <th> program_duration </th>
                                                <th> email_id </th>
                                                <th> gender </th>
                                                <th> Created At</th>
                                                <th>Edit</th>
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

    <!-- Brands Import Modal Starts Here-->
    <div class="modal fade" id="students-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      	<div class="modal-dialog">

            <div class="modal-content">

          		<div class="modal-header">

            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            		<h4 class="modal-title">Import Students</h4>

          		</div>

          		<div class="modal-body">

            		{{ Form::open(['route' => 'admin_students_import', 'class' => 'form-horizontal','id' => 'students-import-form', 'files' => true]) }}

                        <div class="form-group">

                            {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}

                            <div class="col-sm-8">

                                {{ Form::file('file', ['required' => 'required']) }}

                                {{ errors_for('file', $errors) }}

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-offset-2 col-sm-8">

                                {{ Form::submit('Import Students', ['class' => 'btn btn-lg btn-info btn-block']) }}

                            </div>

                        </div>

                    {{ Form::close() }}

          		</div>

        	</div><!-- /.modal-content -->

      	</div><!-- /.modal-dialog -->

    </div><!-- /.modal -->
    <!-- Brands Import Modal Ends Here-->

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

			var table = $('#studentslist').DataTable( {

				scrollY:        "700px",

				scrollX:        true,

                scrollCollapse: true,

				paging:         true,

				"aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 8, 9 ] }
                ]

			});

			$(document).on('click', '#checkall', function(e) {

				var cells = table.cells( ).nodes();

    			$( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));

			});

        });

	</script>

@stop
