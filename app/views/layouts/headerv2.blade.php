<header class="mobile-menu">
    <div class="container">
        <div class="row inner-head">
            <div class="col-md-3 col-8">
                <div class="logo_img">
                    <a href="{{ URL::route('home') }}">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Campus offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Corporate offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Lost card</a>
                        </li>
                            <li><button type="button" class="login-btn" data-toggle="modal" data-target="#popUpWindow">Login</button></li>
                        </ul>
                    </div>
                </nav> 
                <nav role="navigation" class="mobile_menu">
                    <div id="menuToggle">
                        <input type="checkbox" />
                        <span></span>
                        <span></span>
                        <span></span>
                        <ul id="menu">
                            <a href="#"><li>Campus offers</li></a>
                            <a href="#"><li>Corporate offers</li></a>
                            <a href="#"><li>Lost card</li></a>
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