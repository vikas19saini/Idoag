@extends('layouts.default')

@section('title','Idoag.com')

@section('classtitle','login_bg')

@section('css')
    {{ HTML::style('assets/plugins/pikaday/pikaday.css') }}


@stop

@section('content')
<div class="activationstep2_bg">
    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('partials.flash')
        <div class="lostcard_wp">

            <div class="lostcardguest_info">
                <h4>You need to be logged on to your account<br/>
                    to request Duplicate Idoag card</h4>

                <div class="lostcardguest_list">
                    {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}
                        <div class="row lostcardguest_form">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group">
                                    {{ Form::email('email', null, ['placeholder' => 'Email Address', 'required' => 'required', 'class'=>'form-control', 'autocomplete' => 'off']) }}
                                    {{ errors_for('email', $errors) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'class'=>'form-control','autocomplete' => 'off']) }}
                                    {{ errors_for('password', $errors) }}
                                </div>
                                {{Form::hidden('url',URL::to('applycard'),['id'=>'get_url'])}}
                                <div class="lostcard_login">
                                    {{ Form::submit('Login') }}
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 orcenter"><p>OR</p></div>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group">
                                    <a href="{{ URL::to('facebook') }}" class="lostcardscocial_btns">Connect with Facebook</a>
                                    <a href="{{ URL::to('google') }}" class="lostcardscocial_btns redbtn">Connect with Google</a>  </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>

                <div class="lostcardguest_list lostcardguest_bottom">
                    <h4>Don't remember your account details?</h4>
                    <h5>Use <a href="{{ URL::to('forgot_password') }}">Forgot Password</a> to request new password if you know your registered email id.</h5>
                    <div class="or_cricle">
                        <span>OR</span></div>
                    <p>Let us know a few details so that we could help you with your account details</p>
                    <div class="submit_deatilsinfo">
                        <a href="#" class="submit_deatilsbtn"  data-toggle="modal" data-target="#recover_card">Submit Details</a></div>
                </div>
            </div>
        </div>
    </div></div>
	
	<!-- Modal -->
<div id="recover_card" class="modal fade" role="dialog">
  <div class="recover_card-dialog modal-dialog">

    <!-- Modal content-->
    <div class="modal-content recover_modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">{{ HTML::image('assets/images/popup_close.png') }}</button>
        <h4 class="modal-title text-center">Recover Your Card</h4>
      </div>
      <div class="modal-body recover_card-body">
          {{ Form::open(['class' => 'form-group activation_mobile','id' => 'recover_student_card']) }}
  <div class="form-group">
    <label class="control-label col-sm-4">Name</label>
    <div class="col-sm-8">
        {{ Form::text('name', null, ['required'=>'required','class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" >College </label>
    <div class="col-sm-8">
        {{ Form::text('college', null, ['class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4">Roll Number </label>
    <div class="col-sm-8">
        {{ Form::text('roll_number', null, ['class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4">Date of Birth </label>
    <div class="col-sm-8">
        {{ Form::text('dob', null, ['required'=>'required','id'=>'datepicker','placeholder'=>'dd-mm-yyyy','class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4">Card Number <small>(Optional)</small></label>
    <div class="col-sm-8">
        {{ Form::text('card_number', null, ['class' => 'form-control']) }}
    </div>
  </div>
          <div class="clear"></div>
  <div class="form-group">
    <label class="control-label col-sm-4">Message </label>
    <div class="col-sm-8">
        {{ Form::textarea('message', null, ['class' => 'form-control','cols'=>50,'rows'=>6]) }}
     </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-default" value="Submit">
    </div>
  </div>
          {{ Form::close() }}
          <div class="clear"></div>
      </div>
    </div>
  </div>
</div>

<!-- thankyou Registration -->
<div id="thankyou_reg" class="modal fade" role="dialog">
    <div class="modal-dialog thankyou_modal-dialog">

        <!-- Modal content-->
        <div class="modal-content institutions_modal-content">

            <button type="button" class="close" data-dismiss="modal">{{ HTML::image('/assets/images/popup_close.png') }}</button>

            <div class="modal-body thankyou_body">
                <h3>Thank you for corresponding.</h3>
                <p> We will get back to you as soon as we can</br>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- thankyou Registration end -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
    {{ HTML::script('assets/plugins/pikaday/moment.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.jquery.js') }}

    <script>

        $(document).ready(function(e) {

            var picker = new Pikaday(
                    {
                        field: document.getElementById('datepicker'),
                        firstDay: 1,
                        format: 'DD-MM-YYYY',
                        minDate: new Date(1930, 0, 1),
                        maxDate: new Date(2016, 12, 31),
                        yearRange: [1930,2016]
                    });

            $('#recover_student_card').formValidation({

                framework: 'bootstrap',

                excluded: [':disabled'],

                icon: {

                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                trigger: 'change',

                fields: {

                    name: {

                        validators: {

                            notEmpty: {

                                message: 'The Name is required and cannot be empty'

                            },
                            regexp: {

                                regexp: /^[a-z\s]+$/i,

                                message: 'The name can consist of alphabetical characters and spaces only'
                            }

                        }
                    },
                    college: {

                        validators: {

                            notEmpty: {

                                message: 'The College Name is required and cannot be empty'

                            },
                            regexp: {

                                regexp: /^[a-z\s]+$/i,

                                message: 'The College name can consist of alphabetical characters and spaces only'
                            }

                        }
                    },
                    roll_number: {

                        validators: {

                            notEmpty: {

                                message: 'The Roll Number is required and cannot be empty'

                            }

                        }
                    },
                    email: {

                        validators: {

                            notEmpty: {

                                message: 'The email input is required and cannot be empty'

                            },

                            regexp: {

                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',

                                message: 'The email input is not a valid email address'

                            }

                        }
                    },
                    card_number: {

                        validators: {

                            numeric: {

                                message: ' '
                            },

                            stringLength: {

                                min: 16,

                                max: 16,

                                message: 'The Card number must be 16 digits only'
                            },
                            remote: {

                                message: 'Given Card Number is not valid',

                                url: '/cardNumberExists',

                                data: { type: 'card_number' },

                                type: 'POST',

                                onSuccess: function(e, data) {

                                    console.log(data);

                                    $('.help-block').filter(function(index){return index == 6}).show();

                                    $("#recover_student_card").formValidation("updateMessage", "card_number", "remote", data.result.new_message);
                                },
                                onError: function(e, data) {

                                    $("#recover_student_card").formValidation("updateMessage", "card_number", "remote", data.result.new_message);
                                }
                            }
                        }
                    },
                    message: {

                        validators: {

                            notEmpty: {

                                message: 'Message Required'

                            }
                        }
                    }
                }

            }).on('success.form.fv', function(e) {

                $(".recover_card-body .load_info").show();

                e.preventDefault();

                var reg_form = $(e.target),fv = reg_form.data('formValidation');

                // Use Ajax to submit form data
                $.ajax({
                    url: '/cardRecoverIssue',
                    type: 'POST',
                    data: reg_form.serialize(),
                    success: function(response) {

                        $(".recover_card-body .load_info").hide();

                        $("#recover_card").hide();

                        $('#recover_student_card').trigger("reset");

                        reg_form.data('formValidation').resetForm();

                        $('#thankyou_reg').modal('show');

                        $("body").removeClass("modal-open");

                    }
                });

            });

        });
    </script>
@stop