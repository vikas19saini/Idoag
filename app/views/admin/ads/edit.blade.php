@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Edit Ad')

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
        
        	<!-- Content Header (Testimonial header) -->
        	<section class="content-header">
          
          		<h1>Edit Ad</h1>
          
          		<ol class="breadcrumb">

                    <a href="{{ URL::route('admin_ads') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> 
          		
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
                                    
                                        {{ Form::model($ad, ['method' => 'PATCH','route' => ['admin.ads.update', $ad->id], 'class' => 'form-horizontal','id' => 'edit-page-form', 'files' => 'true']) }}

                                        @include('admin.partials.ad_form')


                                        <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Update Ad', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
    


@stop