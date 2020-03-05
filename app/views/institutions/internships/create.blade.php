@extends('layouts.default')

@section('title', 'Idoag!  Create Internship - '.$brand->name)

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


                    <h3>{{ HTML::image('assets/images/note_img4.png') }} POST A NEW INTERNSHIP</h3>

                    {{ Form::open(['route' => 'posts.store', 'class' => 'offers-form','id' => 'offers-form', 'files' => 'true']) }}

                    @include('partials.internship_form')

                    <input type="submit" value="POST INTERNSHIP" class="submit_btn">

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

    <script>

        $(document).ready(function (e) {


            /* add datepicker */
            $('#start_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            $('#end_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            /* upload internships image */

            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.preview_internship').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("body").on('change', '.internship_image', function () {

                readURL(this);

            });

        });


    </script>

@stop
