@extends('layouts.default')

@section('title', 'Idoag!  Update Offer - '.$brand->name)

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

                    <h3>{{ HTML::image('assets/images/note_img3.png') }} Update Offer</h3>

                    {{Form::model($offer,['method' => 'PATCH','route' => ['posts.update', $offer->id],'class'=>'edit-links-detail','files'=>true])}}

                    @include('partials.offer_form')

                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="Update Offer" class="submit_btn"></div>
                        </li>
                    </ul>

                    {{Form::close()}}

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

    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}

     {{HTML::script('packages/summernote/summernote.js')}}


    <script>

        $(document).ready(function (e) {

            $(".textarea").summernote();

            checksize('{{$offer->size}}');

            getVoucher($('#voucher_type').val());

            // $('#webonly').change(function() {
//                if (this.checked)
//                     {
//                        $('#panindia').addClass('hide');
//                    }
//                else
//                 {
//                    $('#panindia').removeClass('hide');
//                }

            //  });

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

            $("#store").multiselect({

                maxHeight: 200,
                buttonWidth: '650px',
                inheritClass: true,
                includeSelectAllOption: true,
                nonSelectedText: 'Select Address'
            });

            /* add datepicker */
            $('#start_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#end_date').datepicker({
                format: 'yyyy-mm-dd'
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
