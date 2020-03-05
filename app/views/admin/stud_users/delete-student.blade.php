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
                    List of Delete Student
      
                </h1>
          
                
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">
            
            		<div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
									
                             
								
								<table id="exampletwo" class="table table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                                <th>S No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Institution</th>
                                                <th>Status</th>
                                                <th>CardNumber</th>
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
        	
			var table = $('#studentslist').DataTable( {
				
				scrollY:        "700px",
				
				scrollX:        true,
                				
                scrollCollapse: true,
				
				paging:         true
				
			});
			
			$('#exampletwo').DataTable( {
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "bSort" : false,
                "ajax":{
                    url :"getdeletedata", // json datasource
                    type: "post",  // type of method  , by default would be get
                    error: function(){  // error handling code
                      $("#exampletwo").css("display","none");
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