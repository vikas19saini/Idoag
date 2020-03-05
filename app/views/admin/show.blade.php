@extends('admin.layouts.default') 

@section('title', 'Idoag.com | User Profile')

@section('class', 'skin-blue fixed')

@section('css')
	
    
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
          
          		<h1>{{ ucfirst($user->first_name) }}'s profile <a href="{{ URL::route('admin.profiles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New User</a></h1>
          
          		<ol class="breadcrumb">
            		
                    <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_users') }}"><i class="fa fa-group"></i> Users</a></li>
            		
                    <li class="active">{{ ucfirst($user->first_name) }}'s profile</li>
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">
            	
                <div class="row">
            
            		<div class="col-md-12">
              			
                        <div class="box box-primary">
                
                			<div class="box-body">
                  
                  				<div class="row">
                            
                                    <div class="col-lg-4">
                                        
                                        First Name
                                        
                                    </div>
                                    
                                    <div class="col-lg-8">
                                    
                                        {{ ucfirst($user->first_name) }}
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-lg-4">
                                        
                                        Last Name
                                        
                                    </div>
                                    
                                    <div class="col-lg-8">
                                    
                                        {{ ucfirst($user->last_name) }}
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-lg-4">
                                        
                                        Email
                                        
                                    </div>
                                    
                                    <div class="col-lg-8">
                                    
                                        {{ $user->email }}
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-lg-4">
                                        
                                        Role
                                        
                                    </div>
                                    
                                    <div class="col-lg-8">
                                    
                                       {{ $user_group }}
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-lg-4">
                                        
                                        Created At
                                        
                                    </div>
                                    
                                    <div class="col-lg-8">
                                    
                                       {{ date('Y-M-d H:i:s', strtotime($user->created_at)) }}
                                        
                                    </div>
                                    
                                </div>
                			
                            </div>
                            <!-- /.box-body -->
              				
                            <div class="box-footer">
                            	
                                <a href="{{ URL::route('admin.profiles.edit', [$user->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                
                            </div>
                            <!-- box-footer -->
  
              			</div>
              			<!-- /.box -->
            		
                    </div>
                    <!-- /.col -->
          
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

	{{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
@stop