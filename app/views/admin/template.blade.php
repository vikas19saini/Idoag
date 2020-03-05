@extends('admin.layouts.default')
<?php if(isset($data[0]) && count($data[0])>0){?>@section('title', 'Idoag.com | Edit Template')
 <?php }else{ ?>
@section('title', 'Idoag.com | Create Template')
 <?php }?> 
@section('class', 'skin-blue fixed')
@section('css')
{{ HTML::style('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
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
      		<h1><?php if(isset($data[0]) && count($data[0])>0){echo 'Edit';}else{ echo 'Create';}?> Template</h1>
      		<ol class="breadcrumb">
                <a href="{{ URL::route('admin_institutions') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
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
                                   <form class = 'form-horizontal' id = 'edit-institution-form' action = "addUpdateTemplate" method = "post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            {{ Form::label('id', 'College ID', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-8">
                                                {{ Form::text('id', $institution->id, ['placeholder' => 'Enter Institution ID', 'disabled' => 'disabled', 'class' => 'form-control']) }}
                                                {{ errors_for('id', $errors) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('name', 'College Name', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-8">
                                                {{ Form::text('name', $institution->name, ['placeholder' => 'Enter Institution Name', 'disabled' => 'disabled', 'class' => 'form-control']) }}
                                                {{ errors_for('name', $errors) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('image', 'College Card Design', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-4">
                                        		<input type="file" name="carddesign" class="form-control"/>
                                            </div>
											<div class = "col-sm-4">
											
										<?php if(isset($data[0]->front_card_design)){?>	<img src="{{URL::route('home')}}/carddesign/{{$data[0]->front_card_design}}" width="250" height="200" /><?php }?>

											</div>
                                        </div>

										<!--carddesign-->

                                        <div class="form-group">
                                            {{ Form::label('rollno', 'Roll Number', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-8">
                                        		<?php if(isset($data[0]->roll_no_required)) { $rollnm = $data[0]->roll_no_required; } else { $rollnm = null;} ?>

                                                {{Form::select('rollno',['0' => 'No', '1' => 'Yes'],$rollnm ,['class'=>'form-control'])}}
                                                {{ errors_for('rollno', $errors) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('content', 'Template Content', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-8">
                                        		<?php if(isset($data[0]->content)) { $cval = $data[0]->content; } else { $cval = null;} ?>
                                        		{{ Form::textarea('content', $cval , ['placeholder' => 'Description about template content', 'class' => 'form-control', 'id' => 'editor1']) }}
                                        		<strong>Note:-</strong> Please mention tag for student details like <strong>%NAME%, %CARDNUMBER%, %EMAILID%, %PHONENUMBER%, %COLLEGENAME%, %COLLEGEID%</strong> . Please copy tag with %% and paste on textarea.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-8">
                                        		<input name="cid" value="{{$institution->id}}" type="hidden"/>
                                                {{ Form::submit('Save Template', ['class' => 'btn btn-lg btn-info btn-block']) }}
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
	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	{{ HTML::script('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
@stop