@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit Event')

@section('class', 'skin-blue fixed')

@section('css')
	
    {{ HTML::style('assets/plugins/multiselect/bootstrap-multiselect.css') }}
   
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
          
          		<h1>Edit Event</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_inst_events') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

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
                                    
                                       {{ Form::model($event, ['method' => 'PATCH','route' => ['admin.inst_events.update', $event->id], 'files' => true, 'class' => 'form-horizontal','id' => 'edit-offer-form']) }}
                                    	                                            
                                           <div class="form-group">
                
                                                {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                        <div class="form-group">

                                            {{ Form::label('short_description',  'Short Description', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::textarea('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control', 'id' => 'description']) }}

                                                {{ errors_for('short_description', $errors) }}

                                            </div>

                                        </div>
                                            <div class="form-group">
                
                                                {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}
                                                    
                                                    {{ errors_for('description', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                             <div class="form-group">
                                            
                                            	{{ Form::label('size', 'Size', ['class' => 'col-sm-3 control-label']) }}
                            
                            					<div class="col-sm-8">
                                                    {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}


                                                    {{ errors_for('size', $errors) }}
                                                    
                            					</div>
                                                
                                            </div>
                                            

                                            
                                            <div class="form-group">
                                            
                                            	{{ Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) }}
                            
                            					<div class="col-sm-8">
                                                	
                                                    {{ Form::checkbox('status', 1, null) }}
                                                    
                            						{{ errors_for('status', $errors) }}
                                                    
                            					</div>
                                                
                                            </div>
                                       
                                            <div class="form-group">
                                            
                                            	{{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}
                                                    
                                                    {{ errors_for('image', $errors) }}
                                                    
                                                </div>
                                            
                                                
                                                <div class="col-sm-5">
                                                	
                                                  	{{ HTML::image('uploads/photos/'.$event->image, '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}
                                                </div>
                                                
                                            </div>
                                            

                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update Event', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
    
    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}

    <script type="text/javascript">
		
		$(document).ready(function(e) {
			
			function readURL(input) {
			
				if (input.files && input.files[0]) {
					
					var reader = new FileReader();
			
					reader.onload = function (e) {
						
						$('#offer_image_preview').attr('src', e.target.result).fadeIn('slow');
						
					};
					
					reader.readAsDataURL(input.files[0]);
					
				}
				
			}
			
			$("#image").change(function(){
				
				readURL(this);
				
			});
			
			 $("#category").multiselect({
				
				maxHeight:200,
				buttonWidth: '650px',
				inheritClass: true,
				includeSelectAllOption: true,
				nonSelectedText: 'Select Categories'	
			});
			 	
			/* Edit Brand Form Validation Code Start Here */
			
			$('#edit-offer-form').formValidation({
			
				framework: 'bootstrap',
				
				excluded: [':disabled'],
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',
									
				fields: {
					
					offer_title: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Name is required and cannot be empty'
								
							}
							
						}
					},
					
					offer_desc: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Descritpion is required and cannot be empty'
								
							}
							
						}
					}
											
				}
					
			});
			
			/* Edit Brand Form Validation Code Ends Here */
		    
		});
		
	</script>
    
@stop