@extends('admin.layouts.default')

@section('title','Idoag.com | Student Users Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}

    {{ HTML::style('assets/plugins/iCheck/square/blue.css') }}
    
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
                
                	List of Student Users
                    
                    <a href="{{ URL::route('admin.students_users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Student User</a>
                    
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#studentsusers-import"><i class="fa fa-upload"></i> Import Excel</a>
                    
                    <a href="{{ URL::route('admin_report_all_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a>
                    
                    <a href="{{ URL::route('admin_student_users_sample') }}" class="btn btn-info"><i class="fa fa-download"></i> sample Excel</a>

               	</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            		
                    <li class="active">Student Users</li> -->
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">
            
            		<div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
                  				
                                {{  Form::open(['route' => 'admin_student_users_actions', 'class' => 'form-horizontal','id' => 'institution-users-actions-form']) }}

                                <table class="table table-striped table-bordered table-hover" id="userslist">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Institution</th>
                                                <th>Status</th>
                                                <th>Card Number</th>
                                                <th width="65">Action</th>
                                                <th><input type="checkbox" name="checkall" value="true" id="checkall" /></th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    @foreach($users as $key => $student)

                                             <tr {{ ($student->deleted_at!='') ? " class='deleted'" : "" }}>

                                                 <td>{{ $student->first_name }} </td>

                                                 <td>{{ $student->last_name }} </td>
                                                 <td>{{ $student->email}} </td>
                                                 <td>{{ getInstitutionName($student->institution_id)}} </td>
                                                 <td>@if($student->activated){{$student->activated}} @else 0 @endif</td>
                                                 <td>{{ $student->card_number }} </td>

                                                <td><a href="/admin/students_users/{{$student->id}}/edit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="/admin/student/{{$student->id}}" target="_blank"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="fa fa-list"></i></a>
                                                    </td>

                                                <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $student->id }}"></td>

                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                				
                                	  {{ Form::submit('Activate', ['name' => 'Activate', 'class' => 'btn btn-lg btn-info']) }}
                                    
                                    {{ Form::submit('Deactivate', ['name' => 'Deactivate', 'class' => 'btn btn-lg btn-warning']) }}
                                    
                                    {{ Form::submit('Trash', ['name' => 'Trash',  'class' => 'btn btn-lg btn-danger']) }}
                                                                        
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
	
    <!-- Users Import Modal Starts Here-->
   
    <div class="modal fade" id="studentsusers-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      
      	<div class="modal-dialog">
        	
            <div class="modal-content">
          
          		<div class="modal-header">
            
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            		<h4 class="modal-title">Import Student Users</h4>
          
          		</div>
          
          		<div class="modal-body">


            		{{ Form::open(['route' => 'admin_student_users_import', 'class' => 'form-horizontal','id' => 'student_users-import-form', 'files' => true]) }}
                    	
                        <div class="form-group">
                                            
                            {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}
        
                            <div class="col-sm-8">
                            
                                {{ Form::file('file', ['required' => 'required']) }}
                                
                                {{ errors_for('file', $errors) }}
                                
                            </div>
                            
                        </div>
                                            
                        <div class="form-group">
                                            
                            <div class="col-sm-offset-2 col-sm-8">
                          
                                {{ Form::submit('Import Students Users', ['class' => 'btn btn-lg btn-info btn-block']) }}
                        
                            </div>
                      
                        </div>
                                                                    
                    {{ Form::close() }}
          
          		</div>
        
        	</div><!-- /.modal-content -->
      
      	</div><!-- /.modal-dialog -->
    
    </div>

    <!-- Users Import Modal Ends Here-->

@stop

@section('js')
    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}
    
    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}
	
    {{ HTML::script('assets/plugins/iCheck/icheck.min.js') }}
    
	{{ HTML::script('assets/js/app.js') }}


    <script type="text/javascript">
	
		$(document).ready(function(e) {

            $('#userslist').DataTable( {
                paging:true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 6,7 ] }
                ]

            } );


			$(document).on('click', '#checkall', function(e) {
												
				var cells = table.cells( ).nodes();
				
    			$( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
			
			});

		});
		
	</script>

@stop