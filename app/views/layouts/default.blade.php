<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Event">
    <head>
        <meta charset="utf-8">    
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Idoag.com">
        @yield('metatags')
        {{ HTML::style('assets/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('assets/bootstrap/css/custom.css') }}
        {{ HTML::style('assets/css/font/stylesheet.css') }}
        {{ HTML::style('assets/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/webslidemenu.css') }}
        {{ HTML::style('assets/plugins/formValidation/formValidation.min.css') }}
        {{ HTML::style('assets/css/sweetalert.css') }}
        {{ HTML::style('assets/css/jquery.mCustomScrollbar.css') }}
        {{ HTML::style('assets/css/jquery.bxslider.css') }}
        {{ HTML::style('assets/css/introjs.css') }}
        {{ HTML::style('assets/css/style.css') }}
        {{ HTML::style('assets/css/responsive.css') }}        
        {{ HTML::style('assets/css/animate.css') }}
        {{ HTML::style('assets/bootstrap/css/custom2.css') }}
        @if(isset($loggedin_user) && $user_group == 'Students')
            @include('students.partials.color')
        @else
            @include('students.partials.color2')
        @endif
        @yield('css')
        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="/favicon.ico">
        <!-- Begin Inspectlet Asynchronous Code -->
            <script type="text/javascript">
            (function() {
            window.__insp = window.__insp || [];
            __insp.push(['wid', 718393848]);
            var ldinsp = function(){
            if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=718393848&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
            setTimeout(ldinsp, 0);
            })();
            </script>
        <!-- End Inspectlet Asynchronous Code -->
    </head>

    <body class="@yield('classtitle') loadin_fix">
        <div class="div_back_main offer_div_back_main">
        <script>

            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-53544017-1', 'auto');
            ga('send', 'pageview');

        </script>

        <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
            _atrk_opts = {atrk_acct: "vIdKm1akGFL1fn", domain: "idoag.com", dynamic: true};
            (function () {
                var as = document.createElement('script'); as.type = 'text/javascript';
                as.async = true;
                as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js";
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(as, s);
            })();
        </script>
        <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=vIdKm1akGFL1fn" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- End Alexa Certify Javascript --> 

        <div class="loading_ope">

            @yield('content')

        </div>

        {{ HTML::script('assets/js/jquery.min.js') }}
        {{ HTML::script('assets/js/jquery.mCustomScrollbar.js') }}
        {{ HTML::script('assets/js/webslidemenu.js') }}
        {{ HTML::script('assets/js/jquery.bxslider.js') }}
        {{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('assets/plugins/formValidation/formValidation.min.js') }}
        {{ HTML::script('assets/plugins/formValidation/addons/reCaptcha2.min.js') }}
        {{ HTML::script('assets/plugins/formValidation/bootstrap.min.js') }}
        {{ HTML::script('assets/js/readmore.js') }}
        {{ HTML::script('assets/js/script.js') }}
        {{ HTML::script('assets/js/sweetalert-dev.js') }}
        {{ HTML::script('assets/js/intro.js') }}
        {{ HTML::script('assets/js/share.js') }}


        <script>

            $(function () {

                $('[data-toggle="tooltip"]').tooltip();

                var ww = $(window).innerWidth();

                $(".navbar-default .navbar-nav > li .submenu").width(ww);

                $(window).resize(function () {

                    var ww2 = $(window).innerWidth();

                    $(".navbar-default .navbar-nav > li .submenu").width(ww2);

                });

                $(document).on('click', '.help_intro', function () {
                    $("body").addClass("intro_fixed");
                });

                $(document).on('click', '.introjs-skipbutton, .introjs-overlay', function () {
                    $("body").removeClass("intro_fixed");
                });

                var wh = $(window).height();
                var bh = $("body").innerHeight();

                $(window).resize(function () {
                    wh = $(window).height();
                    bh = $("body").innerHeight();
                });


                $(window).scroll(function () {
                    if (bh >= (wh + 200)) {
                        if (!$("body").hasClass("intro_fixed")) {
                            if ($(window).scrollTop() >= 100) {
                                $("header").addClass("fixed");
                                $(".wrapper").addClass("wrapperfixed");

                            } else {
                                $("header").removeClass("fixed");
                                $(".wrapper").removeClass("wrapperfixed");

                            }
                        }
                    }
                });

                $("#content-3").mCustomScrollbar({
                    scrollButtons: {enable: true},
                    theme: "light-thick",
                    scrollbarPosition: "outside"
                });
            });


            $(window).load(function () {

                $('.mybrandslider_info').bxSlider({

                    minSlides: 1,
                    maxSlides: 5,
                    slideWidth: 154,
                    infiniteLoop: false,
                    pager: false,
                    moveSlides: 1,
                    slideMargin: 10
                });
            });

        </script>


        <script type="text/javascript">
            $(window).load(function () {
                $(".load_info").hide();
                $("body").removeClass("loadin_fix");
            });

            $(document).keyup(function (e) {
                if (e.keyCode == 27) {
                    if ($("#login_required").hasClass("in")) {
                        $("#login_required").hide();
                        $(".login_btnpop.active_pop").trigger("click");
                    }
                }
            });

            $(".login_btnpop").click(function () {
                $(this).toggleClass("active_pop");
            });
            $(function () {

                var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

                $('a[data-modal-id]').click(function (e) {
                    e.preventDefault();
                    $("body").append(appendthis);
                    $(".modal-overlay").fadeTo(500, 0.7);
                    var modalBox = $(this).attr('data-modal-id');
                    $('#' + modalBox).fadeIn($(this).data());
                });


                $(".js-modal-close, .modal-overlay").click(function () {
                    $(".modal-box, .modal-overlay").fadeOut(500, function () {
                        $(".modal-overlay").remove();
                    });

                });

                $(window).resize(function () {
                    $(".modal-box").css({
                        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
                    });
                });

                $(window).resize();

            });
            $(".help_area").click(function (){
                 $(".help_form").addClass("active");  
                 $(".help_area").addClass("active");  

            });
            $(".help_form>h2>span").click(function (){
                 $(".help_form").removeClass("active");  
                 $(".help_area").removeClass("active");  

            });
        </script>



        @yield('js')

        <div class="load_info">
            <div class="load_img">
                {{ HTML::image('assets/images/loading.gif', 'Loading') }}
            </div>
        </div>
        </div>
    </body>



</html>