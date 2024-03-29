@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Popup Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

  {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    
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
      
    		<h1>
          
        	Create Popup
              
        </h1>
    
    		<ol class="breadcrumb">
      		
          <a href="{{ URL::route('admin_popup') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
    		
        </ol>
    		
      </section>

    	<!-- Main content -->
    	<section class="content">

	      <div class="row">
      
      		<div class="col-lg-12">
              	
          	@include('admin.layouts.flash')

            <div class="box box-primary">
                          
          			<div class="box-body">
            				
                  {{ Form::open(['route' => 'admin.popup.store', 'class' => 'form-horizontal','id' => 'create-popup-form', 'files' => 'true']) }}

                      @include('admin.partials.popup_form')

                      <div class="form-group">
                      
                          <div class="col-sm-offset-3 col-sm-8">
                        
                              {{ Form::submit('Create Popup', ['class' => 'btn btn-lg btn-info btn-block']) }}
                      
                          </div>
                    
                      </div>
              
                  {{ Form::close() }}        

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

  <script>
  
    $(document).ready(function(e) {

        /* add datepicker */
      $('#start_date').datepicker({
           format: 'yyyy-mm-dd'
        });
      
      $('#end_date').datepicker({
           format: 'yyyy-mm-dd'
        });

      /* upload Popup image */
      function readURL(input) {
      
        if (input.files && input.files[0]) {
            
          var reader = new FileReader();

          reader.onload = function (e) {
              
            $('#offer_image_preview').attr('src', e.target.result).fadeIn('slow');
              
          };
          
          reader.readAsDataURL(input.files[0]);            
        }        
      
      }

      $("#popup_image").change(function () {

        readURL(this);

      });

    });
       


  </script>
@stop