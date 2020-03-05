@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Reports')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

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

                <h1>Active/Inactive Students</h1>

                <ol class="breadcrumb">

                    <li class="active"><i class="fa fa-dashboard"></i>  Home</li>

                </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row"><div class="col-lg-12">

                        @include('admin.layouts.flash')

                        <div class="box box-primary">

                            <div class="box-body">
                            <div align="right">
                            <a href="{{ URL::route('admin_report_not_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Not Registered Users List from Student Data</a> &nbsp;  <a href="{{ URL::route('admin_report_registered_students_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Registered Students List</a>&nbsp;  <a href="{{ URL::route('admin_report_all_students_export') }}" class="btn btn-warning"><i class="fa fa-download"></i> Export All Students List</a></div>
                           

                                <table id="enquirieslist" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>College</th>
                                        <th>College Id</th>
<!--                                         <th>Students in Data</th> 
 -->                                        <th>Inactive Students</th>
                                         <th>Active Students</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $registered_count=0;
                                    $not_registered_count=0;?>
                                    @foreach($institutions as $key => $institute) 
                                             <tr {{ ($institute->deleted_at!='') ? " class='deleted'" : "" }}>

                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $institute->name}}</td>
                                                <td>{{ $institute->id}}</td>
                                                <!--  <td>{{ $institute->getStudentsCountFromData()}}</td>   -->
                                                <td>
                                                  <?php $regusers=$institute->getStudentsCount();
                                                  echo $regusers;?>  
                                                </td>
                                                <td><?php $nonregusers=$institute->getStudentsNotRegisteredCountFromData($card_numbers); echo $nonregusers;?></td>
                                            </tr> 
                                              <?php $registered_count=$registered_count+$regusers;
                                    $not_registered_count=$not_registered_count+$nonregusers;?>
                                    @endforeach
                                    </tbody>

                                </table>
                                 <p><br/><strong>Registered Students Count: {{$registered_count}}</strong></p>
                            <p><strong>Not Registered Students Count from Student Data: {{$not_registered_count}}</strong> </p>
                            

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

    </div><!-- ./wrapper -->

@stop

@section('js')

    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script>

        $(document).ready(function(e) {

        });

    </script>
@stop