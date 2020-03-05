@extends('layouts.default')

@section('title', 'Idoag!  Create Photos  - '.$brand->name)

@section('css')

    {{ HTML::style('assets/css/custom.css') }}
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
                    <h3>{{ HTML::image('assets/images/note_img5.png') }} POST A
                        PHOTO</h3>        {{Form::open(['route' => 'posts.store', 'class' => 'form-horizontal','id' => 'add-new-links-form', 'files' => 'true'])}}

                    @include('partials.photo_form')
                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="POST Photo" class="submit_btn"></div>
                        </li>
                    </ul>

                    {{Form::close()}}
                </div>
            </div>
        </div>
        <!-- Content Ends Here -->
    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

     {{HTML::script('packages/summernote/summernote.js')}}


    <script>

        $(document).ready(function (e) {

            $(".textarea").summernote();


            /* upload photos image */

            function readURL(input) {

                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('#photo_image_preview').attr('src', e.target.result).fadeIn('slow');
                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("#image").change(function () {

                readURL(this);

            });

        });

    </script>

@stop
