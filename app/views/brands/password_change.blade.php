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

        @include('partials.flash')

    </div>
    <!-- Content Ends Here -->


    <div class="brand_password_change">

        <div class="brandoffer_info">

            <div class="container_info">

                <div class="postanewoffer_info">

                    <h3>{{HTML::Image('assets/images/note_img5.png')}} Password Change <a
                                href="{{ URL::route('brand_edit_profile', [$brand->slug]) }}"
                                class="btn btn-primary brand_password">Back</a></h3>

                    <?php //print_r($brand); ?>
                    {{Form::model($brand,['method' => 'POST','route' => ['passwordChange', $brand->slug],'class'=>'form-horizontal' ,'id'=>'brand_password_change_form','files'=>true])}}
                    <ul>
                        <li>

                            <div class="form-group">

                                <label class="col-sm-3">Current Password</label>

                                <div class="col-sm-8">

                                    {{ Form::password('prev_password', ['placeholder' => 'Current Password', 'id'=>'prev_password' , 'required' => 'required', 'class' =>'form-control','autocomplete' => 'off']) }}

                                    {{ errors_for('prev_password', $errors) }}

                                </div>

                            </div>


                            <div class="form-group">

                                <label class="col-sm-3">New Password</label>

                                <div class="col-sm-8">

                                    {{ Form::password('new_password', ['placeholder' => 'New Password', 'id'=>'new_password' , 'required' => 'required', 'class' =>'form-control','autocomplete' => 'off']) }}

                                    {{ errors_for('new_password', $errors) }}

                                </div>

                            </div>


                            <div class="form-group">

                                <label class="col-sm-3">Confirm New Password</label>

                                <div class="col-sm-8">

                                    {{ Form::password('password_confirmation', ['placeholder' => 'Confirm New Password','id'=>'confirm_password' ,'required' => 'required','class' =>'form-control', 'autocomplete' => 'off']) }}

                                    {{ errors_for('password_confirmation', $errors) }}

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-3"> </label>

                                <div class="col-sm-8 submit_button_center">

                                    {{form::submit('Submit',['class' => 'btn btn-primary submit_button_size'])}}

                                </div>

                            </div>

                    </ul>

                    {{Form::close();}}
                </div>
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

            $('#brand_password_change_form').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    prev_password: {
                        validators: {
                            stringLength: {
                                min: 6,
                                message: 'The password must be at least 6 characters'
                            }
                        }
                    },
                    new_password: {
                        validators: {
                            stringLength: {
                                min: 6,
                                message: 'The password must be at least 6 characters'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            identical: {
                                field: 'new_password',
                                message: 'The passwords do not match'
                            }
                        }
                    }
                }
            });

        });

    </script>

@stop