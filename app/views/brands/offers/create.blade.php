@extends('layouts.default')

@section('title', 'Idoag!  Create Offers - '.$brand->name)

@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}

    {{HTML::style('packages/summernote/summernote.css')}}

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

                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val">{{ Form::submit('POST OFFER', array('class' => 'submit_btn')) }}</div>
                        </li>
                    </ul>



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

     {{HTML::script('packages/summernote/summernote.js')}}


    <script>

        $(document).ready(function (e) {

            $(".textarea").summernote();


            //$('#webonly').change(function() {

//          if (this.checked)
//           $('#panindia').hide();
//          else
//              $('#panindia').show();
            //  });

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false
            });

            /* add datepicker */
            $('#start_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#end_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $("#store").multiselect({

                maxHeight: 200,
                buttonWidth: '650px',
                inheritClass: true,
                includeSelectAllOption: true,
                nonSelectedText: 'Select address'
            });

            /* upload offers image */
            $("body").on('change', '.offer_image', function () {
                readURL(this);
            });

        });

        $(document).ready(function () {

            $('input[name=coupon_codes]').change(function () {

                var val = $(this).val().toLowerCase();

                var regex = new RegExp("(.*?)\.(xls|xlsx|csv)$");

                if (!(regex.test(val))) {

                    $(this).val('');

                    $('.choose_msg').html('<p> please upload a file format of excel</p>');
                }
                else {
                    $('.choose_msg').hide();
                }

            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {

                    $('.preview_offer').attr('src', e.target.result).fadeIn('slow');

                };

                reader.readAsDataURL(input.files[0]);

            }
        }

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


        function checkType(type) {
            $('#OfferType1').addClass('hide');
            $('#OfferType2').addClass('hide');
            if (type == "percentage") {
                $('#OfferType1').removeClass('hide');
                $('#offer_value1').attr('required', true);
                $('#offer_value2').attr('required', false);
            }
            if (type == "flat") {
                $('#OfferType2').removeClass('hide');
                $('#offer_value2').attr('required', true);
                $('#offer_value1').attr('required', false);
            }
        }
        function checkLocal(type) {
            $('#StateCity').addClass('hide');
            $('#Institution').addClass('hide');
            if (type == "Local" || type == 'India') {
                $('#StateCity').removeClass('hide');
            }
            if (type == "College") {
                $('#Institution').removeClass('hide');
            }
        }


    </script>

@stop