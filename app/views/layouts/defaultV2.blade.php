<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Event">
    <head>
        <meta charset="utf-8">    
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Idoag.com">
        @yield('metatags')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        {{ HTML::style('assets/cssv2/bootstrap.min.css') }}
        {{ HTML::style('assets/cssv2/style.css') }}
        {{ HTML::style('assets/cssv2/responsive.css') }}
        {{ HTML::style('assets/cssv2/owl.carousel.css') }}
        {{ HTML::style('assets/cssv2/animate.min.css') }} 
        {{ HTML::style('assets/plugins/formValidation/formValidation.min.css') }}     
        
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

            @include('partials.login')
            @include('partials.getInTouch')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
         
        {{ HTML::script('assets/plugins/formValidation/formValidation.min.js') }}        
        {{ HTML::script('assets/plugins/formValidation/bootstrap.min.js') }}
        {{ HTML::script('assets/jsv2/bootstrap.min.js') }}
        {{ HTML::script('assets/jsv2/owl.carousel.js') }}
        {{ HTML::script('assets/jsv2/custom.js') }}
        {{ HTML::script('assets/jsv2/wow.js') }}
        
        @yield('js')

        
        </div>
    </body>



</html>