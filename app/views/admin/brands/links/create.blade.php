@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Create Link')

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
          
                <h1>Create Link</h1>
          
                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_links') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_links') }}"><i class="fa fa-bars"></i> links</a></li>
                    
                    <li class="active">create link</li> -->
                
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
                                    
                                        {{ Form::open(['route' => 'admin.links.store', 'class' => 'form-horizontal','id' => 'create-link-form', 'files' => 'true']) }}

                                            {{ Form::hidden('text', 'text') }}

                                            <div class="form-group">
                                            
                                                {{ Form::label('brand_id', 'Brand', ['class' => 'col-sm-3 control-label']) }}
                            
                                                <div class="col-sm-8">
                                                
                                                    {{ Form::select('brand_id',array('' => '-- Please select Brand --') + $brands,
                                                    'null' ,['class' => 'form-control', 'id' => 'brandid', 'required' => 'required'] ) }}
                                                                                                        
                                                </div>
                                                
                                            </div>

                                           <div class="form-group">
                
                                                {{ Form::label('title', 'Link Title', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
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
                                              
                                                    {{ Form::submit('Create Link', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

    {{HTML::script('packages/summernote/summernote.js')}}

    <script>
    $(document).ready(function(e) {
         $("#description").summernote();
    });
    </script>
@stop