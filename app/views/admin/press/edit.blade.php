@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit News')

@section('class', 'skin-blue fixed')

@section('css')
	
	{{ HTML::style('assets/plugins/summernote/summernote.css') }}
        
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
          
          		<h1>Edit News</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_sliders_press') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_sliders') }}"><i class="fa fa-bars"></i> Sliders</a></li>
                    
            		<li class="active">Edit Slider</li> -->
          		
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
                                    
                                        {{ Form::model($press, ['method' => 'PATCH','route' => ['admin.slider_press.update', $press->id], 'class' => 'form-horizontal','id' => 'edit-press-form', 'files' => 'true']) }}                                    	
                                            
                                           <div class="form-group">
                
                                                {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                                                                        
                                            <div class="form-group">
                
                                                {{ Form::label('link', 'Link', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('link', null, ['placeholder' => 'http://www.example.com', 'class' => 'form-control', 'id' => 'link']) }}
                                                    
                                                    {{ errors_for('link', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                           <div class="form-group">
                
                                                {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::textarea('description', null, ['placeholder' => 'content','id'=>'description', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('description', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>

                                            <div class="form-group">
                                            
                                            	{{ Form::label('image_logo', 'Logo for Press', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image_logo', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image_logo']) }}
                                                    
                                                    {{ errors_for('image_logo', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">
                                                	
                                                    @if($press->image_logo)
                                                    
                                                    	{{ HTML::image('uploads/press/'.$press->image_logo, '', ['id' => 'press_image_preview', 'class' => 'slider-img']) }}
                                                        
                                                    @else
                                                    
                                                    	{{ HTML::image('assets/images/banner_img.jpg', '', ['id' => 'press_image_preview', 'class' => 'slider-img']) }}
                                                        
                                                    @endif
                                                    
                                                </div>
                                                
                                            </div>

                                            <!-- <div class="form-group">
                                            
                                            	{{ Form::label('image_news', 'Image for News', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image_news', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image_news']) }}
                                                    
                                                    {{ errors_for('image_news', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">
                                                	
                                                    @if($press->image_news)
                                                    
                                                    	{{ HTML::image('uploads/press/'.$press->image_news, '', ['id' => 'press_image_news', 'class' => 'slider-img']) }}
                                                        
                                                    @else
                                                    
                                                    	{{ HTML::image('assets/images/banner_img.jpg', '', ['id' => 'press_image_news', 'class' => 'slider-img']) }}
                                                        
                                                    @endif
                                                    
                                                </div>
                                                
                                            </div> -->
                                                

                                                                                     
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update News', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
    
    {{ HTML::script('assets/plugins/summernote/summernote.js') }}
    
    <script type="text/javascript">
		
		$(document).ready(function(e) {
			
			function readURL(input) {
			
				if (input.files && input.files[0]) {
					
					var reader = new FileReader();
			
					reader.onload = function (e) {
						
						$('#press_image_preview').attr('src', e.target.result).fadeIn('slow');
						//$('#press_image_news').attr('src', e.target.result).fadeIn('slow');
						
					};
					
					reader.readAsDataURL(input.files[0]);
					
				}
				
			}
			
			$("#image_logo").change(function(){
				
				readURL(this);
				
			});

			// $("#image_news").change(function(){
				
			// 	readURL(this);
				
			// });
		
			/* Edit a Slider Form Validation Code Start Here */
			
			$('#edit-press-form').formValidation({
			
				framework: 'bootstrap',
				
				excluded: [':disabled'],
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',

					name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Name is required and cannot be empty'
								
							},
							regexp: {
								
								regexp: /^[a-z\s0-9]+$/i,
								
								message: 'The name can consist of alphabetical characters and spaces only'
							}
							
						}
					},
									
				link: {
					
					page_name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'Please Give original Article link'
								
							}
							
						}
					},
										
					description: {
						
						validators: {
							
							callback: {
								
								
								message: 'The description is required and cannot be empty',
								
								callback: function(value, validator, $field) {
									
									var code = $('[name="description"]').code();
									
									// <p><br></p> is code generated by Summernote for empty content
									return (code !== '' && code !== '<p><br></p>');
									
								}
								
							}
							
						}
						
					}
											
				}
					
			}).find('[name="description"]')
            
			.summernote({
                
				height: 200
            
			})
            
			.on('summernote.change', function(customEvent, contents, $editable) {
               
			    // Revalidate the content when its value is changed by Summernote
                $('#add-new-press-form').formValidation('revalidateField', 'description');

            
			})
            
			.end();
			
			/* Edit a Slider Form Validation Code Ends Here */

		});
	</script>
    
@stop