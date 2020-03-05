@extends('layouts.default')

@section('title', 'Idoag!  Create Offers - '.$brand->name)

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    @include('brands.partial.color')


@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->


        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->


        <div class="brandoffer_info">
            <div class="container_info">

                <div class="postanewoffer_info">


                    <h3>{{ HTML::image('assets/images/note_img3.png') }} POST A NEW OFFER</h3>

                    {{ Form::open(['route' => 'posts.store', 'class' => 'offers-form','id' => 'offers-form', 'files' => 'true']) }}

                    @include('partials.offer_form')

                    {{ Form::submit('POST OFFER', array('class' => 'submit_btn')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}

    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}

    <script>

        $(document).ready(function (e) {


            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });


            /* add datepicker */
            $('#start_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            $('#end_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            $("#store").multiselect({

                maxHeight: 200,
                buttonWidth: '650px',
                inheritClass: true,
                includeSelectAllOption: true,
                nonSelectedText: 'Select address'
            });

            /* upload offers image */

            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.preview_offer').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("body").on('change', '.offer_image', function () {

                readURL(this);

            });

        });

        function getVoucher(type) {
            $('#VoucherSingle').addClass('hide');
            $('#VoucherMultiple').addClass('hide');
            if (type == "single") {
                $('#VoucherSingle').removeClass('hide');
            }
            if (type == "multiple") {
                $('#VoucherMultiple').removeClass('hide');
            }


        }

    </script>

@stop