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
                
                	List of Offers 
                    
                    <a href="{{ URL::route('admin.offers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Offer</a>
                    
                    <!--  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brands-import"><i class="fa fa-upload"></i> Import Offers</a>
                    
                    <a href="{{ URL::route('admin_brands_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Offers</a> -->
                    
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
                                                <th>Name</th>
                                                <th>Brand</th>
                                                 <th>Image</th>
                                                <th>Coupon</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="80">Action</th>
                                                <th><input type="checkbox" name="selectall" value="all" id="checkall" /></th>
                                                                                            
                                            </tr>
                        
                                        </thead>
                                    
                                        <tbody>
                                            
                                            @foreach($offers as $key => $offer)

                                                  @if($offer->deleted_at=='')
                                                 <tr {{ ($offer->deleted_at!='') ? " class='deleted'" : "" }}>
                                                    
                                                    <td>{{ $key+1 }}</td>
                                                    
                                                    <td>{{ ucfirst($offer->name) }}</td>
                                                    
                                                    <td>{{ getBrandName($offer->brand_id) }}</td>

                                                    <td>{{ HTML::image('uploads/photos/'.$offer->image, '', ['class' => 'admin_thumbnail']) }}</td>
                                             
                                                    <td>@if($offer->voucher_type=='no_coupon')
                                                            No Coupon
                                                        @else
                                                           <a href="{{ URL::route('admin_offer_coupons', [$offer->id]) }}">{{ucfirst($offer->voucher_type)}}</a>
                                                         @endif
                                                    </td>
                                                     <td>{{ $offer->featured }}</td>
                                                    
                                                    <td>{{ $offer->status }}</td>
                                                                                                        
                                                    <td>{{ date('Y-M-d H:i:s', strtotime($offer->created_at)) }}</td>
                                                                                                                                                        
                                                    <td><a href="{{ URL::route('admin.offers.edit', [$offer->id]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ URL::route('offer_details', [getBrandSlug($offer->brand_id),$offer->slug]) }}" target="_blank" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-list"></i></a></td>
                                                    
                                                    <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $offer->id }}"></td>
                                                                                                               
                                                </tr>@endif
 @endforeach                                    
                                </tbody> 
                                <tfoot>
                          
                                            <tr>
                                                
                                                <th>S No</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                 <th>Image</th>
                                                <th>Coupon</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
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
    <div class="modal fade" id="brands-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      
      	<div class="modal-dialog">
        	
            <div class="modal-content">
          
          		<div class="modal-header">
            
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            		<h4 class="modal-title">Import Sliders</h4>
          
          		</div>
          
          		<div class="modal-body">
            
            		{{ Form::open(['route' => 'admin_brands_import', 'class' => 'form-horizontal','id' => 'users-import-form', 'files' => true]) }}
                    	
                        <div class="form-group">
                                            
                            {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}
        
                            <div class="col-sm-8">
                            
                                {{ Form::file('file', ['required' => 'required']) }}
                                
                                {{ errors_for('file', $errors) }}
                                
                            </div>
                            
                        </div>
                                            
                        <div class="form-group">
                                            
                            <div class="col-sm-offset-2 col-sm-8">
                          
                                {{ Form::submit('Import Sliders', ['class' => 'btn btn-lg btn-info btn-block']) }}
                        
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