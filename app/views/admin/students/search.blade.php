@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Students Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}
    
    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}
    
    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}
    
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
      

        <section class="content-header">
        
            <h1>
              
              List of Students 
                
              <a href="{{ URL::route('admin.students.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Student</a>
              
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#students-import"><i class="fa fa-upload"></i> Import Students</a>
              
              <a href="{{ URL::route('admin_report_all_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export As Excel</a>
              
              <a href="{{ URL::route('admin_students_data_sample') }}" class="btn btn-info"><i class="fa fa-download"></i> Sample Excel</a>
          
              <a href="{{ URL::route('admin_students_duplicate_data') }}" class="btn btn-danger"><i class="fa fa-minus"></i> Duplicate Data</a>

            </h1>

            <ol class="breadcrumb">

              <a href="{{ URL::route('admin_dashboard') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
          
              <!-- <li><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          
              <li class="active">Students</li> -->
            
            </ol>
          
        </section>


        <!-- Main content -->
        <section class="content">
              
            <div class="row"><div class="col-lg-12">
                      	
              @include('admin.layouts.flash')
              
                <div class="box box-primary">
                                  
                  <div class="box-body">
                                      
                    {{ Form::open(['method' => 'get', 'route' => 'searchStudents','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}
  									
                        <div class="form-group">                            
                            
                          {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('institution_id', array('' => 'Please select College') + $institutions, '' , ['class' => 'form-control']) }}

                          </div> 
                      
                          {{ Form::label('card_number', 'Card Number', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                          
                            {{ Form::text('card_number', null, ['placeholder' => 'Card Number', 'id'=>'cardnumber','class' => 'form-control']) }}
                          
                          </div>   

                        </div>

                        <div class="form-group">
                            
                          {{ Form::label('phone', 'Phone', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                         
                            {{ Form::text('phone', null, ['placeholder' => 'Phone', 'id'=>'phone','class' => 'form-control']) }}
                          
                          </div>                                                    
                     
                          {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}

                          <div class="col-sm-4">
                         
                            {{ Form::text('email', null, ['placeholder' => 'Email', 'id'=>'email','class' => 'form-control']) }}
                          
                          </div> 

                        </div>   

                        <div class="form-group">
                            
                          {{ Form::label('Roll NUmber', 'rollno', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                         
                            {{ Form::text('rollno', null, ['placeholder' => 'Roll NUmber', 'id'=>'rollno','class' => 'form-control']) }}
                          
                          </div>                                                                         

                        </div>  

                  		  {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-info center-block']) }}

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


  <!-- Brands Import Modal Starts Here-->
  <div class="modal fade" id="students-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
      <div class="modal-dialog">
        
          <div class="modal-content">
        
            <div class="modal-header">
          
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
              <h4 class="modal-title">Import Students</h4>
        
            </div>
        
            <div class="modal-body">
          
              {{ Form::open(['route' => 'admin_students_import', 'class' => 'form-horizontal','id' => 'students-import-form', 'files' => true]) }}
                    
                      <div class="form-group">
                                          
                          {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}
      
                          <div class="col-sm-8">
                          
                              {{ Form::file('file', ['required' => 'required']) }}
                              
                              {{ errors_for('file', $errors) }}
                              
                          </div>
                          
                      </div>
                                          
                      <div class="form-group">
                                          
                          <div class="col-sm-offset-2 col-sm-8">
                        
                              {{ Form::submit('Import Students', ['class' => 'btn btn-lg btn-info btn-block']) }}
                      
                          </div>
                    
                      </div>
                                                                  
                  {{ Form::close() }}
        
            </div>
      
        </div><!-- /.modal-content -->
    
      </div><!-- /.modal-dialog -->
  
  </div><!-- /.modal -->
  <!-- Brands Import Modal Ends Here-->

@stop

@section('js')

  {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}
  
  {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}
  
  {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}
  
  {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
  
  {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

  {{ HTML::script('assets/js/app.js') }}

  <script type="text/javascript">
	
    $(document).ready(function() {

    });

	</script>

@stop