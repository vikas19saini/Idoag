@extends('admin.layouts.default')

@section('title','Idoag.com | Users Roles')

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
          
          		<h1>Roles</h1>
          
          		<ol class="breadcrumb">

                <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li> 
                    
            		<li class="active">Users Roles</li> -->
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">
            
            		<div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
                  
                  				<table id="roleslist" class="table table-bordered table-hover">
                    
                    				<thead>
                      
                      					<tr>
                        					
                                            <th>S No</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                      					</tr>
                    
                    				</thead>
                    			
                                	<tbody>
                      					
                                        @foreach($groups as $key => $group)
                                        
                                        	<tr>
                                            	
                                                <td>{{ $key+1 }}</td>
                                                
                                                <td>{{ ucfirst($group->name) }}</td>
                                                
                                                <td>{{ date('Y-M-d H:i:s', strtotime($group->created_at)) }}</td>

                                          </tr>

                                        @endforeach  
                                </tbody> 

                                <tfoot>
                      
            					           <tr>
              					
                                  <th>S No</th>
                                  <th>Role</th>
                               	  <th> Created At</th>
                                  
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

@stop

@section('js')
    
    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}
    
    {{ HTML::script('assets/plugins/dataTables/js/dataTables.responsive.min.js') }}
    
    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}
        
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
    <script type="text/javascript">
	
		$(document).ready(function(e) {
        
			 $('#roleslist').DataTable({
				 
					responsive: true
			});
			
			$("#roleslist").css("width","100%");
		    
        });
		
	</script>

@stop