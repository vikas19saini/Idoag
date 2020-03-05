@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Reports')

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

            <!-- Content Header (Page header) -->
            <section class="content-header">

                <h1>Brand Activity Summary  <a href="{{ URL::route('admin_report_brands_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Brand Report</a></h1>

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

                                <table id="brandslist" class="table table-bordered table-hover">

                                    <thead>

                                    <tr>

                                        <th>S No</th>
                                        <th>Brand</th>
                                        <th>Offers</th>
                                        <th>Active Offers</th>
                                        <th>Internships</th>
                                        <th>Active Internships</th>
                                        <th>Events</th>
                                        <th>Upcoming Events</th>
                                        <th>Photos</th>
                                        <th>Text Posts</th>
                                        <th>Total Likes</th>
                                        <th>Feedback</th>
                                        <th>Followers</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    @foreach($brands as $key => $brand)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><a href="{{ URL::route('admin_brand_dashboard', [$brand->slug]) }}" target="_blank">{{ $brand->name}}</a></td>
                                                <td>{{ $brand->getCountByType('offer')}}</td>
                                                <td>{{ $brand->getCountByTypeAndActiveStatus('offer')}}</td>
                                                <td>{{ $brand->getCountByType('internship')}}</td>
                                                <td>{{ $brand->getCountByTypeAndActiveStatus('internship')}}</td>
                                                <td>{{ $brand->getCountByType('event')}}</td>
                                                <td>{{ $brand->getCountByTypeAndActiveStatus('event')}}</td>
                                                <td>{{ $brand->getCountByType('photos')}}</td>
                                                <td>{{ $brand->getCountByType('text')}}</td>
                                                <td>{{ $brand->LikesCount()}}</td>
                                                <td>{{ $brand->FeedbackCount()}}</td>
                                                <td>{{ $brand->FollowerCount()}}</td>

                                            </tr>
                                    @endforeach
                                    </tbody>

                                </table>

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
    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script>

        $(document).ready(function(e) {
            var table = $('#brandslist').DataTable({
                paging:         true
            });

        });

    </script>
@stop