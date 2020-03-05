@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Add New Page')

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
          
          		<h1>Add New Page</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_pages') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            		
           		
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
                                    
                                        {{ Form::open(['route' => 'admin.pages.store', 'class' => 'form-horizontal','id' => 'add-new-page-form', 'files' => 'true']) }}
                                    	
                                          
                                           <div class="form-group">
                
                                                {{ Form::label('heading', 'Heading', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('heading', null, ['placeholder' => 'Heading', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('heading', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                        <div class="form-group">

                                            {{ Form::label('pagetitle', 'Page Title', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::text('pagetitle', null, ['placeholder' => 'Page Tile for SEO', 'class' => 'form-control']) }}

                                                {{ errors_for('pagetitle', $errors) }}

                                            </div>

                                        </div>
                                        <div class="form-group">

                                            {{ Form::label('metakeywords', 'Meta Keywords', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::text('metakeywords', null, ['placeholder' => 'Meta Keywords for SEO', 'class' => 'form-control']) }}

                                                {{ errors_for('metakeywords', $errors) }}

                                            </div>

                                        </div>
                                        <div class="form-group">

                                            {{ Form::label('metadesc', 'Meta Description', ['class' => 'col-sm-3 control-label']) }}

                                            <div class="col-sm-8">

                                                {{ Form::text('metadesc', null, ['placeholder' => 'Meta Description for SEO', 'class' => 'form-control']) }}

                                                {{ errors_for('metadesc', $errors) }}

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
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Add New Page', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
            CKEDITOR.replace('description');
        });
    </script>


@stop