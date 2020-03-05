@extends('layouts.default')

@section('title','Idoag! '.$brand->name.' Profile Settings')

@section('css')

    {{ HTML::style('assets/plugins/colorpicker/bootstrap-colorpicker.min.css') }}

    {{ HTML::style('assets/plugins/multiselect/bootstrap-multiselect.css') }}


    @include('brands.partial.color')


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

                <h3>{{HTML::Image('assets/images/note_img5.png')}} Edit Brand <a
                            href="{{ URL::route('passwordChange', [$brand->slug]) }}"
                            class="btn btn-primary brand_password">Change Password</a></h3>

                <?php //print_r($brand); ?>
                {{Form::model($brand,['method' => 'PATCH','route' => ['brands.update', $brand->slug],'class'=>'edit-brand-detail','files'=>true])}}
                <ul>
                    <li>
                        <div class="nam_val">Name</div>
                        <div class="input_val">
                            {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
                            {{ errors_for('name', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">Description</div>
                        <div class="input_val">
                            {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}
                            {{ errors_for('description', $errors) }}
                        </div>
                    </li>
                    <li>
                        <div class="nam_val">Website</div>
                        <div class="input_val">
                            {{ Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control']) }}
                            {{ errors_for('url', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">Facebook</div>
                        <div class="input_val">
                            {{ Form::text('facebook', null, ['placeholder' => 'Facebook URL', 'class' => 'form-control']) }}
                            {{ errors_for('facebook', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">Twitter</div>
                        <div class="input_val">
                            {{ Form::text('twitter', null, ['placeholder' => 'Twitter URL', 'class' => 'form-control']) }}
                            {{ errors_for('twitter', $errors) }} </div>
                    </li>
                    <li>
                        <div class="nam_val">Dominant Color</div>
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
                        <div class="nam_val">Secondary Color</div>
                        <div class="input_val">
                            <div class="input-group my-colorpicker2" style="max-width:480px;">
                                {{ Form::text('color2', null, ['class' => 'form-control']) }}
                                <div class="input-group-addon">
                                    <i></i>
                                </div>
                            </div>
                            {{ errors_for('color2', $errors) }} </div>
                    </li>

                    <li>
                        <div class="nam_val">Category</div>
                        <div class="input_val">
                            <select id="category" name="category[]" multiple="multiple" class="form-control"
                                    required="required">
                                <?php $brand_categories = explode(",", $brand->category); ?>

                                @foreach($categories as $key => $category)

                                    @if(in_array($key, $brand_categories))

                                        <option value="{{ $key }}" selected="selected">{{ $category }}</option>
                                    @else

                                        <option value="{{ $key }}">{{ $category }}</option>
                                    @endif

                                @endforeach

                            </select>

                            {{ errors_for('category', $errors) }}
                        </div>
                    </li>
                    <li>
                        <div class="nam_val">Image</div>
                        <div class="input_val">
                            {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}

                            {{ errors_for('image', $errors) }}
                            @if($brand->image!='')
                                {{ HTML::image('uploads/brands/'.$brand->image, '', ['class' => 'slider-img', 'id' => 'brand_image_preview']) }}
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="nam_val">Cover Image</div>
                        <div class="input_val">
                            {{ Form::file('coverimage', null, ['class' => 'form-control', 'id' => 'coverimage']) }}

                            {{ errors_for('coverimage', $errors) }}

                            @if($brand->coverimage!='')
                            <div class="coverimage_view">
                                {{ HTML::image('uploads/brandcover/'.$brand->coverimage, '', ['class' => 'slider-img', 'id' => 'brand_coverimage_preview']) }}
                              <br/>  <a href="javascript:void(0);"  class="deletecover">Delete Cover Image</a></div>

                            @endif
                        </div>
                    </li>


                    <li>
                        <div class="nam_val"></div>
                        <div class="input_val">
                            {{ Form::submit('Update', ['class' => 'submit_btn']) }}
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

            $("#category").multiselect({

                maxHeight: 200,
                buttonWidth: '480px',
                inheritClass: true,
                includeSelectAllOption: true,
                nonSelectedText: 'Select Categories'
            });


            $(".my-colorpicker1").colorpicker();

            $(".my-colorpicker2").colorpicker();

            $('.deletecover').on('click', function () {

                  var data = "brand_id= {{$brand->id}}";

                $.ajax({
                    url: '/brandDeleteCoverImage',
                    type: 'POST',
                    data: data,

                    success: function (response) {
                        if (response) {
                             $('.coverimage_view').html(response.message);
                        }

                    }
                });
            });

        });

    </script>

@stop