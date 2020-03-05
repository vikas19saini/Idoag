@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Students Duplicates Dashboard')

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

                    <a href="{{ URL::route('admin_students_duplicate_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#duplicates-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete All</a>
                    
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

                                <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>card_number</th>
                                        <th>rollno</th>
                                        <th>status</th>
                                        <th>rol_no</th>
                                        <th>contact_number</th>
                                        <th>first_name</th>
                                        <th>last_name</th>
                                        <th>dob</th>
                                        <th>college_id</th>
                                        <th>streamorcourse</th>
                                        <th> validity_for_how_many_years</th>
                                        <th> cluborgrouporsociety</th>
                                        <th> residentordayscholar</th>
                                        <th> date_of_issue</th>
                                        <th> expiry_date</th>
                                        <th> section</th>
                                        <th> father_name</th>
                                        <th> batch_year</th>
                                        <th> program_duration</th>
                                        <th> email_id</th>
                                        <th> gender</th>
                                        <th> delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>card_number</th>
                                        <th>rollno</th>
                                        <th>status</th>
                                        <th>rol_no</th>
                                        <th>contact_number</th>
                                        <th>first_name</th>
                                        <th>last_name</th>
                                        <th>dob</th>
                                        <th>college_id</th>
                                        <th>streamorcourse</th>
                                        <th> validity_for_how_many_years</th>
                                        <th> cluborgrouporsociety</th>
                                        <th> residentordayscholar</th>
                                        <th> date_of_issue</th>
                                        <th> expiry_date</th>
                                        <th> section</th>
                                        <th> father_name</th>
                                        <th> batch_year</th>
                                        <th> program_duration</th>
                                        <th> email_id</th>
                                        <th> gender</th>
                                        <th> delete</th>
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

    <div class="modal fade" id="duplicates-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content outletsimport_modal-content">

                <div class="modal-header outletsimport_modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        {{ HTML::image('/assets/images/popup_close.png') }}
                    </button>

                    <h4 class="modal-title">Delete Students Duplicate Data</h4>

                </div>

                <div class="modal-body outletsimport_modal-body">

                    <!-- {{ Form::open(['route' => 'admin_students_duplicate_deleteall', 'class' => 'form-horizontal','id' => 'outlets-import-form']) }} -->
                    
                    <div class="form-group" style="text-align: center">

                        <h4>Are you sure you want to delete all the records permanently ?</h4> 

                        <div class="form-group">

                            <a href="{{ URL::route('admin_students_duplicate_deleteall') }}" class="btn btn-danger">  Delete All </a>

                        </div>

                    </div>

                </div>

            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    
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

            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "bSort" : false,
                "ajax":{
                    url :"testdata", // json datasource
                    type: "post",  // type of method  , by default would be get
                    error: function(){  // error handling code
                      $("#example").css("display","none");
                    }
                  }
            } );
			
			$(document).on('click', '#checkall', function(e) {
												
				var cells = table.cells( ).nodes();
				
    			$( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
			
			});	
  
        });	

	</script>

@stop