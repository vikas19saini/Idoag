@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Create Offer')

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
          
                <h1>Create Offer</h1>
          
                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_offers') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    
                    <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    
                    <li><a href="{{ URL::route('admin_offers') }}"><i class="fa fa-bars"></i> Offers</a></li>
                    
                    <li class="active">create Offer</li> -->
                
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
                                    
                                        {{ Form::open(['route' => 'admin.offers.store', 'class' => 'form-horizontal','id' => 'create-offer-form', 'files' => 'true']) }}


                                        @include('admin.partials.offer_form')


                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Create Offer', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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

    <script>
  
    $(document).ready(function(e) {

        $("#description").summernote();


        $('#webonly').change(function() {

            if (this.checked)
                $('#panindia').hide();
            else
                $('#panindia').show();
        });


        /* add datepicker */
      $('#start_date').datepicker({
           format: 'dd-mm-yyyy'
        });
      
      $('#end_date').datepicker({
           format: 'dd-mm-yyyy'
        });

        $("#image").change(function(){
            readURL(this);
        });

    });
       
    /* upload offers image */
    function readURL(input) {
    
        if (input.files && input.files[0]) {
            
            var reader = new FileReader();
    
            reader.onload = function (e) {
                
                $('#offer_image_preview').attr('src', e.target.result).fadeIn('slow');
                
            };
            
            reader.readAsDataURL(input.files[0]);
            
        }
        
    }

    function getVoucher(type) {

        $('#VoucherSingle').addClass('hide');
        $('#VoucherMultiple').addClass('hide');
        if(type=="single")
        {
            $('#VoucherSingle').removeClass('hide');
        }
        if(type=="multiple")
        {
            $('#VoucherMultiple').removeClass('hide');
        }
    
    }

    function checkType(type){
        
        $('#OfferType1').addClass('hide');
        $('#OfferType2').addClass('hide');
        if(type=="percentage")
        {
            $('#OfferType1').removeClass('hide');
        }
        if(type=="flat")
        {
            $('#OfferType2').removeClass('hide');
        }
    
    }
    
    function checkLocal(type) {

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