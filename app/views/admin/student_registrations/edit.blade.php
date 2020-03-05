@extends('admin.layouts.default')

@section('title', 'Idoag.com | Edit Registration')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.10/summernote.css') }}

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

                <h1>Student Registration Details</h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_student_registrations') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

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

                                        {{ Form::model($registration, ['method' => 'PATCH','route' => ['admin.student_registrations.update', $registration->id], 'class' => 'form-horizontal','id' => 'edit-page-form', 'files' => 'true']) }}



                                        <div class="form-group">
                                            <div class="col-sm-3">  Institution Name:</div>
                                            <div class="col-sm-8">  {{ $registration->college }}</div></div>
                                            <div class="form-group"><div class="col-sm-3">State :</div>
                                            <div class="col-sm-8">  {{ $registration->state}}</div></div>
                                        <div class="form-group"><div class="col-sm-3">City :</div>
                                            <div class="col-sm-8">  {{ $registration->city}}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Contact Person Name :</div>
                                            <div class="col-sm-8"> {{ $registration->name }}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Contact Person Email :</div>
                                            <div class="col-sm-8"> {{ $registration->email }}</div></div>
                                        . <div class="form-group"><div class="col-sm-3">Contact Person Designation :</div>
                                            <div class="col-sm-8">  {{ $registration->designation}}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Contact Person Mobile :</div>
                                            <div class="col-sm-8"> {{ $registration->mobile }}</div></div>

                                        <div class="form-group"><div class="col-sm-3">Name :</div>
                                            <div class="col-sm-8"> {{ $registration->stud_name }}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Email :</div>
                                            <div class="col-sm-8"> {{ $registration->stud_email }}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Mobile :</div>
                                            <div class="col-sm-8"> {{ $registration->stud_mobile }}</div></div>

                                        <div class="form-group"><div class="col-sm-3">Date Sent:</div>
                                            <div class="col-sm-8"> {{ $registration->created_at }}</div></div>
                                        <div class="form-group"><div class="col-sm-3">Date Replied:</div>
                                            <div class="col-sm-8"> {{ $registration->updated_at }}</div></div>


                                        <div class="form-group">
                                            {{ Form::hidden('regid', $registration->id) }}
                                            {{ Form::label('status', 'Status:', ['class' => 'col-sm-3']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('status', array('0' => 'Pending', '1' => 'Closed'), $registration->status, ['class' => 'form-control']) }}
                                                {{ errors_for('status', $errors) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('replymessage', 'Comments:', ['class' => 'col-sm-3']) }}
                                            <div class="col-sm-8">
                                                {{ Form::textarea('comments', $registration->comments, ['class' => 'form-control']) }}
                                                {{ errors_for('comments', $errors) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <lable class="col-sm-3"></lable>
                                             <div class=" col-sm-8">
                                                {{ Form::submit('Update', ['class' => 'btn btn-lg btn-info btn-block']) }}
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

    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.10/summernote.js') }}



@stop