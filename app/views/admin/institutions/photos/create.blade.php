@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Create Photo')

@section('class', 'skin-blue fixed')

@section('css') 
        
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
          
                <h1>Create Photo</h1>
          
                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_inst_photos') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    

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
                                    
                                        {{ Form::open(['route' => 'admin.inst_photos.store', 'class' => 'form-horizontal','id' => 'create-photo-form', 'files' => 'true']) }}

                                            {{ Form::hidden('insphoto', 'insphoto') }}

                                            <div class="form-group">
                                            
                                                {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-3 control-label']) }}
                            
                                                <div class="col-sm-8">
                                                
                                                    {{ Form::select('institution_id',array('' => '-- Please select Institution --') + $institutions,
                                                    'null' ,['class' => 'form-control', 'id' => 'institutionid', 'required' => 'required'] ) }}
                                                                                                        
                                                </div>
                                                
                                            </div>                                                                                    

                                            <div class="form-group">
                                            
                                                {{ Form::label('size', 'Size', ['class' => 'col-sm-3 control-label']) }}
                            
                                                <div class="col-sm-8">
                                                    {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}

                                                    
                                                    {{ errors_for('size', $errors) }}
                                                    
                                                </div>
                                                
                                            </div>

                                           <div class="form-group">
                
                                                {{ Form::label('photo', 'Photo Title', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                                                                        
                                            <div class="form-group">
                
                                                {{ Form::label('description', 'Short Description', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}
                                                    
                                                    {{ errors_for('description', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                            
                                                {{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                  
                                                    {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}
                                                    
                                                    {{ errors_for('image', $errors) }}
                                                    
                                                </div>
                                            
                                                
                                                <div class="col-sm-5">
                                                    
                                                    {{ HTML::image('assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'photo_image_preview']) }}
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Create Photo', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

    <script>
  
    $(document).ready(function(e) {
            
        /* upload photos image */
   
        function readURL(input) {
        
            if (input.files && input.files[0]) {
                
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    
                    $('#photo_image_preview').attr('src', e.target.result).fadeIn('slow');
                    
                };
                
                reader.readAsDataURL(input.files[0]);
                
            }
            
        } 
            
        $("#image").change(function(){
            
            readURL(this);
            
        });

    });
 
  </script>

    
@stop