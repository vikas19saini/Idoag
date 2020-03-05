<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    
    <title>@yield('title')</title>
    
    <link rel="shortcut icon" href="/favicon.ico">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="">
    
    <meta name="author" content="">

    @yield('metatags')    
       
    {{ HTML::style('assets/bootstrap/css/bootstrap.min.css') }}
    
    {{ HTML::style('assets/font-awesome/css/font-awesome.min.css') }}
    
    {{ HTML::style('assets/css/AdminLTE.css') }}
    
    {{ HTML::style('assets/css/custom.css') }}
    
    {{ HTML::style('assets/css/skins/skin-blue.min.css') }}
    
    {{ HTML::style('assets/plugins/formValidation/formValidation.min.css') }}


    @yield('css')
    
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
    
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
    
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
    
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
    
    <link rel="shortcut icon" href="img/favicon.png">

</head>

<body class="@yield('class')">
	
   	@yield('content')
    
    {{ HTML::script('assets/js/jquery.min.js') }}
        
    {{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}    
    
    {{ HTML::script('assets/js/admin-script.js') }}
    
    {{ HTML::script('assets/plugins/formValidation/formValidation.min.js') }}
	
    {{ HTML::script('assets/plugins/formValidation/bootstrap.min.js') }}

    {{ HTML::script('assets/js/script.js') }}
    
    @yield('js')
	
</body>

</html>
