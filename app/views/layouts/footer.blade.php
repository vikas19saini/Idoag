<footer class="main-footer-wrapper" @if(isset($user_group) && $user_group=="Students" && Request::is('student/dashboard')) class="studentdashboard_footer" @endif>
	<div class="container_info2 clearfix">
      	<div class="footer-box-01 clearfix">
      		<ul class="clearfix">
                <li class="first"><a href="{{ URL::route('about') }}"> About us </a></li>
                <li><a href="{{ URL::route('institutions') }}">Institution/Companies</a></li>
                <li>
                    <a href="{{ URL::route('brands') }}">Brands </a>                    
                </li>
                <li class="last"><a href="{{ URL::route('inst-register') }}">Register as college/University</a></li>
      		</ul>
            <ul class="clearfix">
                <li class="first"><a href="{{ URL::route('brand-register') }}">Register as Brand</a></li>
                <li><a href="{{ URL::route('press_list') }}">Testimonials</a></li>
                <li><a href="{{ URL::route('contactus') }}">Contact us</a></li>
                <li class="last"><a href="{{ URL::route('press_list') }}">Press</a></li>
            </ul>
      	</div>
        <div class="footer-box-02">
            <h4>SOCIAL</h4>
            <a href="http://instagram.com/social.idoag" target="_blank">{{ HTML::image('assets/images/ig_icon.png', 'Instagram') }}</a>
            <a href="https://www.facebook.com/idoag" target="_blank">{{ HTML::image('assets/images/fb_icon.png', 'Facebook') }}</a>
        </div>  
    </div>

    <div class="container_info3 clearfix">
        <div class="grid-01 clearfix">
            <ul>
                <li><a href="{{ URL::route('faq') }}">FAQ</a></li>
                <li><a href="{{ URL::route('tos') }}">Terms</a></li>
                <li><a href="{{ URL::route('privacy-policy') }}">Privacy policy</a></li>
                <li><a href="{{ URL::route('sitemap') }}">Sitemap</a></li>
                <li class="last"><a href="{{ URL::route('contactus') }}">Support</a></li>
            </ul>
        </div>
        <div class="grid-02"> (C) copyright, Belobog Solutions</div>
    </div>
</footer>

@if(!Sentry::check())

    <div id="login_required" class="modal fade" role="dialog">
        <div class="modal-dialog loginrequired_modal-dialog">

            <!-- Modal content-->
            <div class="modal-content loginrequired_modal-content">
                <div class="modal-header selectall_header">
                    <button type="button" class="close" data-dismiss="modal">{{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                    <h4 class="modal-title text-left">Login Required</h4>
                </div>
                <div class="modal-body loginrequired_modal-body">

                    {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}
                        <div class="form-group">
                            {{ Form::email('email', null, ['placeholder' => 'Enter your email','class'=>'form-control' ,'required' => 'required', 'autocomplete' => 'off']) }}
                            {{ errors_for('email', $errors) }}
                         </div>
                        <div class="form-group">
                            {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required','class'=>'form-control', 'id'=>'pwd', 'autocomplete' => 'off']) }}
                            {{ errors_for('password', $errors) }}
                         </div>

                        {{Form::hidden('url','',['id'=>'get_url'])}}

                        <div class="checkbox">
                            <label><input type="checkbox"> Remember Me</label>
                            <span class="forgotpwd"><a href="{{URL::route('forgot_password')}}">Forgot Password?</a></span>  
                        </div>
                        <div class="loginpopup-buttons">
                            {{ Form::submit('Login', array('class' => 'btn btn-default login_btn')) }}
                            <a href="{{Url::to('/')}}#activateyouridoag_info">
                                <button type="button" class="btn btn-default login_btn" style="width:auto">Activate Your Card</button>
                            </a>
                        </div>
                    {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="users-import2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Need Login</h4>
                </div>
                <div class="modal-body">
                    <h5>  <a href="/login">Login</a> or Sign up with Idoag Card.</h5>
                </div>
            </div>
        </div>
    </div>

@else

    <div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog thankyou_modal-dialog">
            <div class="modal-content institutions_modal-content">
                <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                <div class="modal-header">
                    <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body thankyou_body" id="frm_body"></div>
                <div class="modal-footer">
                    <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" data-toggle="modal"  id="frm_submit">Yes</button>
                    <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formConfirm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog thankyou_modal-dialog">
            <div class="modal-content institutions_modal-content">
                <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                <div class="modal-header">
                    <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body thankyou_body" id="frm_body"></div>
                <div class="modal-footer">
                    <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" id="frm_submit">Yes</button>
                    <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formConfirmSingle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog thankyou_modal-dialog">
            <div class="modal-content institutions_modal-content">
                <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                <div class="modal-header">
                    <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body thankyou_body" id="frm_body"></div>
                <div class="modal-footer">
                    <a href="#" style='margin-left:10px;' class="btn btn-primary col-sm-2 pull-right" id="frm_submit1">Yes</a>
                     <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formConfirmBkup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog thankyou_modal-dialog">
            <div class="modal-content institutions_modal-content">
                <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                <div class="modal-header">
                    <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body thankyou_body" id="frm_body"></div>
                <div class="modal-footer">
                    <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right formConfirm_yes" data-toggle="modal" data-target="#formConfirm2">Yes</button>
                    <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formConfirm2Bkup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog thankyou_modal-dialog">
            <div class="modal-content institutions_modal-content">
                <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
                <div class="modal-header">
                    <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body thankyou_body" id="frm_body"></div>
                <div class="modal-footer">
                    <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" id="frm_submit">Yes</button>
                    <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

@endif

<div class="help_area">
    <i class="fa fa-question-circle"></i> Help
</div>

<div class="help_form">
   <h2>Leave us a Message <span>&times;</span></h2>
   {{ Form::open(['url' => 'needhelp']) }}
      <div>
         <label>Your Name</label>
         {{Form::text('name',null,['placeholder' => 'Full Name', 'required' => 'required'])}}
      </div>
      <div>
         <label>E-mail Address</label>
         {{Form::text('email',null,['placeholder' => 'Email address',  'required' => 'required'])}}
      </div>
      <div>
         <label>Phone Number</label>
         {{Form::text('phone',null,['placeholder' => 'Valid contact number','required' => 'required'])}}
      </div>
      <div>
         <label>Message</label>
         {{Form::textarea('message',null,['placeholder' => 'How can we help you? ', 'rows' => 5])}}
      </div>
      <div>
		 {{ HTML::image('uploads/th_logo.png') }}
         {{ Form::button('SUBMIT', array('class' => 'help_button1', 'type' => 'submit')) }}
         <button type="reset" class="help_button2">CANCEL</button>
      </div>
   {{Form::close()}}
</div>