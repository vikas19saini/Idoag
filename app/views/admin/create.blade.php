@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New User')

@section('class', 'skin-blue fixed')

@section('css')
	
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
          
          		<h1>Add New User</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_users') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_users') }}"><i class="fa fa-group"></i> Users</a></li>
                    
            		<li class="active">Add New User</li> -->
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">
    		
            	<div class="row">
            
                    <div class="col-lg-12">
                    	
                       @include('admin.layouts.flash')
                                
                        <div class="box box-primary">
                                                        
                            <div class="box-body">
                                                                
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                    
                                        {{ Form::open(['route' => 'admin.profiles.store', 'class' => 'form-horizontal','id' => 'add-new-user-form']) }}
                                    
                                           <div class="form-group">
                
                                                {{ Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('first_name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('last_name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('email', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('mobile', 'Mobile Number', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('mobile', null, ['placeholder' => 'Mobile Number', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('mobile', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('import_students', 'Import Students', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('import_students', 1, null) }}
                                                    
                                                    {{ errors_for('import_students', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_categories', 'Manage Categories', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_categories', 1, null) }}
                                                    
                                                    {{ errors_for('manage_categories', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_institutions', 'Manage Institutions', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_institutions', 1, null) }}
                                                    
                                                    {{ errors_for('manage_institutions', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_brands', 'Manage Brands', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_brands', 1, null) }}
                                                    
                                                    {{ errors_for('manage_brands', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_offers', 'Manage Offers', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_offers', 1, null) }}
                                                    
                                                    {{ errors_for('manage_offers', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('brand_users', 'Brand Users', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('brand_users', 1, null) }}
                                                    
                                                    {{ errors_for('brand_users', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_vouchers', 'Manage Vouchers', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_vouchers', 1, null) }}
                                                    
                                                    {{ errors_for('manage_vouchers', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_pincode', 'Manage Pincode', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_pincode', 1, null) }}
                                                    
                                                    {{ errors_for('manage_pincode', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_advertisements', 'Manage Advertisements', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_advertisements', 1, null) }}
                                                    
                                                    {{ errors_for('manage_advertisements', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                
                                                {{ Form::label('manage_testimonials', 'Manage Testimonials', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::checkbox('manage_testimonials', 1, null) }}
                                                    
                                                    {{ errors_for('manage_testimonials', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                            
                                            	{{ Form::label('activated', 'Activate', ['class' => 'col-sm-3 control-label']) }}
                            
                            					<div class="col-sm-8">
                                                	
                                                    {{ Form::checkbox('activated', 1, null) }}
                                                    
                            						{{ errors_for('activated', $errors) }}
                                                    
                            					</div>
                                                
                                            </div>
                                                                            
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New User', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
                                                </div>
                                          
                                          	</div>
                                    
                                        {{ Form::close() }}
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
                            
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
    
    {{ HTML::script('assets/plugins/iCheck/icheck.min.js') }}
    
    <script type="text/javascript">
		
		$(document).ready(function(e) {
        	
			/* Checkbox intialization code */
			 $('input').iCheck({
			  
			  checkboxClass: 'icheckbox_square-blue',
			  
			  radioClass: 'iradio_square-blue',
			  
			  increaseArea: '20%' // optional
			
			});
		
			/* Add New User Form Validation Code Start Here */
			
			$('#add-new-user-form').formValidation({
			
				framework: 'bootstrap',
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',
									
				fields: {
					
					first_name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The First Name is required and cannot be empty'
								
							},
							regexp: {
								
								regexp: /^[a-z\s]+$/i,
								
								message: 'The full name can consist of alphabetical characters and spaces only'
							}
							
						}
					},
					
					last_name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Last Name is required and cannot be empty'
								
							},
							regexp: {
								
								regexp: /^[a-z\s]+$/i,
								
								message: 'The last name can consist of alphabetical characters and spaces only'
							}
							
						}
					},
					
					email: {
				
						validators: {
							
							notEmpty: {
								
								message: 'The email input is required and cannot be empty'
								
							},
							
							regexp: {
								
								regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
								
								message: 'The email input is not a valid email address'
								
							}
				
						}
					},
					
					mobile: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Mobile Number is required and cannot be empty'
								
							},
							phone: {
								
								country: 'IN',
								
								message: 'The value is not valid India Mobile number'
							},
							
							stringLength: {
							
								max: 10,
								
								message: 'The Mobile number must be at max 10 digits'
								
							}
						}
					}	
											
				}
					
			});
			
			/* Add New User Form Validation Code Ends Here */
		    
        });
		
	</script>
    
@stop