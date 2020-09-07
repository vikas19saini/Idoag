<header class="mobile-menu">
    <div class="container">
        <div class="row inner-head">
            <div class="col-md-3 col-8">
                <div class="logo_img">
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
                        {{ HTML::image('assets/imagesv2/logo.png', 'Logo', array('class' => 'img-fluid')) }}
                    </a>
                    <!-- <p>Campus offers</p> -->
                </div>
            </div>
            <div class="col-md-9 col-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students' )
                            <li class="{{ (Request::is('offers') ? 'nav-item active' : 'nav-item') }}">
                                <a class="nav-link" href="{{ URL::route('offers') }}">{{ ($loggedin_user->user_type == 'student') ? 'CAMPUS OFFERS' : 'CORPORATE OFFERS' }}</a>
                            </li>
                            @else
                            <li class="{{ (Request::is('offers') ? 'nav-item active' : 'nav-item') }}">
                                <a class="nav-link" href="{{ URL::route('offers') }}">Campus offers</a>
                            </li>
                            <li class="{{ (Request::is('offers') ? 'nav-item active' : 'nav-item') }}">
                                <a class="nav-link" href="{{ URL::route('offers') }}">Corporate offers</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{Url::route('lostcard')}}" target="_blank">Lost card</a>
                            </li>
                            @if(isset($loggedin_user) && $loggedin_user)
                            <li><a  href="{{Url::route('logout')}}"><button type="button" class="login-btn" >Logout</button></a></li>
                            @else
                            <li><button type="button" class="login-btn" data-toggle="modal" data-target="#popUpWindow">Login</button></li>
							<li><a href="#activecart"><button type="button" class="active-crd">Activate card</button></a></li>
                            @endif
						</ul>
                    </div>
                </nav> 
				<a href="#activecart"><button type="button" class="active-crd mob_veiw">Activate card</button></a>
				<nav role="navigation" class="mobile_menu">
                    <div id="menuToggle">
                        <input type="checkbox" />
                        <span></span>
                        <span></span>
                        <span></span>
                        <ul id="menu">
                            <a href="{{ URL::route('offers') }}"><li>Campus offers</li></a>
                            <a href="{{ URL::route('offers') }}"><li>Corporate offers</li></a>
                            <a href="{{Url::route('lostcard')}}"><li>Lost card</li></a>
                            <a href="#" data-toggle="modal" data-target="#popUpWindow"><li>Login</li></a>
                        </ul>
                    </div>
                </nav>
            </div>
    <!--
        <div class="col-md-3 col-6 bdr_img">
        <div class="inner-user">
        <img src="images/user-img.jpg" alt="">
        <div class="user_1">
        <h5>Mathivanan</h5>
        <p>345667778889</p>
            </div>
            <i class="fa fa-bell" aria-hidden="true"></i>
            </div> 
    </div>
    -->
        </div>	
    </div>
</header>