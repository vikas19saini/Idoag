@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Student User')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
	
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

                    <a href="{{ URL::route('admin_students_users') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_students_users') }}"><i class="fa fa-group"></i> Students Users</a></li>
                    
            		<li class="active">Add New Student User</li> -->
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">
    		
            	<div class="row"><div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
                                
                        <div class="box box-primary">
                                                        
                            <div class="box-body">
                                                                
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                    
                                        {{ Form::open(['route' => 'admin.students_users.store', 'class' => 'form-horizontal','id' => 'add-new-brand-user-form']) }}
                                    
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
                
                                                {{ Form::label('card_number', 'Card Number', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('card_number', null, ['placeholder' => 'Card Number', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('card_number', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>

											<div class="form-group">

											    {{ Form::label('expiry_date', 'Card Expiry Date', ['class' => 'col-sm-3 control-label']) }}
											    
											    <div class="col-sm-3">
											    
											        {{ Form::text('expiry_date', null, ['placeholder' => 'Card Expiry Date', 'class' => 'form-control', 'id'=>'expiry_date']) }}
											    	
											    	{{ errors_for('expiry_date', $errors) }}

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

												{{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-3 control-label']) }}

												<div class="col-sm-8">
											    
											    	{{ Form::select('institution_id', $institutions, '' , ['class' => 'form-control', 'id' => 'institution','required' => 'required']) }}
											        
													{{ errors_for('institution_id', $errors) }}
											        
												</div>
											    
											</div>
                                                                            
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New Student User', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}

	{{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
    {{ HTML::script('assets/plugins/iCheck/icheck.min.js') }}

    <script type="text/javascript">
		
		$(document).ready(function(e) {

      	$('#expiry_date').datepicker({
           format: 'dd-mm-yyyy'
        
        });

			/* Checkbox intialization code */
			 $('input').iCheck({
			  
			  checkboxClass: 'icheckbox_square-blue',
			  
			  radioClass: 'iradio_square-blue',
			  
			  increaseArea: '20%' // optional
			
			});
		
			/* Add New Brand User Form Validation Code Start Here */
			
			$('#add-new-brand-user-form').formValidation({
			
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

					card_number: {
						
						validators: {

							notEmpty: {
								
								message: 'The Card Number is required and cannot be empty'
								
							},
							
							numeric: {
                  
								message: 'The value is not a number' s
								                
							},
                
			                stringLength: {
			                   
			                	min: 16,

			                	max:16,
			                   
			                	message: 'The Card number must be 16 digits.'
			                }
							
						}
					},	

					expiry_date: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The expiry_date is required and cannot be empty'
								
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
			
			/* Add New Student User Form Validation Code Ends Here */
		    
        });
		
	</script>
    
@stop