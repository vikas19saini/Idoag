@extends('layouts.default')

@section('title', 'Idoag!  Update Photos - '.$brand->name)

@section('css')

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
                    <h3>{{ HTML::image('assets/images/note_img5.png') }} Update Photo</h3>

                    {{Form::model($photo,['method' => 'PATCH','route' => ['posts.update', $photo->id],'class'=>'edit-links-detail','files'=>true])}}

                    @include('partials.photo_form')

                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="Update Photo" class="submit_btn"></div>
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


     {{HTML::script('packages/summernote/summernote.js')}}

    <script>

        $(document).ready(function (e) {

            $(".textarea").summernote();

            checksize('{{$photo->size}}');

            /* upload photos image */



            $("#image").change(function () {
                 readURL(this);

            });

        });
        function readURL(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {

                    $('#photo_image_preview').attr('src', e.target.result).fadeIn('slow');
                };

                reader.readAsDataURL(input.files[0]);

            }

        }
    </script>

@stop