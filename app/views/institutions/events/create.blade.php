@extends('layouts.default')

@section('title', 'Idoag!  Create Event - '.$institution->name)

@section('css')
    {{HTML::style('packages/summernote/summernote.css')}}

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    {{ HTML::style('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}

    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->


        <!-- B inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Institution inner Nav End here -->


        <div class="brandoffer_info">
            <div class="container_info">

                <div class="postanewoffer_info">


                    <h3>{{ HTML::image('assets/images/events_icon.png') }} POST A NEW EVENT</h3>

                    {{ Form::open(['route' => 'inst_posts.store', 'class' => 'events-form','id' => 'events-form', 'files' => 'true']) }}

                    @include('partials.inst_events_form')
                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="POST EVENT" class="submit_btn"></div>
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
     {{HTML::script('packages/summernote/summernote.js')}}

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
    {{ HTML::script('https://www.google.com/recaptcha/api.js') }}
    {{ HTML::script('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}

   
    <script>

        $(document).ready(function (e) {

            $(".textarea").summernote();


            /* add datepicker */
            $('#start_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            $('#end_date').datepicker({
                format: 'dd-mm-yyyy',
            });

            $(".timepicker").timepicker({
                showInputs: false
            });

            /* upload events image */

            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.preview_event').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("body").on('change', '.event_image', function () {

                readURL(this);

            });

        });


    </script>

@stop
