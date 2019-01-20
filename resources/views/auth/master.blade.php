<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRMS - @yield('page-title')</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/core.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        body {
      font-family: Poppins, sans-serif !important;  
    }
    </style>
    @yield('page-css')
</head>

<body class="min-h-fullscreen bg-img center-vh p-20" style="background-image: url({{asset('images/login-bg-2.jpg')}});background-position:bottom">
    @yield('content')
    <script type="text/javascript" src="{{asset('js/core.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @include('sweetalert::alert')
</body>

</html>
