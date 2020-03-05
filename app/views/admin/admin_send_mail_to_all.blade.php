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
              
              List of Search Import Students 
                
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
                                      
                    {{ Form::open(['method' => 'get', 'route' => 'post-mail-to-all','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}
  									
                        <div class="form-group">                            
                            
                          {{ Form::label('college_institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('college_institution_id', array('' => 'Please select College') + $institutions, '' , ['class' => 'form-control', 'onchange' => 'selectDate(this.value, 1)']) }}

                          </div> 
                      
                       {{ Form::label('date_id', 'Date', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('date_id', array('' => 'Please select Date'), '' , ['class' => 'form-control', 'onchange' => 'selectFile(this.value)']) }}

                          </div> 

                        </div>
 

                           <div class="form-group">                            
                            
                          {{ Form::label('file_id', 'Option', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('file_id', array('' => 'Select option File/Manual'), '' , ['class' => 'form-control']) }}

                          </div> 
                      
                       

                        </div>

                  		  {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-info center-block']) }}

                    {{ Form::close() }}
					
                    {{ Form::open(['method' => 'get', 'route' => 'post-mail-to-all','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                    <table id="studentslist" class="table table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> email id </th>
                                                <th> status </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college name </th>
                                                <th> Created At</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($students as $key => $student)

                                                  @if($student->deleted_at=='')
                                                 <tr {{ ($student->deleted_at!='') ? " class='deleted'" : "" }}>

                                                    <td>{{ $key+1 }}</td>

                                                    <td>{{ $student->card_number }} </td>

                                                    <td>{{ $student->rollno }} </td>
                                                    <td>{{ $student->email_id }} </td>

                                                    <td>{{ $student->status }} </td>

                                                    <td>{{ $student->contact_number }} </td>

                                                    <td>{{ $student->first_name }} </td>

                                                    <td>{{ $student->last_name }} </td>

                                                    <td>{{ $student->dob }} </td>

                                                    <td>{{ $student->name }} </td>

                                                   
                                                    <td>{{ date('Y-M-d H:i:s', strtotime($student->created_at)) }}</td>



                                                </tr>@endif
                                            @endforeach
                                </tbody>
                                <tfoot>

                                            <tr>

                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> email id </th>
                                                <th> status </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college name </th>
                                                <th> Created At</th>
                                            </tr>

                                        </tfoot>

                                    </table>
									@if(count($students) > 0) 
									<input type="hidden" value="{{$_GET['college_institution_id']}}" name="collegeMiD"/>
									<input type="hidden" value="{{$_GET['date_id']}}" name="dateMiD"/>
									<input type="hidden" value="{{$_GET['file_id']}}" name="fileMiD"/>

                                   {{ Form::submit('MailToStudent', ['name' => 'Mail To All',  'class' => 'btn btn-lg btn-info', 'id' => 'disabledButton']) }} @endif




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
		$("#disabledButton").click(function(){
			$("#disabledButton").attr("disabled", true);
			$(this).parents('form').submit()
		});
    });

	</script>

@stop