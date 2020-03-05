@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit Photo')

@section('class', 'skin-blue fixed')

@section('css')

    {{HTML::style('packages/summernote/summernote.css')}}
   
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
          
          		<h1>Edit Offer</h1>
          
          		<ol class="breadcrumb">
            		
                    <a href="{{ URL::route('admin_photos') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_photos') }}"><i class="fa fa-bars"></i> Photos</a></li>
                    
            		<li class="active">Edit photo</li> -->
          		
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

                                       {{ Form::model($photo, ['method' => 'PATCH','route' => ['admin.photos.update', $photo->id], 'files' => true, 'class' => 'form-horizontal','id' => 'edit-photo-form']) }}

                                        @include('admin.partials.photo_form')

                                        <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update Photo', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

	{{ HTML::script('assets/js/app.js') }}
    
    {{HTML::script('packages/summernote/summernote.js')}}

    <script type="text/javascript">
		
		$(document).ready(function(e) {

            $("#description").summernote();


            function readURL(input) {
			
				if (input.files && input.files[0]) {
					
					var reader = new FileReader();
			
					reader.onload = function (e) {
						
						$('#photo_image_preview').attr('src', e.target.result).fadeIn('slow');
						
					};
					
					reader.readAsDataURL(input.files[0]);
					
				}
				
			}
			
			$("#image").change(function(){
				
				readURL(this);
				
			});
			
			 
			 	
			/* Edit photo Form Validation Code Start Here */
			
			$('#edit-photo-form').formValidation({
			
				framework: 'bootstrap',

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
					}

				}
					
			});
			
			/* Edit photo Form Validation Code Ends Here */
		    
		});
		
	</script>
    
@stop