@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Offer Coupon Details')

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

                <h1>

                     Coupon Details

                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_offers') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
       </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-lg-12">

                        @include('admin.layouts.flash')

                        <div class="box box-primary">

                            <div class="box-body">
                                <p>
                                    <strong>Brand Name :</strong> {{ getBrandName($offer->brand_id)}}</p>
                                <p>
                                    <strong>Offer Name  :</strong> {{ $offer->name}}</p>
                                <p>
                                    <strong>Coupon Type  :</strong> {{ $offer->voucher_type}}</p>
                                <p>
                                    <strong>Coupons Used :</strong> {{ count($coupons_used)}}</p>
                                @if($offer->voucher_type=='single')
                                    <p>
                                        <strong>Coupon Code  :</strong> {{ $coupons->code}}</p>
                                @else
                                    <p>
                                        <strong>Coupons :</strong> {{ count($coupons)}}</p>
                                    <h4>Offer Coupons </h4>
                                    {{ Form::open(['route' => 'admin_coupons_actions', 'class' => 'form-horizontal']) }}

                                    <table id="couponslist" class="table table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Coupon Code</th>
                                            <th><input type="checkbox" name="selectall" value="all" id="checkall" /></th>

                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($coupons as $key=>$codes)
                                            <tr>

                                                <td>{{ $key+1 }}</td>

                                                <td>{{$codes->code}}</td>
                                                <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $codes->id }}"></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ Form::submit('Trash', ['name' => 'Trash',  'class' => 'btn btn-lg btn-danger']) }}
                                    {{ Form::close() }}

                                @endif
                                @if(count($coupons_used))
                                <h4>Users Used Coupons </h4>
                                <table id="offerslist" class="table table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Coupon Code</th>
                                        <th>User</th>
                                        <th>Used On</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($coupons_used as $key => $coupon)
                                             <tr>

                                                <td>{{ $key+1 }}</td>

                                                <td>{{$coupon->code}}</td>

                                                <td>{{ getUserName($coupon->user_id) }}</td>

                                                <td>{{ $coupon->created_at }}</td>

                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->

                    </div><!-- /.col -->

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

        $(document).ready(function(e) {

            var table = $('#offerslist').DataTable( {

                scrollY:        "700px",

                scrollX:        true,

                scrollCollapse: true,

                paging:         true

            } );

            var table = $('#couponslist').DataTable( {

                scrollY:        "700px",

                scrollX:        true,

                scrollCollapse: true,

                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 2 ] }
                ]


            } );

            $(document).on('click', '#checkall', function(e) {

                var cells = table.cells( ).nodes();

                $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));

            });

        });

    </script>

@stop