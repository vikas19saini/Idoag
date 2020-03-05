@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit Internship')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
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
          
          		<h1>Edit Internship</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_internships') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_internships') }}"><i class="fa fa-bars"></i> Internships</a></li>
                    
            		<li class="active">Edit Internship</li> -->
          		
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
                                    
                                       {{ Form::model($internship, ['method' => 'PATCH','route' => ['admin.internships.update', $internship->id], 'files' => true, 'class' => 'form-horizontal','id' => 'edit-internship-form']) }}

                                        @include('admin.partials.internship_form')

                                        <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update Internship', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
     {{HTML::script('packages/summernote/summernote.js')}}

    <script type="text/javascript">
		
		$(document).ready(function(e) {

            $(".textarea").summernote();

            function readURL(input) {

                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('#image_preview').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }
            $("#image").change(function(){
				
				readURL(this);
				
			});

            $('#start_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#end_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#application_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $("#category").multiselect({
				
				maxHeight:200,
				buttonWidth: '650px',
				inheritClass: true,
				includeSelectAllOption: true,
				nonSelectedText: 'Select Categories'	
			});
			 	
			/* Edit Brand Form Validation Code Start Here */
			
			$('#edit-internship-form').formValidation({
			
				framework: 'bootstrap',
				
				excluded: [':disabled'],
				
				icon: {
					
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				
				trigger: 'change',
									
				fields: {
					
					internship_title: {
						
						validators: {
							
							notEmpty: {
								
								message: 'The Name is required and cannot be empty'
								
							}
							
						}
					},
					
					internship_desc: {
						
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