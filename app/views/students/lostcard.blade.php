@extends('layouts.default')

@section('title','Idoag.com')

@section('classtitle','login_bg')

@section('css')


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

                <div class="lostcard_info">
                    <h2>Lost Card</h2>
                    <h5>Card Number: <span>9586 5896 3251 4526</span></h5>

                    <div class="person_details">
                        <h4>Personal Details</h4>
                        <ul>
                            <li><span>Name :</span><span>{{$student->name}}</span></li>
                            <li><span>College :</span><span>{{getInstitutionName($student->institution_id)}}</span></li>

                            <li> <div id="viewemail"><span>Email :</span><span>{{$user->email}} <a href="#" onclick="email()"><i class="fa fa-pencil"></i></a></span></div>
                                <div id="editemail" class="addressform_list hide">
                                    <span>Email :</span><span  class="form-group"> <input type="text" name="email" class="form-control" value="{{$user->email}}"></span>
                                </div>
                            </li>
                            <li><div id="viewphone"><span>Phone :</span><span>{{$user->mobile}} <a href="#" onclick="phone()"><i class="fa fa-pencil"></i></a></span></div>
                                <div id="editphone" class="addressform_list hide">
                                    <span>Phone :</span><span  class="form-group"> <input type="text" name="phone" class="form-control" value="{{$user->mobile}}"></span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="person_details">
                        <h4>Address</h4>
                        <div class="row addressform">
                                 <div class="col-md-12 col-sm-12 col-xs-12 addressform_list">
                                    <div class="form-group">
                                        <label>Address Line 1:</label>
                                        <input type="text" name="address1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 2:</label>
                                        <input type="text" name="address2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>State:</label>
                                        {{ Form::select('state', array('' => 'Select State') + $states,  'null' ,  ['class' => 'form-control', 'id' => 'stateId','onchange' => 'getCity(this.value)'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>City:</label>
                                        {{Form::select('city',array('' => 'Select City'),'null',['class'=>'form-control','id'=>'cityId'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>Pincode:</label>
                                        <input type="text" name="pincode" id="pincode" class="form-control">
                                    </div>

                                    <div class="form-group emptyspace">
                                        <label>&nbsp;</label>
                                        <span class="check_avilab"><a class="checkpin">Check Availability</a></span></div>

                                </div>
                            <div class="alert alert-success hide  avilablestatus">
                                <span></span>
                                <a class="close">&times;</a>
                            </div>
                            <div class="alert alert-danger hide avilablestatus2">
                                <span></span>
                                <a class="close">&times;</a>

                            </div>
                         </div>
                    </div>

                    <div class="person_details payment_details">
                        <h4>Payment Details</h4>
                        <ul>
                            <li><span>Amount:</span><span><i class="fa fa-inr"></i> 100</span></li>
                            <li><span>Have you a coupon:</span><span class="apply_txt"><i class="applycode"><input type="text" class="form-control" name="coupon" id="coupon"></i><a class="checkcoupon">Apply</a></span>
                                <div class="alert alert-success hide  couponstatus">
                                    <span></span>
                                    <a class="close">&times;</a>
                                </div>
                                <div class="alert alert-danger hide couponstatus2">
                                    <span></span>
                                    <a class="close">&times;</a>

                                </div>

                            </li>

                            <li><span>Shipping Charges:</span><span><i class="fa fa-inr"></i> 40</span></li>
                            <li class="hide" id="couponamount"></li>
                        </ul>
                        <h5>Payable Amount:<span><i class="fa fa-inr"></i> <b id="amount">140</b></span></h5>
                        <div class="lostcard_pay">
                            <input type="submit" id="pay" name="pay" value="Pay" style="display: none">
                        </div>
                        <p>Note: Please note that we do not store your card details with us and payment will be processed through<br/>
                            secure payment gateway</p>
                    </div>
                </div>
            </div>
        </div></div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $(".avilablestatus .close").click(function(){
                $(this).parent(".avilablestatus").addClass('hide');
            });
            $(".avilablestatus2 .close").click(function(){
                $(this).parent(".avilablestatus2").addClass('hide');
            });
            $(".couponstatus .close").click(function(){
                $(this).parent(".couponstatus").addClass('hide');
            });
            $(".couponstatus2 .close").click(function(){
                $(this).parent(".couponstatus2").addClass('hide');
            });
        });

    function email() {
    $('#viewemail').addClass('hide');
    $('#editemail').addClass('show');
    }
    function phone() {
        $('#viewphone').addClass('hide');
        $('#editphone').addClass('show');
    }

    $('.checkpin').on('click', function () {

        var pincode = $('#pincode').val();

        var data = "pincode=" + pincode;

        $.ajax({
            url: '/CheckPinCode',
            type: 'POST',
            data: data,

            success: function (response) {

                console.log(response.data);
                if(response) {

                    if (response.status == 1) {
                        $('.avilablestatus').removeClass('hide');
                        $('.avilablestatus').removeClass('hide');
                        $('.avilablestatus2').addClass('hide');
                        $('.avilablestatus span').html(response.data);
                        $('#pay').show();
                      }
                    else {
                        $('.avilablestatus2').removeClass('hide');
                        $('.avilablestatus2').removeClass('hide');
                        $('.avilablestatus').addClass('hide');
                        $('.avilablestatus2 span').html(response.data);
                        $('#pay').hide();
                    }
                }

            }
        });
    });

    $('.checkcoupon').on('click', function () {

        var coupon = $('#coupon').val();

        var data = "coupon=" + coupon;

        $.ajax({
            url: '/CheckCardCoupon',
            type: 'POST',
            data: data,

            success: function (response) {

                console.log(response.data);
                if(response) {

                    if (response.status == 1) {
                        $('.couponstatus').removeClass('hide');
                        $('.couponstatus').removeClass('hide');
                        $('#couponamount').removeClass('hide');
                        $('.couponstatus2').addClass('hide');
                        $('.couponstatus').html(response.data);
                        $('#couponamount').html('<span>Discount:</span><span><i class="fa fa-inr"></i> '+response.amount+'</span>');
                        $('#amount').html(140-response.amount);

                    }
                    else {
                        $('.couponstatus2').removeClass('hide');
                        $('.couponstatus2').removeClass('hide');
                        $('.couponstatus').addClass('hide');
                        $('#couponamount').addClass('hide');
                        $('.couponstatus2 span').html(response.data);
                     }
                }

            }
          });
        });
    </script>
@stop