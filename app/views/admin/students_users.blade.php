@extends('admin.layouts.default')

@section('title','Idoag.com | Users Dashboard')

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
        
        	<!-- Content Header (Page header) -->
        	<section class="content-header">
          
          		<h1>
                
                	List of Brand Users 
                    
                    <a href="{{ URL::route('admin.profiles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Brand User</a>
                    
                     <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#users-import"><i class="fa fa-upload"></i> Import Excel</a>
                    
                    <a href="{{ URL::route('admin_users_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a>
                    
               	</h1>
          
          		<ol class="breadcrumb">
            		
                    <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            		
                    <li class="active">Brand Users</li>
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">
            
            		<div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
                  
                  				<table id="userslist" class="table table-bordered table-hover">
                    
                    				<thead>
                      
                      					<tr>
                        					
                                            <th>S No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th></th>
                                        	<th></th>
                                                                                        
                      					</tr>
                    
                    				</thead>
                    			
                                	<tbody>
                      					
                                        @foreach($users as $key => $user)

                                              @if($user->deleted_at=='')
 <tr {{ ($user->deleted_at!='') ? " class='deleted'" : "" }}>
                                            	
                                                <td>{{ $key+1 }}</td>
                                                
                                                <td>{{ ucfirst($user->first_name) }}</td>
                                                
                                                <td>{{ ucfirst($user->last_name) }}</td>
                                                
                                                <td>{{ $user->email }}</td>
                                                                                                
                                                <td>
                                                
                                                	@if ($user->inGroup($students))
                                                
                                                		Student
                                                
                                                	@endif
                                                    
                                                </td>
                                                
                                                <td>{{ date('Y-M-d H:i:s', strtotime($user->created_at)) }}</td>
                                                                                                
                                                <td><a href="{{ URL::route('admin.profiles.show', [$user->id]) }}" class="btn btn-info"><i class="fa fa-user-md"></i> View</a></td>
                                                
                                                <td><a href="{{ URL::route('admin.profiles.edit', [$user->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                                                                                                           
                                        	</tr>@endif
 @endforeach                                    
                                </tbody> 
                                <tfoot>
                      
                      					<tr>
                        					
                                            <th>S No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th></th>
                                        	<th></th>
                      					
                                        </tr>
                    
                    				</tfoot>
                  
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
	
    <!-- Users Import Modal Starts Here-->
    <div class="modal fade" id="users-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      
      	<div class="modal-dialog">
        	
            <div class="modal-content">
          
          		<div class="modal-header">
            
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            		<h4 class="modal-title">Import Users</h4>
          
          		</div>
          
          		<div class="modal-body">
            
            		{{ Form::open(['route' => 'admin_users_import', 'class' => 'form-horizontal','id' => 'users-import-form', 'files' => true]) }}
                    	
                        <div class="form-group">
                                            
                            {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}
        
                            <div class="col-sm-8">
                            
                                {{ Form::file('file', ['required' => 'required']) }}
                                
                                {{ errors_for('file', $errors) }}
                                
                            </div>
                            
                        </div>
                                            
                        <div class="form-group">
                                            
                            <div class="col-sm-offset-2 col-sm-8">
                          
                                {{ Form::submit('Import Users', ['class' => 'btn btn-lg btn-info btn-block']) }}
                        
                            </div>
                      
                        </div>
                                                                    
                    {{ Form::close() }}
          
          		</div>
        
        	</div><!-- /.modal-content -->
      
      	</div><!-- /.modal-dialog -->
    
    </div><!-- /.modal -->
    <!-- Users Import Modal Ends Here-->
    
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
        	
			var table = $('#userslist').DataTable( {
				
				scrollY:        "300px",
				
				scrollX:        true,
				
				scrollCollapse: true,
				
				paging:         true,
				
				"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 6, 7] }
       ]
				
			} );
			
        });
		
	</script>

@stop