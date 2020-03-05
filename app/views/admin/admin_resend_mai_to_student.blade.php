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
              
              Resend Mail To Students 
                
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
                                      
                    {{ Form::open(['method' => 'get', 'route' => 'resend-mail','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}
  									
                        <div class="form-group">                            
                            
                          {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('institution_id', array('' => 'Please select College') + $institutions, '' , ['class' => 'form-control', 'id' => 'college_institution_id', 'onchange' => 'selectDate(this.value, 2)']) }}

                          </div>
						  
						  {{ Form::label('date_id', 'Date', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('date_id', array('' => 'Please select Date'), '' , ['class' => 'form-control', 'onchange' => 'searchResendFile(this.value)']) }}

                          </div> 
						  
						  </div>
						  
						  <div class="form-group">
						  
						  {{ Form::label('file_id', 'File', ['class' => 'col-sm-2 control-label']) }}
                          
                          <div class="col-sm-4">
                              
                            {{ Form::select('file_id', array('' => 'Please select File'), '' , ['class' => 'form-control']) }}

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
					<br/>
					
					{{ Form::open(['method' => 'get', 'route' => 'resend-mail','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                    <table id="studentslist" class="table table-bordered table-hover">

                                        <thead>

                                            <tr>
												<th><input type="checkbox"/></th>
                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> email id </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college name </th>
                                                <th> Created At</th>

                                            </tr>

                                        </thead>

                                        <tbody>
										@if(isset($students) && !empty($students))
                                            @foreach($students as $key => $student)

                                                  @if($student->deleted_at=='')
                                                 <tr {{ ($student->deleted_at!='') ? " class='deleted'" : "" }}>
													<td><input type="checkbox" name=chk[] value="{{$student->id}}"/></td>
                                                    <td>{{ $key+1 }}</td>

                                                    <td>{{ $student->card_number }} </td>

                                                    <td>{{ $student->rol_no }} </td>
                                                    <td>{{ $student->email_id }} </td>

                                                    <td>{{ $student->contact_number }} </td>

                                                    <td>{{ $student->first_name }} </td>

                                                    <td>{{ $student->last_name }} </td>

                                                    <td>{{ $student->dob }} </td>

                                                    <td>{{ $student->name }} </td>
                                                   
                                                    <td>{{ date('Y-M-d H:i:s', strtotime($student->created_at)) }}</td>



                                                </tr>@endif
                                            @endforeach
											@endif
                                </tbody>
                                <tfoot>

                                            <tr>
												<th></th>
                                                <th> S No</th>
                                                <th> card_number </th>
                                                <th> rollno </th>
                                                <th> email id </th>
                                                <th> contact_number </th>
                                                <th> first_name </th>
                                                <th> last_name </th>
                                                <th> dob </th>
                                                <th> college name </th>
                                                <th> Created At</th>
                                            </tr>

                                        </tfoot>

                                    </table>
									
									@if(!empty($students) && count($students) > 0) 
									
                                   {{ Form::submit('Mail To Selected Students', ['name' => 'Mail',  'class' => 'btn btn-lg btn-info', 'id' => 'disabledButton']) }} 
								   
								   @endif

									


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