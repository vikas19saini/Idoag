@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Brand')

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
          
          		<h1>Add New Brand</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_brands') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_brands') }}"><i class="fa fa-bars"></i> Brands</a></li>
                    
            		<li class="active">Add New Brand</li> -->
          		
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
                                    
                                        {{ Form::open(['route' => 'admin.brands.store', 'class' => 'form-horizontal','id' => 'add-new-brand-form', 'files' => 'true']) }}

                                        @include('admin.partials.brand_form')
                                        <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-8">
                                                    {{ Form::submit('Add New Brand', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                                </div>
                                          
                                          	</div>
                                    
                                        {{ Form::close() }}
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>

                        </div>

                    </div>

            	</div>

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
						
						$('#brand_image_preview').attr('src', e.target.result).fadeIn('slow');
						
					};
					
					reader.readAsDataURL(input.files[0]);
					
				}
			}
            function readURL2(input) {

                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('#brand_cover_image_preview').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("#image").change(function(){
				
				readURL(this);
				
			});
            $("#coverimage").change(function(){

                readURL2(this);

            });
			
			$("#category").multiselect({
				
				maxHeight:200,
				buttonWidth: '650px',
				inheritClass: true,
				includeSelectAllOption: true,
				nonSelectedText: 'Select Categories'	
			});
			 	
			/* Add New Brand Form Validation Code Start Here */
			
			$('#add-new-brand-form').formValidation({
			
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
			
			/* Add New Brand Form Validation Code Ends Here */
		    
		});

        function checkLocal(type)
        {
             $('#StateCity').addClass('hide');
            $('#Institution').addClass('hide');
            if(type=="Local")
            {
                $('#StateCity').removeClass('hide');
            }
            if(type=="College")
            {
                $('#Institution').removeClass('hide');
            }
        }

	</script>
    
@stop