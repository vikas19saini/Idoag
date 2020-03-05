@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Settings')

@section('class', 'skin-blue fixed')

@section('css')

	{{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}
    	
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
                    
                    <a href="{{ URL::route('admin_settings') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_settings') }}"><i class="fa fa-group"></i> Settings</a></li>
                    
                    <li class="active">Edit Site Settings</li> -->
                
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
                                                                            
                                        {{ Form::model($setting , ['method' => 'PATCH', 'route' => ['admin.settings.update', $setting->id], 'class' => 'form-horizontal', 'id' => 'edit-setting-form', 'files' => 'true']) }}	
                                    		
                                            <div class="form-group">
                    
                                                {{ Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('title',  null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('title', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                           <div class="form-group">
                
                                                {{ Form::label('logo', 'Logo', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('logo', null, '', ['class' => 'form-control', 'id' => 'logo']) }}
                                                    
                                                    {{ errors_for('logo', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">

                                                    
                                                    @if(isset($setting))
                                                    
                                                        {{ HTML::image('uploads/'.$setting->logo, '', ['id' => 'edit-logo-preview']) }}

                                                    @else
                                                    
                                                        {{ HTML::image('uploads/logo.png', '', ['id' => 'edit-logo-preview']) }}
                                                        
                                                    @endif
                                                    
                                                </div>
                                            
                                            </div>

                                            <div class="form-group">

                                                {{ Form::label('gplus', 'GoolgePlus URL', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">

                                                    {{ Form::text('gplus', null, ['placeholder' => 'GoolgePlus URL', 'class' => 'form-control']) }}

                                                    {{ errors_for('gplus', $errors) }}

                                                </div>

                                            </div>
                                            <div class="form-group">

                                                {{ Form::label('facebook', 'Facebook URL', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">

                                                    {{ Form::text('facebook', null, ['placeholder' => 'Facebook URL', 'class' => 'form-control']) }}

                                                    {{ errors_for('facebook', $errors) }}

                                                </div>

                                            </div>
                                            <div class="form-group">

                                                {{ Form::label('linkedin', 'LinkedIn URL', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">

                                                    {{ Form::text('linkedin', null, ['placeholder' => 'LinkedIn URL', 'class' => 'form-control']) }}

                                                    {{ errors_for('linkedin', $errors) }}

                                                </div>

                                            </div>
                                            <div class="form-group">

                                                {{ Form::label('twitter', 'Twitter URL', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">

                                                    {{ Form::text('twitter', null, ['placeholder' => 'Twitter URL', 'class' => 'form-control']) }}

                                                    {{ errors_for('twitter', $errors) }}

                                                </div>

                                            </div>
                                             <div class="form-group">

                                                {{ Form::label('dashboard_popup', 'Student Dashboard Popup', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-8">
                                                {{ Form::checkbox('dashboard_popup','1', null, ['id' => 'dashboard_popup']) }}  Show Student Dashboard Popup 

                                                </div>

                                            </div>

                                                <div class="form-group">
                                                
                                                    <div class="col-sm-offset-3 col-sm-8">
                                                  
                                                        {{ Form::submit('Update Settings', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                                
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
        
    </div><!-- ./wrapper -->

@stop

@section('js')
	
    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
    <script>
	
	$(document).ready(function(e) {
        
		function readURL(input) {
			
			if (input.files && input.files[0]) {
				
				var reader = new FileReader();
		
				reader.onload = function (e) {
					
					$('#edit-logo-preview').attr('src', e.target.result).fadeIn('slow');
					
				};
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
		}
		
		$("#logo").change(function(){
			
			readURL(this);
			
		});
	
		/* Edit Settings Form Validation Code Start Here */
			
		$('#edit-setting-form').formValidation({
		
			framework: 'bootstrap',
			
			icon: {
				
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			
			trigger: 'change',
								
			fields: {
				
				title: {
					
					validators: {
						
						notEmpty: {
							
							message: 'The Title is required and cannot be empty'
							
						}
						
					}
				}	
										
			}
				
		});
		
		/* Edit Settings Form Validation Code Ends Here */
			
	
    });
	
	</script>
@stop
