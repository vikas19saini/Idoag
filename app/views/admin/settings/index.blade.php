@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Settings Dashboard')

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
          
          		<h1>Settings</h1>
          
          		<ol class="breadcrumb">
            		
                    <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            		
                    <li class="active">Admin Settings</li> -->
          		
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
                                            
                                            <th>Title</th>
                                            <th>Logo</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                                                                        
                                        </tr>
                    
                                    </thead>
                                
                                    <tbody>
                                        
                                        @foreach($settings as $key => $setting)
                                        
                                            <tr>
                                                                                                
                                                <td>{{ ucfirst($setting->title) }}</td>
                                                
                                                <td>{{ HTML::image('uploads/'.$setting->logo) }}</td>
                                                                                                
                                                <td>{{ date('Y-M-d H:i:s', strtotime($setting->created_at)) }}</td>

                                                <td><a href="{{ URL::route('admin.settings.edit', [$setting->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                                                
                                            </tr>
  @endforeach
                                </tbody>
                                <tfoot>
                      
                                        <tr>
                                            
                                            <th>Title</th>
                                            <th>Logo</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                        
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
	
    {{ HTML::script('assets/plugins/iCheck/icheck.min.js') }}
    
	{{ HTML::script('assets/js/app.js') }}
    


@stop