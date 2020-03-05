@extends('admin.layouts.default')

@section('title','Idoag.com | Logs Dashboard')

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
        
        	<!-- Content Header (Testimonial header) -->
        	<section class="content-header">
          
          		<h1>
                
                	List of Logs
                    
                    
 
                    
               	</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

            
            		<div class="row"><div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
                  				
                                
                                    <table id="logslist" class="table table-bordered table-hover">
                        
                                        <thead>
                          
                                            <tr>
                                                
                                                <th>S No</th>
                                                <th>Request</th>
                                                <th>Code</th>
                                                <th>URI</th>
                                                <th>IP</th>
			                        <th>Date Created</th>
                                                                                            
                                            </tr>
                        
                                        </thead>
                                    
                                        <tbody>
                                            
                                            @foreach($logs as $key => $log)
                                            
                                                    <td>{{ $key+1 }}</td>
                                                     <td>{{ $log->request }}</td>
                                                    <td>{{ $log->code }}</td>
                                                     <td>{{ $log->uri }}</td>
                                                     <td>{{ $log->ip }}</td>
                                                    <td>{{ date('Y-M-d H:i:s', strtotime($log->created_at)) }}</td>
                                                </tr>
					 @endforeach                                    
                                </tbody> 
                                <tfoot>
                          
                                            <tr>
                                           	<th>S No</th>
                                                <th>Request</th>
                                                <th>Code</th>
                                                <th>URI</th>
                                                <th>IP</th>
                                                <th>Date Created</th>     
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
    
    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}
    
    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}
    
    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
    <script type="text/javascript">
	
		$(document).ready(function(e) {
        	
			var table = $('#logslist').DataTable( {
				
				scrollY:        "300px",
				
				scrollX:        true,
				
				scrollCollapse: true,
				
				paging:         true,
				
				"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3,4 ] }
       ]
				
			} );
			
        });
		
	</script>

@stop
