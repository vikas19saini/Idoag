@extends('layouts.default')

@section('title','Idoag! '.$institution->name.' Profile Settings')

@section('css')

    {{ HTML::style('assets/plugins/colorpicker/bootstrap-colorpicker.min.css') }}

    @include('institutions.partial.color')


@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

    </div>
    <!-- Content Ends Here -->

    <div class="brandoffer_info">
        <div class="container_info">
            <div class="postanewoffer_info">
                <h3>{{HTML::Image('assets/images/note_img5.png')}} Edit Institution <a
                            href="{{ URL::route('InstPasswordChange', [$institution->slug]) }}"
                            class="btn btn-primary brand_password">Change Password</a></h3>

                {{Form::model($institution,['method' => 'PATCH','route' => ['institutions.update', $institution->slug],'class'=>'edit-institution-detail','files'=>true])}}
                <ul>
                    <li>
                        <div class="nam_val">{{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                            {{ errors_for('name', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}
                            {{ errors_for('description', $errors) }}
                        </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('url', 'Site URL', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control']) }}
                            {{ errors_for('url', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('facebook', 'Facebook URL', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::text('facebook', null, ['placeholder' => 'Facebook URL', 'class' => 'form-control']) }}
                            {{ errors_for('facebook', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('twitter', 'Twitter URL', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::text('twitter', null, ['placeholder' => 'Twitter URL', 'class' => 'form-control']) }}
                            {{ errors_for('twitter', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('color1', 'Dominant Color', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            <div class="input-group my-colorpicker1" style="max-width:480px;">
                                {{ Form::text('color1', null, ['class' => 'form-control']) }}
                                <div class="input-group-addon">
                                    <i></i>
                                </div>
                            </div>

                            {{ errors_for('color1', $errors) }} </div>
                    </li>


                    <li>
                        <div class="nam_val">{{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::file('image',   ['required' => 'required', 'class' => 'institution_image', 'id' => 'image', 'required' => 'required']) }}

                            {{ errors_for('image', $errors) }}
                            @if($institution->image!='')
                                {{ HTML::image('uploads/institutions/'.$institution->image, '', ['class' => 'slider-img institution_image_preview']) }}
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="nam_val">{{ Form::label('coverimage', 'Cover Image', ['class' => 'col-sm-3 control-label']) }}</div>
                        <div class="input_val">
                            {{ Form::file('coverimage', ['required' => 'required', 'class' => 'institution_cover', 'id' => 'coverimage', 'required' => 'required']) }}

                            {{ errors_for('coverimage', $errors) }}
                            @if($institution->coverimage!='')
                                {{ HTML::image('uploads/instcover/'.$institution->coverimage, '', ['class' => 'slider-img institution_cover_preview']) }}
                            @endif
                        </div>
                    </li>


                    <li>
                        <div class="nam_val"></div>
                        <div class="input_val">
                            {{ Form::submit('Update Institution', ['class' => 'submit_btn']) }}
                        </div>
                    </li>

                </ul>
                {{Form::close();}}
            </div>
        </div>
    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')
    {{ HTML::script('assets/plugins/multiselect/bootstrap-multiselect.js') }}

    {{ HTML::script('assets/plugins/colorpicker/bootstrap-colorpicker.min.js') }}

    <script>

        $(function () {


            $(".my-colorpicker1").colorpicker();


            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.institution_image_preview').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            function readCoverURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.institution_cover_preview').attr('src', e.target.result).fadeIn('slow');

                    };

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("body").on('change', '.institution_image', function () {

                readURL(this);

            });

            $("body").on('change', '.institution_cover', function () {

                readCoverURL(this);

            });
        });

    </script>

@stop