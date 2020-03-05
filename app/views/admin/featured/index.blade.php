@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Offers Dashboard')

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
                
                	Featured Post
                    
                    <!--  <a href="{{ URL::route('admin.offers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Offer</a>
                    
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brands-import"><i class="fa fa-upload"></i> Import Offers</a>
                    
                    <a href="{{ URL::route('admin_brands_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Offers</a> -->
                      <a href="{{ URL::route('add_featured') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
                    
               	</h1>
          
          		<ol class="breadcrumb">
            		
                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>


                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            		
                    <li class="active">Offers</li> -->
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">

				<div class="row">
            
            		<div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
            
                        <div class="box box-primary">
                                
                			<div class="box-body">
                  				
                                {{ Form::open(['route' => 'admin_offers_actions', 'class' => 'form-horizontal','id' => 'brands-actions-form']) }}
                                
                                    <table id="offerslist" class="table table-bordered table-hover">
                        
                                        <thead>
                          
                                            <tr>
                                                
                                                <th>S No</th>
                                                <th>Post Name</th>
                                                <th>Type</th>
                                                <th>Brand</th>
                                                <th>End Date</th>
                                                <th>Image</th> 
                                                 <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            
                                            @if(!$featured_posts->isEmpty())

                                                @foreach($featured_posts as $key=>$featured)

                                                    <tr>
                                                        
                                                        <td>{{ $key+1 }}</td>
                                                        
                                                        <td>{{ ucfirst($featured->name) }}</td>
                                                        <td>{{ ucfirst($featured->type) }}</td>

                                                        <td>{{ getBrandName($featured->brand_id) }}</td>
                                                        
                                                        <td>{{ $featured->end_date }}</td>
                                                        
                                                        <td>{{ HTML::image('uploads/photos/'.$featured->image, '', ['class' => 'admin_thumbnail']) }}</td>
                                                 

                                                        <td>{{ $featured->status }}</td>
                                                                                                            
                                                        <td>{{ date('Y-M-d H:i:s', strtotime($featured->created_at)) }}</td>
                                                                                                                                                            
                                                        <td><a href="{{ URL::route('admin_featured_deactivate', [$featured->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Deactivate</a></td>                                                
                                                                                                                   
                                                    </tr>

                                                @endforeach

                                            @endif
                                                                                                
                                        </tbody>

                                    </table>
                					
                                    
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
        	
			var table = $('#offerslist').DataTable( {
				
				scrollY:        "700px",
				
				scrollX:        true,
				
				scrollCollapse: true,
				
				paging:         true,
				
				"aoColumnDefs": [
          { 'bSortable': false }
       ]
				
			} );
			
			$(document).on('click', '#checkall', function(e) {
												
				var cells = table.cells( ).nodes();
				
    			$( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
			
			});
			
        });
		
	</script>

@stop