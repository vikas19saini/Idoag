@extends('layouts.default')

@section('title','Update Profile - View, update and manage your profile on IDOAG |idoag.com')

@section('metatags')
    <meta name="keywords" content="Update Profile - View, update and manage your profile on IDOAG |idoag.com" />
    <meta name="description" content="Update Profile - View, update and manage your profile on IDOAG |idoag.com" />
@stop

@section('css')
    {{ HTML::style('assets/css/custom_sonu.css') }}    
    {{ HTML::style('assets/plugins/colorpicker/bootstrap-colorpicker.min.css') }}
    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    {{ HTML::style('assets/plugins/pikaday/pikaday.css') }}
@stop

@section('content')
  
    <!-- Content Start Here -->
  	<div class="wrapper">
    
      <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('students.partials.student_profile')
        
        @include('partials.flash')
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="success_profile alert alert-success"><span></span>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>                      
        </div>

        <div class="danger_profile alert alert-danger change_success"><span></span>
            <a class="close">&times;</a>                      
        </div>

        {{--<a href="javascript:void(0);" onclick="javascript:introJs().start();">Help</a>--}}
        
        
        <div class='row row_div_bf_i'>
         <div class='row'>
            <div class='col-lg-2 col-md-2 col-sm-12 col-xs-12'>
               <div class='right_container personal_right onefi'>
                  @include('students.partials.profile_menu')
               </div>
            </div>
            <div class='col-lg-10 col-md-10 col-sm-12 col-xs-12'>
               <div class='bg_ried personal_detail_bg_ried page_weihgt'>
                  <h1>Personal Details</h1>
                  <div class='row_do'>
                     {{ Form::model($student, ['method' => 'POST','route' => ['studentprofile', $student->user_id], 'files' => true, 'class' => '','id' => 'edit-student-form']) }}
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>Name</p>
                              {{ Form::text('name',$student->name,['class' => 'form-control','required'=>'required','placeholder'=>'Click here to edit', 'pattern' => '[a-zA-Z\s]+', 'title' => 'Please enter your valid name']) }}                              
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>E-mail</p>
                              {{ Form::text('email_id', $user->email, ['placeholder' => 'Email', 'class' => 'form-control']) }}
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>Institute</p>
                              {{ Form::text('institution', getInstitutionName($student->institution_id), ['placeholder' => 'Institution', 'class' => 'form-control','readonly']) }}
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>Roll Number</p>
                              {{ Form::number('roll_no', $student->roll_no, ['placeholder' => 'Roll Number', 'class' => 'form-control']) }}
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>Expiry Date</p>
                              {{ Form::text('expiry', $student->expiry, ['placeholder' => 'Roll Number', 'class' => 'form-control','readonly']) }}
                           </div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>
                           <div class='row personal_detail_inenr_child'>
                              <p>Interests</p>
                              {{ Form::text('interests',$student->interests,['class' => 'form-control','required'=>'required','placeholder'=>'Click here to edit']) }}
                           </div>
                        </div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p>Date of Birth</p>
                           <div class="form-group">
                              <div class='input-group date'>
                                 {{ Form::text('dob', $student->dob, ['placeholder' => 'Date of Birth', 'class' => 'form-control', 'id' => 'datepicker']) }}
                                 <span class="input-group-addon ">
                                 <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p>Gender</p>
                           <div class="form-group">
                              <div class='input-group'>
                                 <select name='gender' class="form-control">
                                    @if($student->gender == 'Male')
                                        <option>Gender</option>
                                        <option selected>Male</option>
                                        <option>Female</option>
                                    @elseif($student->gender == 'Female')
                                        <option>Gender</option>
                                        <option>Male</option>
                                        <option selected>Female</option>
                                    @else
                                        <option selected>Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    @endif
                                 </select>
                                 <span class="input-group-addon">
                                 <span class="	glyphicon glyphicon-chevron-down"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p>Card No.</p>
                           {{ Form::text('card_number', $student->card_number, ['placeholder' => 'Roll Number', 'class' => 'form-control','readonly']) }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p> Current State</p>
                           <div class="form-group">
                              <div class='input-group'>
                                 {{ Form::select('state', array('' => 'Select State') + $states,  $student->state ,  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)'])}}
                                 <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-chevron-down"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p>Current City</p>
                           <div class="form-group">
                              <div class='input-group'>
                                 @if($student->city)
                                    {{Form::select('city',array('' => 'Select City')+$cities,$student->city,['class'=>'form-control','id'=>'cityId','required'])}}
                                @else
                                    {{Form::select('city',array('' => 'Select City'),'',['class'=>'form-control','id'=>'cityId','required'])}}
                                @endif
                                 <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-chevron-down"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 '>
                        <div class='row personal_detail_inenr_child'>
                           <p>Course</p>
                           <div class="form-group">
                              <div class='input-group'>
                                 {{ Form::text('course', $student->course, ['placeholder' => 'Course', 'class' => 'form-control']) }}                                 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class='inenr_child row'>
                        <p>Phone Number </p>
                        {{ Form::text('phone_no',$student->phone_no,['class' => 'with_border','required'=>'required','placeholder'=>'Click here to edit', 'pattern' => '[0-9]{10}', 'title' => 'Please enter a valid contact no.']) }}                        
                     </div>
                     <div class="clearfix"></div>
                     <div class='inenr_child row'>
                        <p>About Me </p>
                        {{ Form::textarea('aboutme',$student->aboutme,['size' => '30x2','class' => 'with_border','required'=>'required','placeholder'=>'Click here to edit']) }}                        
                     </div>
                     <div class='row_gn row'></div>
                     <div class='button_div_co row'>
                        <div class='button_row'>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>                              
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='rowd'>
                                  <button type='submit'>SAVE</buton>
                              </div>
                           </div>
                           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                               <button type="button" class='pull-right'><a style="color:inherit" href="{{URL::to('/')}}/student/education_details/{{$user->id}}">NEXT</a></button>
                           </div>
                        </div>
                     </div>
                     <div class='clearfix'></div>
                     {{form::close()}}
                  </div>
               </div>
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
    {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}
    {{ HTML::script('assets/plugins/pikaday/moment.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.js') }}
    {{ HTML::script('assets/plugins/pikaday/pikaday.jquery.js') }}

<script>

    $(function(){		
        var ww=$(window).innerWidth();

        $(".change_success .close").click(function(){
          $(this).parent(".change_success").hide();
        });

        $(".my-colorpicker1").colorpicker();

        $(".navbar-default .navbar-nav > li .submenu").width(ww);

        $( window ).resize(function() {
            var ww2=$(window).innerWidth();
            $(".navbar-default .navbar-nav > li .submenu").width(ww2);
        });

        $('.profile_pic').on('click', function() {
            $('#profile-image-upload').click();

        });

        $("#profile-image-upload").change(function(){

            var val = $(this).val().toLowerCase();
            
            var regex = new RegExp("(.*?)\.(jpg|png)$");
              
            if(!(regex.test(val))) {
          
                $(this).val('');
            }
            else
            {                
                readProfilePicURL(this);
            }            
        });

        $("#profile-image-upload").change(function() {            
            var formData = new FormData($('.profile_picture')[0]);
            $.ajax({
                url: '/uploadProfilePicture',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {                    
                    if (data.success)
                    {
                        $('.success_profile').show();
                        $('.success_profile span').show(); 
                        $('.success_profile span').html(data.message);
                    }
                    else
                    {   
                        $('.danger_profile').show();
                        $('.danger_profile span').show(); 
                        $('.danger_profile span').html(data.message);
                    }   
                },
                error: function() {
                    $('.success').html('<div class="error_msg"><span class="close"><img src="/assets/images/errorclose_icon.png"></span><p>'+data.message+'</p></div>');
                                
                }
            });
        });
        });

    $(window).load(function(){

        // $('.suggestedbrands_list ul').bxSlider({
        //     pager: false,
        //     auto:  true
        // });

        $('.new_class').hide();
        $('.change_class').hide();
        $('.danger_profile').hide();
        $('.success_profile').hide();
        $('.back_profile_btn').hide();
    	
    				
     if (RegExp('multipage', 'gi').test(window.location.search)) {
            introJs().start();
          }
    });
    function readProfilePicURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#offer_image_preview').attr('src', e.target.result).fadeIn('slow');
                $('#show_image_preview').attr('src', e.target.result).fadeIn('slow');            
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script>
        $(document).ready(function(){
            var picker = new Pikaday(
                {
                    field: document.getElementById('datepicker'),
                    firstDay: 1,
                    format: 'DD-MM-YYYY',
                    minDate: new Date(1930, 0, 1),
                    maxDate: new Date(2016, 12, 31),
                    yearRange: [1930, 2016]
                });
        });
    </script>

@stop
