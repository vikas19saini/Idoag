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
            
            		<li class="active"><i class="fa fa-dashboard"></i>  Home</li>
          		
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
                                    
                                        {{ Form::open(['route' => 'admin_settings', 'class' => 'form-horizontal','id' => 'admin-settings-form', 'files' => 'true']) }}
                                    
                                           <div class="form-group">
                
                                                {{ Form::label('logo', 'Logo', ['class' => 'col-sm-2 control-label']) }}
                                                
                                                <div class="col-sm-5">
                  
                                                    {{ Form::file('logo', null, ['class' => 'form-control', 'id' => 'logo']) }}
                                                    
                                                    {{ errors_for('logo', $errors) }}
                                                    
                                                </div>
                                                
                                                <div class="col-sm-5">
                                                	
                                                    @if(isset($settings['logo']) && $settings['logo'])
                                                    
                                                    	{{ HTML::image('uploads/'.$settings['logo']->value, '', ['id' => 'edit-logo-preview']) }}
                                                    
                                                    @else
                                                    
                                                    	{{ HTML::image('uploads/logo.png', '', ['id' => 'edit-logo-preview']) }}
                                                        
                                                    @endif
                                                    
                                                </div>
                                            
                                            </div>

                                            <div class="form-group">
                                                readURL
                                                <div class="col-sm-offset-2 col-sm-8">
                                              
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
	
	
    });
	
	</script>
@stop