@extends('layouts.default')
@section('title', 'Idoag!  Create Text - '.$brand->name)


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
                    <h3>{{ HTML::image('assets/images/note_img.png') }} Post A Text</h3>
                    {{Form::open(['route' => 'posts.store', 'class' => 'form-horizontal','id' => 'add-new-links-form', 'files' => 'true'])}}

                    @include('partials.links_form')
                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="POST Text" class="submit_btn"></div>
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


    <!-- CK Editor -->
     {{HTML::script('packages/summernote/summernote.js')}}
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            $(".textarea").summernote();
        });
    </script>
    <script>

        $(document).ready(function (e) {

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

        });

    </script>

@stop
