@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Slider')

@section('class', 'skin-blue fixed')

@section('css')
	
	{{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.10/summernote.css') }}
        
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
          
          		<h1>Add New Slider</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_sliders') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_sliders') }}"><i class="fa fa-bars"></i> Sliders</a></li>
                    
            		<li class="active">Add New Slider</li> -->
          		
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
                                    
                                        {{ Form::open(['route' => 'admin.sliders.store', 'class' => 'form-horizontal','id' => 'add-new-slider-form', 'files' => 'true']) }}
                                    	
                                            <div class="form-group">
                
                                                {{ Form::label('page_name', 'Select Slider', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::select('page_name', array(''=>'select','HomePageMainBanner' => 'Home Page Main Banner', 'HomePageSecondBanner' => 'Home Page Second Banner', 'HomePageThirdBanner' => 'Home Page Third Banner', 'HomePageThirdBannerImages' => 'Home Page Third Banner Images', 'HomePageFourthBanner' => 'Home Page Fourth Banner', 'HomePageFifthBanner' => 'Home Page Fifth Banner', 'StudentDashboardSlider' => 'Student Dashboard Slider'), null, ['class' => 'form-control','onchange'=>'getUpload(this.value)']) }}
                                                    
                                                    {{ errors_for('page_name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                           <div class="form-group">
                
                                                {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                        
                                           <div class="form-group">
                
                                                {{ Form::label('text_color', 'Color', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('text_color', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('text_color', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>

                                        <div class="form-group">

                                            {{ Form::label('link', 'Link', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::url('link', null, ['placeholder' => 'Link', 'class' => 'form-control']) }}

                                                {{ errors_for('link', $errors) }}

                                            </div>

                                        </div>
                                        <div class="form-group">

                                            {{ Form::label('priority', 'Order Preference', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::number('priority', null, ['placeholder' => 'Order Preference', 'class' => 'form-control']) }}

                                                {{ errors_for('priority', $errors) }}

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('target', 'Target', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::select('target',['Select Target','_blank'=>'Blank','_parent'=>'Parent'],null,['class'=>'form-control','placeholder'=>'Target']) }}

                                                {{ errors_for('status', $errors) }}

                                            </div>

                                        </div>

                                        <div class="form-group">
                
                                                {{ Form::label('title', 'Content', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::textarea('title', null, ['placeholder' => 'Content', 'class' => 'form-control', 'id' => 'title']) }}
                                                    
                                                    {{ errors_for('title', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                            
                                            	{{ Form::label('image_name', 'Image', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image_name', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image_name']) }}
                                                    
                                                    {{ errors_for('image_name', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">
                                                	
                                                    {{ HTML::image('assets/images/banner_img.jpg', '', ['id' => 'slider_image_preview', 'class' => 'slider-img']) }}
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="form-group mobile_image hide">
                                            
                                            	{{ Form::label('image_mobile', 'Mobile Image', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image_mobile', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image_mobile']) }}
                                                    
                                                    {{ errors_for('image_mobile', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">
                                                	
                                                    {{ HTML::image('assets/images/banner_img.jpg', '', ['id' => 'slider_image_mobile', 'class' => 'slider-img']) }}
                                                    
                                                </div>
                                                
                                            </div>
                                                                                     
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New Slider', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
    
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.10/summernote.js') }}
    
    <script type="text/javascript">
		
		$(document).ready(function(e) {
			
			function readURL(input) {
			
				if (input.files && input.files[0]) {
					
					var reader = new FileReader();
			
					reader.onload = function (e) {
						
						if(input.id == 'image_name')
							$('#slider_image_preview').attr('src', e.target.result).fadeIn('slow');
						else
							$('#slider_image_mobile').attr('src', e.target.result).fadeIn('slow');
					};				
					reader.readAsDataURL(input.files[0]);					
				}				
			}
			
			$("#image_name").change(function(){
				
				readURL(this);				
			});
			$("#image_mobile").change(function(){
				
				readURL(this);				
			});
		
			/* Add New Slider Form Validation Code Start Here */
			
			$('#add-new-slider-form').formValidation({
			
				framework: 'bootstrap',
				
				excluded: [':disabled'],
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',
									
				fields: {
					
					page_name: {
						
						validators: {
							
							notEmpty: {
								
								message: 'Choose atleast one slider'
								
							}
							
						}
					},
					
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
					
					title: {
						
						validators: {
							
							callback: {
								
								
								message: 'The title is required and cannot be empty',
								
								callback: function(value, validator, $field) {
									
									var code = $('[name="title"]').code();
									
									// <p><br></p> is code generated by Summernote for empty content
									return (code !== '' && code !== '<p><br></p>');
									
								}
								
							}
							
						}
						
					}
											
				}
					
			}).find('[name="title"]')
            
			.summernote({
                
				height: 200
            
			})
            
			.on('summernote.change', function(customEvent, contents, $editable) {
               
			    // Revalidate the content when its value is changed by Summernote
                $('#add-new-slider-form').formValidation('revalidateField', 'title');
            
			})
            
			.end();
			
			/* Add New Slider Form Validation Code Ends Here */
		    
		});
		
	</script>
    
@stop