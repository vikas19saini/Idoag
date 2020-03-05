@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit Testimonial')

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
        
        	<!-- Content Header (Testimonial header) -->
        	<section class="content-header">
          
          		<h1>Edit Testimonial</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_testimonials') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> 
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">
    		
            	<div class="row">
            
                    <div class="col-lg-12">
                    	
                      	@include('admin.layouts.flash')
                                
                        <div class="box box-primary">
                                                        
                            <div class="box-body">
                                                                
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                    
                                        {{ Form::model($testimonial, ['method' => 'PATCH','route' => ['admin.testimonials.update', $testimonial->id], 'class' => 'form-horizontal','id' => 'edit-page-form', 'files' => 'true']) }}

                                        @include('admin.partials.testimonial_form')


                                        <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update Testimonial', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('answer');
        });
    </script>


@stop