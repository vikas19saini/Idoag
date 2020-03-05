<div class="wsmenucontainer clearfix">
    <header>
        <div class="wsmenuexpandermain slideRight">
            <a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
        </div>

        <div class="wrapper clearfix bigmegamenu">
            <div class="wsmenucontent overlapblackbg"></div>
            <div class="logo_nav_info">
                <div class="logo clearfix">
                    @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students')
                        <a href="{{ URL::route('student_dashboard')}}">
                            @elseif(isset($loggedin_user) && $loggedin_user && $user_group == 'Admins')
                                <a href="{{URL::route('admin_dashboard')}}">
                                    @elseif(isset($loggedin_user) && $loggedin_user && $user_group == 'Brands')
                                        <a href="{{URL::route('brand_profile',array(getBrandSlug($loggedin_user->brand_id)))}}">
                                            @elseif(isset($loggedin_user) && $loggedin_user && $user_group == 'Institutions')
                                                <a href="{{URL::route('institution_profile',array(getInstitutionSlug($loggedin_user->institution_id)))}}">

                                                    @else

                                                        <a href="{{ URL::route('home') }}">

                                                            @endif

                                                            {{ HTML::image('uploads/th_logo.png', 'Logo') }} </a>

                </div>

                <nav class="wsmenu slideLeft clearfix">
                    <ul class="mobile-sub wsmenu-list">
                        @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students' )
                            <li  class="{{ (Request::is('offers') ? 'active' : '') }}">
                                <a href="{{ URL::route('offers') }}"> {{ ($loggedin_user->user_type == 'student') ? 'CAMPUS OFFERS' : 'CORPORATE OFFERS' }} </a>
                                @include('students.partials.offers_navbar')
                            </li>
                         @else
                            <li  class="{{ (Request::is('offers') ? 'active' : '') }}">
                                <a href="{{ URL::route('offers') }}"> CAMPUS OFFERS </a>
                            </li>
                            <li class="{{ (Request::is('offers') ? 'active' : '') }}">
                                <a href="{{ URL::route('offers') }}"> CORPORATE OFFERS </a>
                            </li>
                         @endif
                        <li><a href="{{Url::route('lostcard')}}" target="_blank">LOST CARD</a></li>
                    </ul>
                </nav>
            </div>

            @if(isset($loggedin_user) && $loggedin_user)
                <div class="social_search_info">
                    @if($user_group=="Students")
                    <div class="notification_link">
                        <a href="{{URL::route('activitylog',array($loggedin_user->id))}}">
                        <i class="fa fa-bell-o"></i>
                          @if($user_activity>0)  <span class="label label-warning">{{$user_activity}}</span>@endif
                        </a>
                    </div> 
                    @endif 

                    <ul class="nav navbar-nav navbar-right user_nav">

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  @if($user_group=="Students" && Request::is('student/dashboard')) data-step="4" data-intro="Click on Name to navigate to profile, activity log." data-position='left' @endif><span class="profile_txt">{{ HTML::image('assets/images/userprofile_icon.png') }}</span> <em> {{ ucfirst($loggedin_user->first_name) }} <span class="caret"></span></em></a>

                            <ul class="dropdown-menu user_nav_dropdown">

                                @if($user_group=="Students")
                                <li>
                                    <div class="user_pro_drop">
                                        {{ HTML::image('uploads/profiles/'.$loggedin_user->profile_image, '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}
                                        <p><b>{{ $loggedin_user->first_name }} {{ $loggedin_user->last_name }}</b></p>
                                        <p>{{ $loggedin_user->card_number }}</p>
                                        <hr/>
                                    </div>                                   
                                </li>
                                    <li><a href="{{URL::route('student_dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{URL::route('studentprofile',array($loggedin_user->id))}}">Edit Profile</a></li>
                                    <li><a href="{{URL::route('student_wishlist')}}">Wishlist</a></li>
                                    <!--<li><a href="{{URL::route('student_internships')}}">Applications</a></li>-->
                                    <li><a href="{{URL::route('activitylog',array($loggedin_user->id))}}">Activity log</a></li>
                                    
                                    @if(Route::currentRouteName()=='student_dashboard')
                                        <li>  <a  id="startButton" href="javascript:void(0);" class="help_intro">Help</a></li>
                                    @endif                                    
                                @endif

                                @if($user_group=="Brands")
                                    <li><a href="{{URL::route('brand_profile',array(getBrandSlug($loggedin_user->brand_id)))}}">Dashboard</a></li>
                                    <li><a href="{{URL::route('brand_edit_profile',array(getBrandSlug($loggedin_user->brand_id)))}}">Settings</a></li>
                                @endif

                                @if($user_group=="Institutions")
                                    <li><a href="{{URL::route('institution_profile',array(getInstitutionSlug($loggedin_user->institution_id)))}}">Dashboard</a></li>
                                @endif

                                @if($user_group=="Admins")
                                    <li><a href="{{URL::route('admin_dashboard')}}">Dashboard</a></li>
                                @endif

                                <li><a href="{{ URL::route('logout') }}">Logout</a></li>
                                <li>
                                        <ul class='social_pro_drop'>
                                            <li><a href="http://instagram.com/social.idoag" class='div_hover_div' target="_blank">{{ HTML::image('assets/images/ig_icon.png', 'Instagram') }}</a></li>
                                            <li><a href="https://www.facebook.com/idoag"  class='div_hover_div' target="_blank">{{ HTML::image('assets/images/fb_icon.png', 'Facebook') }}</a></li>
                                        </ul>
                                    </li>
                            </ul>

                        </li>

                    </ul>

                </div>


            @else

                <div class="login_detail">
                    <div class="no_logininfo">
                        <div class="social_txt">
                            <a href="{{Url::to('/')}}#activateyouridoag_info" class="haveanaccount_btn" id="activate-card" >
                                <em>Activate Card</em>
                            </a>
                        </div>
                    </div>
                    <div class="haveanaccount_txt">

                        <div class="haveanaccount_head">
                            <p><a class="haveanaccount_btn"><span class="profile_txt">{{ HTML::image('assets/images/userprofile_icon.png') }}</span> <em>log in <span class="caret"></span></em></a></p>
                        </div>

                        <div class="dropdown-menu login_dropdown_menu">

                            {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}

                            <div class="form-group">
                                {{ Form::email('email', null, ['placeholder' => 'Email Address', 'required' => 'required', 'autocomplete' => 'off']) }}
                                {{ errors_for('email', $errors) }}
                            </div>

                            <div class="form-group">
                                {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off']) }}
                                {{ errors_for('password', $errors) }}
                            </div>

                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                            </div>

                            {{ Form::submit('Login', array('class' => 'submitbtn')) }}

                            <div class="t-p5"><a href="#" data-modal-id="popup2" class="js-open-modal btn">Having Trouble Logging In?</a>
</div>
                            {{ Form::close() }}

                            <!--<div class="forgot_devider">
                                <h6>OR</h6>
                            </div>

                            <div class="fb_gp_btn">
                                <a href="{{ URL::to('facebook') }}" class="fbLogin">Connect with Facebook</a>
                                <a href="{{ URL::to('google') }}" class="gplusLogin">Connect with Google</a>
                            </div>-->

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </header>
    <div id="popup2" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>Having some trouble logging in?</h3>
  </header>
  <div class="modal-body">
   <div class="grid-01">
   <img src="assets/images/lock.jpg" alt="login">
   <br>
<div class="lins">
   <a href="{{URL::route('forgot_password')}}">Forgot Your Password?</a>
   </div>
   </div>



   <div class="grid-02">
   <img src="assets/images/email.jpg" alt="Email">

   <div class="lins">
   <a href="{{URL::route('trouble_login')}}">
   Forgot your email?  <br>/ Change your email <br>if you've enterd a wrong one.
   </a>
   </div>
   </div>

  </div>

</div>
