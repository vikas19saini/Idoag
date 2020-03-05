@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Students Users Dashboard')

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
                    List of Student Users
                    
                    <!--<a href="{{ URL::route('admin.students_users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Student User</a>-->
                    
                    <!--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#studentsusers-import"><i class="fa fa-upload"></i> Import Excel</a>-->
                    
                    <a href="{{ URL::route('admin_report_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a>
                    
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
                                {{--{{ Form::open(['class' => 'form-horizontal','id' => 'search_form']) }}--}}

                                {{--<div class="form-group">--}}

                                    {{--{{ Form::label('institution', 'Institution', ['class' => 'col-sm-2 control-label']) }}--}}

                                    {{--<div class="col-sm-2">--}}
                                        {{--{{ Form::select('institution', array('' => 'All')+$institutions,$filter['institution'] , ['class' => 'form-control']) }}--}}

                                    {{--</div>--}}

                                    {{--{{ Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) }}--}}

                                    {{--<div class="col-sm-2">--}}
                                        {{--{{ Form::select('status', array('' => 'All','1'=>'Active','0'=>'InActive'), $filter['status'] , ['class' => 'form-control']) }}--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3"> {{ Form::button('Filter', ['class' => 'btn btn-warning  ']) }}--}}
                                    {{--</div>--}}

                                {{--</div> --}}

                                {{--{{ Form::close() }}--}}
                                
                                {{  Form::open(['route' => 'admin_student_users_actions', 'class' => 'form-horizontal','id' => 'institution-users-actions-form']) }}

                                <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                                <th>S No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Institution</th>
                                                <th>Status</th>
                                                <th>CardNumber</th>
                                                <th>Edit</th>
                                                {{--<th>Delete</th>--}}
                                                <th><input type="checkbox" name="checkall" value="true" id="checkall" /></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                                <th>S No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Institution</th>
                                                <th>Status</th>
                                                <th>CardNumber</th>
                                                <th>Edit</th>
                                                {{--<th>Delete</th>--}}
                                                <th> </th>
                                        </tr>
                                    </tfoot>

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
				
				paging:         true
				
			});

            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "bSort" : false,
                "ajax":{
                    url :"demodata", // json datasource
                    type: "post",  // type of method  , by default would be get
                    error: function(){  // error handling code
                      $("#example").css("display","none");
                    }
                  }
            } );
			
		
			
			$(document).on('click', '#checkall', function(e) {

		if($(this).is(':checked')){ $("#example").find('input[type="checkbox"]').prop('checked', true);}
        else{$("#example").find('input[type="checkbox"]').prop('checked', false);}
			
			});	
  
        });	

	</script>

@stop