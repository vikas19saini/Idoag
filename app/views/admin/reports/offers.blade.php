@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Reports')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}
    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}
    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}
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

                <h1>Offers - Coupon Usage                     <a href="{{ URL::route('admin_report_offers_export') }}" class="btn btn-info"><i class="fa fa-download"></i> Export Coupons Report</a>
                </h1>

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
                                {{ Form::open(['route' => 'filterOfferReport','files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}

                                <div class="form-group">

                                    {{ Form::label('brand', 'Brand', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                        {{ Form::select('brand', array('' => 'Please select Brand') + $brands, $filter['brand'] , ['class' => 'form-control']) }}

                                    </div>

                                    {{ Form::label('voucher_type', 'Coupon Type', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-4">
                                        {{ Form::select('voucher_type', array('' => 'All','single'=>'Single','multiple'=>'Multipple'), $filter['voucher_type'] , ['class' => 'form-control']) }}
                                    </div>

                                </div>

                                <div class="form-group">


                                    {{ Form::label('daterange', 'Date Used', ['class' => 'col-sm-2 control-label']) }}

                                    <div class="col-sm-2">

                                        {{ Form::text('startdate', $filter['startdate'], ['placeholder' => 'Date From', 'id'=>'startdate','class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::text('enddate', $filter['enddate'], ['placeholder' => 'Date To', 'id'=>'enddate','class' => 'form-control']) }}
                                    </div>

                                    <div class="col-sm-6"> {{ Form::submit('Filter', ['class' => 'btn btn-warning  ']) }}
                                        @if(isset($filter2))
                                            <a href="{{route('admin_reports_offers')}}" class="btn btn-info filter_btn">View All</a>
                                        @endif
                                    </div>

                                </div>


                                {{ Form::close() }}
                                     @if(!isset($filter2))
                                <p><strong>Total coupons used by Students: {{$total_coupons}}. Maximum display restricted to 100. Choose filter as per require.</strong></p>
                                    @endif
                                <table id="offerlist" class="table table-bordered table-hover">

                                    <thead>

                                    <tr>

                                        <th>S No</th>
                                        <th>Brand</th>
                                        <th>Offer</th>
                                        <th>User</th>
                                        <th>College</th>
                                        <th>Coupon</th>
                                        <th>Coupon Type</th>
                                        <th>Date Used</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $key => $coupon)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                               <td>{{ getBrandName($coupon->brand_id)}}</td>
                                            <td>{{ $coupon->name}}</td>
                                            <td>{{ getUserName($coupon->user_id) }}</td>
                                            <td>{{ getUserInstitute($coupon->user_id)}}</td>
                                            <td><a data-toggle="tooltip" data-placement="top" title="Offer type: {{$coupon->offer_type}}, Offer Value: {{$coupon->offer_value}}"> {{ $coupon->code}}</a></td>
                                            <td>{{ $coupon->voucher_type}}</td>
                                            <td>{{ $coupon->created_at}}</td>
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
    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script>

        $(document).ready(function(e) {

            $('#startdate').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#enddate').datepicker({
                format: 'yyyy-mm-dd'
            });

            var table = $('#offerlist').DataTable({
                paging:         true
            });

        });

    </script>
@stop