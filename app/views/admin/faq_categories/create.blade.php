@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Category')

@section('class', 'skin-blue fixed')

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
          
          		<h1>Add New Category</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_faq_categories') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                     
          		
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
                                    
                                        {{ Form::open(['route' => 'admin.faq_categories.store', 'class' => 'form-horizontal','id' => 'add-new-category-form', 'files' => 'true']) }}
                                    	                                            
                                           <div class="form-group">
                
                                                {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                                                                        
                                            <div class="form-group">
                
                                                {{ Form::label('orderno', 'Order No', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('orderno', 1, ['placeholder' => 'Order No', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('orderno', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                                                                     
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New Category', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
        
    <script type="text/javascript">
		
		$(document).ready(function(e) {
					
			/* Add New Category Form Validation Code Start Here */
			
			$('#add-new-category-form').formValidation({
			
				framework: 'bootstrap',
				
				excluded: [':disabled'],
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',
									
				fields: {
					
					name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Name is required and cannot be empty'
								
							}
							
						}
					},
					
					Description: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Descritpion is required and cannot be empty'
								
							}
							
						}
					}
											
				}
					
			});
			
			/* Add New Category Form Validation Code Ends Here */
		    
		});
		
	</script>
    
@stop