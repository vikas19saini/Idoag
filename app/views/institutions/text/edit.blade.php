@extends('layouts.default')

@section('title', 'Idoag!  Update Text - '.$institution->name)

@section('css')
    {{HTML::style('packages/summernote/summernote.css')}}

    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->


        <!-- Brand inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class="brandoffer_info">
            <div class="container_info">
                <div class="postanewoffer_info">
                    <h3>{{ HTML::image('assets/images/note_img.png') }} Update a Link</h3>

                    {{Form::model($links,['method' => 'PATCH','route' => ['inst_posts.update', $links->id],'class'=>'edit-links-detail','files'=>true])}}

                     @include('partials.inst_links_form')
                    <ul>
                        <li>
                            <div class="nam_val"></div>
                            <div class="input_val"><input type="submit" value="Update LINK" class="submit_btn"></div>
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
@stop
