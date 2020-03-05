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
                	Add Featured Post
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
                                      
                      {{ Form::open(['route' => 'searchFeatured','class' => 'form-horizontal','id' => 'search_form','method'=>'post']) }}
                               <div class="form-group">
                            
                          {{ Form::label('type', 'Post Type', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                         
                           {{ Form::select('type', array('' => 'Select Type','offer'=>'Offer','internship'=>'Internship','photo'=>'Photo','text'=>'Text','event'=>'Event'), $param['type'] , ['class' => 'form-control']) }}
                          
                          </div>                                                    
                      
                        </div>             
                        <div class="form-group">                            
                            
                          {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('institution_id', array('' => 'Please select College') + $institutions, $param['institution_id'], ['class' => 'form-control']) }}

                          </div> 
                      
                          {{ Form::label('brand_id', 'Brand', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                          
                            {{ Form::select('brand_id', array('' => 'Please select Brand') + $brands, $param['brand_id'] , ['class' => 'form-control']) }}
                          
                          </div>   

                        </div>

                    

                          {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-info center-block']) }}

                       {{ Form::close() }}
                                        
                     </div>
                  <!-- /.box-body -->
                  </div>

                  <div class="box box-primary">
                            
                        <div class="box-body">
                         
                             @if(!$featured_posts->isEmpty())
                             <p><b>Search Result:</b></p>
                                <table id="offerslist" class="table table-bordered table-hover">
                    
                                    <thead>
                      
                                        <tr>
                                            
                                            <th>S No</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Image</th> 
                                            <th>Featured Post</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                                                                        
                                        </tr>
                    
                                    </thead>
                                
                                    <tbody>
                                        
                                       

                                            @foreach($featured_posts as $featured)

                                                <tr>
                                                    
                                                    <td>{{ 1 }}</td>
                                                    
                                                    <td>{{ ucfirst($featured->name) }}</td>
                                                    
                                                    <td>{{ $featured->type }}</td>
                                                      
                                                    <td>{{ HTML::image('uploads/photos/'.$featured->image, '', ['class' => 'admin_thumbnail']) }}</td>
                                             
                                                    <td>{{ $featured->featured }}</td>
                                                    
                                                    <td>{{ $featured->status }}</td>
                                                                                                        
                                                    <td>{{ date('Y-M-d H:i:s', strtotime($featured->created_at)) }}</td>
                                                                                                                                                        
                                                    <td>
                                                        @if($featured->featured==1)
                                                    <a href="{{ URL::route('admin_featured_deactivate', [$featured->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Deactivate</a>
                                                    @else
  <a href="{{ URL::route('admin_featured_activate', [$featured->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Activate</a>
                                                 
                                                    @endif</td>                                                
                                                                                                               
                                                </tr>

                                            @endforeach

                                      
                                                                                            
                                    </tbody>
                                
                                    <tfoot>
                      
                                        <tr>
                                            
                                            <th>S No</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Image</th> 
                                            <th>Featured Post</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <!-- <th>Edit</th> -->
                                            <th></th>
                                        
                                        </tr>
                    
                                    </tfoot>
                  
                                </table>  @endif
                                 
                            
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