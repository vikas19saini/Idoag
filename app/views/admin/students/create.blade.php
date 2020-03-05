@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Student')

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
          
          		<h1>Add New Student</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_students') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_students') }}"><i class="fa fa-bars"></i> Students</a></li>
                    
            		<li class="active">Add New Student</li> -->
          		
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
                                    
                                        {{ Form::open(['route' => 'admin.students.store', 'class' => 'form-horizontal','id' => 'add-new-student-form', 'files' => 'true']) }}
                                                                                    
                                                                                    
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

                                                {{ Form::label('rol_no', 'Roll No', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('rol_no', null, ['placeholder' => 'Roll No', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('rol_no', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                        
                                            <div class="form-group">

                                                {{ Form::label('type', 'User Type', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::select('type', ['student' => 'Student', 'corporate' => 'Corporates'], null, ['class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('type', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>

                                           <div class="form-group">

                                                {{ Form::label('contact_number', 'Contact Number', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('contact_number', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>                                            

                                           <div class="form-group">

                                                {{ Form::label('dob', 'DOB', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('dob', null, ['placeholder' => 'DOB', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('dob', $errors) }}
                                                    
                                                </div>
                                            
                                            </div> 


                                            <div class="form-group">

                                                {{ Form::label('college_id', 'College ID', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('college_id', null, ['placeholder' => 'College ID', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('college_id', $errors) }}
                                                    
                                                </div>

                                            </div> 

                                            <div class="form-group">

                                                {{ Form::label('streamorcourse', 'Stream/Course', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('streamorcourse', null, ['placeholder' => 'Stream/Course', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('streamorcourse', $errors) }}
                                                    
                                                </div>

                                            </div> 

                                            <div class="form-group">

                                                {{ Form::label('residentordayscholar', 'Resident/DayScholar', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('residentordayscholar', null, ['placeholder' => 'Resident/DayScholar', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('residentordayscholar', $errors) }}
                                                    
                                                </div>

                                            </div> 

                                            <div class="form-group">

                                                {{ Form::label('father_name', 'Father Name', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('father_name', null, ['placeholder' => 'Father Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('father_name', $errors) }}
                                                    
                                                </div>

                                            </div> 

                                            <div class="form-group">

                                                {{ Form::label('batch_year', 'Batch Year', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('batch_year', null, ['placeholder' => 'Batch Year', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('batch_year', $errors) }}
                                                    
                                                </div>

                                            </div>    

                                            <div class="form-group">

                                                {{ Form::label('email_id', 'Email', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('email_id', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('email_id', $errors) }}
                                                    
                                                </div>

                                            </div>    

                                            <div class="form-group">

                                                {{ Form::label('section', 'Section', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    {{ Form::text('section', null, ['placeholder' => 'Section', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('section', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>


                                            <div class="form-group">

                                                {{ Form::label('program_duration', 'Program Duration', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">

                                                    {{ Form::text('program_duration', null, ['placeholder' => 'Program Duration', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('program_duration', $errors) }}
                                                    
                                                </div>

                                            </div>    

                                            <div class="form-group">

                                                {{ Form::label('gender', 'Gender', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    <?php $gender_details = array('M' => 'Male', 'F' => 'Female');?>

                                                    {{ Form::select('gender', [null=>'Please Select'] + $gender_details, null, array('class' => 'form-control')) }}

                                                    {{ errors_for('gender', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">

                                                {{ Form::label('date_of_issue', 'Date of Issue', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    {{ Form::text('date_of_issue', null, ['placeholder' => 'Date of Issue', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('date_of_issue', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">

                                                {{ Form::label('expiry_date', 'Expiry Date', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    {{ Form::text('expiry_date', null, ['placeholder' => 'Expiry Date', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('expiry_date', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">

                                                {{ Form::label('validity_for_how_many_years', 'Validity', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    {{ Form::text('validity_for_how_many_years', null, ['placeholder' => 'Validity', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('validity_for_how_many_years', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">

                                                {{ Form::label('cluborgrouporsociety', 'Club/Group/Society', ['class' => 'col-sm-3 control-label admin_select']) }}

                                                <div class="col-sm-8">

                                                    {{ Form::text('cluborgrouporsociety', null, ['placeholder' => 'Club/Group/Society', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('cluborgrouporsociety', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>


                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New Student', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
                                                </div>
                                          
                                            </div>
                                    
                                        {{ Form::close() }}
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                                
                        </div>
                            
                    </div>
                    
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
						
						$('#student_image_preview').attr('src', e.target.result).fadeIn('slow');
						
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
			 	
			/* Add New Student Form Validation Code Start Here */
			
			$('#add-new-student-form').formValidation({
			
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
			
			/* Add New student Form Validation Code Ends Here */
		    
		});
		
	</script>
    
@stop