@extends('admin.layouts.default') 

@section('title', 'Idoag.com | Create Institution Event')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    {{ HTML::style('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}
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
          
                <h1>Create Event</h1>
          
                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_inst_events') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                
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
                                    
                                        {{ Form::open(['route' => 'admin.inst_events.store', 'class' => 'form-horizontal','id' => 'create-offer-form', 'files' => 'true']) }}

                                            {{ Form::hidden('insevent', 'insevent') }}

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

                                                    {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}   </div>


                                            {{ errors_for('size', $errors) }}
                                                    
                                                </div>


                                           <div class="form-group">
                
                                                {{ Form::label('name', 'Event Title', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                                                    
                                                    {{ errors_for('name', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>

                                    <div class="form-group">

                                        {{ Form::label('short_description',  'Short Description', ['class' => 'col-sm-3 control-label']) }}

                                        <div class="col-sm-8">

                                            {{ Form::textarea('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control', 'id' => 'description']) }}

                                            {{ errors_for('short_description', $errors) }}

                                        </div>

                                    </div>
                                                                                        
                                            <div class="form-group">
                
                                                {{ Form::label('description',  'Description', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-8">
                  
                                                    {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}
                                                    
                                                    {{ errors_for('description', $errors) }}
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                {{ Form::label('nam_val', 'Event Start Date', ['class' => 'col-sm-3 control-label']) }}
                                                  <div class="col-sm-2">
                                                    {{ Form::text('start_date', null, ['placeholder' => 'Start Date', 'class' => 'form-control', 'id'=>'start_date']) }}
                                                  </div>
                                                {{ Form::label('nam_val', 'Event End Date', ['class' => 'col-sm-3 control-label']) }}
                                                  <div class="col-sm-2">
                                                    {{ Form::text('end_date', null, ['placeholder' => 'End Date', 'class' => 'form-control', 'id'=>'end_date']) }}
                                                     </div>  </div>


                                        <div class="form-group">
                                                    {{ Form::label('time_from', 'Event Start Time', ['class' => 'col-sm-3 control-label']) }}
                                                    <div class="col-sm-2">
                                                        <div class="input-group" style="width:160px;">
                                                            {{Form::text('time_from',null,['id' => 'time_from', 'class'=>'timepicker form-control'])}}
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </div></div>

                                                    </div>
                                                    {{ Form::label('time_to', 'Event End Time', ['class' => 'col-sm-3 control-label']) }}
                                                    <div class="col-sm-2">
                                                        <div class="input-group" style="width:160px;">
                                                            {{Form::text('time_to',null,['id' => 'time_to', 'class'=>'timepicker form-control'])}}
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </div></div>
                                                    </div>
                                                </div>



                                            <div class="form-group">
                                            
                                                {{ Form::label('image', 'Event Image', ['class' => 'col-sm-3 control-label']) }}
                                                
                                                <div class="col-sm-4">
                                                    {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}
                                                    
                                                    {{ errors_for('image', $errors) }}
                                                    
                                                </div>
                                            
                                                
                                                <div class="col-sm-5">
                                                    
                                                    {{ HTML::image('assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'event_image_preview']) }}
                                                </div>
                                                
                                            </div>

                                    <div class="form-group">

                                        {{ Form::label('isfree', 'Is Free?', ['class' => 'col-sm-3 control-label']) }}

                                        <div class="col-sm-8">

                                           {{ Form::select('isfree', [null=>'Please Select'] + array('0' => 'No', '1' => 'Yes'), null, array('class' => 'form-control'))}}

                                        </div>

                                    </div>
                                            
                                            <div class="form-group">
                                                {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

                                                <div class="col-sm-8">

                                                  {{ Form::select(
                                                  'state',
                                                  array('' => '-- Please select State --') + $states,
                                                    'null' ,
                                                  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)']
                                                  )
                                                  }}

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}
                                        
                                                <div class="col-sm-8">
                                                  <select id="cityId" name="city" class="form-control cities" required = "required">
                                                      <option value="">--Select City --</option>

                                                  </select>

                                                </div>
                                            </div>
                                    <div class="form-group">

                                        {{ Form::label('registration_url', 'Registration Link', ['class' => 'col-sm-3 control-label']) }}

                                        <div class="col-sm-8">

                                            {{ Form::text('registration_url', null, ['placeholder' => 'Registration Link', 'class' => 'form-control']) }}

                                            {{ errors_for('registration_url', $errors) }}

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        {{ Form::label('contact_details', 'Contact Details', ['class' => 'col-sm-3 control-label']) }}

                                        <div class="col-sm-8">

                                            {{ Form::text('contact_details', null, ['placeholder' => 'Contact Details', 'class' => 'form-control']) }}

                                            {{ errors_for('contact_details', $errors) }}

                                        </div>

                                    </div>

                                            <div class="form-group">
                                                {{ Form::label('tandc', 'Terms and Conditions', ['class' => 'col-sm-3 control-label']) }}
                                                <div class="col-sm-4">
                                                    {{ Form::checkbox('terms_and_conditions', 1, null, ['required'=>'required']) }}
                                                  Check to agree our terms and conditions
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            
                                                <div class="col-sm-offset-3 col-sm-8">
                                              
                                                    {{ Form::submit('Create Event', ['class' => 'btn btn-lg btn-info btn-block']) }}
                                            
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
    {{ HTML::script('https://www.google.com/recaptcha/api.js') }}
    {{ HTML::script('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}
     {{HTML::script('packages/summernote/summernote.js')}}
    <script>
  
    $(document).ready(function(e) {
            
      /* add datepicker */
        $('#start_date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#end_date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(".timepicker").timepicker({
            showInputs: false
        });


        $(".textarea").summernote();


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
            
        $("#image").change(function(){
            
            readURL(this);
            
        });

    });
 
  </script>

    
@stop